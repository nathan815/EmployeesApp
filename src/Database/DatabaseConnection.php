<?php
namespace App\Database;
use \PDO;

class DatabaseConnection {
    private static $instance = null;
    private $db;
    private $host;
    private $username;
    private $password;
    private $database;

    private function __construct() {
        $this->loadCredentials();
        try {
            $this->db = new PDO("mysql:host=$this->host;dbname=$this->database",
                $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            print "Database Connection Error: " . $e->getMessage();
            exit;
        }
    }

    private function loadCredentials() {
        $this->host = env('db_host');
        $this->username = env('db_username');
        $this->password = env('db_password');
        $this->database = env('db_name');
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->db;
    }
}