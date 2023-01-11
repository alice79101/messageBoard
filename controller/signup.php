<?php

use controller\SignupContr;

view_path("partials/head.php");
view_path("partials/nav.php");


// 索取使用者輸入的資料
if ($_SERVER["REQUEST_METHOD"] === "POST") {
//    dumpAndDie($_POST); //看一下會收到什麼
    $nickname = $_POST["nickname"];
    $userID = $_POST["userID"]; //ID為mail
    $userPassword = $_POST["password"];
    $userPasswordRepeat = $_POST["passwordRepeat"];

    $signup = new SignupContr($nickname, $userID, $userPassword, $userPasswordRepeat);
    $signup->signupUser();
}


view_path("signup.view.php");

view_path("partials/footer.php");