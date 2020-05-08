<?php

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    wp-servsec
 * @subpackage wp-servsec/includes
 */

class Wp_Servsec
{
	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
    protected $plugin_name;

    /**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
    protected $version;

    /**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      SVS_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
    protected $loader;

    /**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 * @method   constructor
	 */
	public function __construct()
	{

		if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}

		$this->plugin_name = 'wp-servsec';

		$this->load_dependencies();
		$this->define_admin_hooks();
	}

    /**
     * Return plugin name
     * 
	 * @since     1.0.0
	 * @access    public
	 * @method    get_plugin_name [ return plugin name ]
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @access    public
	 * @method    get_version
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @access    public
	 * @method    get_loader
	 * @return    SVS_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Load required all depencies for plugin here
	 *
	 * @since    1.0.0
	 * @access   private
	 * @method   load_dependencies
	 */
	private function load_dependencies()
	{
		/**
		 * Class responsible for architechure and tuning of 
		 * the core plugin
		 */
		require_once PLUGIN_ROOT_PATH . 'includes/class-svs-loader.php';

		/**
		 * Class responsible for defining all actions and filters occurs in
		 * admin area
		 */
		require_once PLUGIN_ROOT_PATH . '/admin/class-svs-admin.php';

		$this->loader = new SVS_Loader();
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @method   define_admin_hooks
	 */
	private function define_admin_hooks() {

		$plugin_admin = new SVS_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action('admin_menu', $plugin_admin, 'register_menu');

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @method   run
	 */
	public function run()
	{
		$this->loader->run();
	}
}
