<?php
/**
 * @namespace http://ws.dimuthu.org/php/myecho/types
 */
class testObject {

	/**
	 * @var integer aint
	 */
	public $aint;

	/**
	 * @var string astring
	 */
	public $astring;
}

/* The mapping of schema types to PHP class */
$classmap = array("test-object" => "testObject");