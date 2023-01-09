<?php

view_path("partials/head.php");
view_path("partials/nav.php");
view_path("partials/banner.php", [
    'heading' => "What's New?"
]);

require base_path("core/Dbh.php");


$db = new Dbh();

$msgs = $db->query("SELECT * FROM msgList ORDER BY msgTime DESC")->getMsgs();
if (count($msgs) > 10 ) {
    $latestMsg = array_slice($msgs, 0, 10);
} else {
    $latestMsg = $msgs;
}


//dumpAndDie($latestMsg);

// 要可以看到自己跟朋友的訊息 >>>>還沒寫，先拿到所有人的留言


view_path("latestMessage.view.php", [
    'latestMsg' => $latestMsg
]);
view_path("partials/footer.php");
