<?php

/**
 * Plugin Name: Admin Theme Switcher
 * Plugin URI: https://byreza.net
 * Author: Reza Qalekhani
 * Author URI: https://byreza.net
 * Description: Adds a dark/light mode switcher and an admin font family selector to wp-admin.
 * Version: 1.1
 * Text Domain: admin-theme-switcher
 * Domain Path: /languages
 */

if (! defined('ABSPATH')) {
  exit;
}

define('ATS_VERSION', '1.2');
define('ATS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ATS_PLUGIN_URL', plugin_dir_url(__FILE__));

add_action(
  'init',
  function () {
    load_plugin_textdomain(
      'admin-theme-switcher',
      false,
      dirname(plugin_basename(__FILE__)) . '/languages'
    );
  }
);

require_once ATS_PLUGIN_DIR . 'includes/class-dark-mode.php';
require_once ATS_PLUGIN_DIR . 'includes/class-font-settings.php';

add_action(
  'plugins_loaded',
  function () {
    ATS_Dark_Mode::init();
    ATS_Font_Settings::init();
  }
);
