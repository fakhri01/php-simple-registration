<?php
require __DIR__ . '/vendor/autoload.php';

class DB {
    public ?PDO $db = null;
    private $host;
    private $username;
    private $password;
    private $database;

    public function __construct() {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        $this->host = $_ENV["DATABASE_HOST"];
        $this->database = $_ENV['DATABASE_NAME'];
        $this->username = $_ENV['DATABASE_USER'];
        $this->password = $_ENV['DATABASE_PASS'];
    }

    protected function connect(): PDO {
        try {
            $this->db = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return $this->db;
    }
}
?>
