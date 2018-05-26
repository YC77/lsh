<?php

namespace app\admin\controller;


use app\admin\model\AdminMenuModel;
use think\Request;

class Menu extends Base
{

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
    }

    public function index()
    {
        echo $this->fetch();
    }

    public function menuList()
    {
        $mod = new AdminMenuModel();
        $list = $mod->getList();

        return ajaxTable(0, $list);
    }

    public function addMenu()
    {
        if ($this->request->isAjax()) {
            $data = $this->checkMenuInfo($this->request->post(['pid', 'type', 'name', 'app', 'controller', 'action', 'status', 'remark']));
            $mod = new AdminMenuModel();
            $result = $mod->addInfo($data);

            $result > 0 ? returnAjax(1, '添加成功！', '', url('Menu/menuList')) : returnAjax(0, '添加菜单失败');
        }
        echo $this->fetch();
    }

    public function editMenuPage()
    {
        if ($this->request->isAjax()) {
            $id = $this->request->post('id', 0, 'intval');
            if (empty($id)) {
                return returnAjax(0, '请点击需要编辑的菜单');
            }

            $condition['id'] = $id;
            $mod = new AdminMenuModel();
            $info = $mod->getInfo($condition);
            if ($info == false) {
                return returnAjax(0, '菜单不存在');
            }
            $this->assign('info', $info);
            $page = $this->fetch();
            returnAjax(1, '', $page);
        }
    }

    public function editMenu()
    {
        if (!$this->request->isAjax()) {
            returnAjax(0, '非法请求');
        }

        $data = $this->checkMenuInfo($this->request->post(['id', 'type', 'name', 'app', 'controller', 'action', 'status', 'remark']));

        if (empty($data['id'])) {
            returnAjax(0, '菜单失效');
        }

        $mod = new AdminMenuModel();
        $info = $mod->getInfo(['id' => $data['id']]);
        if ($info == false) {
            returnAjax('菜单不存在');
        }
        $saveData=[];
        $msg = updateCheck($data, $info,$saveData);
        if (empty($msg) == false) {
            returnAjax(0, $msg);
        }

        $result = $mod->save($saveData,['id' => $data['id']]);
        $result ? returnAjax(1, '修改成功') : returnAjax(0, '修改失败');
    }

    private function checkMenuInfo($data)
    {
        if (empty($data['id']) && empty($data['pid'])) {
            $data['pid'] = 0;
        }
        if (empty($data['type'])) {
            returnAjax(0, '请选择菜单类型！');
        }
        if (empty($data['name'])) {
            returnAjax(0, '请填写菜单名称！');
        }
        if (empty($data['app'])) {
            returnAjax(0, '请填写应用名！');
        }
        if (empty($data['controller'])) {
            returnAjax(0, '请填写控制器！');
        }
        if (empty($data['action'])) {
            returnAjax(0, '请填写操作名称！');
        }
        return $data;
    }
}