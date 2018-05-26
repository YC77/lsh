<?php
namespace app\index\controller;

use think\Controller;

class Background extends Controller{
    public function index(){
        return $this->fetch();
    }
}