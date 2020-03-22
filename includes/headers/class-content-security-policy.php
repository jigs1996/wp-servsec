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
		return 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.' ;	
	}

	public function getRecommandedValue()
	{
		return '';
	}
}