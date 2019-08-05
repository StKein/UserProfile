/***
	Common functions, which will be used in other js files
***/
// Alert-like message without required "ok" click
function echo( _text ){
	if( $("._echo").length ){
		$("._echo").html( _text ).fadeIn();
		setTimeout(function(){
			$("._echo").fadeOut();
		}, 3000);
	}
}

// Reload after some time
// Usually used after some action, which requires page reload and can be failed (logging in, updating profile)
function delayedReload(){
	setTimeout(function(){
		location.reload();
	}, 2000);
}