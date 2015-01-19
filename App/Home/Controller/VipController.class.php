<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class VipController extends IsloginController {

    public function vlist() {
        $vip = M("Vip");
        if (IS_POST) {
            $name = I('post.store_name');
            $user_name = I('post.user_name');
            $address = I('post.address');
            if ($name)
                $where['store_name'] = array('LIKE', '%' . $name . '%');
            if ($address)
                $where['address'] = array('LIKE', '%' . $address . '%');
            if ($parent_type)
                $where['user_name'] = array('LIKE', '%' . $user_name . '%');
        }
        $count = $vip->where($where)
                ->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 10);
        $show = $page->show();
        //   print_r($show);exit;
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $data = $vip->where($where)->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        $this->assign('data', $data);
        $this->display();
    }

    /*  public function getdata() {
      $page = I('get.page', 1);
      $pageSize = I('get.pageSize', 20);
      $limit = "limit " . ($page - 1) * $pageSize . ',' . $pageSize;
      $sql = "select * from " . C('DB_PREFIX') . "vip " . $limit;
      $data = M()->query($sql);
      return $data;
      }
     * 
     */

    public function vadd() {
        $data['action'] = 'add';
        $data['title'] = "添加";
        $data['btn'] = "添加商家";
        $action = I('post.action');
        $pro = $this->getprovence();
        $this->assign('pro', $pro);
        if (IS_POST) {
            $Village = D('Vip');
            $data = $Village->create();
            if ($data) {
                if ($action == "add") {
                    $data["add_time"] = time();
                    if ($Village->add($data)) {
                        $this->success("用户添加成功！", U('/Home/vip/vlist'));
                    } else {
                        $this->error("用户添加失败！", U('/Home/vip/vadd'));
                    }
                } elseif ($action == "edit") {
                    if ($Village->save($data)) {
                        $this->success("修改成功！", U('/Home/vip/vlist'));
                    } else {
                        $this->error("用户修改失败！", U('/Home/vip/vadd'));
                    }
                }
            } else {
                $this->error($Village->getError(), '', 2);
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
            //   print_r($regionProv);exit;
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
        $name=session('admin.name');
        $id = session('admin.id');
        if($name=='admin'){
            $this->redirect("Order/index"); 
        }
        $order = M("Order");
        $count = $order->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 15);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $data = $order->where("bid=" . $id." and cate=1")
                ->limit($page->firstRow . ',' . $page->listRows)
                ->select();
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        $this->assign('data', $data);
        $this->display();
    }

}

?>
