/***
    Content manager module
    Handles language/tab switching and, when necessary, loading tab content
 ***/
var ContentManager = (function($){

    var _this = {};

    _this.switchTab = function( _tab_elem ){
        if( _tab_elem.hasClass("_mod-active") ){
            return;
        }

        var tab_content_elem = $("._tab_content[data-type=\"" + _tab_elem.attr("data-type") + "\"]");
        if( tab_content_elem.length == 0 ){
            return;
        }

        // If selected tab currently has no content, load it
        if( tab_content_elem.html().length < 10 ){
            _this.loadTabContent( tab_content_elem );
        }

        $("._tab_item").each(function(){
            if( $(this).attr("data-type") == _tab_elem.attr("data-type") ){
                $(this).addClass("_mod-active");
            } else {
                $(this).removeClass("_mod-active");
            }
        })
        $("._tab_content._mod-active").each(function(){
            $(this).removeClass("_mod-active");
        })
        tab_content_elem.addClass("_mod-active");
    }

    _this.loadTabContent = function( _content_elem ){
        $.ajax({
            type: "POST",
            url: "/controllers/content.php",
            data: {
                action: "load_" + _content_elem.attr("data-type")
            },
            success: function( _response ){
                _content_elem.html( _response );
            }
        })
    }

    _this.switchLanguage = function( _language_elem ){
        $.ajax({
            type: "POST",
            url: "/controllers/content.php",
            data: {
                action: "change_language",
                language: _language_elem.val()
            },
            success: function(){
                _this.reloadPageContent();
            }
        })
    }

    _this.reloadPageContent = function(){
        $("._tab_content").each(function(){
            // Reload content of current tab, remove others
            if( $(this).hasClass("_mod-active") ){
                _this.loadTabContent( $(this) );
            } else {
                $(this).html("");
            }
        })
    }

    return _this;

}(jQuery))