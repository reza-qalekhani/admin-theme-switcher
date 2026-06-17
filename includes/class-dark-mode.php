<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ATS_Dark_Mode {

	const META_KEY     = 'ats_dark_mode';
	const NONCE_ACTION = 'ats_toggle_mode_nonce';

	public static function init() {
		add_filter( 'admin_body_class', array( __CLASS__, 'filter_admin_body_class' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_assets' ) );
	}

	public static function is_dark_mode_enabled( $user_id = 0 ) {
		if ( ! $user_id ) {
			$user_id = get_current_user_id();
		}

		return '1' === get_user_meta( $user_id, self::META_KEY, true );
	}

	public static function filter_admin_body_class( $classes ) {
		if ( self::is_dark_mode_enabled() ) {
			$classes .= ' ats-dark ';
		}

		return $classes;
	}

	public static function enqueue_assets( $hook ) {
		wp_enqueue_style(
			'ats-dark-mode',
			ATS_PLUGIN_URL . 'assets/css/dark-mode.css',
			array(),
			ATS_VERSION
		);
	}
}
