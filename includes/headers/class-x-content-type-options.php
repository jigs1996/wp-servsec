<?php

/**
 * 
 */
class XContentTypeOptions implements HeaderInterface
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

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $header_name       The name of this plugin.
	 * @param      string    $headers    The headers of this plugin.
	 */
	
	function __construct( $headers )
	{
		$this->header_name = 'X-Content-Type-Options';
		$this->header_key = 'x-content-type-options';
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
	public function getPossibleValue()
	{
		return [];
	}

	/**
	 * @since    1.0.0
	 */
	public function getDescription()
	{
		return 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.' ;	
	}

	/**
	 * @since    1.0.0
	 */
	public function getRecommandedValue()
	{
		return '';
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
}