<?php

require __DIR__ . "/../view/partials/head.php";
require __DIR__ . "/../view/partials/nav.php";
$heading = "My Message";
require __DIR__ . "/../view/partials/banner.php";
require __DIR__ . "/../core/Dbh.php";

$db = new Dbh();

// 驗證使用者身份，只能看到自己的訊息
$memberID =1;

if ($_SERVER["REQUEST_METHOD"] === 'POST')
//    dumpAndDie($_POST); // 驗證表單傳出來的內容是什麼
    $db->query('INSERT INTO msgList(msgTitle, msgContent, memberID) VALUES (:msgTitle , :msgContent, :memberID)', [
    'msgTitle' => $_POST["Title"],
    'msgContent' => $_POST["content"],
    'memberID' => "1"
]);






require __DIR__ . "/../view/createMessage.view.php";
require __DIR__ . "/../view/partials/footer.php";