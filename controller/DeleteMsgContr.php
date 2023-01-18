<?php

namespace controller;

use model\MsgList as MsgList;

session_start();

// 功能：刪除

//dumpAndDie($_GET);
class DeleteMsgContr
{
    public $path = "deleteMsg.view.php";
    public $deleteStatus = "NO";
    private $db;
    private $msgIndex;
    private $msg;

    public function __construct()
    {
        // 判斷是否登入
        if (!isset($_SESSION["memberID"])) {
            // 請他登入先
            view_path($this->path, [
                'deleteStatus' => $this->deleteStatus
            ]);
            exit();
        } else {
            $this->msgIndex = $_GET["msgIndex"];
            $this->db = new MsgList();
            $this->msg = $this->db->findMsg($this->msgIndex);
//            dumpAndDie($this->msg);
        }

    }

    public function readingAuthority()
    {
        if (empty($this->msg)) {
            abort(404);  // 根本沒有這一則訊息
            exit();
        } elseif ($this->msg["memberID"] === $_SESSION["memberID"]) {
            // 驗證訊息的 memberID 與 登入者 memberID 是否相同
            view_path($this->path, [
                'msg' => $this->msg,
                'deleteStatus' => $this->deleteStatus
            ]);

        } else {
            abort(403);
            exit();
        }
    }

    public function confirmDelete()
    {
//        dumpAndDie($_SERVER);
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->db = new MsgList();
            $this->db->deleteMsg($this->msgIndex);
            $this->deleteStatus = "YES";
        }
        view_path($this->path, [
            'deleteStatus' => $this->deleteStatus,
            'msg' => $this->msg
        ]);
    }


}

$deleteMsg = new DeleteMsgContr();
$deleteMsg->readingAuthority();
$deleteMsg->confirmDelete();
