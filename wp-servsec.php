<?php
/**
 * Wordpress server security tester
 * @package wp-servsec
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License, version 3 or higher
 *
 * @wordpress-plugin
 * Plugin Name: WP Headders/SSL Info
 * Description: This plugin will scan your request/response and give you report of necessary security headers and SSL certificate info and expiration date
 * Version: 1.0.0
 * Author: Jignesh Sanghani, Rahul Kachhadiya
 * Text Domain: wp-servsec
 * License: GPL v3
 *
 * Wp server security is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Wp server security is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Wp server security.  If not, see <http://www.gnu.org/licenses/>.
 */


if ( ! function_exists( 'add_filter' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'WPSERVSEC_PLUGIN_FILE' ) )
	define( 'WPSERVSEC_PLUGIN_FILE', __FILE__ );

if ( ! defined( 'PLUGIN_ROOT_PATH' ) )
	define( 'PLUGIN_ROOT_PATH', plugin_dir_path( WPSERVSEC_PLUGIN_FILE ) );

require_once dirname( WPSERVSEC_PLUGIN_FILE ) . '/wp-servsec-index.php';
