<?php
/**
 * Get ssl information
 * @since      	1.0.0
 * @package 	wp-servsec
 * @subpackage 	wp-servsec/includes
 */
class SSl_Info
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
	 * Certificate chain get from certificate info send by server
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $stream
	 */	
	private $stream;

	/**
	 * Certificate chain get from certificate info send by server
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $meta_info
	 */	
	private $meta_info;

	/**
	 * Response array contains ssl information from server
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $resources
	 */	
	private $resources;

	/**
	 * Certificate chain get from certificate info send by server
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $cert_chain
	 */	
	private $cert_chain;

	public function __construct( $host )
	{
		$this->host       = parse_url( $host, PHP_URL_HOST);
		$this->stream     = !empty( $this->isSSLAvailable() )?$this->getServerResponse():false;
		$this->resources  = !empty( $this->isSSLAvailable() )?stream_context_get_params( $this->stream ):false;
		$this->meta_info  = !empty( $this->isSSLAvailable() )?stream_get_meta_data( $this->stream ):false;
	}

	public function getServerResponse()
	{
		$ssloptions = [
			'ssl' => [
				'capture_peer_cert'       => true,
			    'capture_peer_cert_chain' => true, 
			    'allow_self_signed'       => false, 
			    'CN_match'                => $this->host, 
			    'verify_peer'             => true, 
			    'SNI_enabled'             => true,
			    'SNI_server_name'         => $this->host,
			    'cafile'                  => plugin_dir_path( __FILE__ ).'../cert/cacert.pem',
				'capture_session_meta'    => true
			]
		];

		$stream_context = stream_context_create( $ssloptions );
		$response = stream_socket_client("ssl://". $this->host .":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $stream_context);
		
		return $response;
	
	}

	private function getCertKeySize($cert_resource)
	{
		$key = openssl_pkey_get_public($cert_resource);
		$certinfo = openssl_pkey_get_details($key);
		return $certinfo['bits'];
	}

	public function getCRI( $crl )
	{
		$crl_String = preg_replace('/[ \t]+/', ' ', preg_replace('/[\r\n]+/', "", $crl) );
		return array_filter( explode('Full Name: URI:', $crl_String) );
	}
	private function processSSLInfo()
	{	
		if( empty($this->resources) )
			return false;

		$sslinfo = openssl_x509_parse( $this->resources['options']['ssl']['peer_certificate'] );
		$processedInfo = [
			'subject' => [
				'name' => $sslinfo['subject']['CN'],
				'link' => $sslinfo['subject']['CN'],
				'organization' => $sslinfo['subject']['O'],
				'location' => $sslinfo['subject']['L'].','.$sslinfo['subject']['ST'].','.$sslinfo['subject']['C'],
				'alternative_name' => $sslinfo['extensions']['subjectAltName']
			],
			'issuer' => [
				'organization' => $sslinfo['issuer']['O'],
				'link' => $sslinfo['issuer']['OU'],
				'common_name' => $sslinfo['issuer']['CN'],
				'location' => $sslinfo['issuer']['C']
			],
			'serial_number' => $sslinfo['serialNumber'],
			'protocol_support' => $this->meta_info['crypto']['protocol'],
			'version' => $sslinfo['version'],
			'valid_from' => date( 'M j Y G:i T', $sslinfo['validFrom_time_t']),
			'valid_to' => date( 'M j Y G:i T', $sslinfo['validTo_time_t']),
			'key_type' => $this->getCertKeySize( $this->resources['options']['ssl']['peer_certificate'] ),
			'sign_algo' => $sslinfo['signatureTypeLN'],
			'cri' => $this->getCRI( $sslinfo['extensions']['crlDistributionPoints'] ),
			'ocsp' => '',
			'ocsp_must_stampl' => '',
			'support_ocsp_stampl' => ''
		];

		return $processedInfo;
	}

	public function getSSLInfo()
	{	
		return $this->processSSLInfo();
	}

	public function isSSLAvailable()
	{
		return !empty(is_ssl( $this->host ))?true:false;	
	}

	private function processCertChain()
	{
		if( empty($this->resources) )
			return false;
		
		$cert_chain = [];
		foreach ($this->resources['options']['ssl']['peer_certificate_chain'] as $ctchain) {
			$cert_chain[] = openssl_x509_parse( $ctchain );
		}

		return $cert_chain; 
	}
	public function getCertChain()
	{
		return $this->processCertChain();
	}
}
