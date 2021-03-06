<?php
namespace App\Database;

class DataQuery {
    /** @var DatabaseConnection */
    private $pdo;

    /** @var \PDOStatement */
    private $statement;

    public function __construct(DatabaseConnection $conn) {
        $this->pdo = $conn->getConnection();
    }

    public function query($sql) {
        $this->statement = $this->pdo->query($sql);
        return $this->statement;
    }

    public function preparedQuery($sql, $params) {
        $this->statement = $this->pdo->prepare($sql);
        $this->statement->execute($params);
        return $this->statement;
    }

    public function fetchRowIntoObject($class) {
        $rows = $this->fetchAllIntoObjects($class);
        return isset($rows[0]) ? $rows[0] : null;
    }

    public function fetchAllIntoObjects($class) {
        return $this->statement->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    private function handleErrors() {
        if(!$this->statement) {
            $err = $this->statement->errorInfo();
            if($err)
                throw new DataQueryException("Database query error: " . implode(', ', $err));
        }
    }

    public function rowsAffected() {
        return $this->statement->rowCount();
    }

    public function lastId() {
        return $this->pdo->lastInsertId();
    }
}