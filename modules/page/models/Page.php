<?php

class Page extends Entity {
	
	public function __construct($dbc) {
		$this->dbc = $dbc;
		
		$this->table = 'pages';
		$this->fields = ['pageID', 'title', 'content'];
	}
	
}