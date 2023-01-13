<?php
// 這個頁面是用來顯示每個訊息的內容

use core\Dbh;

$db = new Dbh();
//dumpAndDie($_GET);
$msg = $db->query("SELECT * FROM msgList WHERE msgIndex = :msgIndex", [
    'msgIndex' => $_GET["msgIndex"]
])->findOne();
//dumpAndDie($msg);



// 先暫時放在這裡
//$heading = htmlspecialchars($msg["msgTitle"]);
//require __DIR__ . "/../view/partials/banner.php";

//尚未加入使用者身份驗證，要是自己或朋友的訊息才可瀏覽
//尚未加入修改、刪除功能


//dumpAndDie($latestMsg);

// 要可以看到自己跟朋友的訊息 >>>>還沒寫，先拿到所有人的留言


view_path("showMessage.view.php", [
    'msg' => $msg
]);