<div class="form_wrapper login_form_wrapper">
    <div class="upper_text_wrapper">
        <div class="upper_text_line">
			<span class="upper_text"><?=$text_manager->getText("LoginHeader");?></span>
		</div>
        <div class="upper_text_line">
			<span class="upper_text"><?=$text_manager->getText("LoginNoAccountMessage")?></span>
			<span class="reg_link _mod-clickable _tab_item" data-type="user_form"><?=$text_manager->getText("ActionTextRegister")?></span>
		</div>
    </div>
    <div class="form login_form _login_form">
        <div class="field_wrapper login_field_wrapper">
            <span class="field_label"><?=$text_manager->getText("FieldTextLogin")?>:</span>
            <input class="field_text_input _login_form_input _required_field" name="login" type="text" 
				placeholder="<?=$text_manager->getText("InputPlaceholderLogin")?>" data-validation_type="login" />
            <div class="field_error_wrapper">
                <div class="field_error field_invalid_message"><?=$text_manager->getText("FieldErrorLogin")?></div>
            </div>
        </div>
        <div class="field_wrapper login_field_wrapper">
            <span class="field_label"><?=$text_manager->getText("FieldTextPassword")?>:</span>
            <input class="field_text_input _login_form_input _required_field" name="pass" type="password" 
				placeholder="<?=$text_manager->getText("InputPlaceholderPassword")?>" data-validation_type="password" />
            <div class="field_error_wrapper">
                <div class="field_error field_invalid_message"><?=$text_manager->getText("FieldErrorPassword")?></div>
            </div>
        </div>
        <div class="buttons_wrapper login_buttons_wrapper">
            <span class="button login_form_button submit_button _login_form_submit"><?=$text_manager->getText("ActionTextLogin")?></span>
            <span class="button login_form_button reg_button _tab_item" data-type="user_form"><?=$text_manager->getText("ActionTextRegister")?></span>
        </div>
    </div>
</div>