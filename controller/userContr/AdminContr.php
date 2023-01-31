<?php
namespace controller\userContr;
use controller\ManageMsg as ManageMsg;
use model\UserModel;

class AdminContr extends ManageMsg
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
        if ($_SESSION["ADMIN"] === 1 ) {
            $this->dbUser = new UserModel();
            $this->userList = $this->dbUser->getAllUser();
            view_path($this->path, [
                'userList' => $this->userList
            ]);
        }
//        dumpAndDie($this->userList);
    }
}

$userList = new AdminContr();
$userList-> showUserList();