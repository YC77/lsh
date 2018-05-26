<?php
namespace app\admin\model;

class RoleModel extends BaseModel
{
    protected $table='lsh_role';

    public function getRoleList($condition=''){
        return $this->field('id,pid,`status`,create_time,update_time,list_order,`name`,remark')
                    ->where($condition)
                    ->select();
    }
}