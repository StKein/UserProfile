<div class="profile_wrapper">
    <div class="profile_info_wrapper">
        <div class="profile_text_wrapper">
            <div class="profile_field">
                <span class="field_label"><?=$text_manager->getText("FieldTextName")?>: </span>
                <span class="field_text"><?=$user_data["name"]?></span>
            </div>
            <div class="profile_field">
                <span class="field_label"><?=$text_manager->getText("FieldTextSurname")?>: </span>
                <span class="field_text"><?=$user_data["surname"]?></span>
            </div>
            <div class="profile_field">
                <span class="field_label"><?=$text_manager->getText("FieldTextBirthDate")?>: </span>
                <span class="field_text"><?=$user_data["birth_date"]?></span>
            </div>
        </div>
	<?php if( $user_data["image"] ):?>
        <div class="profile_image_wrapper">
            <img class="profile_image" src="<?="/upload/user_images/".$user_data["image"]?>" />
        </div>
	<?php endif;?>
        <div class="_mod-clr"></div>
    </div>
    <div class="buttons_wrapper">
        <span class="button reg_button _tab_item" data-type="user_form"><?=$text_manager->getText("ActionTextEdit")?></span>
        <span class="button cancel_button _user_logout"><?=$text_manager->getText("ActionTextLogout")?></span>
    </div>
</div>