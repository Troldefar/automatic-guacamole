<?php

final class Database {
	
	private static $instance = null;
	private static $connection;
	
	public static function getInstance() {
		
		if (self::$instance === null) self::$instance = new Database();
		
		return self::$instance;
		
	}
	
	private function __construct() {
		
	}
	
	private function __clone() {
		
	}
	
	private function __wakeup() {
		
	}
	
	public static function connect($host, $db, $user, $password) {
		self::$connection = new PDO("mysql:dbname=$db;host=$host", $user, $password);
	}
	
	public static function getConnection() {
		return self::$connection;
	}
	
}