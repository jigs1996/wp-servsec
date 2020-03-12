<?php

/**
 * class HeaderTest: responsible for maintaing and running header classes
 *
 * @since      1.0.0
 * @package    wp-servsec
 * @subpackage wp-servsec/includes
 */
class HeaderTest
{
	private $host;

	private $resources;
	
	function __construct( $host )
	{
		$this->host = $host;

		$this->getResource();
	}
	
	public function run()
	{
		foreach (glob("headers/*.php") as $filename) {
		    include $filename;
		}
		
	}

	public function runAll()
	{
		foreach (glob("headers/*.php") as $filename) {
		    include $filename;
		}

		return [];
	}

	private function getResource()
	{
		$curl = curl_init();
		if (!$curl) {
        	return new WP_Error("broke", "Couldn't initialize a cURL handle");
        }

        curl_setopt($curl, CURLOPT_URL, $this->host);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, 1);	

        $this->resources = curl_exec( $curl );

        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
		$headers = substr( $this->resources, 0, $header_size);
		$body = substr( $this->resources, $header_size);

        curl_close($curl);
	}

	public function getHost()
	{
		return $this->host;
	}

	public function setHost($host)
	{
		$this->host = $host;
	}
}