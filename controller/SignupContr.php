<?php

namespace controller;
use core\Dbh as Dbh;
use model\Signup as Signup;

class SignupContr extends Signup
{
    private $nickname;
    private $userID;
    private $userPassword;
    private $userPasswordRepeat;

    public function __construct($nicknameInput, $userIDInput, $userPasswordInput, $userPasswordRepeatInput)
    {
        $this->nickname = $nicknameInput;
        $this->userID = $userIDInput;
        $this->userPassword = $userPasswordInput;
        $this->userPasswordRepeat = $userPasswordRepeatInput;
//        dumpAndDie($this);
    }

    public function signupUser()
    {
        if($this->emptyInput() === "Denied") {
            echo "empty input";
//            header("location: ../signup?error=emptyinput");
            exit();
        }
        if($this->validateEmail() === "Denied") {
            echo "invalid email";
//            header("location: ../signup?error=validateEmail");
            exit();
        }
        if($this->passwordMatch() === "Denied") {
            echo "password doesn't match";
//            header("location: ../signup?error=passwordMatch");
            exit();
        }
        if($this->userIdExist() === "Denied") {
            echo "userID already exists.";
//            header("location: ../signup?error=userIdExist");
            exit();
        }
//        dumpAndDie("通過驗證");
        $this->insertUser($this->userID, $this->userPassword, $this->nickname);



    }

    private function validateEmail()
    {
//        dumpAndDie(filter_var($this->userID, FILTER_VALIDATE_EMAIL));
        if (filter_var($this->userID, FILTER_VALIDATE_EMAIL)) {
            $result = "PASS";
        } else {
            $result = "Denied";
        }
        return $result;
    }

    // userID = Email

    private function emptyInput()
    {
        $result = "";
        if (empty($this->nickname) || empty($this->userID) || empty($this->userPassword) || empty($this->userPasswordRepeat)) {
            $result = "Denied";
        } else {
            $result = "PASS";
        }
        return $result;
    }

    private function passwordMatch()
    {
        $result = "";
        if ($this->userPassword === $this->userPasswordRepeat) {
            $result = "PASS";
        } else {
            $result = "Denied";
        }
        return $result;
    }

    private function userIdExist()
    {

        $result = "";
        $stmt = Dbh::__construct()->checkUserExist($this->userID);
        if (empty($stmt)) {
            $result = "PASS";
        } else {
            $result = "Denied";
        }
        return $result;
    }
}