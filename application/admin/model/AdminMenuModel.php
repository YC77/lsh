<?php

namespace app\admin\model;

use think\Exception;

class AdminMenuModel extends BaseModel
{
    protected $table = 'lsh_admin_menu';

    public function getList()
    {
        $list = $this->field('id,pid,path,type,`status`,app,controller,action,`name`,remark')
            ->order('path')
            ->select();
        return $list ? $list->toArray() : false;
    }

    /**
     * 新增菜单
     * @param $data
     * @return bool
     */
    public function addInfo($data)
    {
        $this->startTrans();
        try {
            if ($data['pid'] > 0) {
                $pathArr = $this->field('path')->where(['id' => $data['pid']])->find();
            }

            $id = $this->insertGetId($data);
            if ($id > 0) {
                $path = empty($pathArr['path']) ? 0 : $pathArr['path'];
                $res = $this->save(['path' => $path . ',' . $id], ['id' => $id]);
                if ($res == false) {
                    $this->rollback();
                    return false;
                }
            } else {
                $this->rollback();
                return false;
            }
            $this->commit();
            return true;
        } catch (Exception $e) {
            $e->getMessage();
            return false;
        }
    }

    /**
     * 获取菜单信息
     * @param $condition
     * @return array|false|\PDOStatement|string|\think\Model
     */
    public function getInfo($condition)
    {
        $info = $this->field('id,pid,path,type,`status`,order_by,app,controller,action,`name`,remark')->where($condition)->find();
        return $info ? $info->toArray() : false;
    }
}