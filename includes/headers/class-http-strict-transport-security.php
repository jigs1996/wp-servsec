<?php

class HttpStrictTransportSecurity extends Header
{
	
	function __construct( $headers )
	{
		parent::__construct('Http-Strict-Transport-Security','strict-transport-security',$headers);
		
	}

	public function getPossibleValue()
	{
		return [];
	}

	public function getDescription()
	{
		return 'The HTTP <code>Strict-Transport-Security</code> response header (often abbreviated as HSTS) lets a web site tell browsers that it should only be accessed using HTTPS, instead of using HTTP.' ;	
	}

	public function getRecommandedValue()
	{
		return '';
	}
}