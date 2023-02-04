<?php

namespace controller;
use model\UserModel as UserModel;

class ManageUserContr
{
    public function landingMethodContr($path, $condition = [])
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            view_path($path, $condition);
            exit();
        }
    }

    protected function adminConfirm()
    {
        // 如果沒登入、或有登入但 admin 欄位不為 1
        $this->loginConfirm();
        if ($_SESSION["ADMIN"] !== 1) {
            abort(403);
            exit();
        }
    }

    protected function loginConfirm()
    {
        if (!isset($_SESSION["memberID"])) {
            // 請他登入先
            abort(403);
            exit();
        }
    }

    protected function manageAuthority()
    {
        // 只有會員自己跟管理員能維護自己的會員資料
        // 管理員身份：$_SESSION["ADMIN"] === 1
        $this->loginConfirm();
        if ($_SESSION["ADMIN"] !== 1) {
            // 非屬管理員
            if (intval($_GET["memberID"]) !== $_SESSION["memberID"] ) {
                // 也不是維護自己的帳號
                abort();
                exit();
            }
        }
    }
    protected function isEmptyUser($user)
    {
        if (empty($user)) {
            abort();
            exit();
        }
    }
}