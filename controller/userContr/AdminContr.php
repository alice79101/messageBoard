<?php

namespace controller\userContr;

use controller\ManageMsgContr as ManageMsgContr;
use model\UserModel;

class AdminContr extends ManageMsgContr
{
    public $userList;
    public $path = "usrViews/adminArea.view.php";

    public function __construct()
    {
        $this->loginConfirm();
        if ($_SESSION["ADMIN"] !== 1) {
            abort(403);
            exit();
        }
    }

    public function showUserList()
    {
        $this->dbUser = new UserModel();
        $this->userList = $this->dbUser->getAllValidUser();
        view_path($this->path, [
            'userList' => $this->userList
        ]);
//        dumpAndDie($this->userList);
    }
}

$userList = new AdminContr();
$userList->showUserList();