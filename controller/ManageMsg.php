<?php
namespace controller;
use model\MsgList as MsgList;

class ManageMsg
{
    protected $db;
    protected $msg;


    protected function loginConfirm()
    {
        if (!isset($_SESSION["memberID"])) {
            // 請他登入先
            abort(403);
            exit();
        }
    }
    protected function getMsgInformation()
    {
        $this->db = new MsgList();
        $this->msg = $this->db->findMsg($_GET["msgIndex"]);
//             dumpAndDie($this->msg);
    }
    protected function readingAuthority()
    {
        if (empty($this->msg)) {
            abort(404);  // 根本沒有這一則訊息
            exit();
        } elseif ($this->msg["memberID"] === $_SESSION["memberID"]) {
            // 驗證訊息的 memberID 與 登入者 memberID 是否相同

        } else {
            abort(403);
            exit();
        }
    }

}