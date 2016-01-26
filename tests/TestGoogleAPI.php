<?php

include_once 'vendor/autoload.php';

use Vicimus\Gicimus\GoogleAPI;

class TestGoogleAPI extends PHPUnit_Framework_TestCase
{
	/**
	 * Set these values to a valid key and secret to enable the tests
	 * 
	 * @var string $key
	 * @var string $secret
	 */
	private $key = 'AIzaSyD76bB9pNORju89cN4wzd4MMedquQdlV2k';

	public function testConstructor()
	{
		
	}