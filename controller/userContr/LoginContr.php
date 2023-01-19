<?php
// controller: 制定 Login 的動作內容、引導頁面動作、連結到 view

namespace controller;
use model\User as User;

class LoginContr
{
    private $userID;
    private $userPassword;
    private $login;
    private $userData;
    public $errMsg = "";



    public function __construct()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // 使用 POST 方法抵達網站，代表使用者有輸入表單，開始驗證表單
//             dumpAndDie($_POST); //看一下會收到什麼
            $this->userID = $_POST["userID"];
            $this->userPassword = $_POST["password"];
//            $this->login = new User();
        } else {
            view_path("login.view.php",[
                'errMsg' => $this->errMsg
            ]);
        }
    }
    public function loginFormValidate()
    {
        if ($this->emptyInput() === "Denied") {
            $this->errMsg = "empty input";
        } else {
            if ($this->validateEmail() === "Denied") {
                $this->errMsg = "帳號格式不符合 Email 格式，請重新輸入";
            }
            if ($this->userIdExist() === "Denied") {
                $this->errMsg = "此帳號未經註冊，請先註冊";
            }
        }
//        dumpAndDie($this->errMsg);
    }

    // 登入動作：表單驗證->索取資料庫資料(Model)->比對密碼是否一致
    public function loginUser()
    {
        if (empty($this->errMsg)) {
//            dumpAndDie($this->userData);
//        dumpAndDie($result["password"]); // 從 Database 取得的密碼
//        dumpAndDie($this->password); // 從登入表單取得的密碼
//        dumpAndDie(password_verify($this->password, $result["password"]));
            if (password_verify($this->userPassword, $this->userData["password"])) {
                $this->errMsg = "登入成功";
                session_start();
//                dumpAndDie($this->userData);
                $_SESSION["memberID"] = $this->userData["memberID"];
                $_SESSION["nickname"] = $this->userData["nickname"];
//                dumpAndDie($_SESSION);
            } else {
                $this->errMsg = "登入失敗，帳號或密碼不正確";
            }
        }
        view_path("login.view.php", [
            'errMsg' => $this->errMsg
        ]);

    }


    // 檢查是否有欄位為空白
    private function emptyInput()
    {
        $result = "";
        if (empty($_POST["userID"]) || empty($_POST["password"])) {
            $result = "Denied";
        }
//        dumpAndDie($result);
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
    private function userIdExist()
    {
        $result = "";
        $this->login = new User();
        $this->userData = $this->login->findAUser("userID" ,$this->userID);
//        dumpAndDie($result);
        if (!empty($result)) {
            $result = "Denied";
        }
        return $result;
    }

}

$login = new LoginContr();
$login->loginFormValidate();
$login->loginUser();