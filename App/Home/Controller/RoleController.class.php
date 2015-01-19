<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class RoleController extends IsloginController {

    // 列表页面
    public function index() {
        $auth = M('auth_group');
        $count = $auth->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 15);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $data = $auth->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        $this->assign('data', $data);
        $this->display();
    }

    // 修改添加页面
    public function add() {
        if (IS_POST) {
            $table = "auth_group";
            $id = I('post.id');
            $arr = array('title' => I('post.title'), 'description' => I('post.des'));
            // dump($arr);
            if ($id) {//编辑
                $arr['id'] = $id;
                $bool = M($table)->save($arr);
                $msg = "编辑";
            } else {
                $bool = M($table)->add($arr);
                $msg = "添加";
            }
            if ($bool) {
                $this->success($msg . '成功');
            } else {
                $this->error($msg . '失败');
            }
        }
        $data['action'] = 'add';
        $data['title'] = "添加";
        $data['btn'] = "添加角色";
        $action = 'add';
        $id = I('get.id', 0, 'intval');
        if ($id) {
            $data['action'] = 'add';
            $data['title'] = "修改";
            $data['btn'] = "修改角色";
            $action = 'edit';
            $info = M('auth_group')->where(array('id' => $id))->find();
            $this->assign('info', $info);
        }
        $this->assign('data', $data);
        $this->display();
    }

    // 修改添加页面
    public function del() {
        $id = I('get.id', 0, 'intval');
        $table = "auth_group";
        $msg = "删除";
        $bool = M($table)->delete($id);
        if ($bool) {
            $this->success($msg . '成功', U('index'));
        } else {
            $this->error($msg . '失败');
        }
    }

    // 分配权限页面
    public function authority() {
        if (IS_POST) {
       //     echo 1;exit;
            // dump($_POST);
            $str = implode(',', $_POST['check']);
            $arr = array('id' => I('post.id', 0, 'intval'), 'rules' => $str);
            $bool = M('auth_group')->save($arr);
  
        }
        $id = I('get.id', 0, 'intval');
        if (!$id) {
            $this->error('请选择角色再来分配权限');
        }
        $info = M('auth_group')->where(array('id' => $id))->find();
        $this->assign('info', $info);
        // dump($info);
        $data = $this->getData();
        $this->assign('data', $data);
        $this->display();
    }

    public function getData() {
        $table = "auth_rule";
        $w = array('type' => 1, 'add_type' => 1, 'add_pid' => 0);
        $field = "id,title";
        $data = M($table)->field($field)->where($w)->select();
        // dump($data);
        // 循环顶级数据查询自己的数据
        foreach ($data as $k => $v) {
            // dump($v);die();
            $where = array('type' => 1, 'add_pid' => $v['id']);
            // dump($where);
            $son = M($table)->field($field)->where($where)->select();

            // dump($son);die();
            $data[$k]['son'] = $son;
        }
        return $data;
    }

}