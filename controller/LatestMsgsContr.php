<?php
session_start();
use model\MsgList as MsgList;

class LatestMsgsContr
{
    public $latestMsgs;
    public $db;
   public function __construct()
   {
       $this->db = new MsgList();
   }
   public function getLatestMsgs()
   {
       $this->latestMsgs = $this->db->descMsgs("msgTime");
//       dumpAndDie($this->latestMsgs);
       if (count($this->latestMsgs) > 10) {
           $this->latestMsgs = array_slice($this->latestMsgs, 0, 10);
       }
   }
   public function showLatestMsgs()
   {
       view_path("latestMsgs.view.php", [
           'latestMsg' => $this->latestMsgs
       ]);
   }
}

$latestMsg = new LatestMsgsContr();
$latestMsg->getLatestMsgs();
$latestMsg->showLatestMsgs();


