<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/27
 * Time: 11:06
 */

namespace app\admin\controller;

use app\admin\model\DemoModel;
use think\Controller;

class Demo extends Controller
{
    public function index(){
        $pattern="/\bis\b/";
        echo  preg_match($pattern,'this is island!');
    }
}