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
	
		// Get the highest ancestor of the current page
		if (is_page() && !is_front_page() && !$post->post_parent) {
			$top_page = $post->ID;
		}

		if (is_page() && $post->post_parent) {
			$ancestors = get_post_ancestors($post->ID);
			$top_page = array_values(array_slice($ancestors, -1))[0];
		}
		
		// Get main menu items and frontpage
		$menuItems = wp_get_nav_menu_items('main-menu');
		$frontpage = (int)get_option('page_on_front');

		foreach ($menuItems as $i => $item) {
			// Get the actual page ID that the menu item points to.
			// https://wordpress.stackexchange.com/q/94787
			$pageId = get_post_meta( $item->ID, '_menu_item_object_id', true );

			if ($pageId === $frontpage) {
				unset($pages[$i]);
				continue;
			}

			if (isset($top_page) && $top_page === $pageId) {
				$page->active = true;
			}

			$item->children = get_pages(array( 
				'child_of' => $pageId, 
				'parent' => $pageId,
				'hierarchical' => 0,
				'sort_column' => 'menu_order', 
				'sort_order' => 'asc'
			));
		}

		return $menuItems;
	}
}