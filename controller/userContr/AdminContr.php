<?php

namespace controller\userContr;

use controller\ManageUserContr as ManageUserContr;
use model\UserModel as UserModel;

class AdminContr extends ManageUserContr
{
    public $userList;
    public $path = "usrViews/adminArea.view.php";

    public function __construct()
    {
        $this->adminConfirm();
    }

    public function showUserList()
    {
        $dbUser = new UserModel();
        $this->userList = $dbUser->getAllValidUser();
        view_path($this->path, [
            'userList' => $this->userList
        ]);
//        dumpAndDie($this->userList);
    }
}

$userList = new AdminContr();
$userList->showUserList();