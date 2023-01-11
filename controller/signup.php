<?php
use core\Dbh;
use core\SignupContr;
use core\Signup;

view_path("partials/head.php");
view_path("partials/nav.php");

//    dumpAndDie(isset($_POST["submit"]));

// 索取使用者輸入的資料
if ($_SERVER["REQUEST_METHOD"] === "POST") {
//    dumpAndDie($_POST); //看一下會收到什麼
    $nickname = $_POST["nickname"];
    $userID = $_POST["userID"]; //ID為mail
    $userPassword = $_POST["password"];
    $userPasswordRepeat = $_POST["passwordRepeat"];

    // Instantiate SignupContr class
//    include base_path("core/SignupContr.php");
//    include base_path("core/Signup.classes.php");
//    $signup = new SignupContr($nickname, $userID, $userPassword, $userPasswordRepeat);
    $signup = new SignupContr($nickname, $userID, $userPassword, $userPasswordRepeat);
    $signup->signupUser();
}


view_path("signup.view.php");

view_path("partials/footer.php");