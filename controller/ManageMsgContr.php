<?php

namespace controller;

use model\MsgModel as MsgModel;

class ManageMsgContr
{
    protected $dbMsg;
    protected $dbUser;
    protected $msg;
    protected $user;


    protected function loginConfirm()
    {
        if (!isset($_SESSION["memberID"])) {
            // 請他登入先
            abort(403);
            exit();
        }
    }

    protected function getMsgInformation($msgIndex)
    {
        $this->dbMsg = new MsgModel();
        $this->msg = $this->dbMsg->findAMsgWithColumn("msgIndex", $msgIndex);
//             dumpAndDie($this->msg);
    }

    protected function readingAuthority()
    {
        $this->loginConfirm();
//        dumpAndDie($this->msg);
        if ($_SESSION["ADMIN"] === 1
            || $this->msg["memberID"] === $_SESSION["memberID"]) {

        } else {
            abort(403);
            exit();
        }
    }
    public function landingMethodContr($path, $condition=[])
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            view_path($path, $condition);
            exit();
        }
    }
    protected function isEmptyMsg($message)
    {
        if (empty($message)) {
            abort();
            exit();
        }
    }
}