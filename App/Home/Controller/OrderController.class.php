<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class OrderController extends IsloginController {

    public function index() {

        $order = M("Order");
        $data = $order->select();
        $this->assign('data', $data);
        $this->display();
    }

    public function del() {
        $id = I('get.id', 0);
        $order = D('Order');
        $result = $order->where("oid=$id")->find();
        $ordertime = date("Y-m-d", $result['time']);
        if ($this->getChaBetweenTwoDate(date("Y-m-d"), $ordertime) > 7) {
            if ($order->where("oid=$id")->delete()) { redirect($_SERVER["HTTP_REFERER"]); }
    
            } else {  $url = U('/Home/order/index', '', false); $this->error('订单未过期!');
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
