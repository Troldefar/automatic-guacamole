<?php

class Controller {
	
	protected $entityID;
	
	public function runAction($action) {
		if (method_exists($this, 'runBeforeAction')) {
			$result = $this->runBeforeAction();
			if (!$result) return;
		}
		$action .= 'Action';
		if (method_exists($this, $action)) $this->$action();
		else include 'view/statusPages/404.php';
	}
	
	public function setEntityID($entityID) {
		$this->entityID = $entityID;
	}
	
}