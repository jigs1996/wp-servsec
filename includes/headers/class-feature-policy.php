<?php

class FeaturePolicy extends Header
{
	function __construct($headers){
		parent::__construct('Feature-Policy','feature-policy',$headers);
	}

	public function getPossibleValue()
	{
		return [];
	}

	public function getDescription()
	{
		return 'The HTTP <code>Feature-Policy</code> header provides a mechanism to allow and deny the use of browser features in its own frame, and in content within any elements in the document.' ;	
	}

	public function getRecommandedValue()
	{
		return '';
	}
}