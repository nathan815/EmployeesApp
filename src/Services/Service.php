<?php
namespace App\Services;

use App\Database\DatabaseConnection;
use App\Database\DataQuery;

class Service {
    protected $dbConn;
    protected $dataQuery;

    public function __construct(DatabaseConnection $db) {
        $this->dbConn = $db->getConnection();
        $this->dataQuery = new DataQuery($db);
    }

}