<?php

namespace controller\msgContr;
//if (!isset($_SESSION)) {
//    session_start();
//}

use model\MsgModel as MsgModel;

class LatestMsgsContr
{
    public $latestMsgs;
    public $db;
    public $path = "msgViews/latestMsgs.view.php";

    public function __construct()
    {
        $this->db = new MsgModel();
    }

    public function getLatestMsgs()
    {
        $this->latestMsgs = $this->db->allMsgJoinMemberDESC("msgTime");
//       dumpAndDie($this->latestMsgs);
        if (count($this->latestMsgs) > 10) {
            $this->latestMsgs = array_slice($this->latestMsgs, 0, 10);
        }
    }

    public function showLatestMsgs()
    {
        view_path($this->path , [
            'latestMsg' => $this->latestMsgs
        ]);
    }
}

$latestMsg = new LatestMsgsContr();
$latestMsg->getLatestMsgs();
$latestMsg->showLatestMsgs();


