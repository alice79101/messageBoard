<?php

namespace controller;

use model\UserModel as UserModel;

class FormValidateContr
{
    public $dbUser;
    public $userData;

    public function emptyInput($value)
    {
        $result = "";
        if (empty($value)) {
            $result = "Denied";
        }
        return $result;
    }

    public function validateEmail($email)
    {
        $result = "";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = "Denied";
        }
        return $result;
    }
    public function passwordMatch($password, $passwordRepeat)
    {
        $result = "";
        if ($password !== $passwordRepeat) {
            $result = "Denied";
        }
        return $result;
    }
    public function inputLengthValidate($value, $min, $max)
    {
        $result = "";
        if (strlen(htmlspecialchars($value)) < $min || strlen( htmlspecialchars($value)) > $max) {
            $result = "Denied";
        }
        return $result;
    }
    public function userIdExist($userID)
    {
//        dumpAndDie($userID);
        $result = "";
        $this->dbUser = new UserModel();
        $result = $this->dbUser->findAUser($userID);
//        dumpAndDie($result);
        if ($result === false) {
            $result = "Already Exist";
        } else {
            $result = "Not Register";
        }
        return $result;
    }
}