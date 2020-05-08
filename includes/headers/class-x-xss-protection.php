<?php

class XXSSProtection extends Header
{
	function __construct($headers)
	{
		parent::__construct("X-XSS-Protection","x-xss-protection",$headers);
	}

	public function getPossibleValue()
	{
		return [];
	}

	public function getDescription()
	{
		return 'The HTTP <code>X-XSS-Protection</code> response header is a feature of Internet Explorer, Chrome and Safari that stops pages from loading when they detect reflected cross-site scripting (XSS) attacks. Although these protections are largely unnecessary in modern browsers when sites implement a strong Content-Security-Policy that disables the use of inline JavaScript (\'unsafe-inline\'), they can still provide protections for users of older web browsers that don\'t yet support CSP.' ;	
	}

	public function getRecommandedValue()
	{
		return '';
	}
}