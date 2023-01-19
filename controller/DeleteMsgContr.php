<?php

namespace controller;

use model\MsgList as MsgList;

session_start();

// 功能：刪除

//dumpAndDie($_GET);
class DeleteMsgContr extends ManageMsg
{
    public $path = "deleteMsg.view.php";
    public $deleteStatus = "NO";


    public function __construct()
    {
        $this->loginConfirm();
        $this->readingAuthority();
    }


    public function confirmDelete()
    {
//        dumpAndDie($_SERVER);
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
//            $this->db = new MsgList();
            $this->db->deleteMsg($this->msg["msgIndex"]);
            $this->deleteStatus = "YES";
        }
        view_path($this->path, [
            'deleteStatus' => $this->deleteStatus,
            'msg' => $this->msg
        ]);
    }


}

$deleteMsg = new DeleteMsgContr();
$deleteMsg->confirmDelete();
