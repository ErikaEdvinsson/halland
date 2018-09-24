<?php

namespace App\Traits;

trait Bloginfo
{
	/**
	 * Return the sites title
	 * @return string
	 */
	public function siteTitle()
	{
		return get_bloginfo('name');
	}

	/**
	 * Return the sites description or "slogan"
	 * @return string
	 */	
	public function siteDescription()
	{
		return get_bloginfo('description');
	}
}
