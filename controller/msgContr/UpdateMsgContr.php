<?php

namespace controller\msgContr;
//
//if (!isset($_SESSION)) {
//    session_start();
//}

// 使用者到達網頁的方式有三種：
//  1. GET方法，但尚未登入->請他登入
//  2. GET方法，已登入->驗證是否為使用者的訊息->顯示訊息內容
//  3. 已登入且已輸入表單->更新訊息

// 步驟：
// 一、判斷是否已登入 isset($_SESSION["memberID"]) ，未登入者導向登入
// 二、判斷已登入，判斷是否用GET方法抵達，是的話顯示訊息內容

//dumpAndDie($_GET);
use controller\FormValidateContr;
use controller\ManageMsgContr;
use model\MsgModel;

class UpdateMsgContr extends ManageMsgContr
{
    public $path = "msgViews/updateMsg.view.php"; // view 的頁面
    public $updateStatus = "NO";
    public $errMsg;
    public $newMsgTitle;
    public $newMsgContent;

    public function __construct()
    {
        $this->getMsgInformation($_GET["msgIndex"]); //取得 $this->dbMsg連線、$this->msg內容
        $this->readingAuthority();
        $this->landingMethodContr($this->path, [
            'msg' => $this->msg,
            'updateStatus' => $this->updateStatus,
            'errMsg' => $this->errMsg
        ]);
        $this->isEmptyMsg($this->msg);
    }

//    public function landingMethod()
//    {
////        dumpAndDie($_SERVER);
//        if ($_SERVER["REQUEST_METHOD"] === "POST") {
////            dumpAndDie($_POST);
//            $this->newMsgTitle = $_POST["Title"];
//            $this->newMsgContent = $_POST["content"];
////            dumpAndDie($this->newMsgTitle);
//
//        } else {
//            // 如果用 GET 方法抵達，直接顯示訊息
//            $this->landingMethodContr($this->path, [
//                'msg' => $this->msg,
//                'updateStatus' => $this->updateStatus
//            ]);
//        }

//    }


    public function updateFormValidate()
    {
        $this->newMsgTitle = $_POST["Title"];
        $this->newMsgContent = $_POST["content"];

        $validate = new FormValidateContr();
        if ($validate->emptyInput($this->newMsgTitle) || $validate->emptyInput($this->newMsgContent)) {
            $this->errMsg = "留言失敗：訊息主旨及內容皆為必填";
        }
        if ($validate->inputLengthValidate($this->newMsgTitle, 1, 100)
            || $validate->inputLengthValidate($this->newMsgContent, 1, 1000)) {
            $this->errMsg = "留言失敗：訊息主旨至多100字元、內容至多1,000字元";
        }
    }

    public function updateMsg()
    {
        // 輸入資料庫
        if (empty($this->errMsg)) {
//             $this->dbMsg = new MsgModel //已在前面取得留言資訊時啟動了
//             $this->msg = $this->dbMsg->getMsgInformation();
            $this->dbMsg->updateMsg($this->msg["msgIndex"], $this->newMsgTitle, $this->newMsgContent);
            $this->getMsgInformation($this->msg["msgIndex"]);
            $this->updateStatus = "YES";
        }
//        dumpAndDie($this->updateStatus);
        view_path($this->path, [
            'msg' => $this->msg,
            'updateStatus' => $this->updateStatus,
            'errMsg' => $this->errMsg
        ]);
    }


}

$updateMsg = new UpdateMsgContr();
$updateMsg->updateFormValidate();
$updateMsg->updateMsg();
