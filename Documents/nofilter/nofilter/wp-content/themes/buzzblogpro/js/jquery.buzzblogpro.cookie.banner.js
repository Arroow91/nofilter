(function($){
	$(document).ready(function(){


		$('#buzzblogpro-dismiss-cookie').on( 'click', function (event){
			event.preventDefault();

			// Set cookie.
			setCookie( cookie_banner_args.name, cookie_banner_args.value, cookie_banner_args.options );

			// Hide cookie banner.
			$( '#buzzblogpro-cookie-banner' ).remove();
		} );

		function setCookie(name, value, options) {
			options = options || {};

			var expires = options.expires;
			
		var url = window.location.protocol + '//',
				hostname = window.location.host + '/' + window.location.pathname;


			if ( typeof expires == "number" && expires ) {
				var d = new Date();
				d.setTime(d.getTime() + expires * 1000);
				expires = options.expires = d;
			}

			if ( expires && expires.toUTCString ) {
				options.expires = expires.toUTCString();
			}

			value = encodeURIComponent( value );

			var updatedCookie = name + "=" + value;

			for ( var propName in options ) {
				var propValue = options[propName];

				if ( propValue !== undefined && propValue !== '' && propValue !== false ) {
					updatedCookie += "; " + propName + "=" + propValue;
				}
			}
			
			document.cookie = updatedCookie;
		}
		
		function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

var banner = getCookie("buzzblogpro_cookie_banner");
    if (banner == "") {
        $( '#buzzblogpro-cookie-banner' ).removeClass('hidden');
    }
	});
})(jQuery);