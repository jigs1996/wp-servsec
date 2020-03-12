<?php

/**
 * class XFO: X-Frame-Option to check and maintan all details about x frame option
 *
 * @since      1.0.0
 * @package    wp-servsec
 * @subpackage wp-servsec/includes
 */
class XFrameOption
{
	/**
	 * Name of the header
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $header_name    Name of the header.
	 */
	private $header_name;

	/**
	 * Resources of main domain
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $resources    Resources of main domain
	 */
	private $resources;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $header_name       The name of this plugin.
	 * @param      string    $resources    The resources of this plugin.
	 */
	
	function __construct( $header_name, $resources )
	{
		$this->header_name = $header_name;
		$this->resources = $resources;
	}

	/**
	 * run this header test
	 *
	 * @since    1.0.0
	 */
	public function test()
	{
		
	}
}