<?php

class ContentSecurityPolicy extends Header
{
	function __construct($headers){
		parent::__construct('Content-Security-Policy','content-security-policy',$headers);
		
	}

	public function getPossibleValue()
	{
		return [];
	}

	public function getDescription()
	{
		return '<b>Content Security Policy (CSP)</b> is an added layer of security that helps to detect and mitigate certain types of attacks, including Cross Site Scripting (XSS) and data injection attacks. These attacks are used for everything from data theft to site defacement to distribution of malware. <br/> For more information use this link: <a href="https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy" target="_blank">https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy</a>' ;	
	}

	public function getRecommandedValue()
	{
		return '';
	}
}