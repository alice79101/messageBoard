<?php

namespace controller\userContr;
// 使用者到達網頁的方式有三種：
//  1. GET方法，驗證是否為管理者，否->403
//  2. GET方法，為管理者，顯示會員資料
//  3. 驗證為管理者且送出表單(POST方法)->更新會員資料 / 刪除資料


use controller\FormValidateContr as FormValidateContr;
use controller\ManageUserContr as ManageUserContr;
use model\UserModel as UserModel;

class UpdateMemberContr extends ManageUserContr
{
    public $path = "usrViews/updateMember.view.php"; // view 的頁面
    public $updateStatus = "NO";
    public $errMsg;
    protected $memberID;
    protected $newUserID;
    protected $newNickname;
    protected $newPassword;
    protected $newPasswordRepeat;
    protected $newAdmin = NULL;
    protected $validate;
    protected $delete = 0;
    protected $userModel; //new Model使用
    protected $user;
    protected $existUser;



    public function __construct()
    {
//        dumpAndDie($_SESSION);
        $this->adminConfirm();
//        dumpAndDie($_POST);
    }

    public function landingMethod()
    {
        if (isset($_POST["update"])) {
            // 管理者選擇修改會員資料的情況
            $this->memberID = $_POST["memberID"];
            $this->newUserID = $_POST["userID"];
            $this->newNickname = $_POST["nickname"]; //雖然密碼可能為空，先放入
            $this->newPassword = $_POST["password"];
            $this->newPasswordRepeat = $_POST["passwordRepeat"];
            if ($_POST["admin"] === "管理員") {
                // 如果被指定為管理員，才指定為 1
                $this->newAdmin = 1;
            }

        } elseif (isset($_POST["delete"])) {
            // 管理者點選刪除會員的情況
            $this->userModel = new UserModel();
            $this->userModel->fakeDeleteUser($_POST["memberID"]);
            require "AdminContr.php";
            exit();

        } else {
            // 使用 GET 方法抵達頁面
            $this->userModel = new UserModel();
            $this->user = $this->userModel->findUserWithMemberID($_GET["memberID"]);
//            dumpAndDie($this->user);
            if (empty($this->user)) {
                abort();
                exit();
            } else {
                view_path($this->path, [
                    'user' => $this->user,
                    'updateStatus' => $this->updateStatus,
                    'errMsg' => $this->errMsg
                ]);
                exit();
            }
        }
    }
    public function compareExistUserInfo()
    {
//         如果資料都相同，就不需後續動作，直接 view
        //似乎不需要？
        $this->userModel = new UserModel();
        $this->existUser = $this->userModel->findUserWithMemberID($this->memberID);
        if (($this->existUser["userID"] === $this->newUserID)
         && ($this->existUser["nickname"] === $this->newNickname)
         && ($this->existUser["password"] === $this->newPassword)
         && ($this->existUser["ADMIN"] === $this->newAdmin)) {
            view_path($this->path, [
                'user' => $this->existUser,
                'updateStatus' => $this->updateStatus,
                'errMsg' => $this->errMsg
            ]);
            exit();
        }
    }

    public function updateFormValidate()
    {
        $this->validate = new FormValidateContr();
        if ($this->validate->emptyInput($this->newUserID)
            || $this->validate->emptyInput($this->newNickname) === "Denied") {
            $this->errMsg['emptyInput'] = "會員帳號與暱稱為必填項目，請再次確認";
        }
        if ($this->validate->validateEmail($this->newUserID) === "Denied") {
            $this->errMsg['userID'] = "會員帳號非有效email格式，請再次確認";
        }
        if ($this->validate->inputLengthValidate($this->newNickname, 3, 30) === "Denied") {
            $this->errMsg['nickname'] = "暱稱須介於3~30字元之間，請重新輸入";
        }

        //密碼驗證
        // 1. 密碼可為空->不修改密碼
        // 2. 僅輸入password，未輸入passwordRepeat，或相反->errMsg
        // 3. 兩者皆輸入->正常驗證
        if (!empty($this->newPassword) || !empty($this->newPasswordRepeat)) {
            // 兩者其一有值才會進入判斷式
            if (empty($this->newPassword) || empty($this->newPasswordRepeat)) {
                // 兩者其一有值，但其中之一為空
                $this->errMsg["password"] = "如要修改密碼，兩個密碼欄位皆需輸入";
            } else {
                // 兩者皆不為空
                if ($this->validate->passwordMatch($this->newPassword, $this->newPasswordRepeat) === "Denied") {
                    $this->errMsg["password"] = "兩次輸入密碼不相同，請重新確認";
                }
                if ($this->validate->inputLengthValidate($this->newPassword, 6, 20)) {
                    $this->errMsg["password"] = "密碼不可以有特殊符號，且限制於 6~20字元之間";
                }
            }
        }
    }

    public function userIdExist()
    {
        // 如果使用者沒有更改 userID ，則資料庫會有自己的 userID
        $this->userModel = new UserModel();
        $existUser = $this->userModel->findUserWithMemberID($this->memberID);
        if ($this->newUserID === $existUser["userID"]) {
            // 使用者沒有更改 userID ，不用進行後續驗證
        } else {
            $this->user = $this->userModel->getSameUserID($this->newUserID);
            // 如果使用者有更改 userID ， 則需判斷是否跟別人的 userID 相同
            if (count($this->user) > 1) {
                $this->errMsg['userID'] = "這個 Email 已經註冊過";
                view_path($this->path, [
                    'user' => $this->user,
                    'errMsg' => $this->errMsg,
                    'updateStatus' => $this->updateStatus
                ]);
            }
        }
//        dumpAndDie($this->errMsg);
    }

    public function updateUserValidate()
    {
//        dumpAndDie($this->errMsg);
        // 輸入資料庫
        if (empty($this->errMsg) && empty($this->newPassword)) {
            // 在確認 userID 時已經有new UserModel()，已啟動 DB 連線，故直接使用 $this->user
//            $this->userModel = new UserModel();
            $this->userModel->updateUserWithoutPassword($this->memberID, $this->newUserID, $this->newNickname, $this->newAdmin);
            $this->updateStatus = "YES";
            $this->user = $this->userModel->findUserWithMemberID($this->memberID);
//            dumpAndDie($this->user);
        } elseif (empty($this->errMsg) && !empty($this->newPassword)) {
            $this->userModel->updateUser($this->memberID, $this->newUserID, $this->newPassword, $this->newNickname, $this->newAdmin);
            $this->updateStatus = "YES";
            $this->user = $this->userModel->findUserWithMemberID($this->memberID);
        } else {
            $this->user["memberID"] = $this->memberID;
            $this->user["userID"] = $this->newUserID;
            $this->user["nickname"] = $this->newNickname;
            $this->user["admin"] = $this->newAdmin;
        }
//        dumpAndDie($this->user);
        view_path($this->path, [
            'user' => $this->user,
            'errMsg' => $this->errMsg,
            'updateStatus' => $this->updateStatus
        ]);
    }
}

$update = new UpdateMemberContr();
$update->landingMethod();
$update->updateFormValidate();
$update->userIdExist();
$update->updateUserValidate();