<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class ProInfoController extends IsloginController {

    public function index() {
        $house = M("ProNotice p");
        $data = $house->field('p.*,y.id as yid,y.pname')
                ->join('wrt_property AS y ON p.proid=y.id')
                ->select();
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
                    //     print_r(_vialg($data));exit;

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
        $data['btn'] = "添加公告";
        $action = I('post.action');
        $prosury = M("ProSurvey");

        if (IS_POST) {
            if ($action == "add") {
                $prosuvey = D('ProSurvey');
                if ($data = $prosuvey->create()) {
                    $data['Release_time'] = time();
                    $data['add_time'] = time();
                    //     print_r(_vialg($data));exit;
                    if ($prosuvey->add($data)) {
                        $url = U('/Home/proInfo/index');
                        $this->success("用户添加成功！", $url);
                    } else {
                        $this->error("用户添加失败！", 'index');
                    }
                }
            } elseif ($action == "edit") {
                $prosuvey = D('ProSurvey');
                if ($data = $prosuvey->create()) {
                    if ($prosuvey->save($data)) {
                        $url = U('/Home/proInfo/index');
                        $this->success("修改成功！", $url);
                    } else {
                        $url = U('/Home/proInfo/add', '', false);
                        $this->error('修改失败!');
                    }
                } else {
                    $this->error($prosuvey->getError());
                }
            }
        }
        $this->assign('data', $data);
        $this->display();
    }

}

?>
