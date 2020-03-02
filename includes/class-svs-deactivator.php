<?php
/**
 * Fired during plugin deactivation
 * @since      	1.0.0
 * @package 	wp-servsec
 * @subpackage 	wp-servsec/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package 	wp-servsec
 * @subpackage 	wp-servsec/includes
 */
class SVS_Deactivator
{
	
	/**
	 * @since    1.0.0
	 */
	public static function deactivate() {
		
		// clear the permalinks after the post type has been registered
    	flush_rewrite_rules();
    	
	}
}
