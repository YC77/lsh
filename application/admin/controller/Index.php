<?php
namespace app\admin\controller;

use app\admin\model\AdminMenuModel;
use think\Controller;
use think\Request;

class Index extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
    }

    public function index()
    {
        return $this->fetch();
    }
    public function admin(){

        return $this->fetch();
    }

}
