<?php

namespace controller\msgContr;

//if (!isset($_SESSION)) {
//    session_start();
//}

// 功能：刪除

//dumpAndDie($_GET);
class DeleteMsgContr extends ManageMsg
{
    public $path = "msgViews/deleteMsg.view.php";
    public $deleteStatus = "NO";


    public function __construct()
    {
        $this->loginConfirm();
        $this->getMsgInformation();
        $this->readingAuthority();
    }


    public function confirmDelete()
    {
//        dumpAndDie($_SERVER);
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
//            $this->db = new MsgModel();
            $this->dbMsg->deleteMsg($this->msg["msgIndex"]);
            $this->deleteStatus = "YES";
            require "MyMsgContr.php";
        } else {
            view_path($this->path, [
                'deleteStatus' => $this->deleteStatus,
                'msg' => $this->msg
            ]);
        }
    }


}

$deleteMsg = new DeleteMsgContr();
$deleteMsg->confirmDelete();
