<?php
namespace model;
use core\Dbh as Dbh;

class UserModel
{
    public $db;

    public function __construct()
    {
        $this->db = new Dbh();

    }
    public function findAUser($userID)
    {

        $sql = "SELECT * FROM membership WHERE userID =:userID;";
        $result = $this->db->query($sql, [
            'userID' => $userID
        ])->findOne();
//        dumpAndDie($result);
        return $result;
    }
    public function findUserMemberID($memberID)
    {
        $sql = "SELECT * FROM membership WHERE memberID =:memberID;";
        $result = $this->db->query($sql, [
            'memberID' => $memberID
        ])->findOne();
//        dumpAndDie($result);
        return $result;
    }
    public function insertUser($userID, $userpassword, $nickname)
    {
        $hashedPassword = password_hash($userpassword, PASSWORD_BCRYPT);
        $sql = "INSERT INTO `membership`(userID, password, nickname) VALUES (:userID, :password, :nickname);";
        $this->db->query($sql, [
            'userID' => $userID,
            'password' => $hashedPassword,
//            'password' => $userpassword,
            'nickname' => $nickname
        ]);
//        dumpAndDie("insertUs");
    }
}
