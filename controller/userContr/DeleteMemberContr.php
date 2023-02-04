<?php
namespace controller\userContr;

use controller\ManageUserContr as ManageUserContr;
use model\UserModel as UserModel;

class DeleteMemberContr extends ManageUserContr
{
    public function __construct()
    {
        $this->manageAuthority();
        if (isset($_POST["delete"])) {
            $userModel = new UserModel();
            $userModel->fakeDeleteUser($_POST["memberID"]);

        }
        if ($_SESSION["ADMIN"] === 1) {
            // 管理者畫面
            require "AdminContr.php";
        } else {
            // 會員自己刪除後的畫面
            session_unset();
            session_destroy();
//            dumpAndDie(base_path("public/index.php"));
            require __DIR__ . "/../indexContr.php";
        }
        exit();
    }
}
$delete = new DeleteMemberContr();