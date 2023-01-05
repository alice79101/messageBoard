<?php
//namespace controller;
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


    public $connection;


    public function __construct()
    {
//        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $this->host = $_ENV['host'];
        $this->dbname = $_ENV['dbname'];
        $this->dbpwd = $_ENV['dbpwd'];
        $this->dbuser = $_ENV['dbuser'];

        $dsn = "mysql:host=$this->host;port=3306;dbname=$this->dbname;charset=utf8mb4";
//        dumpAndDie($dsn); 驗證 $dsn 是否正確、有沒有抓到 .env 的資料
        $this->connection = new PDO($dsn, $this->dbuser, $this->dbpwd, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        $this->connection = new PDO($dsn, $this->dbuser);
        return $this;

    }

    public function viewMsgs()
    {
        $sql = "SELECT * FROM msgList" ;
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $msgs = $statement->fetchAll();
//        dumpAndDie($msgs);
        return $msgs;

    }

    public function myMsgs($memberID = NULL)
    {
        $sql = "SELECT * FROM msgList WHERE memberID = ? ORDER BY msgTime";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$memberID]);
        $msgs = $statement->fetchAll();
//        dumpAndDie($msgs);
        return $msgs;
    }

    public function createMsg()
    {

    }

}