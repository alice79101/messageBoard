<?php
// Model: 負責 Signup 動作跟 Database 的溝通

namespace model;

use core\Dbh as Dbh;

class Signup extends Dbh
{
    // 索取 Database 資料，確認是否重複註冊 (userID)
    public function checkUserExist($userID)
    {

        $sql = "SELECT * FROM membership WHERE userID =:userID;";
        $result = $this->query($sql, [
            'userID' => $userID
        ])->getAll();
//        dumpAndDie($result);
        return $result;
    }

    // 註冊使用者（新稱表格資料）
    protected function insertUser($userID, $userpassword, $nickname)
    {
        $hashedPassword = password_hash($userpassword, PASSWORD_BCRYPT);
//        dumpAndDie($userpassword);
//        dumpAndDie($hashedPassword);
        $sql = "INSERT INTO `membership`(userID, password, nickname) VALUES (:userID, :password, :nickname);";
        $this->query($sql, [
            'userID' => $userID,
            'password' => $hashedPassword,
            'nickname' => $nickname
        ]);

//        dumpAndDie("insertUs");

    }
}