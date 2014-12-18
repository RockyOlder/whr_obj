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

    public function config() {
        
    }

}

?>
