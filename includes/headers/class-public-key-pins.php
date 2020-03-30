<?php

class PublicKeyPins extends Header
{
	function __construct( $headers )
	{
		parent::__construct('Public-Key-Pins','public-key-pins',$headers);
		
	}

	public function getPossibleValue()
	{
		return [];
	}

	public function getDescription()
	{
		return '<code>HTTP Public Key Pinning (HPKP)</code> was a security feature that used to tell a web client to associate a specific cryptographic public key with a certain web server to decrease the risk of MITM attacks with forged certificates. It has been removed in modern browsers and is no longer supported.' ;	
	}

	public function getRecommandedValue()
	{
		return '';
	}
}