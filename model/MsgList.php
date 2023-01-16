<?php

namespace model;

use core\Dbh as Dbh;

class MsgList
{
    public $db;

    public function __construct()
    {
        $this->db = new Dbh();
    }

    public function findMsg($msgIndex)
    {
        $sql = "SELECT * FROM msgList WHERE msgIndex = :msgIndex;";
        $result = $this->db->query($sql, [
            ':msgIndex' => $msgIndex
        ])->findOne();
        return $result;
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

    public function updateMsg($msgIndex,$msgTitle, $msgContent, $memberID, $msgTime)
    {
        $sql = "UPDATE msgList SET msgTitle = :msgTitle, msgContent = :msgContent, memberID = :memberID, msgTime = :msgTime WHERE msgIndex = :msgIndex;";
        $this->db->query($sql, [
            'msgIndex' => $msgIndex,
            'msgTitle' => $msgTitle,
            'msgContent' => $msgContent,
            'memberID' => $memberID,
            'msgTime' => $msgTime
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
}