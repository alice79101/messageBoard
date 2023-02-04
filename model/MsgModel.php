<?php

namespace model;

use core\Dbh as Dbh;

class MsgModel
{
    public $db;

    public function __construct()
    {
        $this->db = new Dbh();
    }
    public function createMsg($msgTitle, $msgContent, $memberID)
    {
        $sql = "INSERT INTO msgList(msgTitle, msgContent, memberID) VALUES (:msgTitle , :msgContent, :memberID);";
        $this->db->query($sql, [
            'msgTitle' => $msgTitle,
            'msgContent' => $msgContent,
            'memberID' => $memberID
        ]);
    }

    public function findAMsgWithColumn($column, $value)
    {
        $sql = "SELECT * FROM msgList WHERE " . $column . " = :column;";
        $result = $this->db->query($sql, [
            ':column' => $value
        ])->findOne();
        return $result;
    }
    public function getAllMsgWithColumn($column, $value)
    {
        $sql = "SELECT * FROM msgList WHERE " . $column . " = :column;";
        $result = $this->db->query($sql, [
            ':column' => $value
        ])->getAll();
//        dumpAndDie($result);
        return $result;
    }
    public function updateMsg($msgIndex, $msgTitle, $msgContent)
    {
        // updateMsg 有用到
        $sql = "UPDATE msgList SET msgTitle = :msgTitle, msgContent = :msgContent WHERE msgIndex = :msgIndex;";
        $this->db->query($sql, [
            'msgIndex' => $msgIndex,
            'msgTitle' => $msgTitle,
            'msgContent' => $msgContent
        ]);
    }

    public function deleteMsg($msgIndex)
    {
        //是否要少用？
        $sql = "DELETE FROM msgList WHERE msgIndex = :msgIndex;";
        $this->db->query($sql, [
            'msgIndex' => $msgIndex
        ]);

    }
    public function allMsgJoinMemberDESC($column = "msgTime")
    {
        $sql = "SELECT * FROM msgList, membership WHERE msgList.memberID = membership.memberID ORDER BY " . $column . " DESC;";
        $result = $this->db->query($sql)->getAll();
        return $result;
    }
}