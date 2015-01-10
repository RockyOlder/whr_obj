<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class HouseController extends IsloginController {

    public function index() {
        $house = M("houses h");
        $count = $house->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] :2);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $data = $house->field('h.*,d.id as did,d.name as dname')
                ->join('wrt_developer AS d ON d.id=h.developer_id')
                ->limit($page->firstRow . ',' . $page->listRows)
                ->select();
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
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
            $houses = D('Houses');
            $data = $houses->create();
            if ($data) {
                if ($action == "add") {
                    if ($houses->add($data)) {
                        $this->success("用户添加成功！", U('/Home/house/index'));
                    } else {
                        $this->error("用户添加失败！", U('/Home/house/add'));
                    }
                } elseif ($action == "edit") {
                    if ($houses->save($data)) {
                        $this->success("修改成功！", U('/Home/house/index'));
                    } else {
                        $this->error('修改失败!', U('/Home/house/add'));
                    }
                }
            } else {
                $this->error($houses->getError());
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
