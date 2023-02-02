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
        return $result;  // 沒有結果的話會是 false
    }
    public function findUserWithMemberID($memberID)
    {
        $sql = "SELECT * FROM membership WHERE memberID =:memberID;";
        $result = $this->db->query($sql, [
            'memberID' => $memberID
        ])->findOne();
//        dumpAndDie($result);
        return $result;
    }
    public function getAllValidUser()
    {
        $sql = "SELECT * FROM membership WHERE (`delete` IS NULL);";
        $result = $this->db->query($sql)->getAll();
//        dumpAndDie($result);
        return $result;
    }
    public function getSameUserID($userID)
    {
        $sql = "SELECT * FROM membership WHERE userID = :userID;";
        $result = $this->db->query($sql, [
            'userID' => $userID
        ])->getAll();
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
    public function updateUser($memberID, $userID, $userpassword, $nickname, $admin = "")
    {
        $hashedPassword = password_hash($userpassword, PASSWORD_BCRYPT);
        $sql = "UPDATE membership SET `userID` = :userID, `password` = :password, `nickname` = :nickname, `ADMIN` = :ADMIN WHERE memberID = :memberID;";
        $this->db->query($sql, [
            'memberID' =>$memberID,
            'userID' => $userID,
            'password' => $hashedPassword,
            'nickname' => $nickname,
            'ADMIN' => $admin,
        ]);
    }
    public function updateUserWithoutPassword($memberID, $userID, $nickname, $admin = "")
    {
        $sql = "UPDATE membership SET `userID` = :userID, `nickname` = :nickname, `ADMIN` = :ADMIN WHERE memberID = :memberID;";
        $this->db->query($sql, [
            'memberID' =>$memberID,
            'userID' => $userID,
            'nickname' => $nickname,
            'ADMIN' => $admin,
        ]);
    }
    public function fakeDeleteUser($memberID)
    {
        $sql = "UPDATE membership SET `delete` = 1 WHERE `memberID` = :memberID;";
        $this->db->query($sql, [
            'memberID' => $memberID
        ]);
    }
}
