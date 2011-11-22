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
		return $url;
	}

	private function get_domain($url) {
		$matches = array();
		$count = preg_match('~^https?://(?:www\.)?([a-z0-9.-])~', $url, $matches);
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
		))->find();

		if (!$shop->loaded() || !$shop->deep_url) {
			return $this->original_url;
		}

		$deep_url = urlencode($this->original_url);

		return str_replace('%', $deep_url, $shop->deep_url);
	}

}