<?php
/**
 * Fired during plugin activation
 * @since      	1.0.0
 * @package 	wp-servsec
 * @subpackage 	wp-servsec/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package 	wp-servsec
 * @subpackage 	wp-servsec/includes
 */
class SVS_Activator
{
	
	/**
	 * @since    1.0.0
	 */
	public static function activate() {
		
		// clear the permalinks after the post type has been registered
    	flush_rewrite_rules();
    	
	}
}
