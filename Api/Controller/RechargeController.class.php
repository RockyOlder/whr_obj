<?php
namespace Api\Controller;
use Api\Controller\CommonController;
class RechargeController extends CommonController {

    /**
     * 生成用户充值订单号
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-09T11:12:38+0800
     * @return [type]                   [description]
     */
    public function index()
    {
          $id = I('request.version',1);
          if ($id == 1) {
              $uid = I('request.userId',0,'intval');
              if (!$uid) {
                $out['msg'] = C('no_id');
                $out['success'] = 0;
                $out['data'] = null;
              }
              $data[user_id] = $uid;
              $data[time] = time();
              $data[number] = getOrderId();
              $data[totle] = I('request.total');
              $data[type] = 1;
              $out['success'] = 1;              
              $bool = M('order')->add($data);
              $recharge['uid']= $uid;
              $recharge['number']= $data[number];
              $recharge['total']= $data[totle];
              $recharge['statue']= 0;
              $recharge['time'] = time();
              $bool1 = M('recharge')->add($recharge);
              // dump($bool1);
              if($bool && $bool1 && $bool){
                $out['data'] = $data[number];
                $out['msg'] = '成功';
              }else{
                $out['data'] = null;
                $out['msg'] = '失败';
              }              
              $this->ajaxReturn($out);
          }       
    }
    /**
     * 修改用户充值订单号状态
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-09T11:12:38+0800
     * @return [type]                   [description]
     */
    public function PayCheck()
    {
      C('URL_MODEL',1);
          $id = I('request.version',1);
          $type = I('request.type',0,'intval');
          $number = I('request.number','');
          if ($id == 1) {
              if (!$type) {
                  $out['success'] = 0;
                  $out['data'] = null;
                  $out['msg'] = '没有穿入付款类型';
                  $this->ajaxReturn($out);
                }
              if ($number == '') {
                  $out['success'] = 0;
                  $out['data'] = null;
                  $out['msg'] = '没有穿入订单编号';
                  $this->ajaxReturn($out);
                }
              if ($type == 1) {
                $data['statue'] = 1; 
                $w= array('number'=>I('request.number'));   
                // dump($w);
                // dump($data);  
                //开启事务
                M()->startTrans();
                $bool = M('recharge')->where($w)->save($data);
                $data = M('recharge')->field('total,uid')->where($w)->find();
                $w = array('user_id'=>$data[uid]);
                // dump($data[total]);die();
                $bool1 = M('user')->where($w)->setInc('user_money',$data['total']);
                $sorce = M('goods_integral')->field('name')->where(array('id'=>1))->find();
                if($sorce){
                  $str = current($sorce);
                  $str = explode('/', $str);  
                  $up = (int)$data['totle']*$str[1]/$str[0]; 
                  $bool0 = M('user')->where(array('user_id'=>$uid))->setInc('source',$up);    
                }
                // dump($bool);
                // dump($bool1);
                if ($bool && $bool1) {
                  M()->commit();
                  $bool = true;
                }else{
                  $bool = false;
                  M()->rollback();
                }                          
              }
              if ($type == 2) {
                $data['statue'] = 1; 
                $w= array('number'=>I('request.number'));     
                $bool = M('order')->where($w)->save($data);

                $content = "您购买的$mobile[price]元【商品名】消费券为：$mobile[check_number],一经验证不能代表消费，不能退款，请你安排好你的验证时间，商家电话：$b_mobile[mobile_phone].客服电话： 400-700-8828<br/>【慧享园】";
                // dump($content);die();
                sendMsg($data[phone],$content);   //给客户发送提示编码                                          
              }
              if($bool){
                $out['success'] = 1;
                $out['data'] = $bool;
                $out['msg'] = '成功';
              }else{
                $out['success'] = 0;
                $out['data'] = null;
                $out['msg'] = '失败';
              }   
              $this->ajaxReturn($out);
          }       
    }
    /**
     * 修改用充值记录
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-09T11:12:38+0800
     * @return [type]                   [description]
     */
    public function notes()
    {
          $id = I('request.version',1);
          if ($id == 1) {
              $uid=I('request.userId',0,'intval');
               
              if (!$uid) {
                    $out['success'] = 0;
                    $out['data'] = null;
                    $out['msg'] = C('no_id');
                    $this->ajaxReturn($out);
                  }  
              $w = array('uid'=>$uid,'statue'=>1);
              $bool = M('recharge')->where($w)->select();
              // dump(M('recharge')->getlastSql());
              // dump($bool);
              // dump(M('recharge')->getlastSql());
              if($bool){
                foreach ($bool as $k => $v) {
                  $v[time] = date('Y-m-d H:i:s',$v[time]);
                  $bool[$k] =$v;
                }
                $out['success'] = 1;
                $out['data'] = $bool;
                $out['msg'] = '成功';
              }else{
                $out['success'] = 0;
                $out['data'] = array();
                $out['msg'] = '该用户暂无充值记录';
              }              
              $this->ajaxReturn($out);
          }       
    }
    
    public function payfor(){
      // dump(I('get.num'));
      $num = I('get.num');
      $where = array('number'=>$num);
      // 查找用户订单信息
      $data = M('order')->field('statue,cate,totle,phone,number,check_number,user_id')->where($where)->find();
      // if($data){
      //     $bool = M('user')->where(array('user_id'=>$data['user_id']))->setDec('user_money',$data['totle']);
      //     $sorce = M('goods_integral')->field('name')->where(array('id'=>1))->find();
      //     if($sorce){
      //       $str = current($sorce);
      //       $str = explode('/', $str);  
      //       $up = (int)$data['totle']*$str[1]/$str[0]; 
      //       $bool0 = M('user')->where(array('user_id'=>$uid))->setInc('source',$up);    
      //     }
      //   }
      // dump($data);
        if ($data['cate'] == 0) {//生活导航订单
            //$data = M('order')->field('statue,cate,totle,phone,number,check_number,user_id,goodid')->where($where)->find();
            $content = "尊敬的客户：你好！感谢你选择慧享园购物，您的".$data['number'].'号订单已经成功付款,你的消费验证码为:'.$data['check_number'].',请妥善保管,一经验证等同消费,请安排好验证时间！       【慧享园】';
            $phone = $data['phone'];
            $bool =sendMsg($phone,$content);
        }
        if ($data['cate'] == 1) {//VIP订单
            $mail = current(M('user')->field('email')->where(array('user_id'=>$data['user_id']))->find());
            // dump($mail);
            $title = '慧享园付款通知';
            $author = '【慧享园】';
            $time = date('Y年m月d日 H时i分',time());
            $content=<<<str
<html>
<head>
  <title>慧享园付款通知</title>
</head>
<body>
<div style="">
  <p>尊敬的顾客你好</p>
  <div style="text-indent: 2em;">你的{$data[number]}号账单已经成功付款，感谢你对慧享园的支持，请静待卖家发货，祝你购物愉快！</div>
  <div style="text-align: right;">{$time}</div>
  <div style="text-align: right;">【慧享园】</div>
</div>

</body>
</html>
str;
            $bool = sendEmail($mail,$title,$content,$author);
            // dump($bool);
        }
        return $bool;

    }
    

  
}
