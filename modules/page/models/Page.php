<?php

class Page extends Entity {
	
	private static string $tableName = 'pages';
	
	public function __construct($dbc) {
		parent::__construct($dbc, self::$tableName);
	}
	
	protected function initFields() {
		$this->fields = ['pageID', 'title', 'content'];
	}
	
}