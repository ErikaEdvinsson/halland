<?php

namespace App\Theme;

class Enqueue
{
	protected $COMPONENT_LIB_URL = '//regionhalland.github.io/styleguide/dist/css/main.min.css';

	public function __construct()
	{
		// Enqueue Region Halland Component Library
		if (!empty(env('COMPONENT_LIB_URL'))) {
			$this->COMPONENT_LIB_URL = env('COMPONENT_LIB_URL');
		}
		
		add_action('wp_enqueue_scripts', array($this, 'styles'));
		add_action('wp_enqueue_scripts', array($this, 'scripts'));
		add_action('wp_enqueue_scripts', array($this, 'jquery'));
		add_theme_support( 'title-tag' );
	}

	/**
	 * Enqueue styles
	 * @return void
	 */
	public function styles()
	{			
		wp_enqueue_style('rh-components', $this->COMPONENT_LIB_URL, false, null);
		wp_enqueue_style('halland/main.css', \App\asset_path('styles/main.css'), false, null);
	}

	/**
	 * Enqueue styles
	 * @return void
	 */
	public function scripts()
	{
		// Theme JS
		wp_enqueue_script('halland/main.js', \App\asset_path('scripts/main.js'), ['jquery'], null, true);
	}

	/**
	 * Register jQuery and enqueue the footer
	 * @return void
	 */
	public function jquery()
	{	
		if (is_admin()) {
			return;
		}
			
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', false, false, true);
		wp_enqueue_script('jquery');
	}
}
