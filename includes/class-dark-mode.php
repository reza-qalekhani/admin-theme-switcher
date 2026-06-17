<?php

if (! defined('ABSPATH')) {
  exit;
}

class ATS_Dark_Mode {

  const META_KEY     = 'ats_dark_mode';
  const NONCE_ACTION = 'ats_toggle_mode_nonce';

  public static function init() {
    add_filter('admin_body_class', array(__CLASS__, 'filter_admin_body_class'));
    add_action('admin_bar_menu', array(__CLASS__, 'add_toolbar_button'), 100);
    add_action('admin_enqueue_scripts', array(__CLASS__, 'enqueue_assets'));
    add_action('enqueue_block_assets', array(__CLASS__, 'enqueue_iframe_assets'));
    add_action('wp_ajax_ats_toggle_mode', array(__CLASS__, 'ajax_toggle_mode'));
  }

  public static function is_dark_mode_enabled($user_id = 0) {
    if (! $user_id) {
      $user_id = get_current_user_id();
    }

    return '1' === get_user_meta($user_id, self::META_KEY, true);
  }

  public static function filter_admin_body_class($classes) {
    if (self::is_dark_mode_enabled()) {
      $classes .= ' ats-dark ';
    }

    return $classes;
  }

  public static function add_toolbar_button($wp_admin_bar) {
    if (! is_admin()) {
      return;
    }

    $is_dark = self::is_dark_mode_enabled();

    $wp_admin_bar->add_node(
      array(
        'id'    => 'ats-dark-mode-toggle',
        'title' => $is_dark ? __('☀️ Light Mode', 'admin-theme-switcher') : __('🌙 Dark Mode', 'admin-theme-switcher'),
        'href'  => '#',
      )
    );
  }

  public static function ajax_toggle_mode() {
    check_ajax_referer(self::NONCE_ACTION, 'nonce');

    if (! is_user_logged_in()) {
      wp_send_json_error('not_logged_in');
    }

    $dark_mode = isset($_POST['dark_mode']) && '1' === $_POST['dark_mode'] ? '1' : '0';

    update_user_meta(get_current_user_id(), self::META_KEY, $dark_mode);

    wp_send_json_success(array('dark_mode' => $dark_mode));
  }

  // Runs in addition to enqueue_assets(): WordPress collects styles enqueued
  // here separately to inject into the block editor's iframe canvas. This
  // hook also fires on the public front end, so it's guarded to admin only.
  public static function enqueue_iframe_assets() {
    if (! is_admin()) {
      return;
    }

    wp_enqueue_style(
      'ats-dark-mode',
      ATS_PLUGIN_URL . 'assets/css/dark-mode.css',
      array(),
      ATS_VERSION
    );
  }

  public static function enqueue_assets($hook) {
    wp_enqueue_style(
      'ats-dark-mode',
      ATS_PLUGIN_URL . 'assets/css/dark-mode.css',
      array(),
      ATS_VERSION
    );

    wp_enqueue_script(
      'ats-dark-mode-toggle',
      ATS_PLUGIN_URL . 'assets/js/dark-mode-toggle.js',
      array(),
      ATS_VERSION,
      true
    );

    wp_localize_script(
      'ats-dark-mode-toggle',
      'atsDarkMode',
      array(
        'nonce'      => wp_create_nonce(self::NONCE_ACTION),
        'lightLabel' => __('☀️ Light Mode', 'admin-theme-switcher'),
        'darkLabel'  => __('🌙 Dark Mode', 'admin-theme-switcher'),
      )
    );
  }
}
