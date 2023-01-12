<?php

namespace core;
use Dotenv\Dotenv;
use PDO;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

class Dbh
{
    public $connection;
    public $statement;
    private $host;
    private $dbuser;
    private $dbpwd;
    private $dbname;

    public function __construct()
    {
        // 這邊使用 .env 引入敏感值
        $this->host = $_ENV['host'];
        $this->dbname = $_ENV['dbname'];
        $this->dbpwd = $_ENV['dbpwd'];
        $this->dbuser = $_ENV['dbuser'];

//        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $dsn = "mysql:host=$this->host;port=3306;dbname=$this->dbname;charset=utf8mb4";
//        dumpAndDie($dsn); 驗證 $dsn 是否正確、有沒有抓到 .env 的資料
        $this->connection = new PDO($dsn, $this->dbuser, $this->dbpwd, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC  //結果以array形式傳回
        ]);
        return $this;

    }

    public function viewMsgs()
    {
        $sql = "SELECT * FROM msgList";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $msgs = $statement->fetchAll();
//        dumpAndDie($msgs);
        return $msgs;

    }

    public function myMsgs($memberID = NULL)
    {
        $sql = "SELECT * FROM msgList WHERE memberID = ? ORDER BY msgTime DESC";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$memberID]);
        $msgs = $statement->fetchAll();
//        dumpAndDie($msgs);
        return $msgs;
    }

    //原本使用上面的 vieMsg() 和 myMsg()，但既然有不同情境會更改 $sql ，何不把這個 function 變得更通用
    public function query($sql, $conditions = [])
    {
        $this->statement = $this->connection->prepare($sql);
        $this->statement->execute($conditions);
//        dumpAndDie($this); //驗證 $statement有沒有值
        return $this;

    }


    public function getAll()
    {
        return $this->statement->fetchAll();
    }

    public function findOne()
    {
        return $this->statement->fetch();
    }

}