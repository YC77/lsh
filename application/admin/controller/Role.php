<?php

namespace app\admin\controller;

use app\admin\model\RoleModel;

class Role extends Base
{
    public function index()
    {
        echo $this->fetch();
    }

    public function roleList()
    {
        $mod = new RoleModel();
        $list = $mod->getRoleList();
        return ajaxTable(0, $list);
    }

    public function addRole()
    {
        if (!$this->request->isAjax()) {
            return returnAjax(0, '不正确的访问方式');
        }

        $info = $this->checkInfo();
        $mod = new RoleModel();
        $result = $mod->save($info);
        $result > 0 ? returnAjax(1, '新增角色成功') : returnAjax(0, '新增角色失败');
    }

    public function editRole()
    {
        if (!$this->request->isAjax()) {
            returnAjax(0, '错误的请求方式');
        }
        $roleId = $this->request->post('id');
        if (empty($roleId)) {
            returnAjax(0, '数据接收失败');
        }

        $mod = new RoleModel();
        $map['id'] = $roleId;
        $roleInfo = $mod->field('id,name,remark,status')->where($map)->find();
        if ($roleInfo == false) {
            returnAjax(0, '角色不存在');
        }

        $this->assign('info', $roleInfo);
        $info = $this->fetch();
        returnAjax(1, '', $info);
    }

    public function subEditRole()
    {
        $data = getPostData($this->request->post(['id', 'name', 'remark', 'status']));

        if (empty($data['name'])) {
            returnAjax(0, '角色名称不能为空');
        }
        if ($data['status'] != 1 && $data['status'] != 2) {
            $data['status'] = 1;
        }

        $map['id'] = $data['id'];
        $mod = new RoleModel();
        $roleInfo = $mod->field('id,name,remark,status')->where($map)->find();
        if ($roleInfo == false) {
            returnAjax(0, '角色不存在');
        }
        $insertData = [];
        $result = updateCheck($data, $roleInfo, $insertData);
        if (empty($result) == false) {
            returnAjax(0, $result);
        }
        $insertData['update_time']=time();
        $res = $mod->save($insertData, ['id' => $data['id']]);
        $res > 0 ? returnAjax(1, '修改成功') : returnAjax(0, '修改失败');
    }

    private function checkInfo()
    {
        $data = $this->request->post(['name', 'remark', 'status']);
        if (empty($data['name'])) {
            returnAjax(0, '角色名称不能为空');
        }
        if ($data['status'] != 1 || $data['status'] != 2) {
            $data['status'] = 1;
        }
        return [
            'name' => $data['name'],
            'status' => $data['status'],
            'remark' => $data['remark'],
            'create_time' => time(),
            'update_time' => time(),
            'pid' => $data['pid'],
        ];
    }

    public function higherLevel(){
        return $this->fetch();
    }
}