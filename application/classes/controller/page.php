<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Page extends Controller_Template {

	public $template = 'template';
	
	// whether to add CSS and JS
	public $template_extras = true;

	/**
	 * Get the currently logged in user
	 * 
	 * @param {string} $model Optional, return a different model instead of
	 * 						  Model_User.
	 * 
	 * @return {mixed} stdClass if not logged in, Model_User or $model
	 */
	protected function me($model = null) {
		$user = Auth::instance()->get_user();
		if ($user) {
			if ($model) {
				$user = ORM::factory($model, $user->id);
			}
		} else {
			$user = (object) array(
				'id' => null,
			);
		}

		return $user;
	}

	/**
	 * The before() method is called before your controller action.
	 * In our template controller we override this method so that we can
	 * set up default values. These variables are then available to our
	 * controllers if they need to be modified.
	 */
	public function before() {
		parent::before();

		if ($this->auto_render) {
			// Initialize empty values
			$this->template->title = '';
			$this->template->content = '';

			$this->template->styles = array();
			$this->template->scripts = array();
		}
	}

	/**
	 * The after() method is called after your controller action.
	 * In our template controller we override this method so that we can
	 * make any last minute modifications to the template before anything
	 * is rendered.
	 */
	public function after() {
		if ($this->auto_render && $this->template_extras) {
			$styles = array(
				//'http://fonts.googleapis.com/css?family=Oswald' => 'screen',
				'static/css/bootstrap.min.css' => 'screen',
				'static/css/theme.css' => 'screen',
			);

			$scripts = array(
				//'http://zeptojs.com/javascripts/zepto.min.js',
				'http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js',
				'static/js/cufon-yui.js',
				'static/js/HouschkaAltBlackRegular_900.font.js',
				'static/js/VAGLight_700.font.js',
				'static/js/nevisBold_700.font.js',
				'static/js/functions.js',
			);

			$this->template->styles = array_merge(
				$this->template->styles, 
				$styles
			);
			$this->template->scripts = array_merge(
				$this->template->scripts,
				$scripts
			);
		}
		
		parent::after();
	}	



}
