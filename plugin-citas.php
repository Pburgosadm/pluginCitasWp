<?php

/**
 *
 * The plugin bootstrap file
 *
 * This file is responsible for starting the plugin using the main plugin class file.
 *
 * @since 0.0.1
 * @package plugin_citas
 *
 * @wordpress-plugin
 * Plugin Name:     Plugin citas
 * Description:     This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:         0.0.1
 * Author:          Pedro Burgos
 * Author URI:      https://www.example.com
 * License:         GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:     plugin-citas
 * Domain Path:     /lang
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access not permitted.' );
}

if ( ! class_exists( 'plugin_citas' ) ) {

	/*
	 * main plugin_citas class
	 *
	 * @class plugin_citas
	 * @since 0.0.1
	 */
	class plugin_citas {

		/*
		 * plugin_citas plugin version
		 *
		 * @var string
		 */
		public $version = '4.7.5';

		/**
		 * The single instance of the class.
		 *
		 * @var plugin_citas
		 * @since 0.0.1
		 */
		protected static $instance = null;

		/**
		 * Main plugin_citas instance.
		 *
		 * @since 0.0.1
		 * @static
		 * @return plugin_citas - main instance.
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * plugin_citas class constructor.
		 */
		public function __construct() {
			$this->load_plugin_textdomain();
			$this->define_constants();
			$this->includes();
			$this->define_actions();
		}

		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'plugin-citas', false, basename( dirname( __FILE__ ) ) . '/lang/' );
		}

		/**
		 * Include required core files
		 */
		public function includes() {
            // Example
		//	require_once __DIR__ . '/includes/loader.php';

			// Load custom functions and hooks
			require_once __DIR__ . '/includes/includes.php';
		}

		/**
		 * Get the plugin path.
		 *
		 * @return string
		 */
		public function plugin_path() {
			return untrailingslashit( plugin_dir_path( __FILE__ ) );
		}


		/**
		 * Define plugin_citas constants
		 */
		private function define_constants() {
			define( 'plugin_citas_PLUGIN_FILE', __FILE__ );
			define( 'plugin_citas_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
			define( 'plugin_citas_VERSION', $this->version );
			define( 'plugin_citas_PATH', $this->plugin_path() );
		}

		/**
		 * Define plugin_citas actions
		 */
		public function define_actions() {
			//
			add_action( 'add_meta_boxes', 'function_campos_citas' );
			add_action( 'save_post', 'campos_personalizados_citas_save_data' );
            add_action('init', 'shortcodes_init');
			
		}

		/**
		 * Define plugin_citas menus
		 */
		public function define_menus() {
            //
		}
	}

	$plugin_citas = new plugin_citas();
}
