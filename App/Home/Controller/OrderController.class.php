<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class OrderController extends IsloginController {

    public function index() {
        $action = I('post.action');
        $oid = I('get.id', 0);     
        $order = M("Order o");
        
       if($oid){
         $list= $order->field('o.*,i.number as info_number,i.good_name,i.totle as info_totle,i.list_pic ')
                ->join('wrt_user AS u ON u.user_id=o.user_id')
                ->join('wrt_order_info AS i ON i.order_number=o.number')
                ->where("o.oid=".$oid)
                ->select();
         
         foreach ($list as $value){ $total+=$value['info_totle']; }
         
          $find=$order->where('oid='.$oid)->find(); $find['action']='delivery';
          $total+=$find['freight'];
          
          $express=M("express");
          $expressFind=$express->where('id='.$find['express'])->find();  $expressList=$express->select();

          $this->assign('find', $find); $this->assign('list', $expressList); $this->assign('data', $list); $this->assign('expressFind', $expressFind); $this->assign('total', $total);
          
          $this->display('Vip/delivery');
          exit;
        }    
      //    ->join('wrt_user AS u ON u.user_id=o.user_id')    ->join('wrt_business AS b ON b.id=o.shop_id')->
                     
        $count = $order->count();
                    
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 10);
        $show = $page->show();
     
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
           $data = $order->field('o.*,u.user_id,b.id,b.name,b.list_pic,u.user_name')
                         ->join('wrt_user AS u ON u.user_id=o.user_id')
                         ->join('wrt_business AS b ON b.id=o.shop_id')
                         ->limit($page->firstRow . ',' . $page->listRows)
                         ->select();
           
           $vip = $order->field('o.*,u.user_id,v.store_id as id,v.store_name as name,u.user_name')
                         ->join('wrt_user AS u ON u.user_id=o.user_id')
                         ->join('wrt_vip AS v ON v.store_id=o.shop_id')
                         ->limit($page->firstRow . ',' . $page->listRows)
                         ->select();
      
      foreach ($vip  as $v){ array_push($data, $v);   }  
        // print_r($data);exit;
      $mycars=Array("新订单","未付款","待发货","配货中","发货","发货中","待收货","已收货","评论后");
      
      foreach ($data as $v){
         if($v['statue']==0){$v['statue']=$mycars[0];} elseif($v['statue']==1){$v['statue']=$mycars[1];}
         if($v['statue']==2){$v['statue']=$mycars[2];} elseif($v['statue']==3){$v['statue']=$mycars[3];}
         if($v['statue']==4){$v['statue']=$mycars[4];} elseif($v['statue']==5){$v['statue']=$mycars[5];}    
         if($v['statue']==6){$v['statue']=$mycars[6];} elseif($v['statue']==7){$v['statue']=$mycars[7];}    
         if($v['statue']==8){$v['statue']=$mycars[8];}   
         $arr[]=$v;
      }
         if (IS_POST) {
          
               $order = D('Order');
               $data = $order->create();
            if ($data) {
                if ($action == "add") {
                  
                    if ($order->add($data)) {  $this->success("用户添加成功！", U('/Home/vip/order'));} else { $this->error("用户添加失败！",U('/Home/vip/order')); }
            
                } elseif ($action == "edit") {
                    
                    if ($order->save($data)) {  $this->success("修改成功！", U('/Home/vip/order')); } else { $this->error("用户修改失败！", U('/Home/vip/order')); } 
              
               } elseif ($action == "delivery") { $data['statue']=6;
          
                    if ($order->save($data)) {  $this->success("正在发货！", U('/Home/vip/order')); } else { $this->error("用户提交失败！", U('/Home/vip/order')); } }       
         
            } else { $this->error($order->getError(),'',1); } }
        $this->assign("currentPage", $currentPage); $this->assign("totalPage", $page->totalPages); $this->assign("page", $show); $this->assign('data', $arr);
     
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

 public function urlAjaxOrderFind() {

        $id = I('post.id', 0);
        if ($id) {
            $goods = M("Order o");
            $goodsFind = $goods->field('o.*,u.user_id,b.id,b.name,b.list_pic,u.user_name')
                    ->join('wrt_user AS u ON u.user_id=o.user_id')
                    ->join('wrt_business AS b ON b.id=o.shop_id')
                    ->where('o.oid=' . $id)
                    ->find();
            $goodsFind['time'] = date("Y-m-d H:i:s", $goodsFind['time']);
            $goodsFind['action']='edit';
        } else {
            $this->error($goods->getError());
        }
        $this->ajaxReturn($goodsFind);
    }
 public function urlAjaxOrderVipFind() {

        $id = I('post.id', 0);
        if ($id) {
            $goods = M("Order o");
            $goodsFind = $goods->field('o.*,u.user_id,v.store_id as id,v.store_name as name,u.user_name')
                    ->join('wrt_user AS u ON u.user_id=o.user_id')
                    ->join('wrt_vip AS v ON v.store_id=o.shop_id')
                    ->where('o.oid=' . $id)
                    ->find();
            $goodsFind['time'] = date("Y-m-d H:i:s", $goodsFind['time']);
            $goodsFind['action']='edit';
        } else {
            $this->error($goods->getError());
        }
        $this->ajaxReturn($goodsFind);
    }

}

?>
