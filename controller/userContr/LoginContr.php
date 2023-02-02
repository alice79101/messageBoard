<?php
// controller: 制定 Login 的動作內容、引導頁面動作、連結到 view

namespace controller;

use controller\FormValidateContr as FormValidateContr;
use model\UserModel as UserModel;

class LoginContr
{
    public $errMsg = "";
    public $path = "usrViews/login.view.php";
    public $validate;
    private $userID;
    private $userPassword;
    private $userData;

    public function __construct()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // 使用 POST 方法抵達網站，代表使用者有輸入表單，開始驗證表單
//             dumpAndDie($_POST); //看一下會收到什麼
            $this->userID = $_POST["userID"];
            $this->userPassword = $_POST["password"];
        } else {
            view_path($this->path, [
                'errMsg' => $this->errMsg
            ]);
        }
    }

    public function loginFormValidate()
    {
        $this->validate = new FormValidateContr();
        if ($this->validate->emptyInput($this->userID)
            || $this->validate->emptyInput($this->userPassword)
            === "Denied") {
            $this->errMsg = "請輸入所有欄位";
        } else {

            if ($this->validate->validateEmail($this->userID) === "Denied") {
                $this->errMsg = "帳號格式不符合 Email 格式，請重新輸入";
            }
            if ($this->validate->inputLengthValidate($this->userPassword, 6, 20) === "Denied") {
                $this->errMsg = "密碼介於6至20位間，且不含特殊符號，請重新輸入";
            }
//            dumpAndDie($this->validate->userIdExist($this->userID));
            if ($this->validate->userIdExist($this->userID) === "Not Exist") {
                $this->errMsg = "此帳號未經註冊，請先註冊";
                view_path($this->path, [
                    'errMsg' => $this->errMsg
                ]);
                exit();
            }
        }
//        dumpAndDie($this->errMsg);

    }

    public function loginUser()
    {
        if (empty($this->errMsg)) {
            // 通過表單驗證的話取得資料庫裡面 user 的資料
            $this->dbUser = new UserModel();
            $this->userData = $this->dbUser->findAUser($this->userID);
//            dumpAndDie($this->userData);
//        dumpAndDie($userData["password"]); // 從 Database 取得的密碼
//        dumpAndDie($this->password); // 從登入表單取得的密碼
//        dumpAndDie(password_verify($this->password, $result["password"]));
            if (password_verify($this->userPassword, $this->userData["password"])) {
                $this->errMsg = "登入成功";
//                session_start(); //已經在最開始網站router加入了，這邊就不用再次加入
//                dumpAndDie($this->userData);
                $_SESSION["memberID"] = $this->userData["memberID"];
                $_SESSION["nickname"] = $this->userData["nickname"];
                $_SESSION["ADMIN"] = $this->userData["ADMIN"];
//                dumpAndDie($_SESSION);
                require __DIR__ . "/../msgContr/MyMsgContr.php";
            } else {
                $this->errMsg = "登入失敗，帳號或密碼不正確";
            }
        }
        view_path($this->path, [
            'errMsg' => $this->errMsg
        ]);

    }

}

$login = new LoginContr();
$login->loginFormValidate();
$login->loginUser();