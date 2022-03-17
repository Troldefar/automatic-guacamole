<?php

class Router extends Entity {
	
	private static string $tableName = 'routes';
	
	public function __construct($dbc) {
		parent::__construct($dbc, self::$tableName);
		$this->dbc = $dbc;
		$this->table = self::$tableName;
	}
	
	protected function initFields() {
		$this->fields = ['routeID', 'module', 'action', 'entityID', 'locater'];
	}
	
}