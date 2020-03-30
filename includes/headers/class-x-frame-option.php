<?php

/**
 * class XFO: X-Frame-Option to check and maintan all details about x frame option
 *
 * @since      1.0.0
 * @package    wp-servsec
 * @subpackage wp-servsec/includes
 */
class XFrameOption extends Header
{
	function __construct( $headers )
	{
		parent::__construct('X-Frame-Options', 'x-frame-options', $headers);
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
		return 'The <code>X-Frame-Options</code> HTTP response header can be used to indicate whether or not a browser should be allowed to render a page in a &lt;frame&gt;, &lt;iframe&gt;, &lt;embed&gt; or &lt;object&gt;. Sites can use this to avoid clickjacking attacks, by ensuring that their content is not embedded into other sites.';
	}

	/**
	 * @since    1.0.0
	 */
	public function getRecommandedValue()
	{
		return '';
	}
}