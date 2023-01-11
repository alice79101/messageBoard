<?php

namespace model;

use core\Dbh as Dbh;

class Signup extends Dbh
{

    public function checkUserExist($userID)
    {

        $sql = "SELECT * FROM membership WHERE userID =:userID;";
        $result = $this->query($sql, [
            'userID' => $userID
        ])->getAll();
//        dumpAndDie($result);
        return $result;
    }


    protected function insertUser($userID, $userpassword, $nickname)
    {
        $hashedPassword = password_hash($userpassword, PASSWORD_DEFAULT);
//        dumpAndDie($hashedPassword);
        $sql = "INSERT INTO `membership`(userID, password, nickname) VALUES (:userID, :password, :nickname);";
        $this->query($sql, [
            'userID' => $userID,
            'password' => $hashedPassword,
            'nickname' => $nickname
        ]);


    }
}