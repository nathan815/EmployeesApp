<?php
namespace App\Models;

use App\Database\DatabaseConnection;
use App\Database\DataQuery;

class Model {

    protected $databaseConn;
    protected $database;
    protected $tableName;

    public $created_at;

    public function __construct() {
        $this->databaseConn = DatabaseConnection::getInstance();
        $this->database = new DataQuery($this->databaseConn);
    }

    public function getAll($columns = '*', $orderBy = null, $limit = null) {
        $sql = "SELECT $columns FROM $this->tableName";
        if($orderBy) {
            $sql .= " ORDER BY $orderBy";
        }
        if(is_int($limit)) {
            $sql .= " LIMIT $limit";
        }
        return $this->database->query($sql)->fetchAll(\PDO::FETCH_CLASS, get_called_class());
    }

    public function findById($id, $columns = '*') {
        $sql = "SELECT $columns FROM $this->tableName WHERE id = :id";
        $rows = $this->database->preparedQuery($sql, [':id' => $id])->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        $this->columns = array_keys($rows);
        return isset($rows[0]) ? $rows[0] : false;
    }

    public function delete($id) {
        return $this->database->preparedQuery("DELETE FROM $this->tableName WHERE id = :id", ['id'=>$id]);
    }

    public function update($id, $columns) {
        $sql = "UPDATE $this->tableName SET ";
        $sql .= $this->generateSetStatements($columns);
        $sql .= " WHERE id = $id";
        $this->database->preparedQuery($sql, $columns);
        return $this->database->rowsAffected();
    }

    public function create($columns) {
        $sql = "INSERT INTO $this->tableName SET ";
        $sql .= $this->generateSetStatements($columns);
        $sql .= ", created_at = now()";
        $this->database->preparedQuery($sql, $columns);
        return $this->database->rowsAffected();
    }

    private function generateSetStatements($columns) {
        $setStatements = [];
        foreach($columns as $columnName => $columnVal) {
            $setStatements[] = "$columnName = :$columnName";
        }
        return implode(', ', $setStatements);
    }

}