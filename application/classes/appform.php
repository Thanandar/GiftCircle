<?php

class Appform extends Useradmin_Appform {

	/**
	 * Add a class to the input attributes array.
	 * @param array $attributes
	 * @param string $class
	 * @return array
	 */
	protected static function add_class ($attributes, $class) {
		if (isset($attributes['class']))
		{
			$attributes['class'] .= ' ' . $class;
		}
		else
		{
			$attributes['class'] = $class;
		}
		return $attributes;
	}

	/**
	 * Load values for errors, defaults and values from AppForm instance.
	 * @param <type> $name
	 * @param <type> $value
	 * @param <type> $attributes 
	 */
	private function load_values ($name, &$value, &$attributes) {
		if (isset($this->errors[$name]))
		{
			$attributes = Appform::add_class($attributes, 'error');
		}
		if (isset($this->defaults[$name]) && $value == NULL)
		{
			$value = $this->defaults[$name];
		}
		if (isset($this->values[$name]) && $value == NULL)
		{
			$value = $this->values[$name];
		}
	}

	/**
	 * Add alert span for error or field info
	 * 
	 * @param string $errorName $this->errors[$name]
	 * @param string $attrInfo  $attributes['info']
	 * @return string
	 */
	private function addAlertSpan($errorName, $attributes = NULL) {
		if (isset($errorName))
		{
			$result = '<span class="error help-inline">' 
			        . ucfirst($errorName) 
			        . '</span>';
		}
		else 
		{
			if (isset($attributes['info']))
			{
				// else add info span
				$result = '<span class="'.$this->info_class.' help-inline">' 
				        . $attributes['info'] 
				        . '</span>';
			}
		}
		return (string) (isset($result))?$result:'';
	}
	
	/**
	 * Creates a form input. If no type is specified, a "text" type input will
	 * be returned.
	 *
	 * @param   string  input name
	 * @param   string  input value
	 * @param   array   html attributes
	 * @return  string
	 */
	public function input($name, $value = NULL, array $attributes = NULL) {
		$attributes = Appform::add_class($attributes, 'text');
		$attributes['id'] = $name;
		$this->load_values($name, $value, $attributes);
		return Kohana_Form::input($name, $value, $attributes)
			. $this->addAlertSpan((isset($this->errors[$name])?$this->errors[$name]:NULL), $attributes);
	}	

	/**
	 * Creates a password form input.
	 *
	 * @param   string  input name
	 * @param   string  input value
	 * @param   array   html attributes
	 * @return  string
	 */
	public function password($name, $value = NULL, array $attributes = NULL) {
		$attributes = Appform::add_class($attributes, 'password');
		$attributes['id'] = $name;
		$this->load_values($name, $value, $attributes);
		return Kohana_Form::password($name, $value, $attributes)
			. $this->addAlertSpan((isset($this->errors[$name])?$this->errors[$name]:NULL), $attributes);
	}

	/**
	 * Creates a checkbox form input.
	 *
	 * @param   string   input name
	 * @param   string   input value
	 * @param   boolean  checked status
	 * @param   array    html attributes
	 * @return  string
	 */
	public function checkbox($name, $value = NULL, $checked = FALSE, array $attributes = NULL)
	{
		$attributes['id'] = $name;
		$this->load_values($name, $value, $attributes);
		return Kohana_Form::checkbox($name, $value, $checked, $attributes)
			. $this->addAlertSpan((isset($this->errors[$name])?$this->errors[$name]:NULL), $attributes);
	}


}