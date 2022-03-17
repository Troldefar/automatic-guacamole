<?php

class Entity {
	
	protected string $table;
	protected array  $fields;
	protected /*c*/  $dbc;
	
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