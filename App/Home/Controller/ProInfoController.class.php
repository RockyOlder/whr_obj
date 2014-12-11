<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class ProInfoController extends IsloginController {

    public function index() {
        //echo 1;exit;
        $house = M("ProNotice p");
        $data = $house->field('p.*,y.id as yid,y.pname')
                ->join('wrt_property AS y ON p.proid=y.id')
                ->select();
       // print_r($data);exit;
        $this->assign('data', $data);
        $this->display();
    }

    public function add() {
        $data['action'] = 'add';
        $data['title'] = "添加";
        $data['btn'] = "添加小区";
        $action = I('post.action');
        $pro = M('property');
        $proList = $pro->select();
        $this->assign('pro', $proList);
        if (IS_POST) {
            //  print_r($_REQUEST);exit;
            if ($action == "add") {
                $pntice = D('ProNotice');
                if ($data = $pntice->create()) {
                    if ($pntice->add($data)) {
                        $url = U('/Home/proinfo/index');
                        $this->success("用户添加成功！", $url);
                    } else {
                        $this->error("用户添加失败！", 'index');
                    }
                }
            } elseif ($action == "edit") {
                $pntice = D('ProNotice');
                if ($data = $pntice->create()) {
                    if ($pntice->save($data)) {
                        $url = U('/Home/proInfo/index');
                        $this->success("修改成功！", $url);
                    } else {
                        $url = U('/Home/proInfo/add', '', false);
                        $this->error('修改失败!');
                    }
                } else {
                    $this->error($pntice->getError());
                }
            }
        }
        $id = I('get.id', 0);
        if ($id) {
            $data['action'] = 'edit';
            $data['title'] = "编辑公告";
            $data['btn'] = "编辑";
            $house = M("ProNotice p");
            $info = $house->field('p.*,y.id as yid,y.pname')
                    ->join('wrt_property AS y ON p.proid=y.id')
                    ->where('p.nid=' . $id)
                    ->find();
         //  print_r($info);exit;
            $this->assign('info', $info);
        }
        $this->assign('data', $data);
        $this->display();
    }

}

?>
