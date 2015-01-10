<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class AdminController extends IsloginController {

    public function index() {
        $admin=M('admin');
        $count = $admin->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 4);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $data = $admin->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        $this->assign('data', $data);
        $this->display();
    }

    public function getdata() {
        $page = I('get.page', 1);
        $pageSize = I('get.pageSize', 20);
        $limit = "limit " . ($page - 1) * $pageSize . ',' . $pageSize;
        $sql = "select * from " . C('DB_PREFIX') . "admin " . $limit;
        $data = M()->query($sql);
        return $data;
    }

    public function add() {
        $data['action'] = 'add';
        $data['title'] = "添加";
        $data['btn'] = "添加管理员";
        $action = I('post.action');
        if (IS_POST) {
            $user = D('Admin');
            $data = $user->create();
            if ($data) {
                if ($action == "add") {
                    $salt = rand(999, 9999);
                    $data['salt'] = $salt;
                    $password = change($salt);
                    $data['password'] = $password;
                    $data['add_time'] = time();
                    unset($data['id']);
                    $bool = $user->add($data);
                    if ($bool) {
                        $this->addRole($bool, $data['role_id']);
                        $this->success("用户添加成功！", U('/Home/Admin/index'));
                    } else {
                        $this->error("用户添加失败！",U('/Home/Admin/add'));
                    }
                } elseif ($action == "edit") {
                    $salt = rand(999, 9999);
                    $data['salt'] = $salt;
                    $password = change($salt);
                    $data['password'] = $password;
                    if ($user->save($data)) {
                        // 修改用户的角色
                        $this->changeRole($data['id'], $data['role_id']);
                        $this->success("修改成功！",  U('/Home/Admin/index'));
                    } else {
                        $this->error("用户修改失败！", U('/Home/Admin/add'));
                    }
                }
            } else {
                $this->error($user->getError());
            }
        }
        $id = I('get.id', 0);
        if ($id == 1) {
            $this->error('超级管理员不能修改');
        }
        $rule = M('auth_group')->field('id,title')->select();
        $this->assign('rule', $rule);
        if ($id) {
            //    echo 1;exit;
            $data['action'] = 'edit';
            $data['title'] = "编辑管理员";
            $data['btn'] = "编辑";
            $user = M("Admin");
            $userList = $user->where("id=" . $id)->find();
            $rule_id = M('auth_group_access')->field('group_id')->where(array('uid' => $id))->find();
            $rule_id = current($rule_id);
            $this->assign('rule_id', $rule_id);
        }
        $this->assign('info', $userList);
        $this->assign('data', $data);
        $this->display();
    }

    public function del() {
        $id = I('get.id', 0);
        $admin = D('Admin');
        $admindelte = $admin->where("id=$id")->find();
        if ($admindelte['name'] == 'admin') {
            $url = U('/Home/Admin/index');
            $this->error("admin不允许删除！", $url);
        }
        $result = $admin->where("id=$id")->delete();
        if ($result) {
            redirect($_SERVER["HTTP_REFERER"]);
        }
    }

    function addRole($uid, $rid) {
        $arr = array('uid' => $uid, 'group_id' => $rid);
        M('auth_group_access')->add($arr);
    }

    function changeRole($uid, $rid) {
        $w = array('uid' => $uid);
        $arr = array('group_id' => $rid);
        M('auth_group_access')->where($w)->save($arr);
    }

}

?>
