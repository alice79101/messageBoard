<?php
// controller: 制定 Login 的動作內容

namespace controller;
use core\Dbh as Dbh;
use model\Login;

class LoginContr extends Login
{
    private $userID;
    private $password;
    public $errMsg = "";

    public function __construct($userIDInput, $passwordInput)
    {
        $this->userID = $userIDInput;
        $this->password = $passwordInput;
    }


    // 登入動作：表單驗證->索取資料庫資料(Model)->比對密碼是否一致
    public function loginUser()
    {

        if($this->emptyInput() === "Denied" ) {
            $this->errMsg = "empty input";
            exit();
        }

        $result = $this->findUser($this->userID); //傳回 $result Array
//        dumpAndDie($result["password"]); // 從 Database 取得的密碼
//        dumpAndDie($this->password); // 從登入表單取得的密碼
//        dumpAndDie(password_verify($this->password, $result["password"]));
        if (password_verify($this->password, $result["password"])) {
            $errMsg = "登入成功";
        } else {
            $errMsg = "登入失敗";
        }
        return $errMsg;


    }


    // 檢查是否有欄位為空白
    public function emptyInput()
    {
        $result = "";
        if (empty($this->userID) || empty($this->password)) {
            $result = "Denied";
        } else {
            $result = "PASS";
        }
        return $result;
    }
    // 檢查特殊符號輸入






}