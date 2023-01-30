<?php

namespace controller\msgContr;
session_start();

use model\MsgList as MsgList;

class LatestMsgsContr
{
    public $latestMsgs;
    public $db;
    public $path = "msgViews/latestMsgs.view.php";

    public function __construct()
    {
        $this->db = new MsgList();
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


