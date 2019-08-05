/***
	User account module
	Handles account actions: checking if account available, submitting account (login)
***/
var UserAccount = (function($, Validator){
	
	var _this = {};
	
	_this.tryLogin = function( _submit_elem ){
		var form_elem = _submit_elem.closest("._login_form");
		if( form_elem.length == 0 ){
			return false;
		}
		
		Validator.validateForm( form_elem );
		if( form_elem.find("._mod-invalid").length > 0 ){
			return false;
		}
		
		$.ajax({
			type: "POST",
			url: "/controllers/user.php",
			data: {
				action: "login",
				data: _this.getData( form_elem )
			},
			dataType: "json",
			success: function( _response ){
				echo( _response["message"] );
				if( _response["success"] ){
					delayedReload();
				}
			}
		})
	}
	
	_this.getData = function( _form_elem ){
		var data = {};
		_form_elem.find("._login_form_input").each(function(){
			data[ $(this).attr("name") ] = $(this).val();
		})
		
		return data;
	}

	_this.logOut = function(){
		$.ajax({
			type: "POST",
			url: "/controllers/user.php",
			data: { action: "logout" },
			success: function(){
				location.reload();
			}
		})
	}
	
	return _this;
	
}(jQuery, Validator));