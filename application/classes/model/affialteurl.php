<?php

class Model_AffialteUrl {
	
	private $original_url;

	public function __construct($url) {
		$this->original_url = $this->fix_url($url);
	}

	private function fix_url($url) {
		if (!preg_match('~^https?://~', $url)) {
			$url = 'http://' . $url;
		}

		// Presents for men keeps '?src=aw' in product URLs then
		// breaks when Affilaite Window adds the tracking code.
		$url = str_replace('?src=aw', '', $url);

		return $url;
	}

	private function get_domain($url) {
		$matches = array();
		$count = preg_match('~^https?://(?:www\.)?([a-z0-9.-]+)~', $url, $matches);
		if ($count) {
			return $matches[1];
		}

		return false;
	}

	public function tracking_url() {
		$domain = $this->get_domain($this->original_url);
		
		if ($domain === false) {
			return $this->original_url;
		}

		$shop = ORM::factory('shop', array(
			'domain' => $domain,
		));

		if (!$shop->loaded() || !$shop->deep_url) {
			return $this->original_url;
		}

		$deep_url = urlencode($this->original_url);

		return str_replace('%', $deep_url, $shop->deep_url);
	}

}