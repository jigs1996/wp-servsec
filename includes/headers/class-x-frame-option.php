<?php

/**
 * class XFO: X-Frame-Option to check and maintan all details about x frame option
 *
 * @since      1.0.0
 * @package    wp-servsec
 * @subpackage wp-servsec/includes
 */
class XFrameOption implements HeaderInterface
{
	/**
	 * Name of the header
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $header_name    Name of the header.
	 */
	private $header_name;

	private $header_key;

	/**
	 * headers of main domain
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $headers    Resources of main domain
	 */
	private $headers;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $header_name       The name of this plugin.
	 * @param      string    $headers    The headers of this plugin.
	 */
	
	function __construct( $headers )
	{
		$this->header_name = 'X-Frame-Options';
		$this->header_key = 'x-frame-options';
		$this->headers = $headers;
	}

	/**
	 * run this header test
	 *
	 * @since    1.0.0
	 */
	public function test()
	{
		return array_key_exists($this->header_key, $this->headers)?1:0;
	}

	public function getValue()
	{
		return $this->headers[$this->getKey()];
	}

	public function getPossibleValue()
	{
		return [];
	}

	public function getDescription()
	{
		return '';	
	}

	public function getRecommandedValue()
	{
		return '';
	}

	public function getName()
	{
		return $this->header_name;
	}
	public function getKey()
	{
		return $this->header_key;
	}
}