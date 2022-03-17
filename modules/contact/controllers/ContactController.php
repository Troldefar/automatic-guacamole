<?php

class ContactController extends Controller {
	
	public function runBeforeAction() {
		if ($_SESSION['submitted'] ?? 0 === 1) {
			$template = new Template('default');
			$dbh = Database::getInstance();
			$dbc = $dbh->getConnection();
			
			$page = new Page($dbc);
			$page->findBy('pageID', 2);
			
			$args = [];
			
			$args['pageObj'] = $page;
			$template->view('view/static.php', $args);
			return false;
		}
		return true;
	}
	
	public function defaultAction() {
		$template = new Template('default');
		$dbh = Database::getInstance();
		$dbc = $dbh->getConnection();
		
		$page = new Page($dbc);
		$page->findBy('pageID', $this->entityID);
		
		$args = [];
		
		$args['pageObj'] = $page;
		$template->view('view/contact/contact.php', $args);
	}
	
	public function submitContactFormAction() {
		$_SESSION['submitted'] = 1;
		$template = new Template('default');
		$dbh = Database::getInstance();
		$dbc = $dbh->getConnection();
		
		$page = new Page($dbc);
		$page->findBy('pageID', 4);
		
		$args = [];
		
		$args['pageObj'] = $page;
		$template->view('view/static.php', $args);
	}
	
}