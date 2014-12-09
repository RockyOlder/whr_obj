<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class HouseController extends IsloginController {

    public function index() {
        $house = M("houses h");
        $data = $house->field('h.*,d.id as did,d.name as dname')
                ->join('wrt_developer AS d ON d.id=h.developer_id')
                ->select();
        $this->assign('data', $data);
        $this->display();
    }

    public function add() {
        $data['action'] = 'add';
        $data['title'] = "添加";
        $data['btn'] = "添加楼盘";
        $action = I('post.action');
        $houses = M('Developer');
        $housesList = $houses->select();
        $this->assign('pro', $housesList);
        if (IS_POST) {
            //  print_r($_REQUEST);exit;
            if ($action == "add") {
                $houses = D('Houses');
                if ($data = $houses->create()) {
                    if ($houses->add($data)) {
                        $url = U('/Home/house/index');
                        $this->success("用户添加成功！", $url);
                    } else {
                        $this->error("用户添加失败！", 'index');
                    }
                }
            } elseif ($action == "edit") {
                $houses = D('Houses');
                if ($data = $houses->create()) {
                    if ($houses->save($data)) {
                        $url = U('/Home/house/index');
                        $this->success("修改成功！", $url);
                    } else {
                        $url = U('/Home/house/add', '', false);
                        $this->error('修改失败!');
                        //   $this->error("用户修改失败！", 'index');
                    }
                } else {
                    $this->error($houses->getError());
                }
            }
        }
        $id = I('get.id', 0);
        if ($id) {
            $data['action'] = 'edit';
            $data['title'] = "编辑小区";
            $data['btn'] = "编辑";
            $house = M("houses h");
            $info = $house->field('h.*,d.id as did,d.name as dname')
                    ->join('wrt_developer AS d ON d.id=h.developer_id')
                    ->where('h.id=' . $id)
                    ->find();

            $this->assign('info', $info);
        }
        $this->assign('data', $data);
        $this->display();
    }

}

?>
