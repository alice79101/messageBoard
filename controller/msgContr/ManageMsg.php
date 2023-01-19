<?php

namespace controller\msgContr;

use model\MsgList as MsgList;
use model\User as User;

class ManageMsg
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
        $this->dbMsg = new MsgList();
        $this->msg = $this->dbMsg->findMsg($_GET["msgIndex"]);
//             dumpAndDie($this->msg);
    }
    protected function isAdmin()
    {
        $this->dbUser = new User();
//        dumpAndDie($_SESSION);
        $this->user = $this->dbUser->findUserMemberID($_SESSION["memberID"]);
//        dumpAndDie($this->user);
    }
    protected function readingAuthority()
    {
        if (empty($this->msg)) {
            abort();
            exit();
        } else {
            $this->isAdmin();
            if ($this->user["ADMIN"] === 1
                || $this->msg["memberID"] === $_SESSION["memberID"]) {

            } else {
                abort(403);
                exit();
            }
        }

    }


}