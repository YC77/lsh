<?php

namespace app\admin\model;

class UserModel extends BaseModel
{
    protected $table = 'lsh_user';

    public function getUserList($condition = '')
    {
        return $this->field('id,user_login,user_nickname,avatar,user_email,mobile,create_time,last_login_time,last_login_ip,user_status')
                    ->where($condition)
                    ->select();
    }
}