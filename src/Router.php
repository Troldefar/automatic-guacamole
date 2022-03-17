<?php

class Router extends Entity {
	public function __construct($dbc) {
		$this->dbc = $dbc;
		$this->table = 'routes';
		$this->fields = ['routeID', 'module', 'action', 'entityID', 'locater'];
	}
	
}