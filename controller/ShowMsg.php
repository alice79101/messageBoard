<?php
// 這個頁面是用來顯示每個訊息的內容
namespace controller;

use model\MsgList as MsgList;

//require BASE_PATH . "core/functions.php";
session_start();

class ShowMsg
{
    public $db;
    private $memberID;
    private $msg;

    public function __construct()
    {
        $this->memberID = $_SESSION["memberID"];
    }

    public function findingMsg()
    {
        $this->db = new MsgList();
        $this->msg = $this->db->findMsg($_GET["msgIndex"]);
    }

    public function readingAuthority()
    {
        if (empty($this->msg)) {
            abort(404);
        } elseif ($this->msg["memberID"] === $this->memberID) {
            view_path("showMessage.view.php", [
                'msg' => $this->msg
            ]);
        } else {
            abort(403);
        }
    }
}

$showmsg = new ShowMsg();
$showmsg->findingMsg();
$showmsg->readingAuthority();
