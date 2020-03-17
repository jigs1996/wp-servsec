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

	private $headers;
	
	private $objs;

	function __construct( $host )
	{
		$this->$objs = array();

		$this->headers = array();

		$this->host = $host;

		$this->getResource();
	}
	
	public function run()
	{
		
	}

	public function runAll()
	{
		include PLUGIN_ROOT_PATH . '/includes/helper/class-header-interface.php';
		include PLUGIN_ROOT_PATH . '/includes/helper/class-header.php';

		foreach (glob(PLUGIN_ROOT_PATH . '/includes/headers/*.php') as $filename) {
		    include $filename;
		    $class_name = explode('-', str_replace('.php', '', basename($filename)));
		    unset($class_name[0]);
		    $class_name = implode('', array_map(function($var){
		    	return ucfirst($var);
		    }, $class_name));

			$this->objs[] = new $class_name($this->headers);
		}


		$tempArray = [];

		foreach ($this->objs as $classtest) {
			$tempArray[$classtest->getKey()] = [ 
				'is_active' => $classtest->test(),
				'key' => $classtest->getKey(),
				'name' => $classtest->getName(),
				'value' => $classtest->getValue(),
				'description' => $classtest->getDescription(),
				'possible_value' => $classtest->getPossibleValue(),
				'recommanded_value' => $classtest->getRecommandedValue()
			];
		}

		return $tempArray;
	}

	private function getResource()
	{
		$curl = curl_init();
		if (!$curl) {
        	return new WP_Error("broke", "Couldn't initialize a cURL handle");
        }

        curl_setopt($curl, CURLOPT_URL, $this->host);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
    	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, 1);	

        $this->resources = curl_exec( $curl );

        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
		$headers = substr( $this->resources, 0, $header_size);
		$body = substr( $this->resources, $header_size);
		
		curl_close($curl);

		$this->headers = $this->getHeaders($headers);
	}

	public function getHost()
	{
		return $this->host;
	}

	public function setHost($host)
	{
		$this->host = $host;
	}

	private function getHeaders($respHeaders)
	{
	    $headers = array();

	    $headerText = substr($respHeaders, 0, strpos($respHeaders, "\r\n\r\n"));

	    foreach (explode("\r\n", $headerText) as $i => $line) {
	        if ($i === 0) {
	            $headers['http_code'] = $line;
	        } else {
	            list ($key, $value) = explode(': ', $line);

	            $headers[$key] = $value;
	        }
	    }

	    return $headers;
	}
}