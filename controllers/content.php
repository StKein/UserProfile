<?php
/***
	Handles content actions: loading additional content, switching language
***/
session_start();
include_once __DIR__ . "/../engine/TextManager.php";
switch( $_POST["action"] ){
	case "load_user_form":
		if( $_SESSION["user"] ){
			include_once __DIR__."/../include/get_profile_manager.php";
			$user_data = $profile_manager->getProfileData();
		} else {
			$user_data = array();
			$user_data["birth_date"] = date("Y-m-d");
		}
		include_once __DIR__."/../views/user_form.php";
		break;
    case "load_profile":
        include_once __DIR__."/main.php";
        break;
    case "change_language":
        $_SESSION["language"] = $_POST["language"];
        break;
}
?>