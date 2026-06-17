( function () {
	'use strict';

	document.addEventListener( 'DOMContentLoaded', function () {
		var toggle = document.getElementById( 'wp-admin-bar-ats-dark-mode-toggle' );

		if ( ! toggle ) {
			return;
		}

		var link = toggle.querySelector( 'a.ab-item' );

		if ( ! link ) {
			return;
		}

		link.addEventListener( 'click', function ( event ) {
			event.preventDefault();

			var isDark = document.body.classList.toggle( 'ats-dark' );

			link.textContent = isDark ? '☀️ Light Mode' : '🌙 Dark Mode';

			var xhr = new XMLHttpRequest();
			xhr.open( 'POST', window.ajaxurl, true );
			xhr.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' );
			xhr.send(
				'action=ats_toggle_mode' +
				'&dark_mode=' + ( isDark ? '1' : '0' ) +
				'&nonce=' + encodeURIComponent( window.atsDarkMode.nonce )
			);
		} );
	} );
} )();
