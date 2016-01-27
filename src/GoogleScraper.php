<?php

namespace Vicimus\Gicimus;

use PHPHtmlParser\Dom;

/** 
 * The Google Scraper attempts to retrieve data from publicly
 * accessable google pages.
 *
 * @author Jordan Grieve <jgrieve@vicimus.com>
 */
class GoogleScraper
{
	/**
	 * Attempts to get the URL to a given profiles
	 * photo. This method will return the URL or will return
	 * boolean false if the profile photo could not be scraped.
	 *
	 * @param string $profileURL 	The URL to the profile
	 *
	 * @return string|boolean
	 */
	public function profilePhoto($profileURL)
	{
		$contents = @file_get_contents($profileURL.'/posts');

		if(!$contents)
			return false;

		$position = stripos($contents, 'dkb photo');

		/* Chop off all of the string before this position */
		$contents = substr($contents, $position);
		$position = stripos($contents, '<img');
		$contents = substr($contents, $position);
		$position = stripos($contents, '>');

		/* Chop off everything after the position */
		$contents = substr($contents, 0, $position + 1);

		$dom = new Dom;
		$dom->load($contents);

		$img = $dom->find('img', 0);

		$src = $img->getAttribute('src');

		if(substr($src, 0, 2) == '//')
			$src = 'https:'.$src;

		return $src;
	}
}