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
		
		// Get main menu items
		$menuItems = wp_get_nav_menu_items('main-menu');

		// Get the highest ancestor of the current page
		if (is_page() && !is_front_page() && !$post->post_parent) {
			$top_page = $post->ID;
		}

		if (is_page() && $post->post_parent) {
			$ancestors = get_post_ancestors($post->ID);
			$top_page = array_values(array_slice($ancestors, -1))[0];
		}

		$frontpage = (int)get_option('page_on_front');

		$pages = [];

		foreach ($menuItems as $i => $item) {
			// Get the actual page ID that the menu item points to.
			// https://wordpress.stackexchange.com/q/94787
			$pageId = get_post_meta( $item->ID, '_menu_item_object_id', true );
			$page = get_post($pageId);

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

			$pages[] = $page;
		}

		return $pages;
	}
}