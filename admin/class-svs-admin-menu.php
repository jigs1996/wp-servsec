<?php

/**
 * SVS_Admin_Menu is responsiible for creating admin menu and submenu
 * @since      1.0.0
 * @package    wp-servsec
 * @subpackage wp-servsec/includes
 */
class SVS_Admin_Menu
{
	/**
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $page_title   Static instance of current class
	 */
	private static $instance;

	/**
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $page_title   Main menu page title
	 */	
	private $page_title = 'Dashboard';

	/**
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $menu_title   Main menu title
	 */
	private $menu_title = 'SVS';
	
	/**
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $capability   Main menu page title
	 */
	private $capability = 'manage_options';
	
	/**
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $menu_slug   Slug of the menu page
	 */
	private $menu_slug = 'wpsvs_dashboard';
	
	/**
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $icon    Icon of the main menu item
	 */
	private $icon = 'dashicons-shield';

	/**
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $position    Postion of wordpress menu
	 */
	private $position = 74;

	public static function create()
	{
		if( !isset( self::$instance ) ){
			self::$instance = new SVS_Admin_Menu();
			self::$instance->register_main_menu();
			self::$instance->register_submenu();
		}
	}
	protected function register_main_menu()
	{
		add_menu_page( $this->page_title, $this->menu_title, $this->capability, $this->menu_slug, array($this, 'display_dashboard'), $this->icon, $this->position );
	}

	public function display_dashboard()
	{
		require_once PLUGIN_ROOT_PATH . '/admin/partials/dashboard.php';
	}

	protected function register_submenu()
	{
		add_submenu_page( $this->menu_slug, 'Dashboard', 'Dashboard', $this->capability, $this->menu_slug );
		add_submenu_page( $this->menu_slug, 'Help', 'Help', $this->capability, 'wpsvs_headers' );
	}
	
}