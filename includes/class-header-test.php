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
	/**
	 * A domain/request name of which needs to be tested
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $host    A domain/request name of which needs to be tested
	 */	
	private $host;

	/**
	 * Content of the request
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $resources    Content of the request
	 */	
	private $resources;

	/**
	 * Array of headers retrive from resources
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $headers    Array of headers retrive from resources
	 */	
	private $headers;
		
	/**
	 * Array of all headers instance
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $objs    Array of all headers instance
	 */	
	private $objs;

		
	function __construct( $host )
	{
		$this->$objs = array();

		$this->headers = array();

		$this->host = $host;

		$this->getResource();
	}

	/**
	 * will include all header test class, and run method for test
	 *
	 * @since    1.0.0
	 * @access   public
	 * @method   runAll
	 * @return   array [ header test results]
	 */
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

	/**
     * Get resources of requested url
     * 
	 * @since     1.0.0
	 * @access    private
	 * @method    getResource [ get resources of requested url ]
	 */
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