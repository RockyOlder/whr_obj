<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class VipController extends IsloginController {

    public function vlist() {
        $vip = M("Vip");
        if (IS_POST) {
            $name = I('post.store_name'); $user_name = I('post.user_name'); $address = I('post.address');
            if ($name)
                $where['store_name'] = array('LIKE', '%' . $name . '%');
            if ($address)
                $where['address'] = array('LIKE', '%' . $address . '%');
            if ($user_name)
                $where['user_name'] = array('LIKE', '%' . $user_name . '%');
        }
        $count = $vip->where($where) ->count();
        
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 10);
        $show = $page->show();

        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $data = $vip->where($where)->limit($page->firstRow . ',' . $page->listRows)->select();
        
        $this->assign("currentPage", $currentPage); $this->assign("totalPage", $page->totalPages); $this->assign("page", $show); $this->assign('data', $data);
        $this->display();
    }

    public function vadd() {
        $data['action'] = 'add'; $data['title'] = "添加"; $data['btn'] = "添加商家";
        $action = I('post.action');
        $pro = $this->getprovence();
        $this->assign('pro', $pro);
        if (IS_POST) {
            $Village = D('Vip');
            $data = $Village->create();
            if ($data) {
                if ($action == "add") {
                    $data["add_time"] = time();
                    
                    if ($Village->add($data)) { $this->success("用户添加成功！", U('/Home/vip/vlist')); } else {  $this->error("用户添加失败！", U('/Home/vip/vadd')); }
              
              } elseif ($action == "edit") {
                    
                    if ($Village->save($data)) { $this->success("修改成功！", U('/Home/vip/vlist')); } else { $this->error("用户修改失败！", U('/Home/vip/vadd'));
                        
            } } } else { $this->error($Village->getError(), '', 2); } }
        $id = I('get.id', 0);
        if ($id) {
            $data['action'] = 'edit';  $data['title'] = "编辑商家"; $data['btn'] = "编辑";
            
            $vip = M("Vip");  $region = M("region");
            
            $vipList = $vip->where("store_id=$id")->find();
            $regionProv = $region->where("REGION_ID=" . $vipList['province'])->find();
            $this->assign("region", $regionProv); $this->assign('info', $vipList);
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
            
          if ($order->where("oid=$id")->delete()) {  redirect($_SERVER["HTTP_REFERER"]); } } else { $this->error('订单未过期!',U('/Home/order/index', '', false)); }
    }
    public function order() {
        $name=session('admin.name');
        $id = session('admin.shop_id');
        $action = I('post.action');
        $oid = I('get.id', 0);     
        $order = M("Order o");
        
       if($name=='admin'){$this->redirect("Order/index");  }
       
        if($oid){
         $list= $order->field('o.*,i.number as info_number,i.good_name,i.totle as info_totle,i.list_pic,i.order_number')
                ->join('wrt_user AS u ON u.user_id=o.user_id')
                ->join('wrt_order_info AS i ON i.order_number=o.number')
                ->where("o.oid=".$oid)
                ->select();
         
         $username=$order->field('o.*,u.user_name')->join('wrt_user AS u ON u.user_id=o.user_id')->where("o.oid=".$oid) ->find();
         
          foreach ($list as $value){ $total+=$value['info_totle']; }
         
          $find=$order->where('oid='.$oid)->find(); $find['action']='delivery';
          $total+=$find['freight'];
          
          $express=M("express");
          $expressFind=$express->where('id='.$find['express'])->find();  $expressList=$express->select();

          $this->assign('find', $find); $this->assign('list', $expressList); $this->assign('data', $list); $this->assign('expressFind', $expressFind); $this->assign('total', $total); $this->assign('username', $username);
          
          $this->display('delivery');
          exit;
        }    
     
        $count = $order  ->join('wrt_user AS u ON u.user_id=o.user_id')
                         ->join('wrt_vip AS v ON v.store_id=o.shop_id')
                         ->where("shop_id=" . $id." and cate=".session('admin.type'))->count();
       // echo $id;exit;
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 15);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        
           $data = $order->field('o.*,u.user_id,v.store_id as id,v.store_name as name,u.user_name')
                         ->join('wrt_user AS u ON u.user_id=o.user_id')
                         ->join('wrt_vip AS v ON v.store_id=o.shop_id')
                         ->where("shop_id=" . $id." and cate=".session('admin.type'))
                         ->limit($page->firstRow . ',' . $page->listRows)
                         ->select();
      //   print_r($data);exit;
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

                    if ($order->save($data)) { sendMsg(I('post.username'),'您好，您的商品已发货'); $this->success("正在发货！", U('/Home/vip/order')); } else { $this->error("用户提交失败！", U('/Home/vip/order')); } }       
         
            } else { $this->error($order->getError(),'',1); } }
               
        $this->assign("currentPage", $currentPage); $this->assign("totalPage", $page->totalPages); $this->assign("page", $show); $this->assign('data', $arr);
    
        $this->display();
    }
 public function urlAjaxOrderFind() {

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
