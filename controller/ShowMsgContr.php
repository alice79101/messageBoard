<?php
// 這個頁面是用來顯示每個訊息的內容
namespace controller;

use model\MsgList as MsgList;

session_start();

// 抵達此頁的要件：
// 1. 使用者有登入
// 2. 使用者有權限閱讀此訊息

// 可能有幾種情況：
// 1. 使用者用瀏覽器列試圖查看->沒登入->請先登入 （無 $_SESSION["memberID"] )
// 2. 使用者已登入試圖查看->403 (有 $_SESSION["memberID"] 比對訊息 ID 後不符合）
// 3. 使用者有登入&權限正確->正常顯示

class ShowMsgContr
{
    public $db;
    private $path = "showMessage.view.php";
    private $memberID;
    private $msg;

    public function __construct()
    {
        if (!isset($_SESSION["memberID"])) {
            view_path($this->path);
            exit();
        } else {
            $this->memberID = $_SESSION["memberID"];
        }
    }

    public function findingMsg()
    {
        $this->db = new MsgList();
        $this->msg = $this->db->findMsg($_GET["msgIndex"]);
    }

    public function readingAuthority()
    {
        if (empty($this->msg)) {
            abort(404);  // 根本沒有這一則訊息
        } elseif ($this->msg["memberID"] === $this->memberID) {
            // 驗證訊息的 memberID 與 登入者 memberID 是否相同
            view_path("showMessage.view.php", [
                'msg' => $this->msg
            ]);
        } else {
            abort(403);
        }
    }
}

$showMsg = new ShowMsgContr();
$showMsg->findingMsg();
$showMsg->readingAuthority();
