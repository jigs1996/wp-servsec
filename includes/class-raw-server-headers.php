<?php

/**
 * class RawServerHeaders
 *
 * @since      1.0.0
 * @package    wp-servsec
 * @subpackage wp-servsec/includes
 */
class RawServerHeaders
{
	/**
	 * A domain/request name of which needs to be tested
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $host    A domain/request name of which needs to be tested
	 */	
	private $host;

	/**
	 * Array of headers retrive from resources
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $headers    Array of headers retrive from resources
	 */	
	private $headers;
		
	function __construct( $host )
	{

		$this->headers = array();

		$this->host = $host;
	}


	/**
     * Get url
     * 
	 * @since     1.0.0
	 * @access    public
	 * @method    getHost [ get url ]
	 */
	public function getHost()
	{
		return $this->host;
	}

	/**
     * Set url
     * 
	 * @since     1.0.0
	 * @access    public
	 * @method    setHost [ set url ]
	 */
	public function setHost($host)
	{
		$this->host = $host;
	}

	/**
     * Extract headers from resources
     * 
	 * @since     1.0.0
	 * @access    private
	 * @method    getHeaders [ extract headers from resources ]
	 * @return    array [return array of headers]
	 */
	private function getHeaders()
	{
		return get_headers( $this->host );
	}
}