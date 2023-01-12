<?php
// Model: 負責 Login 和 Database 間的連結
namespace model;

use core\Dbh as Dbh;

class Login extends Dbh
{
    // 搜尋 Database 是否有 userID 相同者，檢查密碼是否相同
    protected function findUser($userID)
    {

        $sql = "SELECT * FROM membership WHERE userID =:userID;";
        $result = Dbh::__construct()->query($sql, [
            'userID' => $userID
        ])->findOne();

//        dumpAndDie($result);
        return $result;
    }

}