<?php
/***
	Handles actions regarding user account
	Checking login availability, logging in/out, updating user profile
***/
session_start();
include_once __DIR__ . "/../engine/TextManager.php";
switch( $_POST["action"] ){
	case "check_login_availability":
		include_once __DIR__."/../include/get_account_manager.php";
		echo ( $account_manager->accountIsAvailable( $_POST["login"] ) ) ? '1' : '0';
		break;
	case "login":
		include_once __DIR__."/../include/get_account_manager.php";
		$response = array();
		if( $account_id = $account_manager->getAccountId( $_POST["data"]["login"], $_POST["data"]["pass"] ) ){
			$_SESSION["user"] = $account_id;
			$response["success"] = '1';
			$response["message"] = $text_manager->getText("ResponseLoginSuccess");
		} else {
			$response["error"] = '1';
			$response["message"] = $text_manager->getText("ResponseLoginError");
		}
		echo json_encode( $response, JSON_UNESCAPED_UNICODE );
		break;
    case "logout":
        unset( $_SESSION["user"] );
        break;
	case "update_profile":
        include_once __DIR__."/../include/get_profile_manager.php";
		$response = array();
		try{
			if( !$_SESSION["user"] ){
				// User not logged in - need to create account first
				include_once __DIR__."/../include/get_account_manager.php";
				$account_manager->createAccount( $_POST["login"], $_POST["pass"] );
				$_SESSION["user"] = $db->insert_id;
				$response["message"] = $text_manager->getText("ResponseCreateAccountSuccess");
			} else {
				$response["message"] = $text_manager->getText("ResponseUpdateProfileSuccess");
			}

			// If user attached image file and it has been successfully uploaded, store its name
            if( $_FILES["image"] && $filename = $profile_manager->uploadImage( $_FILES["image"] ) ){
                $_POST["image"] = $filename;
            }
			
			$profile_manager->updateProfile( $_POST );
			$response["success"] = '1';
		} catch( Exception $e ){
			$response["error"] = '1';
			$response["message"] = $text_manager->getText( $e->getMessage() );
		}
		echo json_encode( $response, JSON_UNESCAPED_UNICODE );
		break;
}
?>