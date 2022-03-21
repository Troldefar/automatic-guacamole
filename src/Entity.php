<?php

abstract class Entity {
	
	protected string $table;
	protected array  $fields;
	protected /*c*/  $dbc;
    protected $primaryKeys = ['id'];
	
	protected abstract function initFields();
	
	protected function __construct($dbc, $table) {
		$this->dbc = $dbc;
		$this->table = $table;
		$this->initFields();
	}

	public function findAll(): array {
		$results = [];
		$data = $this->find();

		if (!$data) return [];

		$class = static::class;
		foreach ($data as $key => $dataObject) {
			$object = new $class;
			$object = $this->setValues($dataObject, $object);
			$results[] = $object;
		}

		return $results;

	}

	private function find($fieldName = '', $fieldValue = '') {
        
        $results = [];
        $preparedFields = [];
        $sql = "SELECT * FROM " . $this->table;
        if($fieldName){
            $sql .= " WHERE " . $fieldName . " = :value";
            $preparedFields = ['value'=> $fieldValue];
        }
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute($preparedFields);
        
        $databaseData = $stmt->fetchAll();
        return $databaseData;
        
    }
	
	public function findBy(string $fieldName, string $fieldValue): bool {
		try {
			$results = $this->find($fieldName, $fieldValue);
			if ($results && isset($results[0])) $this->setValues($results[0]);
			return true;
		} catch (PDOException $e) {
			$e->getMessage();
			return false;
		}
	}
	
	public function setValues(array $values, object $object = null): void {
		if ($object === null) $object = $this;

		foreach ($this->fields as $fieldName) $this->$fieldName = $values[$fieldName] ?? 'Unknown: $values[$fieldName]';
	}

	public function save() {
        
        $fieldBindings = [];
        $keyBindings = [];
        $preparedFields = [];
        
        foreach ($this->primaryKeys as $keyName){
            $keyBindings[$keyName] = $keyName . ' = :' . $keyName;
            $preparedFields[$keyName] = $this->$keyName;
        }
        
        foreach ($this->fields as $fieldName){
            $fieldBindings[$fieldName] = $fieldName . ' = :' . $fieldName;
            $preparedFields[$fieldName] = $this->$fieldName;
        }
        
        $fieldBindingsString = join(', ', $fieldBindings);
        $keyBindingsString = join(', ', $keyBindings);
        $sql = "UPDATE " . $this->tableName . " SET " . $fieldBindingsString
                . " WHERE " . $keyBindingsString;

        $stmt = $this->dbc->prepare($sql);
        $stmt->execute($preparedFields);
        
    }
	
}