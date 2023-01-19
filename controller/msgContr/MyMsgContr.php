<?php
// 頁面目標：顯示所有自己 create 的 Msg
namespace controller\msgContr;
use model\MsgList as MsgList;

session_start();

class MyMsgContr
{
    public $myMsg;
    private $memberID;
    public $db;

    public function __construct()
    {
//        dumpAndDie(isset($_SESSION["memberID"]));
        if (isset($_SESSION["memberID"])) {
            $this->memberID = $_SESSION["memberID"];
        } else {
//            $this->myMsg = "請先登入";
            view_path("myMsg.view.php");
            exit();
        }
    }

    public function findMyMsg()
    {
        $this->db = new MsgList();
        $this->myMsg = $this->db->getAllMsg($this->memberID);
//        dumpAndDie($this->myMsg);
        view_path("myMsg.view.php", [
            'myMsg' => $this->myMsg
        ]);
    }

}

$myMsg = new MyMsgContr();
$myMsg->findMyMsg();


