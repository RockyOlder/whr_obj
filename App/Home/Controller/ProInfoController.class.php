<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class ProInfoController extends IsloginController {

    public function index() {
        $house = M("ProNotice p");
        $data = $house->field('p.*,y.id as yid,y.pname')
                ->join('wrt_property AS y ON p.proid=y.id')
                ->select();
        //   print_r($data);exit;
        if (empty($data)) {
            $this->display(add);
        }
        $this->assign('data', $data);
        $this->display();
    }

    public function add() {
        $data['action'] = 'add';
        $data['title'] = "添加";
        $data['btn'] = "添加公告";
        $action = I('post.action');
        $pro = M('property');
        $proList = $pro->select();
        $this->assign('pro', $proList);
        if (IS_POST) {
            if ($action == "add") {
                $pntice = D('ProNotice');
                if ($data = $pntice->create()) {
                    $_villa = _vialg($data);
                    if (!empty($_villa)) {
                        $url = U('/Home/proInfo/add', '', false);
                        $this->error($_villa . '  添加失败!');
                    }
                    if ($pntice->add($data)) {
                        $url = U('/Home/proInfo/index');
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
            $this->assign('info', $info);
        }
        $this->assign('data', $data);
        $this->display();
    }

    public function word() {
        $data['action'] = 'add';
        $data['title'] = "添加/修改";
        $data['btn'] = "提交关键词";
        $action = I('post.action');
        $word = M('ProKeyword');
        $wordfind = $word->find();
        if ($wordfind) {
            $data['action'] = 'edit';
            $wordfind['pname'] = implode(",", json_decode($wordfind['pname']));
            $this->assign('word', $wordfind);
        }
        if (IS_POST) {
            if ($action == "add") {
                $word = D('ProKeyword');
                if ($wordfind) {
                    $url = U('/Home/proInfo/word', '', false);
                    $this->error('已有关键设置,添加失败!');
                }
                if ($data = $word->create()) {
                    $dataname = explode(",", $data['pname']);
                    $data['pname'] = json_encode($dataname);
                    if ($word->add($data)) {
                        $url = U('/Home/ProInfo/word');
                        $this->success("用户添加成功！", $url);
                    } else {
                        $this->error("用户添加失败！", 'index');
                    }
                }
            } elseif ($action == "edit") {
                $word = D("ProKeyword");
                if ($data = $word->create()) {
                    $dataname = explode(",", $data['pname']);
                    $data['pname'] = json_encode($dataname);
                    if ($word->save($data)) {
                        $url = U('/Home/ProInfo/word');
                        $this->success("修改成功！", $url);
                    } else {
                        $this->error("用户修改失败！", 'index');
                    }
                } else {
                    $this->error($word->getError());
                }
            }
        }
        $this->assign('data', $data);
        $this->display();
    }

    public function examine() {
        $data['action'] = 'add';
        $data['title'] = "添加";
        $data['btn'] = "添加调查";
        $action = I('post.action');
        $prosury = M("ProSurvey");
        $prolist = $prosury->select();
        $this->assign('pro', $prolist);
        if (IS_POST) {
            if ($action == "add") {
                $prosuvey = D('ProSurvey');
                if ($data = $prosuvey->create()) {
                    $data['Release_time'] = time();
                    $data['add_time'] = time();
                    if ($prosuvey->add($data)) {
                        $url = U('/Home/proInfo/examine');
                        $this->success("用户添加成功！", $url);
                    } else {
                        $this->error("用户添加失败！", 'index');
                    }
                }
            } elseif ($action == "edit") {
                // print_r($_REQUEST);exit;
                $prosury = M("ProSurvey");
                if ($data = $prosury->create()) {
                    if ($prosury->save($data)) {
                        $url = U('/Home/proInfo/examine');
                        $this->success('修改成功!', $url);
                    } else {
                        $this->error("修改失败！", 'index');
                    }
                }
            }
        }
        $this->assign('data', $data);
        $this->display();
    }

    public function url_ajaxCalendar() {
        $id = I('post.id', 0);
        $prosury = M("ProSurvey");
        $info = $prosury->where("id=" . $id)->find();
        $info['action'] = 'edit';
        $this->ajaxReturn($info);
    }

    public function url_ajaxCarpool() {
        $id = I('post.id', 0);
        // echo $id;exit;
        $prosury = M("ProCar");
        $info = $prosury->where("id=" . $id)->find();
        $info['action'] = 'edit';
        $this->ajaxReturn($info);
    }

    public function url_ajaxActive() {
        $id = I('post.id', 0);
        // echo $id;exit;
        $prosury = M("ProActivity");
        $info = $prosury->where("id=" . $id)->find();
        $info['action'] = 'edit';
        $this->ajaxReturn($info);
    }

    public function url_ajaxhinder() {
        $id = I('post.id', 0);
        $prorepair = M("ProRepair");
        $info = $prorepair->where("rid=" . $id)->find();
        $info['action'] = 'edit';
        $this->ajaxReturn($info);
    }

    public function url_ajaxdecorate() {
        $id = I('post.id', 0);
        $pro = M("ProDecorate");
        $info = $pro->where("rid=" . $id)->find();
        $info['action'] = 'edit';
        $this->ajaxReturn($info);
    }

    public function url_ajaxrepair() {
        $id = I('post.id', 0);
        $pro = M("ProComplaints");
        $info = $pro->where("rid=" . $id)->find();
        $info['action'] = 'edit';
        $this->ajaxReturn($info);
    }

    public function carpool() {
        $data['action'] = 'add';
        $data['title'] = "添加";
        $data['btn'] = "添加调查";
        $action = I('post.action');
        $procar = M("ProCar");
        $prolist = $procar->select();
        $this->assign('pro', $prolist);
        if (IS_POST) {
            if ($action == "add") {
                $procar = M("ProCar");
                if ($data = $procar->create()) {
                    //  $data['Release_time'] = time();
                    $data['add_time'] = time();
                    if ($procar->add($data)) {
                        $url = U('/Home/proInfo/carpool');
                        $this->success("用户添加成功！", $url);
                    } else {
                        $this->error("用户添加失败！", 'index');
                    }
                }
            } elseif ($action == "edit") {
                // print_r($_REQUEST);exit;
                $procar = M("ProCar");
                if ($data = $procar->create()) {
                    if ($procar->save($data)) {
                        $url = U('/Home/proInfo/carpool');
                        $this->success('修改成功!', $url);
                    } else {
                        $this->error("修改失败！", 'index');
                    }
                }
            }
        }
        $this->assign('data', $data);
        $this->display();
    }

    public function active() {
        $data['action'] = 'add';
        $data['title'] = "添加";
        $data['btn'] = "添加调查";
        $action = I('post.action');
        $proactiv = M("ProActivity");
        $prolist = $proactiv->select();
        $this->assign('pro', $prolist);
        if (IS_POST) {
            if ($action == "add") {
                $proactiv = M("ProActivity");
                if ($data = $proactiv->create()) {
                    //  $data['Release_time'] = time();
                    $data['add_time'] = time();
                    if ($proactiv->add($data)) {
                        $url = U('/Home/proInfo/active');
                        $this->success("用户添加成功！", $url);
                    } else {
                        $this->error("用户添加失败！", 'index');
                    }
                }
            } elseif ($action == "edit") {
                $proactiv = M("ProActivity");
                if ($data = $proactiv->create()) {
                    if ($proactiv->save($data)) {
                        $url = U('/Home/proInfo/active');
                        $this->success('修改成功!', $url);
                    } else {
                        $this->error("修改失败！", 'index');
                    }
                }
            }
        }
        $this->assign('data', $data);
        $this->display();
    }

    public function hinder() {
        $data['action'] = 'add';
        $data['title'] = "添加";
        $data['btn'] = "添加调查";
        $action = I('post.action');
        $prorepair = M("ProRepair");
        $prolist = $prorepair->select();
        $this->assign('pro', $prolist);
        if (IS_POST) {
            if ($action == "add") {
                $prorepair = M("ProRepair");
                if ($data = $prorepair->create()) {
                    $data['add_time'] = time();
                    if ($prorepair->add($data)) {
                        $this->success("用户添加成功！", U('/Home/proInfo/hinder'));
                    } else {
                        $this->error("用户添加失败！", U('/Home/proInfo/hinder'));
                    }
                }
            } elseif ($action == "edit") {
                $prorepair = M("ProRepair");
                if ($data = $prorepair->create()) {
                    if ($prorepair->save($data)) {
                        $this->success('修改成功!', U('/Home/proInfo/hinder'));
                    } else {
                        $this->error("修改失败！", U('/Home/proInfo/hinder'));
                    }
                }
            }
        }

        $this->assign('data', $data);
        $this->display();
    }

    public function decorate() {
        $data['action'] = 'add';
        $data['title'] = "添加";
        $data['btn'] = "添加调查";
        $action = I('post.action');
        $pro = M("ProDecorate");
        $prolist = $pro->select();
        $this->assign('obj', $pro);
        $this->assign('pro', $prolist);
        if (IS_POST) {
      //      print_r($_REQUEST);exit;
            if ($action == "add") {
                $pro = M("ProDecorate");
                if ($data = $pro->create()) {
                    $data['add_time'] = time();
                    if ($pro->add($data)) {
                        $this->success("用户添加成功！", U('/Home/proInfo/decorate'));
                    } else {
                        $this->error("用户添加失败！", U('/Home/proInfo/decorate'));
                    }
                }
            } elseif ($action == "edit") {
         //       echo 1;exit;
                $pro = M("ProDecorate");
                if ($data = $pro->create()) {
                    if ($pro->save($data)) {
                        $this->success('修改成功!', U('/Home/proInfo/decorate'));
                    } else {
                        $this->error("修改失败！", U('/Home/proInfo/decorate'));
                    }
                }
            }
        }
        $this->assign('data', $data);
        $this->display();
    }

    public function repair() {
        $data['action'] = 'add';
        $data['title'] = "添加";
        $action = I('post.action');
        $pro = M("ProComplaints");
        $prolist = $pro->select();
        $this->assign('obj', $pro);
        $this->assign('pro', $prolist);
        if (IS_POST) {
            if ($action == "add") {
                $pro = M("ProComplaints");
                if ($data = $pro->create()) {
                    $data['add_time'] = time();
                    if ($pro->add($data)) {
                        $this->success("用户添加成功！", U('/Home/proInfo/repair'));
                    } else {
                        $this->error("用户添加失败！", U('/Home/proInfo/repair'));
                    }
                }
            } elseif ($action == "edit") {
                $pro = M("ProComplaints");
                if ($data = $pro->create()) {
                    if ($pro->save($data)) {
                        $this->success('修改成功!', U('/Home/proInfo/repair'));
                    } else {
                        $this->error("修改失败！", U('/Home/proInfo/repair'));
                    }
                }
            }
        }
        $this->assign('data', $data);
        $this->display();
    }

}

?>
