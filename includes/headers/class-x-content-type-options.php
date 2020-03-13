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
		$this->header_name = 'x-content-type-options';
		$this->headers = $headers;
	}

	/**
	 * run this header test
	 *
	 * @since    1.0.0
	 */
	public function test()
	{
		return array_key_exists($this->header_name, $this->headers)?1:0;
	}

	public function getName()
	{
		return $this->header_name;
	}
}