<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class UserController extends IsloginController {

    public function index() {
        $user = M("user u");
        $count = $user->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 15);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $data = $user->field('u.*,v.id as vid,p.id as pid,p.pname,v.name as vname')
                ->join('wrt_village AS v ON v.id=u.village_id')
                ->join('wrt_property AS p ON v.property_id=p.id')
                ->limit($page->firstRow . ',' . $page->listRows)
                ->select();
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        $this->assign('data', $data);
        $this->display();
    }

    public function add() {
        //echo change();
        // print_r($salt);exit;
        $data['action'] = 'add';
        $data['title'] = "添加";
        $data['btn'] = "添加会员";
        $action = I('post.action');

        $property = M("property");
        $village = M("village");
        $Vlist = $village->select();
        $propertyList = $property->select();
        $pro = $this->getprovence();

        $this->assign('pro', $pro);
        $this->assign('Vlist', $Vlist);
        $this->assign('prolist', $propertyList);
        if (IS_POST) {
            $user = D('User');
            $data = $user->create();
            if ($data) {
                $village = M("village v");
                $vfind = $village->field('v.*,p.id as pid,p.pname')
                        ->join('wrt_property AS p ON v.property_id=p.id')
                        ->where("v.id=" . $data['village_id'])
                        ->find();
                if ($action == "add") {
                    $salt = rand(999, 9999);
                    $data['salt'] = $salt;
                    $password = change($salt);
                    $data['password'] = $password;
                    $data["reg_time"] = time();
                    $data['property_id'] = $vfind['pid'];
                    $data['property'] = $vfind['pname'];
                    if ($user->add($data)) {
                        $this->success("用户添加成功！", U('/Home/User/index'));
                    } else {
                        $this->error("用户添加失败！", U('/Home/User/add'));
                    }
                } elseif ($action == "edit") {
                    $data['property_id'] = $vfind['pid'];
                    $data['property'] = $vfind['pname'];
                    if ($user->save($data)) {
                        $this->success("修改成功！", U('/Home/User/index'));
                    } else {
                        $this->error("用户修改失败！", U('/Home/User/add'));
                    }
                }
            } else {
                $this->error($user->getError());
            }
        }
        $id = I('get.id', 0);
        if ($id) {
            $data['action'] = 'edit';
            $data['title'] = "编辑会员";
            $data['btn'] = "编辑";
            $user = M("User");
            $region = M("region");
            $userlist = $user->where("user_id=" . $id)->find();
            $vfind = $village->where("id=" . $userlist['village_id'])->find();
            $regionProv = $region->where("REGION_ID=" . $userlist['province'])->find();
            $this->assign('vfind', $vfind);
            $this->assign("region", $regionProv);
            $this->assign('info', $userlist);
        }
        $this->assign('data', $data);
        $this->display();
    }

    public function updatePW() {
        $id = I('get.id', 0);
        $action = I('post.action');
        if (IS_POST) {
            if ($action == "edit") {
                $user = D("User");
                if ($data = $user->create()) {
                    $salt = rand(999, 9999);
                    $data['salt'] = $salt;
                    $password = change($salt);
                    $data['password'] = $password;
                    if ($user->save($data)) {
                        // 修改用户的角色
                        //       $this->changeRole($data['id'], $data['role_id']);
                        $url = U('/Home/User/index');
                        $this->success("修改成功！", $url);
                    } else {
                        $this->error("用户修改失败！", 'index');
                    }
                } else {
                    $this->error($user->getError());
                }
            }
        }
        $user = M("User");
        $userlist = $user->field('user_id,user_name')->where("user_id=" . $id)->find();
        $data['action'] = 'edit';
        $data['title'] = "编辑会员";
        $data['btn'] = "修改";
        $this->assign('info', $userlist);
        $this->assign('data', $data);

        $this->display();
    }

    public function del() {
        $id = I('get.id', 0);
        $admin = D('User');
        $result = $admin->where("id=$id")->delete();
        if ($result) {
            redirect($_SERVER["HTTP_REFERER"]);
        }
    }

}

?>
