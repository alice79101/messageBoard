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


    public function __construct()
    {
        $this->connection = SingletonDb::getInstance()->getConnection();
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