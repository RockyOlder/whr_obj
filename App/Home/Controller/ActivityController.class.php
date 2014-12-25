<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class ActivityController extends IsloginController {

    public function index() {
        //    echo 1;exit;
        $vip = D('VipActGood v');
        //     $vipList=$vip->select();
        $find = $vip->field('v.*,w.title,w.start_time,w.end_time')
                ->join('wrt_vip_activity AS w ON w.id=v.aid')
                ->select();
        $this->assign('data', $find);
        $this->display();
    }

    public function add() {
        $data['action'] = 'add';
        $data['title'] = "添加";
        $data['btn'] = "添加商家";
        $action = I('post.action');
        $vip = M('VipActivity');
        $vipList = $vip->select();
        //     print_r($vipList);exit;
        $this->assign('into', $vipList);
        if (IS_POST) {
            if ($action == "add") {
                //      print_r(date('Y-m-d H:i:s',strtotime(I('post.start_time'))));exit;
                //     print_r(I('post.start_time'));exit;
                $vip = D('VipActivity');
                if ($data = $vip->create()) {
                    $data["start_time"] = strtotime(I('post.start_time'));
                    $data["end_time"] = strtotime(I('post.end_time'));
                    if ($vip->add($data)) {
                        $url = U('/Home/Activity/add');
                        $this->success("用户添加成功！", $url);
                    } else {
                        $this->error("用户添加失败！", 'index');
                    }
                }
            } elseif ($action == "edit") {
                $vip = D("Vip");
                if ($vipData = $vip->create()) {
                    if ($vip->save($vipData)) {
                        $url = U('/Home/vip/vlist');
                        $this->success("修改成功！", $url);
                    } else {
                        $this->error("用户修改失败！", 'index');
                    }
                } else {
                    $this->error($vip->getError());
                }
            }
        }
        $id = I('get.id', 0);
        if ($id) {
            $data['action'] = 'edit';
            $data['title'] = "编辑商家";
            $data['btn'] = "编辑";
            $vip = M("Vip");
            $region = M("region");
            $vipList = $vip->where("store_id=$id")->find();
            //  print_r($vipList);exit;
            $provine = $vipList['province'];
            $regionProv = $region->where("REGION_ID=" . $provine)->find();
            $this->assign("region", $regionProv);
            $this->assign('info', $vipList);
        }
        $this->assign('data', $data);
        $this->display();
    }

}

?>
