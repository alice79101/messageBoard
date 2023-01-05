<?php

//namespace messageBoard\controller;

require __DIR__ . "/../partials/head.php";
require __DIR__ . "/../partials/nav.php";
$heading = "My Message";
require __DIR__ . "/../partials/banner.php";
require __DIR__ . "/../core/Dbh.php";

$db = new Dbh();

// 驗證使用者身份，只能看到自己的訊息
$memberID =1;
$myMsg = $db->prepareSQL("SELECT * FROM msgList WHERE memberID =:memberID", [
    'memberID' => $memberID
])->getMsgs();
//dumpAndDie($myMsg);
//$myMsg = $db->prepareSQL("SELECT * FROM msgList WHERE memberID =1");








require __DIR__ . "/../view/myMessage.view.php";
require __DIR__ . "/../partials/footer.php";