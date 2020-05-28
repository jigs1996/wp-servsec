<?php
/**
 * class SSl_Info
 * 
 * @since      	1.0.0
 * @package 	wp-servsec
 * @subpackage 	wp-servsec/includes
 */
class SSl_Info
{
	/**
	 * A url of which needs to be tested
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $host    A url name of which needs to be tested
	 */	
	private $host;

	/**
	 * A domain name of which needs to be tested
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $host    A domain name of which needs to be tested
	 */	
	private $domain;
	
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
		$this->host       = $host;
		$this->domain     = parse_url( $this->host, PHP_URL_HOST);
		$this->stream     = $this->isSSLAvailable() ? $this->getServerResponse() : false;
		$this->resources  = $this->isSSLAvailable() ? stream_context_get_params( $this->stream ) : false;
		$this->meta_info  = $this->isSSLAvailable() ? stream_get_meta_data( $this->stream ) : false;
	}

	/**
	 * send request to server to with certificate,
	 * which will respons with ssl certificate information
	 *
	 * @since    1.0.0
	 * @access   public
	 * @method   getServerResponse
	 * @return   array [ server response]
	 */
	public function getServerResponse()
	{
		$ssloptions = [
			'ssl' => [
				'capture_peer_cert'       => true,
			    'capture_peer_cert_chain' => true, 
			    'allow_self_signed'       => false, 
			    'CN_match'                => $this->domain, 
			    'verify_peer'             => true, 
			    'SNI_enabled'             => true,
			    'SNI_server_name'         => $this->domain,
			    'cafile'                  => plugin_dir_path( __FILE__ ).'../cert/cacert.pem',
			]
		];

		$stream_context = stream_context_create( $ssloptions );
		$response = stream_socket_client("ssl://". $this->domain .":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $stream_context);
		
		return $response;
	
	}

	/**
	 * get certificate key size
	 *
	 * @since    1.0.0
	 * @access   private
	 * @method   getCertKeySize
	 * @param    resource $cert_resource
	 * @return   int [ return certificate algorithm key size in bits ]
	 */
	private function getCertKeySize($cert_resource)
	{
		$key = openssl_pkey_get_public($cert_resource);
		$certinfo = openssl_pkey_get_details($key);
		return $certinfo['bits'];
	}

	/**
	 * extract curi from crlDistributionPoints value
	 *
	 * @since    1.0.0
	 * @access   private
	 * @method   getCRI
	 * @param    array $crl
	 * @return   array [ return array of curi ]
	 */
	private function getCRI( $crl )
	{
		if(empty($crl['extensions']['crlDistributionPoints']))
			return '';

		$crl_String = preg_replace('/[ \t]+/', ' ', preg_replace('/[\r\n]+/', "", $crl['extensions']['crlDistributionPoints']) );

		return array_filter( explode('Full Name: URI:', $crl_String) );
	}

	/**
	 * get processed array of ssl info
	 *
	 * @since    1.0.0
	 * @access   private
	 * @method   processSSLInfo
	 * @return   array [ return processed array of ssl info ]
	 */
	private function processSSLInfo()
	{	
		if( empty($this->resources) )
			return false;

		$sslinfo = openssl_x509_parse( $this->resources['options']['ssl']['peer_certificate'] );
		$processedInfo = [
			'subject' => $this->getSSLSubject( $sslinfo ),
			'issuer' => $this->getSSLIssuer( $sslinfo ),
			'serial_number' => $sslinfo['serialNumber'],
			'protocol_support' => $this->meta_info['crypto']['protocol'],
			'version' => $sslinfo['version'],
			'valid_from' => date( 'M j Y G:i T', $sslinfo['validFrom_time_t']),
			'valid_to' => date( 'M j Y G:i T', $sslinfo['validTo_time_t']),
			'key_type' => $this->getCertKeySize( $this->resources['options']['ssl']['peer_certificate'] ),
			'sign_algo' => $sslinfo['signatureTypeLN'],
			'cri' => $this->getCRI( $sslinfo ),
			'ocsp' => '',
			'ocsp_must_stampl' => '',
			'support_ocsp_stampl' => ''
		];

		return $processedInfo;
	}

	/**
	 * get processed array of ssl info
	 *
	 * @since    1.0.0
	 * @access   private
	 * @method   getSSLSubject
	 * @param    array  $sslinfo
	 * @return   array [ return details of domain ssl sender ]
	 */
	private function getSSLSubject( $sslinfo ){

		$location = '';
		if(!empty($sslinfo['subject']['L']))
			$location .= ' '.$sslinfo['subject']['L'];

		if(!empty($sslinfo['subject']['ST']))
			$location .= ' '.$sslinfo['subject']['ST'];
		
		if(!empty($sslinfo['subject']['C']))
			$location .= ' '.$sslinfo['subject']['C'];

		return [
				'name' => !empty($sslinfo['subject']['CN'])?$sslinfo['subject']['CN']:'',
				'link' => !empty($sslinfo['subject']['CN'])?$sslinfo['subject']['CN']:'',
				'organization' => !empty($sslinfo['subject']['O'])?$sslinfo['subject']['O']:'',
				'location' => $location,
				'alternative_name' => !empty($sslinfo['extensions']['subjectAltName'])?$sslinfo['extensions']['subjectAltName']:''
			];
	}

	/**
	 * get processed array of ssl info
	 *
	 * @since    1.0.0
	 * @access   private
	 * @method   getSSLIssuer
	 * @param    array  $sslinfo
	 * @return   array [ return details of domain ssl issuer ]
	 */
	private function getSSLIssuer( $sslinfo ){

		return [
				'organization' => !empty($sslinfo['issuer']['O'])?$sslinfo['issuer']['O']:'',
				'link' => !empty($sslinfo['issuer']['OU'])?$sslinfo['issuer']['OU']:'',
				'common_name' => !empty($sslinfo['issuer']['CN'])?$sslinfo['issuer']['CN']:'',
				'location' => !empty($sslinfo['issuer']['C'])?$sslinfo['issuer']['C']:''
			];
	}

	/**
	 * invocke method who made private mehod call
	 *
	 * @since    1.0.0
	 * @access   public
	 * @method   getSSLInfo
	 * @return   array [ invocke method who made private mehod call ]
	 */
	public function getSSLInfo()
	{	
		return $this->processSSLInfo();
	}

	/**
	 * check site is secure with ssl or not
	 *
	 * @since    1.0.0
	 * @access   public
	 * @method   isSSLAvailable
	 * @return   array [ ssl available or not on url ]
	 */
	public function isSSLAvailable()
	{
		$host_part = explode('://', $this->host);

		return ( $host_part[0] == 'https' ) ? true : false;	
	}

	/**
	 * extract certification chain
	 * WIP
	 * @since    1.0.0
	 * @access   private
	 * @method   processCertChain
	 * @return   array [ ]
	 */
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

	/**
	 * check site is secure with ssl or not
	 *
	 * @since    1.0.0
	 * @access   public
	 * @method   getCertChain
	 * @return   array [ ]
	 */
	public function getCertChain()
	{
		return $this->processCertChain();
	}
}
