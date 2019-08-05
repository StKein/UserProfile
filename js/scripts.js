/***
 	JS controller file
***/
$(document).ready(function(){

	/* Validator */
    $("._required_field").live("keyup focusout", function(){
        Validator.validateField( $(this) );
    })

	/* UserAccount */
	$("._login_form_input").live("keyup", function( _event ){
		// If enter is clicked inside login form input, submit it like usual form
		if( _event.keyCode == 13 ){
			UserAccount.tryLogin( $(this) );
		}
	})

	$("._login_form_submit").live("click", function(){
		UserAccount.tryLogin( $(this) );
	})

	$("._user_logout").live("click", function(){
		UserAccount.logOut();
	})

	/* UserProfile */
	$("._user_form_input[name=\"login\"]").live("focusout", function(){
		UserProfile.checkLoginAvailability( $(this) );
	})
	
	$("._user_form_submit").live("click", function(){
		UserProfile.submitProfile( $(this) );
	})

	/* ContentManager */
	$("._tab_item").live("click", function(){
		ContentManager.switchTab( $(this) );
	})

	$("._language_switcher").live("change", function(){
		ContentManager.switchLanguage( $(this) );
	})

})