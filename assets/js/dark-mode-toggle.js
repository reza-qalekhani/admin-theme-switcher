( function () {
	'use strict';

	function findEditorIframe() {
		return document.querySelector( 'iframe[name="editor-canvas"]' );
	}

	// The block editor canvas renders inside a same-origin iframe, and
	// WordPress does not forward our "ats-*" body classes into it. Mirror
	// them onto the iframe's own body so dark mode/font CSS scoped to
	// "body.ats-dark"/"body.ats-font-*" also applies inside the canvas.
	function syncIframeAtsClasses() {
		var iframe = findEditorIframe();

		if ( ! iframe || ! iframe.contentDocument || ! iframe.contentDocument.body ) {
			return;
		}

		var iframeBody = iframe.contentDocument.body;
		var outerClasses = Array.prototype.filter.call( document.body.classList, function ( name ) {
			return name.indexOf( 'ats-' ) === 0;
		} );

		Array.prototype.slice.call( iframeBody.classList ).forEach( function ( name ) {
			if ( name.indexOf( 'ats-' ) === 0 && outerClasses.indexOf( name ) === -1 ) {
				iframeBody.classList.remove( name );
			}
		} );

		outerClasses.forEach( function ( name ) {
			iframeBody.classList.add( name );
		} );
	}

	document.addEventListener( 'DOMContentLoaded', function () {
		// The iframe mounts asynchronously and can reload when switching
		// preview/zoom modes, so poll instead of relying on a single load
		// event that could fire before or after the iframe (re)appears.
		setInterval( syncIframeAtsClasses, 1000 );

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

			link.textContent = isDark ? window.atsDarkMode.lightLabel : window.atsDarkMode.darkLabel;

			syncIframeAtsClasses();

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
