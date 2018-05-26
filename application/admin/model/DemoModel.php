<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/27
 * Time: 11:02
 */

namespace app\admin\model;


use think\Model;

class DemoModel extends Model
{
    //protected $table = 'lsh_users_category';
    protected $table = 'z_sign';
    public function getList()
    {
        $list = $this->field('id,name,parent_category_id,level')->select();
        $newList = [];
        //重构数据，以id为键
        foreach ($list as $item) {
            $newList[$item['id']] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'parent_category_id' => $item['parent_category_id'],
                'level' => $item['level']
            ];
        }
        return $newList;
    }

    public function getSign(){
        return $this->query('select * from z_sign');
    }
}