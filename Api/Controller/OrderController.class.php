<?php
namespace Api\Controller;
use Api\Controller\CommonController;
class OrderController extends CommonController {
    // 添加用户地址
    public function address()
    {
      // echo time();die();
        $id = I('request.version',1);
        $pid = I('request.pid',0,'intval');
          // 获取商店需要的数据
         $arr = array(
            "user_id" =>I('request.userId',0,'intval'),
            "phone"   =>I('request.phone'),
            'address' =>I('request.address'),
            "name"    =>I('request.userName'),
            "notice"  =>I('request.notice'),
            "area"  =>I('request.area'),
          );
          if ($arr['user_id'] == 0) {
              $out['msg'] = C('no_id');
              $out['success'] = 0;
              $this->ajaxReturn($out);
          }
          if ($id == 1) {
              if ($pid) {
                $arr['id'] = $pid;
                $bool = M('user_address')->save($arr);
                if ($bool) {
                    $out['success'] = 1;
                    $out['msg'] ='地址修改成功';
                }else{
                    $out['success'] = 0;
                    $out['msg'] ='地址修改失败';
                }
                 $this->ajaxReturn($out);
              }
              $bool = M('user_address')->add($arr);
              if ($bool) {
                  $out['success'] = 1;
                  $out['msg'] ='地址添加成功';
              }else{
                  $out['success'] = 0;
                  $out['msg'] ='地址添加失败';
              }
               $this->ajaxReturn($out);
          }       
    }
    // 获取收货地址
     public function getAddress()
    {
        $id = I('request.version',1,'intval');
        $userId = I('request.userId',0,'intval');
          if (!$userId) {
              $out['msg'] = C('no_id');
              $out['success'] = 0;
              $this->ajaxReturn($out);
          }          
          // dump($number);
          if ($id == 1) {
              $sql = "select id,phone,area,address,name,`default`,notice from ".C('DB_PREFIX')."user_address where user_id = '$userId' and del = '0'";
              // dump($sql);
              $data = M()->query($sql);
              if (!empty($data)) {
                  $out['success'] = 1;
                  $out['data'] =$data;
              }else{
                  $out['success'] = 0;
                  $out['msg'] ='获取失败或者该用户没有地址';
              }
               $this->ajaxReturn($out);
          }       
    }
    // 获取运费
     public function getFree()
    {
        $id = I('request.version',1,'intval');
        $expressId = I('request.expressId',0,'intval');
        $city = I('request.city');
        // $num = I('request.num');
        
        $number =I('request.number');
        $number = explode(',', $number);
        // dump($pro);
        // dump($goodId);die();
        if ($id == 1) {
          $key = array_keys($pro);
          $key = implode(',', $key);
          $str = "goods_id in ($key)";
          // dump($str);die();
          $city = mb_substr($city, 0,2,'utf-8');
          // dump($city);die();
         /* dump($goods);
          $garr = explode(',', $goods);*/
          $goodId = I('request.goodId');        
          $w = 'goods_id in ('.$goodId.')';//组合出查询的条件
          $goodId = explode(',', $goodId);
          // 查询商品是否有免运费
          $data = M('goods')->field('is_free,weight,goods_id')->where($w)->select();
         
              if (!is_null($data)) {
            // dump($data);
            $weight = 0;
          //dump($data);
              foreach ($data as $k => $v) { //将数组组合为新的数组
                // dump($weight);
                  $tem[] = $v['is_free'];    
                  //计算出商品的重量
                  foreach ($goodId as $k1 => $v1) {
                    if ($v1 == $v['goods_id']) {
                      $num = $number[$k1];
                    }
                  }
                  //dump($v['goods_id']);
                  //dump($num);
                  $temp = $num * $v['weight']; 
                  $weight += ($temp == 0)?1:$temp;         
              }
              // dump($tem);
              // dump($weight);die();
              if(in_array('1', $tem)){
                  $out['success'] = 1;
                  $out['free'] = 0;
                  $this->ajaxReturn($out);
              }
              
              // 查看传递的城市是否在快递公司的城市设置之中
              $sql = "select price from ".C('DB_PREFIX')."express_info where eid = $expressId and area like '%$city%' ";
              // dump($sql);
              $bool = M()->query($sql);
              // dump($bool);
              if (!empty($bool)) {
                $bool = current($bool);
                $price = $bool['price'];
              }else{
                $express = M('express')->field('price')->where(array('id'=>$expressId))->find(); 
                $price = $express['price'];
              }
              // dump($weight);
              $out['price'] = $price * $weight;
              $out['msg'] = '成功';
              $out['success'] =1;
              $this->ajaxReturn($out);

          }
          // 搜索出用户选择的快递的内容            
        }    
    }
     // 获取默认收货地址
     public function getDefault()
    {
        $id = I('request.version',1,'intval');
        $userId = I('request.userId',0,'intval');
          if (!$userId) {
              $out['msg'] = C('no_id');
              $out['success'] = 0;
              $this->ajaxReturn($out);
          }          
          // dump($number);
          if ($id == 1) {
              $sql = "select id,phone,address,name from ".C('DB_PREFIX')."user_address where user_id = '$userId' and del = '0' and `default` = 1";
              // dump($sql);
              $data = M()->query($sql);
              if (!empty($data)) {
                  $out['success'] = 1;
                  $out['msg'] = '成功回去收货地址';
                  $out['data'] =$data;
              }else{
                $out['success'] = 1;
                $out['msg'] = '无任何收货地址';
                $out['data'] =$data;
              }
               $this->ajaxReturn($out);
          }       
    }
    // 设置默认地址
     public function isDefault()
    {
        $id = I('request.version',1);
        $addressId = I('request.addressId',0,'intval');
        $uid =I('request.userId',0,'intval');
          if (!$addressId || !$uid) {
              $out['msg'] = C('no_id');
              $out['success'] = 0;
              $this->ajaxReturn($out);
          }          
          // dump($number);
          if ($id == 1) {
              $bool = M('user_address')->where(array('user_id'=>$uid))->save(array('default'=>0));
              $sql = "update ".C('DB_PREFIX')."user_address set `default` = 1 where id = $addressId";
              $bool = M()->execute($sql);
              if ($bool) {
                  $out['success'] = 1;
                  $out['msg'] ='设置成功';
              }else{
                  $out['success'] = 0;
                  $out['msg'] ='设置失败';
              }
               $this->ajaxReturn($out);
          }       
    }
    // 删除用户地址
      public function addressDel()
    {
        $id = I('request.version',1);
        $addressId = I('request.addressId',0,'intval');
          if (!$addressId) {
              $out['msg'] = C('no_id');
              $out['success'] = 0;
              $this->ajaxReturn($out);
          }          
          // dump($number);
          if ($id == 1) {
            // 查询是否是默认地址
            $w = array('id'=>$addressId,'default'=>0);
              $data = M('user_address')->field('id')->where($w)->select();
              // dump($data);
              if (empty($data)) {
                $out['success'] = 0;
                $out['data'] = $bool;
                $out['msg'] ='不能删除默认收货地址！';
                $this->ajaxReturn($out);
              }
              $bool = M('user_address')->delete($addressId);
              if ($bool) {                
                  $out['success'] = 1;
                  $out['data'] = $bool;
                  $out['msg'] ='删除成功';
              }else{
                  $out['success'] = 1;
                  $out['data'] = $bool;
                  $out['msg'] ='删除失败';
              }
               $this->ajaxReturn($out);
          }       
    }
    // 获取快递方式
    public function getExpress()
    {
        $id = I('request.version',1);                  
          // dump($number);
        $out['success'] = 1;
          if ($id == 1) {
            $express = S('express');
            if ($express == "") {
               $sql = "select id,name from ".C('DB_PREFIX')."express where `is_ok` = 1";
              // dump($sql);
              $express = M()->query($sql);
              S('express',$express,360000);
             
            }
               $out['data'] =$express;
             
               $this->ajaxReturn($out);
          }       
    }
    /**
     * 添加vip订单
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-09T18:32:15+0800
     * @return [type]                   [description]
     */
    public function orderAdd()

