<?php
// Login 頁面動作
// 連結 view

use core\Dbh;
use controller\LoginContr as LoginContr;



// 取得表單資料
if ($_SERVER["REQUEST_METHOD"] === "POST") {
//    dumpAndDie($_POST); //看一下會收到什麼
    $userID = $_POST["userID"]; //ID為mail
    $userPassword = $_POST["password"];

    $login = new LoginContr($userID, $userPassword);
//    dumpAndDie($login->loginUser());
    $result = $login->loginUser();
//    $login = (array)$login;
//    dumpAndDie($result);
}

if (!empty($result)) {
    view_path("Login.view.php", [
        'errMsg' => $result
    ]);
} else {
    view_path("Login.view.php");
}
