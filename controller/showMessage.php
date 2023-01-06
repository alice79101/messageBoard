<?php

require __DIR__ . "/../view/partials/head.php";
require __DIR__ . "/../view/partials/nav.php";
require __DIR__ . "/../core/Dbh.php";

// 這個頁面是用來顯示每個訊息的內容

$db = new Dbh();
//dumpAndDie($_GET);
$msg = $db->query("SELECT * FROM msgList WHERE msgIndex = :msgIndex", [
    'msgIndex' => $_GET["msgIndex"]
])->findMsg();
//dumpAndDie($msg);



// 先暫時放在這裡
$heading = htmlspecialchars($msg["msgTitle"]);
require __DIR__ . "/../view/partials/banner.php";
//尚未加入使用者身份驗證，要是自己或朋友的訊息才可瀏覽


//dumpAndDie($latestMsg);

// 要可以看到自己跟朋友的訊息 >>>>還沒寫，先拿到所有人的留言

require __DIR__ . "/../view/showMessage.view.php";
require __DIR__ . "/../view/partials/footer.php";