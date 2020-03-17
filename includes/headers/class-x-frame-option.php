<?php

/**
 * class XFO: X-Frame-Option to check and maintan all details about x frame option
 *
 * @since      1.0.0
 * @package    wp-servsec
 * @subpackage wp-servsec/includes
 */
class XFrameOption extends Header
{
	function __construct( $headers )
	{
		parent::__construct('X-Frame-Options', 'x-frame-options', $headers);
	}

	/**
	 * @since    1.0.0
	 */
	public function getPossibleValue()
	{
		return [];
	}

	/**
	 * @since    1.0.0
	 */
	public function getDescription()
	{
		return '';	
	}

	/**
	 * @since    1.0.0
	 */
	public function getRecommandedValue()
	{
		return '';
	}
}