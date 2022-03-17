<?php

class Template {
	
	private string $layout;
	
	public function __construct($layout) {
		$this->layout = $layout;
	}
	
	public function view($template, $args) {
		extract($args);
		include_once VIEW_PATH . 'layout/' . $this->layout . '.php';
	}
	
}