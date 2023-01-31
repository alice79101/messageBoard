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

    public function findMsg($msgIndex)
    {
        $sql = "SELECT * FROM msgList WHERE msgIndex = :msgIndex;";
        $result = $this->db->query($sql, [
            ':msgIndex' => $msgIndex
        ])->findOne();
        return $result;
    }

    public function getAllMsg($memberID)
    {
        $sql = "SELECT * FROM msgList WHERE memberID = :memberID;";
        $result = $this->db->query($sql, [
            'memberID' => $memberID
        ])->getAll();
        return $result;
    }

    public function descMsgs($column = "msgTime")
    {
        $sql = "SELECT * FROM msgList ORDER BY " . $column . " DESC;";
        $result = $this->db->query($sql)->getAll();
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

    public function updateMsg($msgIndex, $msgTitle, $msgContent)
    {
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

    public function findMsgJoinMember($msgIndex)
    {
        $sql = "SELECT * FROM msgList, membership WHERE msgList.memberID = membership.memberID;";
        $result = $this->db->query($sql, [
            ':msgIndex' => $msgIndex
        ])->findOne();
        return $result;
    }

    public function allMsgJoinMemberDESC($column = "msgTime")
    {
        $sql = "SELECT * FROM msgList, membership WHERE msgList.memberID = membership.memberID ORDER BY " . $column . " DESC;";
        $result = $this->db->query($sql)->getAll();
        return $result;
    }
}