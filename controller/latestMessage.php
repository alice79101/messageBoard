<?php

require __DIR__ . "/../view/partials/head.php";
require __DIR__ . "/../view/partials/nav.php";
$heading = "What's New?";
require __DIR__ . "/../view/partials/banner.php";
require __DIR__ . "/../core/Dbh.php";


$db = new Dbh();

$msgs = $db->query("SELECT * FROM msgList ORDER BY msgTime DESC")->getMsgs();
if (count($msgs) > 10 ) {
    $latestMsg = array_slice($msgs, 0, 10);
} else {
    $latestMsg = $msgs;
}


//dumpAndDie($latestMsg);

// 要可以看到自己跟朋友的訊息 >>>>還沒寫，先拿到所有人的留言

require __DIR__ . "/../view/latestMessage.view.php";
require __DIR__ . "/../view/partials/footer.php";