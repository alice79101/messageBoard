<?php

//namespace messageBoard\controller;

view_path("partials/head.php");
view_path("partials/nav.php");
view_path("partials/banner.php", [
    'heading' => "My Message"
]);

require base_path("core/Dbh.php");

$db = new Dbh();

// 驗證使用者身份，只能看到自己的訊息
$memberID =1;
$myMsg = $db->query("SELECT * FROM msgList WHERE memberID =:memberID", [
    'memberID' => $memberID
])->getMsgs();
//dumpAndDie($myMsg);
//$myMsg = $db->prepareSQL("SELECT * FROM msgList WHERE memberID =1");








view_path("myMessage.view.php", [
    'myMsg' => $myMsg
]);
view_path("partials/footer.php");