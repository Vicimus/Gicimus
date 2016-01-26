<?php

include_once 'vendor/autoload.php';

use Vicimus\Gicimus\GoogleAPI;
use Vicimus\Gicimus\Place;
use Vicimus\Gicimus\PlaceDetails;
use Vicimus\Gicimus\Review;

class TestGoogleAPI extends PHPUnit_Framework_TestCase
{
	/**
	 * Set this value to a valid key to enable the tests
	 * 
	 * @var string $key
	 */
	private $key = '';

	public function testConstructor()
	{
		$api = new GoogleAPI($this->key);

		$this->assertObjectHasAttribute('key', $api);

		$this->assertInstanceOf('Vicimus\Gicimus\GoogleAPI', $api);

	}

	public function testPlaceSearch()
	{
		$api = new GoogleAPI($this->key);
		$place = $api->place('Oakridge Ford');

		$this->assertTrue(count($place) > 0);

		$this->assertInstanceOf('Vicimus\Gicimus\Place', $place[0]);

		return $place[0];
	}

	/**
	 * @depends testPlaceSearch
	 */
	public function testPlaceDetails(Place $place)
	{
		$api = new GoogleAPI($this->key);

		$details = $api->details($place);

		$this->assertInstanceOf('Vicimus\Gicimus\PlaceDetails', $details);

		return $details;
	}

	/**
	 * @depends testPlaceDetails
	 */
	public function testPlaceDetailsReviews(PlaceDetails $details)
	{
		$this->assertTrue(count($details->reviews) > 0);

		$first = $details->reviews[0];

		$this->assertInstanceOf('Vicimus\Gicimus\Review', $first);

		return $first;
	}

	/**
	 * @depends testPlaceDetailsReviews
	 */
	public function testReviewTimestamp(Review $review)
	{
		$this->assertInstanceOf('DateTime', $review->time);

		$hash = $review->hash();

		$this->assertInternalType('string', $hash);

		$second = clone($review);

		$secondHash = $second->hash();

		$this->assertEquals($hash, $secondHash);

		$review->text = 'random string';

		$this->assertNotEquals($review->hash(), $second->hash());
	}
}