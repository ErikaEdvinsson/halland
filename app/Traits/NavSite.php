<?php

namespace App\Traits;

trait NavSite
{
	/**
	 * Get navigation tree for the site nav
	 * @return string
	 */
	public function navSite()
	{
		global $post;
		
		if (!is_a($post, 'WP_Post')) {
			return;
		}

		$args = array(
			'output' => ARRAY_A
		);

		$menu = wp_get_nav_menu_items('Main menu', $args);
		
		var_dump($menu);
	
		// Get the highest ancestor of the current page
		if (is_page() && !is_front_page() && !$post->post_parent) {
			$top_page = $post->ID;
		}

		if (is_page() && $post->post_parent) {
			$ancestors = get_post_ancestors($post->ID);
			$top_page = array_values(array_slice($ancestors, -1))[0];
		}
		
		// Create pages array
		$pages = get_pages(array(
			'parent' => 0
		));

		$frontpage = (int)get_option('page_on_front');

		foreach ($pages as $i => $page) {
			if ($page->ID === $frontpage) {
				unset($pages[$i]);
				continue;
			}

			if (isset($top_page) && $top_page === $page->ID) {
				$page->active = true;
			}

			$page->children = get_pages(array( 
				'child_of' => $page->ID, 
				'parent' => $page->ID,
				'hierarchical' => 0,
				'sort_column' => 'menu_order', 
				'sort_order' => 'asc'
			));
		}

		return $pages;
	}

	/**
	 * Update the key of an array while preserving the order of the array
	 * https://stackoverflow.com/a/21299719
	 * @return array
	 */
	private function changeKeys($arr, $oldKey, $newKey)
	{
    	if (!array_key_exists($oldKey, $arr)) {
			return $arr;
    	}

		$keys = array_keys( $arr );
		$keys[ array_search( $oldKey, $keys ) ] = $newKey;
		
		var_dump(array_combine( $keys, $arr ));
		return array_combine( $keys, $arr );
	}
}