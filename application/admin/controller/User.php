<?php
namespace app\admin\controller;


use app\admin\model\UserModel;

class User extends Base
{
    public function index(){
        echo $this->fetch();
    }

    public function userList(){
        $mod=new UserModel();
        $list=$mod->getUserList();
        return ajaxTable(0,$list);
    }
}