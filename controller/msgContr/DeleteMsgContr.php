<?php

namespace controller\msgContr;
// 頁面功能：刪除

//dumpAndDie($_GET);
use controller\ManageMsgContr;
use model\MsgModel;

class DeleteMsgContr extends ManageMsgContr
{
    public $path = "msgViews/deleteMsg.view.php";
    public $deleteStatus = "NO";

    public function __construct()
    {
        //先確認登入身份、取得訊息內容、判斷有無閱讀權限
        $this->getMsgInformation($_GET["msgIndex"]);
//        dumpAndDie($this->msg);
        $this->readingAuthority();
        $this->landingMethodContr($this->path, [
            'deleteStatus' => $this->deleteStatus,
            'msg' => $this->msg
        ]);
    }

    public function confirmDelete()
    {
        $deleteMsg = new MsgModel();
        $deleteMsg->deleteMsg($this->msg["msgIndex"]);
        $this->deleteStatus = "YES";
        require "MyMsgContr.php";
    }

}

$deleteMsg = new DeleteMsgContr();
$deleteMsg->confirmDelete();
