<?php
namespace controller\userContr;
use controller\ManageMsg as ManageMsg;
use model\UserModel;

class AdminContr extends ManageMsg
{
    public $userList;
   public function __construct()
   {
       $this->loginConfirm();
       $this->getAdminValue();
       if ($this->user["ADMIN"] !== 1) {
           abort(403);
           exit();
       }
   }
    public function showUserList()
    {
        $this->dbUser = new UserModel();
        $this->userList = $this->dbUser->getAllUser();
    }



}

$userList = new AdminContr();
$userList-> showUserList();