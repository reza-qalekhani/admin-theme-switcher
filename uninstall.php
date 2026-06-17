<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option( 'ats_font_family' );
delete_metadata( 'user', 0, 'ats_dark_mode', '', true );
