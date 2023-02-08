<?php

namespace controller\msgContr;
//if (!isset($_SESSION)) {
//    session_start();
//}

use controller\ManageMsgContr;
use controller\ManageUserContr;
use model\MsgModel as MsgModel;

class AllMsgsContr extends ManageMsgContr
{
    public $allMsgs;
    public $dbMsg;

    public $path = "msgViews/allMsgs.view.php";

    public function __construct()
    {
        $dbUser = new ManageUserContr();
        $dbUser->adminconfirm();

    }

    public function getAllMsgs()
    {
        $this->dbMsg = new MsgModel();
        $this->allMsgs = $this->dbMsg->allMsgJoinMemberDESC("msgIndex");
//       dumpAndDie($this->latestMsgs);
//        if (count($this->latestMsgs) > 10) {
//            $this->latestMsgs = array_slice($this->latestMsgs, 0, 10);
//        }
    }

    public function showAllMsgs()
    {
        view_path($this->path , [
            'allMsg' => $this->allMsgs
        ]);
    }
}

$latestMsg = new AllMsgsContr();
$latestMsg->getAllMsgs();
$latestMsg->showAllMsgs();


