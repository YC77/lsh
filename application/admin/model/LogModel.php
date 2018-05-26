<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/28
 * Time: 15:26
 */

namespace app\admin\model;


class LogModel extends BaseModel
{
    protected $table = 'lsh_log';

    public function addLog($data)
    {
        return $this->insert($data);
    }
}