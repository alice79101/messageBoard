<?php

namespace controller;

use model\MsgModel as MsgModel;
use model\UserModel as UserModel;

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

    protected function getMsgInformation()
    {
        $this->dbMsg = new MsgModel();
        $this->msg = $this->dbMsg->findMsg($_GET["msgIndex"]);
//             dumpAndDie($this->msg);
    }
    protected function findMsgList($memberID)
    {
        $this->dbMsg = new MsgModel();
        $this->msg = $this->dbMsg->getAllMsg($memberID);
//        dumpAndDie($this->msg);
    }
    protected function getAdminValue()
    {
        $this->dbUser = new UserModel();
//        dumpAndDie($_SESSION);
        $this->user = $this->dbUser->findUserWithMemberID($_SESSION["memberID"]);
//        dumpAndDie($this->user);

    }

    protected function readingAuthority()
    {
        if (empty($this->msg)) {
            abort();
            exit();
        } else {
            $this->getAdminValue();
            if ($_SESSION["ADMIN"] === 1
                || $this->msg["memberID"] === $_SESSION["memberID"]) {

            } else {
                abort(403);
                exit();
            }
        }

    }


}