    {
        $id = I('request.version',1,'intval');
        $info = I('request.info');
        $cate = I('request.cate',0,'intval');
        // $info = $info;
        $number = getOrderId();//获取唯一的订单号
          // 获取商店需要的数据
         $order = array(
            "user_id" =>I('request.userId',0,'intval'),
            'address' =>I('request.address',0,'intval'),
            'bill_type'     =>I('request.billType',0,'intval'),   
            'express'       => I('request.express',0,'intval'),
            'freight'       => I('request.fee',0,'intval'),
            'time' =>time(),
            'number' => $number,
            'cate' => 1,
            'totle'=>I('request.fee',0,'intval'),
          );
        
                    
          // dump($order);die();
          if ($id == 1) {   
               if (!$order['user_id'] || !$order['address']) {
                  $out['msg'] = C('no_id');
                  $out['data'] = null;
                  $out['success'] = 0;
                  $this->ajaxReturn($out);
              }

              //$info = '[{"goodid":"5","number":"1","price":"88"}]';
              $goodId = I('request.goodId');
              $num = I('request.number');
              $price = I('request.price');
              // dump($goodId);
              $arr = explode(',', $goodId);
              $arrNum = explode(',',$num);
              $arrPrice = explode(',', $price);
              $sum_price = 0;
              $weight = 0;
              // dump($arr);
              // dump($arrNum);die();
              $shop_id = M('goods')->field('store_id')->where(array('goods_id'=>$arr[0]))->find();
              $order[shop_id] = current($shop_id);
              // dump($order);die();
              M()->startTrans();
             foreach ($arr as $k => $v) {
              //dump($v);
                
                $sql = "select goods_name,list_img,price from ".C('DB_PREFIX')."goods where lgid = $v[goodid]";
                $field = "goods_name,list_img,price";
                $w = array('goods_id'=>$v);
                //dump($w);
                $data = M('goods')->field($field)->where($w)->find();
                //dump($data);die();
                
                if (!empty($data)) {
                  $info = array(
                    'order_number'  =>$number,
                    'good_id'       => $v,
                    'good_name'     =>$data['goods_name'],
                    'price'         =>$arrPrice[$k],
                    'list_pic'      =>$data['list_img'],
                    'number'        =>$arrNum[$k],
                    'totle'         =>$arrNum[$k] * $arrPrice[$k]
                    );

                  // dump($arrNum);
                  // dump($arrPrice);
                  //dump($info);die();
                  $bool=M('order_info')->add($info);//将 数据插入订单详情表中
                  if (!$bool) {
                    $bool = false;
                    return;
                  }
                  $order['totle'] +=$info['totle'];//将打个商品的总价计算进入商品订单列表
                }else{
                  $bool = false;
                }
             }
              $bool1 = M('order')->add($order);
              if ($bool && $bool1) {
                  M()->commit();
                  $out['data'] = $number;
                  $out['success'] = 1;
                  $out['msg'] ='添加订单成功';
              }else{
                  M()->rollback();
                  $out['data'] = null;
                  $out['success'] = 0;
                  $out['msg'] ='添加订单失败';
              }
               $this->ajaxReturn($out);
          }       
    }
    /**
     * 添加生活导航订单
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-09T18:32:57+0800
     * @return [type]                   [description]
     */
    public function lifeAdd()

