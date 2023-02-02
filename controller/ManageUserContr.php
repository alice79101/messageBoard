<?php
namespace controller;

use Couchbase\User;
use model\MsgModel as MsgModel;
use model\UserModel as UserModel;

class ManageUserContr
{

    protected function adminConfirm()
    {
        // 如果沒登入、或有登入但 admin 欄位不為 1
        if (!isset($_SESSION["memberID"]) && $_SESSION["ADMIN"] !== 1) {
            abort(403);
            exit();
        }
    }



}