<?php

namespace Vicimus\Gicimus;

/**
 * The Review class is used to represent a review that was left on a place
 * on Google Plus.
 *
 * @author Jordan Grieve <jgrieve@vicimus.com>
 */
class Review
{
	/**
	 * The author of the review
	 *
	 * @var string
	 */
	public $author_name;

	/**
	 * The URL to the authors google plus page
	 *
	 * @var string
	 */
	public $author_url;

	/**
	 * The preferred language of the author
	 *
	 * @var string
	 */
	public $language;

	/**
	 * The rating of the review
	 *
	 * @var float
	 */
	public $rating;

	/**
	 * The body of the review
	 *
	 * @var string
	 */
	public $text;

	/**
	 * The breakdown of the review rating
	 *
	 * @var string[]
	 */
	public $aspects;

	/**
	 * This is an array of properties that will be collected during
	 * the parsing of the review. All other properties will be ignored.
	 *
	 * @var string[]
	 */
	protected static $properties = [
		'author_name',
		'author_url',
		'language',
		'rating',
		'text',
		'time',
		'aspects',
	];

	/**
	 * Create an instance of Review by passing an array of properties.
	 * This is mainly used by the GoogleAPI to convert it's raw
	 * result data into a more usable collection of Reviews.
	 *
	 * @param string[] $args An array of properties to turn into a Review
	 *
	 * @return Review
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