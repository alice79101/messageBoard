<?php
// 這個頁面是用來顯示每個訊息的內容
namespace controller\msgContr;

//if (!isset($_SESSION)) {
//    session_start();
//}

// 抵達此頁的要件：
// 1. 使用者有登入
// 2. 使用者有權限閱讀此訊息

// 可能有幾種情況：
// 1. 使用者用瀏覽器列試圖查看->沒登入->請先登入 （無 $_SESSION["memberID"] )
// 2. 使用者已登入試圖查看->403 (有 $_SESSION["memberID"] 比對訊息 ID 後不符合）
// 3. 使用者有登入&權限正確->正常顯示

use controller\ManageMsg;

class ShowMsgContr extends ManageMsg
{
    private $path = "msgViews/showMessage.view.php";

    public function __construct()
    {
        $this->loginConfirm();
//        dumpAndDie($this->user);
        $this->getMsgInformation();
    }

    public function showMsg()
    {
        $this->readingAuthority();
        view_path($this->path, [
            'msg' => $this->msg
        ]);
    }
}

$showMsg = new ShowMsgContr();
$showMsg->showMsg();
