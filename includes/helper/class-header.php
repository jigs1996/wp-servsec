<?php

/**
 * Header tst abstract class
 *
 * @since      1.0.0
 * @package    wp-servsec
 * @subpackage wp-servsec/includes
 */
abstract class Header implements HeaderInterface
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
	 * Run test and check header exist or not
	 * 
	 * @since    1.0.0
	 * @access   public
	 * @method   test
	 * @return   boolean [return either true/false]
	 */
	public function test()
	{
		return array_key_exists($this->header_key, $this->headers)?1:0;
	}

	/**
	 * Return current header value
	 * 
	 * @since    1.0.0
	 * @access   public
	 * @method   getValue
	 * @return   string [return current header value]
	 */
	public function getValue()
	{
		return $this->headers[$this->getKey()];
	}

	/**
	 * Return header name
	 * 
	 * @since    1.0.0
	 * @access   public
	 * @method   getName
	 * @return   string [return header name]
	 */
	public function getName()
	{
		return $this->header_name;
	}

	/**
	 * Return header key for testing and set in headers array
	 * 
	 * @since    1.0.0
	 * @access   public
	 * @method   getKey
	 * @return   string [return header key for testing and set in headers array]
	 */
	public function getKey()
	{
		return $this->header_key;
	}

	/**
	 * Return description for header
	 * 
	 * @since    1.0.0
	 * @access   public
	 * @method   getDescription
	 * @return   string [return description for header]
	 */
	abstract public function getDescription();

	/**
	 * Return possible value of header
	 * 
	 * @since    1.0.0
	 * @access   public
	 * @method   getPossibleValue
	 * @return   array [return possible value of header]
	 */
	abstract public function getPossibleValue();

	/**
	 * Return recommanded value of header
	 * 
	 * @since    1.0.0
	 * @access   public
	 * @method   getRecommandedValue
	 * @return   string [return recommanded value of header]
	 */
	abstract public function getRecommandedValue();
}