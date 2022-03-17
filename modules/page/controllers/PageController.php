<?php

class PageController extends Controller {
	
	public function defaultAction() {
		
		$template = new Template('default');
		
		$dbh = Database::getInstance();
		$dbc = $dbh->getConnection();
		
		$page = new Page($dbc);
		$page->findBy('pageID', $this->entityID);
		
		$args = [];
		
		$args['pageObj'] = $page;
		$template->view('../modules/page/views/static.php', $args);
	}
	
}