<?php
// Controller：制定 signup 動作的內容、引導頁面動作、連結到 view

namespace controller;

use controller\FormValidateContr as FormValidateContr;
use model\UserModel as UserModel;

class SignupContr extends ManageUserContr
{
    public $errMsg = [];
    public $path = "usrViews/signup.view.php";
    private $nickname;
    private $userID;
    private $userPassword;
    private $userPasswordRepeat;

    public function __construct()
    {
        $this->landingMethodContr($this->path);
        // 使用 POST 方法抵達網站，代表使用者有輸入表單，開始驗證表單
//             dumpAndDie($_POST); //看一下會收到什麼
        $this->nickname = $_POST["nickname"];
        $this->userID = $_POST["userID"]; //ID為mail
        $this->userPassword = $_POST["password"];
        $this->userPasswordRepeat = $_POST["passwordRepeat"];
    }

    public function signupFormValidate()
    {
        // 表單驗證項目
        $validate = new FormValidateContr();
        // 空白輸入驗證
        if ($validate->emptyInput($this->nickname)
            || $validate->emptyInput($this->userID)
            || $validate->emptyInput($this->userPassword)
            || $validate->emptyInput($this->userPasswordRepeat)
            === "Denied") {
            $this->errMsg['emptyInput'] = "請輸入所有欄位";
        } else {
            // 非空白輸入才驗證其他項目
            if ($validate->inputLengthValidate($this->nickname, 3, 30) === "Denied") {
                $this->errMsg['nickname'] = "暱稱須介於3~30字元之間，請重新輸入";
            }
            if ($validate->validateEmail($this->userID) === "Denied") {
                $this->errMsg['email'] = "Email 格式不正確，請重新確認";
            }
            if ($validate->inputLengthValidate($this->userPassword, 6, 20) === "Denied") {
                $this->errMsg['password'] = "密碼不可以有特殊符號，且限制於 6~20字元之間";
            }
            if ($validate->passwordMatch($this->userPassword, $this->userPasswordRepeat) === "Denied") {
                $this->errMsg['passwordRepeat'] = "兩次輸入的密碼不一致，請重新輸入";
            }
            if ($validate->userIdExist($this->userID) === "Exist") {
                $this->errMsg['userID'] = "這個 Email 已經註冊過";
            }
        }
    }

    public function signupUserValidate()
    {
//        dumpAndDie(empty($this->errMsg)); // 看一下 $this->errMsg裡面有沒有東西
        if (empty($this->errMsg)) {
            // 如果沒有錯誤訊息，代表通過表單驗證，可讓使用者註冊
            $signup = new UserModel();
            $signup->insertUser($this->userID, $this->userPassword, $this->nickname);
//            $this->errMsg['signupStatus'] = "註冊成功囉，請至登入畫面登入";
            require "LoginContr.php";
            exit();
        }
        view_path($this->path, [
            'errMsg' => $this->errMsg
        ]);

    }
}

$signup = new SignupContr();
$signup->signupFormValidate();
$signup->signupUserValidate();

