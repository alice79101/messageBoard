<?php
// 頁面目標：顯示所有自己 create 的 Msg
namespace controller\msgContr;

//use model\MsgModel as MsgModel;
//if (!isset($_SESSION)) {
//    session_start();
//}
//session_start();

use controller\ManageMsgContr;
use model\MsgModel;

class MyMsgContr extends ManageMsgContr
{
    public $path = "msgViews/myMsg.view.php";
    private $memberID;

    public function __construct()
    {
        $this->loginConfirm();
        $this->memberID = $_SESSION["memberID"];

    }

    public function MyMsgList()
    {
        $dbMsg = new MsgModel();
        $this->msg = $dbMsg->getAllMsgWithColumn("memberID", $this->memberID);
//        $this->findMsgList("memberID", $this->memberID);
        view_path($this->path, [
            'myMsg' => $this->msg
        ]);
    }

}

$myMsg = new MyMsgContr();
$myMsg->MyMsgList();


