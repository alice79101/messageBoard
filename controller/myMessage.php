<?php
use core\Dbh;



$db = new Dbh();

// 驗證使用者身份，只能看到自己的訊息
$memberID =1;
$myMsg = $db->query("SELECT * FROM msgList WHERE memberID =:memberID", [
    'memberID' => $memberID
])->getAll();
//dumpAndDie($myMsg);
//$myMsg = $db->prepareSQL("SELECT * FROM msgList WHERE memberID =1");








view_path("myMessage.view.php", [
    'myMsg' => $myMsg
]);
