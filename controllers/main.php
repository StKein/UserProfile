<?php
if( $_SESSION["user"] ){
    include_once __DIR__."/../include/get_profile_manager.php";
    $user_data = $profile_manager->getProfileData();

    include_once __DIR__."/../views/profile.php";
} else {
    include_once __DIR__."/../views/login_form.php";
}
?>