<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

Route::rule('hello/[:name]','index/index/hello');
return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    /*''hello/[:name]'=>'index/hello',
    'Blog/:year/:month'=>['blog/archive',['methed'=>'get'],['year'=>'\d{4}','month'=>'\d{2}']],
    'Blog/:id'=>['blog/get',['methed'=>'get'],['id'=>'\id+']],
    'Blog/:name'=>['blog/read',['methed'=>'get'],['name'=>'\w+']],
    [Blog]'=>[
        ':year/:month'=>['blog/archive',['methed'=>'get'],['year'=>'\d{4}','month'=>'\d{2}']],
        ':id'=>['blog/get',['methed'=>'get'],['id'=>'\id+']],
        ':name'=>['blog/read',['methed'=>'get'],['name'=>'\w+']],
    ],*/
];
