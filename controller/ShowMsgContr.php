<?php
// 這個頁面是用來顯示每個訊息的內容
namespace controller;

use model\MsgList as MsgList;

session_start();

class ShowMsgContr
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
            abort(404);  // 根本沒有這一則訊息
        } elseif ($this->msg["memberID"] === $this->memberID) {
            // 驗證訊息的 memberID 與 登入者 memberID 是否相同
            view_path("showMessage.view.php", [
                'msg' => $this->msg
            ]);
        } else {
            abort(403);
        }
    }
}

$showmsg = new ShowMsgContr();
$showmsg->findingMsg();
$showmsg->readingAuthority();
