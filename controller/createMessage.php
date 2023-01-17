<?php

namespace controller;

use model\MsgList as MsgList;
session_start();
//dumpAndDie(isset($_SESSION["memberID"]));
class CreateMessage
{
    public $errMsg = "";
    public $createStatus = "NO";
    private $msgTitle;
    private $msgContent;
    private $memberID;

    public function __construct()
    {
        // 使用者到達網頁的方式有三種：
        //  1. GET方法，但尚未登入->請他登入
        //  2. GET方法，已登入->顯示訊息框，讓他填寫表單
        //  3. 已登入且已輸入表單->送出驗證
        if (!isset($_SESSION["memberID"])) {
            // 請他登入先
            view_path("createMessage.view.php");
            exit();
        } else {

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                // 使用 POST 方法抵達網站，代表使用者有輸入表單，開始驗證表單
                // dumpAndDie($_POST); //看一下會收到什麼
                $this->msgTitle = $_POST["Title"];
                $this->msgContent = $_POST["content"];
                $this->memberID = $_SESSION["memberID"];
            }else {
                // 使用 GET 方法抵達網站，直接顯示view
                view_path("createMessage.view.php", [
                    'createStatus' => $this->createStatus,
                    'errMsg' => $this->errMsg
                ]);
                exit();
            }
        }
    }

    public function createFormValidate()
    {
        // 空白輸入驗證
        if (empty($this->msgTitle) || empty($this->msgContent)) {
            $this->errMsg = "留言失敗：訊息主旨及內容皆為必填";
        }

        // 內容過多驗證
//        dumpAndDie($this->errMsg);
        if (strlen($this->msgTitle) > 100 || strlen($this->msgContent) > 1000) {

            $this->errMsg = "留言失敗：訊息主旨至多100字元、內容至多1,000字元";
        }
    }

    public function insertMsg()
    {
        // 輸入資料庫
        if (empty($this->errMsg)) {
            $changedContent = changeWords($this->msgContent); // 保留空白跟換行
//        $content = nl2br($_POST["content"]); //這可以保留換行，但沒辦法保留空白
//        dumpAndDie($changedContent);
            $insertMsg = new MsgList();
            $insertMsg->createMsg($this->msgTitle, $changedContent, $this->memberID);
            $this->createStatus = "YES";
        }

        view_path("createMessage.view.php", [
            'createStatus' => $this->createStatus,
            'errMsg' => $this->errMsg
        ]);
    }

}

$createMsg = new CreateMessage();
$createMsg->createFormValidate();
$createMsg->insertMsg();