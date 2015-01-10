<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class ConfigController extends IsloginController {

    public function index() {
        $business = M("BusinessShop");
        if (IS_POST) {
            $name = I('post.name');
            $parent_type = I('post.parent_type');
            $address = I('post.address');
            if ($name)
                $where['bsname'] = array('LIKE', '%' . $name . '%');
            if ($address)
                $where['address'] = array('LIKE', '%' . $address . '%');
            if ($parent_type)
                $where['phone'] = array('LIKE', '%' . $parent_type . '%');
        }
        $count = $business->where($where)
                ->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 4);
        $show = $page->show();
        //   print_r($show);exit;
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $data = $business->field('*')
                ->where($where)
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
        $data['btn'] = "添加物业";
        $action = I('post.action');
        $obj = M("Business");
        $pro = $obj->select();
        // dump($pro);
        $this->assign('pro', $pro);
        if (IS_POST) {
            $path = I('post.path');
            $mid = I('post.mid');
            $name = I('post.pic_name');
            foreach ($path as $k => $v) {
                $tem = "";
                $tem['pic'] = $v;
                $tem['mid'] = $mid[$k];
                $tem['name'] = $name[$k];

                $path[$k] = $tem;
            }
            $goods_img = json_encode($path);
            if ($action == "add") {
                //   print_r($_REQUEST);exit;
                $business = M("BusinessShop");
                if ($data = $business->create()) {
                    //    $data["add_time"] = time();
                    $data["more_pic"] = $goods_img;
                    if ($business->add($data)) {
                        $url = U('/Home/Config/index');
                        $this->success("用户添加成功！", $url);
                    } else {
                        $this->error("用户添加失败！", 'index');
                    }
                }
            } elseif ($action == "edit") {
                $business = M("BusinessShop");
                if ($data = $business->create()) {
                    $data["more_pic"] = $goods_img;
                    if ($business->save($data)) {
                        $url = U('/Home/Config/index');
                        $this->success("修改成功！", $url);
                    } else {
                        $this->error("用户修改失败！", 'index');
                    }
                } else {
                    $this->error($business->getError());
                }
            }
        }
        $id = I('get.id', 0);
        if ($id) {
            $data['action'] = 'edit';
            $data['title'] = "编辑物业";
            $data['btn'] = "编辑";
            $business = M("BusinessShop");
            $obj = M("Business");
            $businessList = $business->where("bsid=" . $id)->find();
            $img = $businessList['more_pic'];
            $businessList['more_pic'] = json_decode($img, true);
            $bid = $obj->where("id=" . $businessList['bid'])->find();
            //  print_r($bid);exit;
            $this->assign("region", $bid);
            $this->assign('info', $businessList);
        }
        $this->assign('data', $data);
        $this->display();
    }

    public function details() {
        $id = I('post.id', 0);

        if ($id) {
            $data['title'] = "编辑商品";
            $data['btn'] = "编辑";
            $business = M("BusinessShop b");
            $goodsFind = $business->field('b.*,c.id as sid,c.name as sname')
                    ->join('wrt_business AS c ON b.bid=c.id')
                    ->where('b.bsid=' . $id)
                    ->find();
        } else {
            $this->error($business->getError());
        }
        $this->ajaxReturn($goodsFind);
    }

}

?>
