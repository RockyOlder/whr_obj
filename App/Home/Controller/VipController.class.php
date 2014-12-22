<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class VipController extends IsloginController {

    public function vlist() {
        $data = $this->getdata();

        $this->assign('data', $data);
        $this->display();
    }

    public function getdata() {
        $page = I('get.page', 1);
        $pageSize = I('get.pageSize', 20);
        $limit = "limit " . ($page - 1) * $pageSize . ',' . $pageSize;
        $sql = "select * from " . C('DB_PREFIX') . "vip " . $limit;
        $data = M()->query($sql);
        return $data;
    }

    public function vadd() {
        $data['action'] = 'add';
        $data['title'] = "添加";
        $data['btn'] = "添加商家";
        $action = I('post.action');
        $pro = $this->getprovence();
        $this->assign('pro', $pro);
        if (IS_POST) {
            if ($action == "add") {
                $Village = D('Vip');
                if ($data = $Village->create()) {
                    $data["add_time"] = time();
                    if ($Village->add($data)) {
                        $url = U('/Home/vip/vlist');
                        $this->success("用户添加成功！", $url);
                    } else {
                        $this->error("用户添加失败！", 'index');
                    }
                }
            } elseif ($action == "edit") {
                //  print_r($_REQUEST);exit;
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

    public function del() {
        $id = I('get.id', 0);
        $admin = D('Vip');
        $result = $admin->where("id=$id")->delete();
        if ($result) {
            redirect($_SERVER["HTTP_REFERER"]);
        }
    }

    public function orderDel() {
        $id = I('get.id', 0);
        $order = D('Order');
        $result = $order->where("oid=$id")->find();
        $ordertime = date("Y-m-d", $result['time']);
        if ($this->getChaBetweenTwoDate(date("Y-m-d"), $ordertime) > 7) {
            if ($order->where("oid=$id")->delete()) {
                redirect($_SERVER["HTTP_REFERER"]);
            }
        } else {
            $url = U('/Home/order/index', '', false);
            $this->error('订单未过期!');
        }
    }

    public function order() {
        $order = M("Order");
        $data = $order->select();
        $this->assign('data', $data);
        $this->display();
    }

}

?>
