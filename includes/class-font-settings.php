<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ATS_Font_Settings {

	const OPTION_KEY = 'ats_font_family';

	const FONT_LABELS = array(
		'default' => 'Default (Theme Standard)',
		'font1'   => 'Font Option 1',
		'font2'   => 'Font Option 2',
		'font3'   => 'Font Option 3',
	);

	public static function init() {
		add_action( 'admin_menu', array( __CLASS__, 'add_settings_page' ) );
		add_action( 'admin_init', array( __CLASS__, 'register_settings' ) );
		add_filter( 'admin_body_class', array( __CLASS__, 'filter_admin_body_class' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_assets' ) );
	}

	public static function add_settings_page() {
		add_options_page(
			'Admin Appearance',
			'Admin Appearance',
			'manage_options',
			'admin-theme-switcher',
			array( __CLASS__, 'render_settings_page' )
		);
	}

	public static function register_settings() {
		register_setting(
			'ats_font_settings_group',
			self::OPTION_KEY,
			array(
				'type'              => 'string',
				'sanitize_callback' => array( __CLASS__, 'sanitize_font_choice' ),
				'default'           => 'default',
			)
		);
	}

	public static function sanitize_font_choice( $value ) {
		if ( ! array_key_exists( $value, self::FONT_LABELS ) ) {
			return 'default';
		}

		return $value;
	}

	public static function render_settings_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$current = get_option( self::OPTION_KEY, 'default' );
		?>
		<div class="wrap">
			<h1>Admin Appearance</h1>
			<form method="post" action="options.php">
				<?php settings_fields( 'ats_font_settings_group' ); ?>
				<table class="form-table">
					<tr>
						<th scope="row">Admin Font Family</th>
						<td>
							<?php foreach ( self::FONT_LABELS as $value => $label ) : ?>
								<label style="display:block;margin-bottom:6px;">
									<input
										type="radio"
										name="<?php echo esc_attr( self::OPTION_KEY ); ?>"
										value="<?php echo esc_attr( $value ); ?>"
										<?php checked( $current, $value ); ?>
									/>
									<?php echo esc_html( $label ); ?>
								</label>
							<?php endforeach; ?>
						</td>
					</tr>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}

	public static function filter_admin_body_class( $classes ) {
		$current = get_option( self::OPTION_KEY, 'default' );

		if ( 'default' !== $current && array_key_exists( $current, self::FONT_LABELS ) ) {
			$classes .= ' ats-font-' . sanitize_html_class( $current ) . ' ';
		}

		return $classes;
	}

	public static function enqueue_assets( $hook ) {
		wp_enqueue_style(
			'ats-admin-fonts',
			ATS_PLUGIN_URL . 'assets/css/admin-fonts.css',
			array(),
			ATS_VERSION
		);
	}
}
