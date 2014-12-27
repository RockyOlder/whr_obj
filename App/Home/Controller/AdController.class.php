<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class AdController extends IsloginController {

    public function index() {

        $ad = M("Ad");
        $adcount = $ad->select();
        //  print_r($adcount);exit;
        $this->assign('data', $adcount);
        $this->display();
    }

    public function add() {
        $data['action'] = 'add';
        $data['title'] = "添加";
        $data['btn'] = "添加广告";
        $action = I('post.action');
        $vip = M('VipActivity');

        if (IS_POST) {
            if ($action == "add") {
                //      print_r(date('Y-m-d H:i:s',strtotime(I('post.start_time'))));exit;
                //     print_r(I('post.start_time'));exit;
                $ad = D('Ad');
                if ($data = $ad->create()) {
                    $data["start_time"] = strtotime(I('post.start_time'));
                    $data["end_time"] = strtotime(I('post.end_time'));
                    if ($ad->add($data)) {
                        $url = U('/Home/Ad/index');
                        $this->success("用户添加成功！", $url);
                    } else {
                        $this->error("用户添加失败！", 'index');
                    }
                }
            } elseif ($action == "edit") {
                 $ad = D('Ad');
                if ($vipData = $ad->create()) {
                    $data["start_time"] = strtotime(I('post.start_time'));
                    $data["end_time"] = strtotime(I('post.end_time'));
                    if ($ad->save($vipData)) {
                        $url = U('/Home/vip/vlist');
                        $this->success("修改成功！", $url);
                    } else {
                        $this->error("用户修改失败！", 'index');
                    }
                } else {
                    $this->error($ad->getError());
                }
            }
        }
        $id = I('get.id', 0);
        if ($id) {
       
            $data['action'] = 'edit';
            $data['title'] = "编辑商家";
            $data['btn'] = "编辑";
            $ad = M("Ad");
            $vipList = $ad->where("ad_id=$id")->find();
         //   print_r($vipList);exit;
            $this->assign('info', $vipList);
        }
        //$this->redirect("home/del",array());
        $this->assign('data', $data);
        $this->display();
    }

    public function sort() {
        
    }
    public function count() {
           $ad = M("Ad");
        $adcount = $ad->order('click desc')->select();
        $this->assign('data', $adcount);
        $this->display();
    }

    public function divde() {
        
    }

}

?>
