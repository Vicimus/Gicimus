<?php

namespace Vicimus\Gicimus;

/**
 * The Place class represents information about a Place that has been
 * returned by the Google API after searching.
 *
 * @author Jordan Grieve <jgrieve@vicimus.com>
 */
class Place
{
	/**
	 * The street address of the place
	 *
	 * @var string
	 */
	public $formatted_address;

	/**
	 * The place identifier for the place
	 *
	 * @var string
	 */
	public $place_id;

	/**
	 * The place's rating
	 *
	 * @var float
	 */
	public $rating;

	/**
	 * The place's name
	 *
	 * @var string
	 */
	public $name;

	/**
	 * The place's icon url
	 *
	 * @var string
	 */
	public $icon;
	/**
	 * This is an array of properties that will be collected during
	 * the parsing of the place data. All other properties will be ignored.
	 *
	 * @var string[]
	 */
	protected static $properties = [
		'name',
		'icon',
		'formatted_address',
		'place_id',
		'rating'
	];

	/**
	 * Create an instance of Place by passing an array of properties.
	 * This is mainly used by the GoogleAPI to convert it's raw
	 * result data into a more usable collection of Places.
	 *
	 * @param string[] $args An array of properties to turn into a Place
	 *
	 * @return Place
	 */
	public static function create(array $args)
	{
		$instance = new self;

		foreach($args as $property => $value)
			if(in_array($property, self::$properties))
				$instance->$property = $value;

		return $instance;
	}
}