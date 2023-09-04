<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://telow.com
 * @since      1.0.0
 *
 * @package    Telow
 * @subpackage Telow/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Telow
 * @subpackage Telow/admin
 * @author     Telow <support@telow.com>
 */
class Telow_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Telow_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Telow_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/telow-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Telow_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Telow_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/telow-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	/**
	* Register Telow Admin Menu
	*
	* @since    1.0.0
	*/
	public function admin_setting_page() {
		include_once 'partials/telow-admin-display.php';
	}

	public function admin_menu() {
		add_options_page(
			__( 'Telow', 'textdomain' ),
			__( 'Telow', 'textdomain' ),
			'manage_options',
			'telow',
			array(
				$this,
				'admin_setting_page'
			)
		);
	}

	/**
	* Register Telow Setting
	*
	* @since    1.0.0
	*/

	public function register_telow_settings() {
		$args = array(
			'type' => 'string',
			'sanitize_callback' => 'sanitize_text_field',
			'default' => NULL
		);

		register_setting('telow', 'telow_account', $args);

		add_settings_field(
			'telow_account',
			esc_html__('', 'default'),
			function (){
				include_once 'partials/telow-admin-fields.php';
			},
			'telow'
		);
	}

}
