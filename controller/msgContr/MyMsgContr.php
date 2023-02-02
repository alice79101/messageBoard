<?php
// 頁面目標：顯示所有自己 create 的 Msg
namespace controller\msgContr;

//use model\MsgModel as MsgModel;
//if (!isset($_SESSION)) {
//    session_start();
//}
//session_start();

use controller\ManageMsgContr;

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
        $this->findMsgList($this->memberID);
        view_path($this->path, [
            'myMsg' => $this->msg
        ]);
    }

}

$myMsg = new MyMsgContr();
$myMsg->MyMsgList();