    {
        $id = I('request.version',1);
        $userId = I('request.userId');
        $goodId = I('request.goodId',0,'intval');
        $sum = I('request.number',0,'intval');
        $price = I('request.price');
        $info = $info;
        $number = getOrderId();//获取唯一的订单号
        $num = $this->getNumber($oid);//获取电子验证码
                
          // 获取商店需要的数据
         $order = array(
            "user_id" =>$userId,        
            'shop_id'       => I('request.shopId',0,'intval'),
            'totle'         =>$sum*$price,
            'sum'     =>$sum,
            'cate'       =>0,
            'number'=>$number,
            'goodid' =>$goodId,
            'price' =>$price,
            'phone' =>I('request.phone'),
            'check_number' =>$num
          );
          //更新商品销售数量
          M('life_goods')->where(array('lgid'=>$goodId))->setInc('sold',$sum);
          if ($id == 1) {  
              if (!$userId) {
                $out['msg'] = C('no_id');
                $out['data'] =null;
                $out['success'] = 0;
                $this->ajaxReturn($out);
                }
              $order['time'] = time();

              $bool = M('order')->add($order);
               if ($bool) {
                  $out['data'] = $number;
                  $out['success'] = 1;
                  $out['msg'] ='添加订单成功';
              }else{
                  $out['data'] = null;
                  $out['success'] = 0;
                  $out['msg'] ='添加订单失败';
              }
              $this->ajaxReturn($out);
           } 
     
    }
    /**orderInfo
     * 订单付款
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-09T19:58:37+0800
     * @return [type]                   [description]
     */
     public function orderPay()
    {
        $id = I('request.version',1);
        $oid = I('request.orderId',0,'intval');
        $type = I('request.type',0,'intval');
          if (!$oid) {
              $out['msg'] = C('no_id');
              $out['success'] = 0;
              $this->ajaxReturn($out);
          }  
          if ($id == 1) {
              $data = array('oid'=>$oid,'statue'=>1);
              if ($type == 1) {//是生活导航的订单
                $num = $this->getNumber($oid);//获取电子验证码
                $data['check_number'] = $num; 
                $mobile = M('order') ->field('phone,price,check_number,shop_id,goodid')->where(array('oid'=>$oid))->find();
                //查找消费卷的商品信息
                // 根据商店的id查询商店的电话
               $b_mobile = M('business')->field('mobile_phone')->where(array('id'=>$mobile['shop_id']))->find();
                // dump($mobile);die();
                $content = "您购买的$mobile[price]元【商品名】消费券为：$mobile[check_number],一经验证不能代表消费，不能退款，请你安排好你的验证时间，商家电话：$b_mobile[mobile_phone].客服电话： 400-700-8828<br/>【慧享园】";
                // dump($content);die();
                sendMsg($mobile[phone],$content);   //给客户发送提示编码           
              }
              // dump($data);
              $bool = M('order')->save($data);
              // dump($bool);
              if ($bool) {
                
                  $out['success'] = 1;
                  $out['msg'] ='付款成功';
              }else{
                  $out['success'] = 0;
                  $out['msg'] ='付款失败';
              }
               $this->ajaxReturn($out);
          }       
    }
    /**orderInfo
     * 收货确认
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-09T19:58:37+0800
     * @return [type]                   [description]
     */
     public function receipt()
    {
        $id = I('request.version',1);
        $oid = I('request.orderId',0,'intval');
          if (!$oid) {
              $out['msg'] = C('no_id');
              $out['success'] = 0;
              $this->ajaxReturn($out);
          }  
          if ($id == 1) {
              $data = array('oid'=>$oid,'statue'=>6);
              
              // dump($data);
              $bool = M('order')->save($data);
              // dump($bool);
              $out['data'] = null;
              if ($bool) {
                
                  $out['success'] = 1;
                  $out['msg'] ='收货确认';
              }else{
                  $out['success'] = 0;
                  $out['msg'] ='收货确认失败';
              }
               $this->ajaxReturn($out);
        }       
    }
    // 取消订单
     public function orderDel()
    {
        $id = I('request.version',1);
        $oid = I('request.orderId',0,'intval');
          if (!$oid) {
              $out['msg'] = C('no_id');
              $out['success'] = 0;
              $this->ajaxReturn($out);
          }          
          // dump($number);
          if ($id == 1) {
              $sql = "update ".C('DB_PREFIX')."order set is_end = 1  where oid =$oid";
              $bool = M()->execute($sql);
              if ($bool) {
                  $out['success'] = 1;
                  $out['msg'] ='成功删除';
              }else{
                  $out['success'] = 0;
                  $out['msg'] ='删除失败';
              }
               $this->ajaxReturn($out);
          }       
    }
    // 获取用户的订单
     public function userOrder()
    {
        $id = I('request.version',1);
        $uid = I('request.userId',0,'intval');
        $type = I('request.type',0,'intval');
          if ($uid == 0) {
              $out['msg'] = C('no_id');
              $out['success'] = 0;
              $this->ajaxReturn($out);
          }
          if ($type == 2) {
            $type = 5;
          }
          if ($type == 3) {
            $type = 6;
          }
          // dump($type);die();
          if ($id == 1) {              
              //$sql = "select * from ".C('DB_PREFIX')."order where  statue = $type and user_id =$uid and is_end = 0 and cate = 1";
              // dump($sql);
              $w= array('statue' => $type , 'user_id' =>$uid , 'is_end' => 0 , 'cate' => 1);
              $bool = M('order')->where($w)->select();
              // dump(M('order')->getlastSql());
              //dump($bool);
              // var_dump(is_null($bool));die();
              if (is_null($bool)) {
                  $out['success'] = 1;
                  $out['data'] = null;
                  $out['msg'] ="你没有相应订单";
                  $this->ajaxReturn($out);
              }
              if (is_array($bool) && !empty($bool)) {
                  foreach ($bool as $k => $v) {
                    
                      $son = M('order_info')->where('order_number='.$v['number'])->select();
                      $v['son'] = $son;
                      // 查找出快递的名字
                      // dump($v['express']);
                      $v['express_name'] = current(M('express')->field('name')->where(array('id'=>$v['express']))->find());
                      $bool[$k]=$v;                  
                  }
                  $out['success'] = 1;
                  $out['msg'] = '成功';
                  $out['sum'] = $bool;
              }elseif($bool === false){
                  $out['success'] = 0;
                  $out['msg'] = '失败';
                  $out['data'] = null;
              }
               $this->ajaxReturn($out);
          }       
    }
    // 获取用户所有订单
     public function userAll()
    {
         $id = I('request.version',1);
        $uid = I('request.userId',0,'intval');
        $type = I('request.type',0,'intval');
          if ($uid == 0) {
              $out['msg'] = C('no_id');
              $out['success'] = 0;
              $this->ajaxReturn($out);
          }
          if ($id == 1) {              
              $sql = "select * from ".C('DB_PREFIX')."order where user_id =$uid and is_end = 0 and cate = $type order by time desc";
              // dump($sql);
              $bool = M()->query($sql);
              // dump($bool);
              // var_dump($bool);
              if (is_array($bool) && empty($bool)) {
                  $out['success'] = 1;
                  $out['data'] = null;
                  $out['msg'] ="你没有相应订单";
              }
              if (is_array($bool) && !empty($bool)) {
                  foreach ($bool as $k => $v) {
                      if ($v['cate'] == 0) { //生活导航的订单
                      $son = M('life_goods')->field('list_pic')->where(array('lgid'=>$v['goodid']))->find();
                      $son['price'] = $v['price'];
                      // dump($son);die();
                      $v['son'][] = $son;
                      $bool[$k]=$v;
                    }else{
                      $son = M('order_info')->where('order_number='.$v['number'])->select();
                      $v['son'] = $son;
                      $bool[$k]=$v;
                    }
                  }
                  $out['success'] = 1;
                  $out['data'] = $bool;
              }elseif($bool === false){
                  $out['success'] = 0;
                  $out['data'] = null;
              }
               $this->ajaxReturn($out);
          }      
    }
     // 获取单个订单
     public function orderInfo()
    {
         $id = I('request.version',1);
        $oid = I('request.orderId',0,'intval');
          if ($oid == 0) {
              $out['msg'] = C('no_id');
              $out['success'] = 0;
              $this->ajaxReturn($out);
          }
          if ($id == 1) { 
              // dump($sql);
              $data = M('order')->where(array('oid'=>$oid))->find();
              // dump($data);
              // var_dump($bool);
              $out['success'] = 1;
              $out['msg'] = '成功！';
              if (empty($data)) {                  
                  $out['data'] = null;
                  $out['msg'] ="你没有相应订单";
              }else{
                    if ($data['cate'] == 0) { //生活导航的订单
                    $son = M('life_goods')->field('list_pic,lgname')->where(array('lgid'=>$data['goodid']))->find();
                    $son['price'] = $data['price'];
                    $son['oid'] = $data['oid'];
                    $son['sum'] = $data['sum'];
                    $son['statue'] = ($data['statue'] == 0)?'未付款':'付款成功';
                    $son['number'] = $data['number'];
                    $son['time'] = date('Y-m-d H:i:s',$data['add_time']);
                    $son['check_number'] = $data['check_number'];
                    $son['check_statue'] =  ($data['check_statue'] == 0)?'未验证':'已使用';
                    // dump($son);die();
                    $out['data'] = $son;
                  }else{
                    // dump($data);die();
                    $box = M('user_address')->field('area,address,name,phone')->where(array('id'=>$data['address']))->find();
                    $box['oid'] = $data['oid'];
                    $box['number'] = $data['number'];
                    $box['freight'] = $data['freight'];
                    $box['statue'] = $data['statue'];
                    $box['totle'] = $data['totle'];
                    $box['express_num'] = $data['express_num'];
                    $express = M('express')->field('id,name')->where(array('id'=>$data['express']))->find();
                    $box[express] = $express[name];
                    $box[expressId] = $express[id];
                    $son = M('order_info')->field('good_id,list_pic,price,number,good_name,totle')->where('order_number='.$data['number'])->select();
                    // dump(M('order_info')->getlastSql());                    
                    $box['info'] = $son;
                    // dump($box);die();
                    $out['data'] = $box;
                  }                  
              }
               $this->ajaxReturn($out);
          }      
    }
     // 设置用户发票
     public function userBill()
    {
        $id = I('request.version',1);
        $uid = I('request.userId',0,'intval');        
        $bid=I('request.bid',0,'intval');
          if ($uid == 0) {
              $out['msg'] = C('no_id');
              $out['success'] = 0;
              $this->ajaxReturn($out);
          }
          if ($id == 1) {     
              $arr = array(
                'uid'=>$uid,
                'type'=>I('request.type',0,'intval'),
                'is_self'=>I('request.isSelf',0,'intval'),
                'header'=>I('request.header'),
                'notice'=>I('request.notice')
              );
              if ($bid) {
                  $bool = M('user_bill')->where(array('bid'=>$bid))->save($arr);
                  if ($bool) {                  
                      $out['success'] = 1;                  
                      $out['msg'] ="修改成功";
                      $out['id'] = $bool;
                  }else{
                      $out['success'] = 0;
                      $out['msg'] ="修改失败";
                  }
                } else{     
             // dump($arr);
                  $bool = M('user_bill')->add($arr);
                   // dump($bool);
                  if ($bool) {                  
                      $out['success'] = 1;                  
                      $out['msg'] ="添加成功";
                      $out['id'] = $bool;
                  }else{
                      $out['success'] = 0;
                      $out['msg'] ="添加失败";
                  }
                } 
             
               $this->ajaxReturn($out);
          }       
    }
    // 获取用户发票
     public function getBill()
    {
        $id = I('request.version',1);
        $uid = I('request.userId',0,'intval');
             
          if ($uid == 0) {
              $out['msg'] = C('no_id');
              $out['success'] = 0;
              $this->ajaxReturn($out);
          }
          if ($id == 1) {         
             
              $bool = M('user_bill')->where(array('uid'=>$uid))->select();
              // dump($bool);
              if ($bool) {                  
                  $out['success'] = 1;     
                  $out['data'] = $bool;
              }else{

                  $data = S('nomal_bill');
                  if (!$data) {
                     $data= M('user_bill')->where(array('bid'=>1))->select();
                     S('nomal_bill',$data,3600);
                  }
                  $out['data'] = $data;
                  $out['success'] = 1;   
              }
               $this->ajaxReturn($out);
          }       
    }
    /**
     * 生成一个电子吗
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-09T20:10:53+0800
     * @return [type]                   [description]
     */
    public function getNumber($oid){
      $num=mt_rand(999,9999);
      $num .=getOrderId();
      $num .=$oid;
      return $num;
    }
    /**
     * 生活导航用户设置订单号
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-01-11T19:23:07+0800
     * @return [type]                   [description]
     */
    public function phone(){
      $id=I('request.version',1,'intval');
      $phone = I('request.phone');
      $oid=I('request.orderId',0,'intval');
      if ($id == 1) {
        if ($oid == 0) {
          $out['success'] = 1;
          $out['data']=$bool;
          $out['msg'] = '电话添加失败';
          $this->ajaxReturn($out);
        }
        $data = array('phone'=>$phone,'oid'=>$oid);
        $bool=M('order')->save($data);
        if($bool){
          $out['success'] = 1;
          $out['data']=$bool;
          $out['msg'] = '电话添加成功';
        }else{
          $out['success'] = 1;
          $out['data']=$bool;
          $out['msg'] = '电话添加失败';
        }
        $this->ajaxReturn($out);
      }
    }
  
}
