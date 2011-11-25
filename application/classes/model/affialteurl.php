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

		if (strpos($shop->deep_url, '%') !== false) {
			// if the deep url has a "%" then replace "%" with an
			// encoded version of the user-supplied url
			$encoded = urlencode($this->original_url);
			$u = str_replace('%', $encoded, $shop->deep_url);
			
		} else {
			// if there's no "%", replace "#" with a non-encded
			// version of the url
			$u = str_replace('#', $this->original_url, $shop->deep_url);
		}

		return $u;
	}

}