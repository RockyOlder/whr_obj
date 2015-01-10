<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class ActivityController extends IsloginController {

    public function index() {
        //    echo 1;exit;
        $vip = M('VipActGood v');
        $count = $vip->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 5);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $find = $vip->field('v.*,w.title,w.start_time,w.end_time')
                ->join('wrt_vip_activity AS w ON w.id=v.aid')
                ->limit($page->firstRow . ',' . $page->listRows)
                ->select();
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        $this->assign('data', $find);
        $this->display();
    }

    public function add() {
        $data['action'] = 'add';
        $data['title'] = "添加";
        $data['btn'] = "添加商家";
        $action = I('post.action');
        $vip = M('VipActivity');
        $count = $vip->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 2);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $data = $vip->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        $this->assign('into', $data);
        if (IS_POST) {
            $vip = D('VipActivity');
            $data = $vip->create();
            if ($data) {
                $data["start_time"] = strtotime(I('post.start_time'));
                $data["end_time"] = strtotime(I('post.end_time'));
                if ($action == "add") {
                    if ($vip->add($data)) {
                        $this->success("用户添加成功！", U('/Home/Activity/add'));
                    } else {
                        $this->error("用户添加失败！", U('/Home/Activity/add'));
                    }
                } elseif ($action == "edit") {
                    if ($vip->save($data)) {
                        $this->success("添加成功！", U('/Home/Activity/add'));
                    } else {
                        $this->error("用户修改失败！", U('/Home/Activity/add'));
                    }
                }
            } else {
                $this->error($vip->getError());
            }
        }
        $id = I('get.id', 0);
        if ($id) {
            $data['action'] = 'edit';
            $data['title'] = "编辑活动";
            $data['btn'] = "编辑";
            $vip = D('VipActivity');
            $vipFind = $vip->where("id=$id")->find();
            $vipFind['start_time'] = date("Y-m-d H:i:s", $vipFind['start_time']);
            $vipFind['end_time'] = date("Y-m-d H:i:s", $vipFind['end_time']);
            $this->assign('info', $vipFind);
        }
        //$this->redirect("home/del",array());
        $this->assign('data', $data);
        $this->display();
    }

    public function saveAct() {
        $action = I('post.action');
        if ($action == "edit") {
            $vip = D('VipActGood');
            if ($vipData = $vip->create()) {
                if ($vip->save($vipData)) {
                    $url = U('/Home/Activity/index');
                    $this->success("修改成功！", $url);
                } else {
                    $this->error("用户修改失败！", 'index');
                }
            } else {
                $this->error($vip->getError());
            }
        }

        $id = I('get.id', 0);
        if ($id) {
            $data['action'] = 'edit';

            $vip = M('VipActGood');
            $VipActivity = M('VipActivity');
            $vipList = $vip->where("id=$id")->find();
            $aid = $vipList['aid'];
            $actoObject = $VipActivity->where("id=$aid")->find();
            $list = $VipActivity->select();
            //  print_r($actoObject);exit;
            $this->assign('info', $vipList);
            $this->assign('list', $list);
        }
        //$this->redirect("home/del",array());
        $this->assign('save', $actoObject);
        $this->assign('data', $data);
        $this->display();
    }

}

?>
