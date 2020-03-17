<?php

/**
 * class XFO: X-Frame-Option to check and maintan all details about x frame option
 *
 * @since      1.0.0
 * @package    wp-servsec
 * @subpackage wp-servsec/includes
 */
class Header implements HeaderInterface
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
	 * Key of the header
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $header_key   Name of the key.
	 */
	private $header_key;

	/**
	 * headers of main domain
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $headers    Resources of main domain
	 */
	private $headers;

	function __construct( $name, $key, $headers )
	{
		$this->header_name = $name;
		$this->header_key = $key;
		$this->headers = $headers;
	}

	/**
	 * @since    1.0.0
	 */
	public function test()
	{
		return array_key_exists($this->header_key, $this->headers)?1:0;
	}

	/**
	 * @since    1.0.0
	 */
	public function getValue()
	{
		return $this->headers[$this->getKey()];
	}

	/**
	 * @since    1.0.0
	 */
	public function getName()
	{
		return $this->header_name;
	}

	/**
	 * @since    1.0.0
	 */
	public function getKey()
	{
		return $this->header_key;
	}

	/**
	 * @since    1.0.0
	 */
	public function getDescription(){
		return '';
	}

	/**
	 * @since    1.0.0
	 */
	public function getPossibleValue(){
		return '';
	}

	/**
	 * @since    1.0.0
	 */
	public function getRecommandedValue(){
		return '';
	}
}