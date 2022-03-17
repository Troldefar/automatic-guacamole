<?php

abstract class Entity {
	
	protected string $table;
	protected array  $fields;
	protected /*c*/  $dbc;
	
	protected abstract function initFields();
	
	protected function __construct($dbc, $table) {
		$this->dbc = $dbc;
		$this->table = $table;
		$this->initFields();
	}
	
	public function findBy(string $fieldName, string $fieldValue): bool {
		try {
			$sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . $fieldName . ' = :value';
			$stmt = $this->dbc->prepare($sql);
			$stmt->execute(['value' => $fieldValue]);
			$data = $stmt->fetch();
			$this->setValues($data);
			return true;
		} catch (PDOException $e) {
			$e->getMessage();
			return false;
		}
	}
	
	public function setValues(array $values): void {
		foreach ($this->fields as $fieldName) $this->$fieldName = $values[$fieldName] ?? 'Unknown: $values[$fieldName]';
	}
	
}