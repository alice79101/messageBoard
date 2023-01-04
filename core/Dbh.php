<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
class Dbh
{
    private $host;
    private $dbuser;
    private $dbpwd;
    private $dbname;

    protected function __construct()
    {
//        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $this->host = $_ENV['host'];
        $this->dbname = $_ENV['dbname'];
        $this->dbpwd = $_ENV['dbpwd'];
        $this->dbuser = $_ENV['dbuser'];

        $dsn = "msql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
        $this->connection = new PDO($dsn, $this->dbuser, $this->dbpwd, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    protected function query()
    {

    }

}