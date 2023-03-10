<?php

namespace controller;

use model\UserModel as UserModel;

class FormValidateContr
{
    public function emptyInput($value)
    {
        if (empty($value)) {
            return "Denied";
        }
    }

    public function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Denied";
        }
    }
    public function passwordMatch($password, $passwordRepeat)
    {
        if ($password !== $passwordRepeat) {
            return "Denied";
        }
    }
    public function inputLengthValidate($value, $min, $max)
    {
        if (strlen(htmlspecialchars($value)) < $min || strlen( htmlspecialchars($value)) > $max) {
            return "Denied";
        }
    }
    public function userIdExist($userID)
    {
//        dumpAndDie($userID);
        $result = "";
        $dbUser = new UserModel();
        $user = $dbUser->findUserWithUserID($userID);
//        dumpAndDie($user);
        // 有找到使用者的話會是 array
        // 沒找到使用者的話會是 false
//        dumpAndDie(empty($user));
        if (empty($user) === true) {
            return "Not Exist";
        } else {
            return "Exist";
        }
    }
}