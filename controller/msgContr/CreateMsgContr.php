<?php

namespace controller\msgContr;

use controller\FormValidateContr;
use controller\ManageMsgContr as ManageMsgContr;
use model\MsgModel as MsgModel;

class CreateMsgContr extends ManageMsgContr
{
    public $errMsg = "";
    public $createStatus = "NO";
    public $path = "msgViews/createMessage.view.php";
    private $msgTitle;
    private $msgContent;
    private $memberID;
//    private $validate;

    public function __construct()
    {
        // 使用者到達網頁的方式有三種：
        //  1. GET方法，但尚未登入->請他登入
        //  2. GET方法，已登入->顯示訊息框，讓他填寫表單
        //  3. 已登入且已輸入表單->送出驗證
        $this->loginConfirm(); //ManageMsgContr
    }

    public function landingMethod()
    {
        $this->landingMethodContr($this->path, [ //ManageMsgContr
            'createStatus' => $this->createStatus,
            'errMsg' => $this->errMsg
        ]);
        $this->msgTitle = $_POST["Title"];
        $this->msgContent = $_POST["content"];
        $this->memberID = $_SESSION["memberID"];
    }

    public function createFormValidate()
    {
        $validate = new FormValidateContr();
        if ($validate->emptyInput($this->msgTitle) || $validate->emptyInput($this->msgContent)) {
            $this->errMsg = "留言失敗：訊息主旨及內容皆為必填";
        }
       if ($validate->inputLengthValidate($this->msgTitle, 0, 100)
        || $validate->inputLengthValidate($this->msgContent, 0, 1000)) {
           $this->errMsg = "留言失敗：訊息主旨至多100字元、內容至多1,000字元";
       }
    }

    public function insertMsg()
    {
        // 輸入資料庫
        if (empty($this->errMsg)) {
            $insertMsg = new MsgModel();
            $insertMsg->createMsg($this->msgTitle, $this->msgContent, $this->memberID);
            $this->createStatus = "YES";
        }

        view_path($this->path, [
            'createStatus' => $this->createStatus,
            'errMsg' => $this->errMsg
        ]);
    }

}

$createMsg = new CreateMsgContr();
$createMsg->landingMethod();
$createMsg->createFormValidate();
$createMsg->insertMsg();