/***
	User profile module
	Handles profile actions: checking if entered login is available, submitting profile form
***/
var UserProfile = (function($, Validator){
	
	var _this = {};

	_this.checkLoginAvailability = function( _login_input_elem ){
		if( _login_input_elem.length == 0 || _login_input_elem.hasClass("_mod-invalid") ){
			return false;
		}

		$.ajax({
			type: "POST",
			url: "/controllers/user.php",
			data: {
				action: "check_login_availability",
				login: _login_input_elem.val()
			},
			success: function( _response ){
				// Returned value is "boolean"
				if( _response * 1 ){
					_login_input_elem.removeClass("_mod-unavailable").addClass("_mod-available");
				} else {
					_login_input_elem.removeClass("_mod-available _mod-valid").addClass("_mod-unavailable");
				}
			}
		})
	}
	
	_this.submitProfile = function( _submit_elem ){
		var form_elem = _submit_elem.closest("._user_form");
		if( form_elem.length == 0 ){
			return false;
		}
		
		Validator.validateForm( form_elem );
		if( form_elem.find("._mod-invalid, ._mod-unavailable").length > 0 ){
			return false;
		}
		
		$.ajax({
			type: "POST",
			url: "/controllers/user.php",
			data: _this.getProfileData( form_elem ),
			dataType: "json",
			async: false,
			cache: false,
			contentType: false,
			enctype: 'multipart/form-data',
			processData: false,
			success: function( _response ){
				echo( _response["message"] );
				if( _response["success"] ){
					delayedReload();
				}
			}
		})
	}
	
	_this.getProfileData = function( _form_elem ){
		var data = new FormData( _form_elem[0] );
		data.append( "action", "update_profile" );
		
		return data;
	}
	
	return _this;
	
}(jQuery, Validator));