<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class OrderController extends IsloginController {

    public function index() {

        $order = M("Order");
        $count = $order->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 5);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $data = $order->limit($page->firstRow . ',' . $page->listRows)->select();
        //  print_r($adcount);exit;
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        $this->assign('data', $data);
        $this->display();
    }

    public function del() {
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

    public function config() {
        
    }

    public function urlAjaxOrderFind() {
        $id = I('post.id', 0);
        if ($id) {
            $goods = M("Order o");
            $goodsFind = $goods->field('o.*,u.user_id,b.id,b.name,u.user_name')
                    ->join('wrt_user AS u ON u.user_id=o.user_id')
                    ->join('wrt_business AS b ON b.id=o.bid')
                    ->where('o.oid=' . $id)
                    ->find();
            $goodsFind['time'] = date("Y-m-d H:i:s", $goodsFind['time']);
        } else {
            $this->error($goods->getError());
        }
        $this->ajaxReturn($goodsFind);
    }

}

?>
