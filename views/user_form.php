<div class="form_wrapper user_form_wrapper">
    <div class="upper_text_wrapper">
        <span class="upper_text"><?=$text_manager->getText("UserFormHeader")?></span>
    </div>
    <form class="form user_form _user_form">
	<?php if( !$_SESSION["user"] ):?>
        <div class="field_wrapper user_field_wrapper">
            <span class="field_label"><?=$text_manager->getText("FieldTextLogin")?>:</span>
            <input name="login" type="text" class="field_text_input _user_form_input _required_field"
                   placeholder="<?=$text_manager->getText("FieldPlaceholderLogin")?>" data-validation_type="login" />
            <div class="field_error_wrapper">
                <div class="field_error field_invalid_message"><?=$text_manager->getText("FieldErrorLogin")?></div>
                <div class="field_error field_unavailable_message"><?=$text_manager->getText("FieldErrorLoginUnavailable")?></div>
            </div>
        </div>
        <div class="field_wrapper user_field_wrapper">
            <span class="field_label"><?=$text_manager->getText("FieldTextPassword")?>:</span>
            <input name="pass" type="text" class="field_text_input _user_form_input _required_field"
                   placeholder="<?=$text_manager->getText("FieldPlaceholderPassword")?>" data-validation_type="password" />
            <div class="field_error_wrapper">
                <div class="field_error field_invalid_message"><?=$text_manager->getText("FieldErrorPassword")?></div>
            </div>
        </div>
	<?php endif;?>
        <div class="field_wrapper user_field_wrapper">
            <span class="field_label"><?=$text_manager->getText("FieldTextName")?>:</span>
            <input name="name" type="text" class="field_text_input _user_form_input _required_field" 
					placeholder="<?=$text_manager->getText("FieldPlaceholderName")?>" value="<?=$user_data["name"]?>" data-validation_type="name" />
            <div class="field_error_wrapper">
                <div class="field_error field_invalid_message"><?=$text_manager->getText("FieldErrorName")?></div>
            </div>
        </div>
        <div class="field_wrapper user_field_wrapper">
            <span class="field_label"><?=$text_manager->getText("FieldTextSurname")?>:</span>
            <input name="surname" type="text" class="field_text_input _user_form_input _required_field" 
					placeholder="<?=$text_manager->getText("FieldPlaceholderSurname")?>" value="<?=$user_data["surname"]?>" />
            <div class="field_error_wrapper">
                <div class="field_error field_invalid_message"><?=$text_manager->getText("FieldErrorSurname")?></div>
            </div>
        </div>
        <div class="field_wrapper user_field_wrapper">
            <span class="field_label"><?=$text_manager->getText("FieldTextBirthDate")?>:</span>
            <input name="birth_date" type="date" class="field_text_input _user_form_input _required_field" 
					value="<?=$user_data["birth_date"]?>" data-validation_type="date" />
            <div class="field_error_wrapper">
                <div class="field_error field_invalid_message"><?=$text_manager->getText("FieldErrorBirthDate")?></div>
            </div>
        </div>
        <div class="field_wrapper user_field_wrapper _image_input_wrapper">
            <span class="field_label"><?=$text_manager->getText("FieldTextImage")?>:</span>
            <input name="image" type="file" class="field_file_input user_form_image_input _user_form_input" accept="image/*" />
        <?php if( $user_data["image"] && file_exists( $_SERVER["DOCUMENT_ROOT"]."/upload/user_images/".$user_data["image"] ) ):?>
            <img class="user_form_image" src="<?="/upload/user_images/".$user_data["image"]?>" />
        <?php endif;?>
        </div>
        <div class="buttons_wrapper">
            <span class="button user_form_button submit_button _user_form_submit"><?=$text_manager->getText("ActionTextSave")?></span>
            <span class="button user_form_button cancel_button _tab_item" data-type="profile"><?=$text_manager->getText("ActionTextCancel")?></span>
        </div>
    </form>
</div>