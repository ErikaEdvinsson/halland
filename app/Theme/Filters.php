<?php

namespace App\Theme;

class Filters
{
	public function __construct()
	{
		// Sage already modifies the read more link, we removed it from filters. See https://codex.wordpress.org/Customizing_the_Read_More
		add_action('excerpt_more', array($this, 'update_excerpt_more'));
	}

	/**
	 * Enqueue styles
	 * @return void
	 */
	public function update_excerpt_more()
	{			
		return '';
	}
}
