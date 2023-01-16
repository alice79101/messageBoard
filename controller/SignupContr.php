<?php
// Controller：制定 signup 動作的內容、引導頁面動作、連結到 view

namespace controller;

use model\User as User;

class SignupContr
{
    private $nickname;
    private $userID;
    private $userPassword;
    private $userPasswordRepeat;
    public $errMsg = [];

    public function __construct()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // 使用 POST 方法抵達網站，代表使用者有輸入表單，開始驗證表單
            // dumpAndDie($_POST); //看一下會收到什麼
            $this->nickname = $_POST["nickname"];
            $this->userID = $_POST["userID"]; //ID為mail
            $this->userPassword = $_POST["password"];
            $this->userPasswordRepeat = $_POST["passwordRepeat"];
        } else {
            // 使用 GET 方法抵達網站，直接顯示view
            view_path("signup.view.php");
            exit();
        }
    }

    public function signupFormValidate()
    {
        // 表單驗證項目
        if ($this->emptyInput() === "Denied") {
            // 空白輸入驗證
            $this->errMsg['emptyInput'] = "請輸入所有欄位";
        } else {
            // 非空白輸入才驗證其他項目
            if ($this->validateEmail() === "Denied") {
                $this->errMsg['email'] = "Email 格式不正確，請重新確認";
            }
            if ($this->passwordMatch() === "Denied") {
                $this->errMsg['passwordRepeat'] = "兩次輸入的密碼不一致，請重新輸入";
            }
            if ($this->userIdExist() === "Denied") {
                $this->errMsg['userID'] = "這個 Email 已經註冊過";
            }
        }
//        dumpAndDie($this->errMsg);
    }

    public function signupUserValidate()
    {
//        dumpAndDie(empty($this->errMsg)); // 看一下 $this->errMsg裡面有沒有東西
        if (empty($this->errMsg)) {
            // 如果沒有錯誤訊息，代表通過表單驗證，可讓使用者註冊
            $signup = new User();
            $signup->insertUser($this->userID, $this->userPassword, $this->nickname);
            $this->errMsg['signupStatus'] = "註冊成功囉";
        }
        view_path("signup.view.php", [
            'errMsg' => $this->errMsg
        ]);

    }

    private function emptyInput()
    {
        $result = "";
        if (empty($this->nickname) || empty($this->userID) || empty($this->userPassword) || empty($this->userPasswordRepeat)) {
            $result = "Denied";
        }
        return $result;
    }

    private function validateEmail()
    {
//        dumpAndDie(filter_var($this->userID, FILTER_VALIDATE_EMAIL));
        $result = "";
        if (!filter_var($this->userID, FILTER_VALIDATE_EMAIL)) {
            $result = "Denied";
        }
        return $result;
    }

    // userID = Email

    private function passwordMatch()
    {
        $result = "";
        if ($this->userPassword !== $this->userPasswordRepeat) {
            $result = "Denied";
        }
        return $result;
    }

    private function userIdExist()
    {
        $result = "";
        $stmt = new User();
        $result = $stmt->findAUser($this->userID);
//        dumpAndDie($result);
        if (!empty($result)) {
            $result = "Denied";
        }
        return $result;
    }
}

$signup = new SignupContr();
$signup->signupFormValidate();
$signup->signupUserValidate();

