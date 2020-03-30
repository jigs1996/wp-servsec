<?php

class ExpectCT extends Header
{
	function __construct($headers)
	{
		parent::__construct("Expect-CT","expect-ct",$headers);
	}

	public function getPossibleValue()
	{
		return [];
	}

	public function getDescription()
	{
		return 'The <code>Expect-CT</code> header allows sites to opt in to reporting and/or enforcement of Certificate Transparency requirements, which prevents the use of misissued certificates for that site from going unnoticed.' ;	
	}

	public function getRecommandedValue()
	{
		return '';
	}
}