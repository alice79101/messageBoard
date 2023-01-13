<?php

namespace core;

use Dotenv\Dotenv;
use PDO;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

class SingletonDb
{
    private static $instance = null; // Singleton 必要項目
    private $dbConnection;
    private $host;
    private $dbuser;
    private $dbpwd;
    private $dbname;

    private function __construct()
    {
        // 這邊使用 .env 引入敏感值
        $this->host = $_ENV['host'];
        $this->dbname = $_ENV['dbname'];
        $this->dbpwd = $_ENV['dbpwd'];
        $this->dbuser = $_ENV['dbuser'];

//        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $dsn = "mysql:host=$this->host;port=3306;dbname=$this->dbname;charset=utf8mb4";
//        dumpAndDie($dsn); 驗證 $dsn 是否正確、有沒有抓到 .env 的資料
        $this->dbConnection = new PDO($dsn, $this->dbuser, $this->dbpwd, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC  //結果以array形式傳回
        ]);

    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new SingletonDb();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->dbConnection;
    }

}