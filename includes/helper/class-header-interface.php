<?php

/**
 * 	
 */
interface HeaderInterface
{	
	/**
	 * Run test and check header exist or not
	 * 
	 * @since    1.0.0
	 * @access   public
	 * @method   test
	 * @return   boolean [return either true/false]
	 */
	public function test();

	/**
	 * Return header name
	 * 
	 * @since    1.0.0
	 * @access   public
	 * @method   getName
	 * @return   string [return header name]
	 */
	public function getName();

	/**
	 * Return current header value
	 * 
	 * @since    1.0.0
	 * @access   public
	 * @method   getValue
	 * @return   string [return current header value]
	 */
	public function getValue();

	/**
	 * Return header key for testing and set in headers array
	 * 
	 * @since    1.0.0
	 * @access   public
	 * @method   getKey
	 * @return   string [return header key for testing and set in headers array]
	 */
	public function getKey();

	/**
	 * Return description for header
	 * 
	 * @since    1.0.0
	 * @access   public
	 * @method   getDescription
	 * @return   string [return description for header]
	 */
	public function getDescription();

	/**
	 * Return possible value of header
	 * 
	 * @since    1.0.0
	 * @access   public
	 * @method   getPossibleValue
	 * @return   array [return possible value of header]
	 */
	public function getPossibleValue();

	/**
	 * Return recommanded value of header
	 * 
	 * @since    1.0.0
	 * @access   public
	 * @method   getRecommandedValue
	 * @return   string [return recommanded value of header]
	 */
	public function getRecommandedValue();

}