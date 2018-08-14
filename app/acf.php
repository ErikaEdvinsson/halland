<?php

namespace App;

class Acf
{
	public function __construct()
	{
		add_filter('acf/settings/path', array($this, 'settingsPath'));
		add_filter('acf/settings/dir', array($this, 'settingsDir'));
	}

	public function settingsPath($dir)
	{
		return HALLAND_PATH . 'vendor/advanced-custom-fields-pro/';
	}

	public function settingsDir($dir)
	{
		return HALLAND_URI . 'vendor/advanced-custom-fields-pro/';
	}
}