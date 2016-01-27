<?php

include_once 'vendor/autoload.php';

use Vicimus\Gicimus\GoogleScraper;

class TestGoogleScraper extends PHPUnit_Framework_TestCase
{

	private $testURL = 'https://plus.google.com/108194545362332230856';

	public function testFailure()
	{
		$scraper = new GoogleScraper;

		$profilePhoto = $scraper->profilePhoto('garbage');

		$this->assertFalse($profilePhoto);
	}

	public function testSuccess()
	{
		$scraper = new GoogleScraper;
		$profilePhoto = $scraper->profilePhoto($this->testURL);

		$this->assertInternalType('string', $profilePhoto);
	}
}