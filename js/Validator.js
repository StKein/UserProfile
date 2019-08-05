/*
	Validator module
	Handles validation of required inputs and the form containing them
*/
var Validator = (function(){

    var _this = {};

    _this.validateField = function( _field_elem ){
        var is_valid = false;
        switch( _field_elem.attr("data-validation_type") ){
            case "login":
                is_valid = ( _field_elem.val().length >= 6 && _field_elem.val().length <= 15 );
                break;
            case "password":
                is_valid = ( _field_elem.val().length >= 6 && _field_elem.val().length <= 20 );
                break;
			case "date":
			    var years_passed = ( new Date() - new Date( _field_elem.val() ) ) * 1000 * 86400 * 365;
				is_valid = ( years_passed >= 12 && years_passed < 90 );
				break;
			case "name":
				is_valid = ( _field_elem.val().length >= 2 );
				break;
            default:
                is_valid = ( _field_elem.val().length >= 6 );
                break;
        }

        if( is_valid ){
            _field_elem.removeClass("_mod-invalid").addClass("_mod-valid");
        } else {
            _field_elem.removeClass("_mod-valid").addClass("_mod-invalid");
        }

        return is_valid;
    }

    _this.validateForm = function( _form_elem ){
        var is_valid = true;
        _form_elem.find("._required_field").each(function(){
            if( !_this.validateField( $(this) ) ){
                is_valid = false;
            }
        })

        return is_valid;
    }

    return _this;

}());