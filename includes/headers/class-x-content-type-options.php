<?php

/**
 * 
 */
class XContentTypeOptions extends Header
{
	function __construct( $headers )
	{
		parent::__construct('X-Content-Type-Options', 'x-content-type-options', $headers);
	}

	/**
	 * @since    1.0.0
	 */
	public function getPossibleValue()
	{
		return [];
	}

	/**
	 * @since    1.0.0
	 */
	public function getDescription()
	{
		return '<code>The X-Content-Type-Options</code> response HTTP header is a marker used by the server to indicate that the MIME types advertised in the Content-Type headers should not be changed and be followed. This allows to opt-out of MIME type sniffing, or, in other words, it is a way to say that the webmasters knew what they were doing.' ;	
	}

	/**
	 * @since    1.0.0
	 */
	public function getRecommandedValue()
	{
		return '';
	}
}