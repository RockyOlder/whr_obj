<?php
namespace Api\Controller;
use Api\Controller\CommonController;
class BalanceController extends CommonController {
  /**
   * 设置用户付款密码
   * @author xujun
   * @email  [jun0421@163.com]
   * @time   2015-03-02T15:44:31+0800
   * @return [type]                   [description]
   */
  public function setting(){
    // dump($_POST);die();
      $id = I('request.version',1);
      $uid = I('request.userId',0,'intval');
      $password = md5(I('request.password'));

      $newPwd = I('request.newPwd','');
      if ($id ==1) {
        if (!$uid) {
          $out['msg'] = C('no_id');
          $out['data'] = null;
          $out['success'] = 0;
          $this->ajaxReturn($out);
        }
         // dump($newPwd);
         // dump($newPwd == '');die();
        if ($newPwd == '') { //设置用户密码
          $data = array('pay_password'=>$password,'user_id'=>$uid);
          // dump($data);
           $bool = M('user')->field('user_id')->where($data)->find();
           // dump($bool);die();
           if ($bool) {
              $out['msg'] = '设置密码重置不能和旧密码相同';
              $out['data'] = null;
              $out['success'] = 0;
              $this->ajaxReturn($out);
           }
           $bool = M('user')->save($data);
           $out['msg'] = '付款密码设置成功！';

        }else{//修改用户密码
          $where = array('pay_password'=>$password,'user_id'=>$uid);
          //查找用户旧密码是否正确
          $bool = M('user')->field('user_id')->where($where)->find();
          // dump($bool);
          if ($bool) {
            $data = array('pay_password'=>md5($newPwd),'user_id'=>$uid);
            $bool = M('user')->save($data);
            $out['msg'] = '支付密码修改成功！';
          }else{
            $out['msg'] = '旧密码输入错误！密码修改失败';
            $out['data'] = null;
            $out['success'] = 0;
            $this->ajaxReturn($out);
          }
          

        }
        if ($bool) {
          $out['data'] = null;
          $out['success'] = 1;
          $this->ajaxReturn($out);
        }
        
      }

  }

/**
 * 付款通知，
 * @author xujun
 * @email  [jun0421@163.com]
 * @time   2015-02-12T10:05:46+0800
 * @return [type]                   [description]
 */
    public function payfor(){
      // dump(I('get.num'));
      $num = I('get.num');
      // 查找用户订单信息
      $data = M('order')->field('statue,cate,totle,phone,number,check_number,user_id')->where($where)->find();
      // dump($data);
        if ($data['cate'] == 0) {//生活导航订单
            //$data = M('order')->field('statue,cate,totle,phone,number,check_number,user_id,goodid')->where($where)->find();
            $content = "尊敬的客户：你好！感谢你选择慧享园购物，您的".$data['number'].'号订单已经成功付款,你的消费验证码为:'.$data['check_number'].',请妥善保管,一经验证等同消费,请安排好验证时间！       【慧享园】';
            $phone = $data['phone'];
            $bool =sendMsg($phone,$content);
        }
        if ($data['cate'] == 1) {//VIP订单
            $mail = current(M('user')->where(array('user_id'=>$data['user_id']))->find());
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
        }

    }
   

    /**
 * 付款通知，
 * @author xujun
 * @email  [jun0421@163.com]
 * @time   2015-02-12T10:05:46+0800
 * @return [type]                   [description]
 */
    public function pay(){
      $id = I('request.version',1);
      $uid = I('request.userId',0,'intval');
      $number = I('request.number');
      $password = md5(I('request.password'));
     if (!$uid) {
        $out['msg'] = C('no_id');
        $out['data'] = null;
        $out['success'] = 0;
        $this->ajaxReturn($out);
      }
      $arr = array('pay_password'=>$password,'user_id'=>$uid);
      $check = M('user')->where($arr)->find();
      // dump($check);
      // dump(!$check);
      if (!$check) {
        $out['msg'] = '付款密码输入错误！';
        $out['data'] = null;
        $out['success'] = 0;
        $this->ajaxReturn($out);
      }
      $where = array('number'=>$number);
      // dump($where);
      // dump(I('get.num'));
      
      // 查找用户订单信息
      $data = M('order')->field('statue,cate,totle,phone,number,check_number,user_id')->where($where)->find();
      // dump(M('order')->getlastSql());
      //查找出用户的余额进行比较
      $usermoney = M('user')->field('user_money')->where(array('user_id'=>$uid))->find();
      $usermoney = current($usermoney);
      // dump($usermoney);
      if ($usermoney < $data['totle']) {
        $out['msg'] = '用户余额不足请先充值再来付款';
        $out['data'] = null;
        $out['success'] = 0;
        $this->ajaxReturn($out);
      }else{
        $update = array('statue'=>1);
        $bool = M('order')->where($where)->save($update);
        // dump($bool);
        if ($bool) {
          $bool = M('user')->where(array('user_id'=>$uid))->setDec('user_money',$data['totle']);
          // dump(M('user')->getlastSql());
          // dump($bool);
          if (!$bool) {
            $update = array('statue'=>0);
            $bool1 = M('order')->where($where)->save($update);
          }
        }else{
          $out['msg'] = '该订单已经付款或者不存在';
          $out['data'] = null;
          $out['success'] = 0;
          $this->ajaxReturn($out);
        }
      }
      if ($bool) {
            if ($data['cate'] == 0) {//生活导航订单
            //$data = M('order')->field('statue,cate,totle,phone,number,check_number,user_id,goodid')->where($where)->find();
            $content = "尊敬的客户：你好！感谢你选择慧享园购物，您的".$data['number'].'号订单已经成功付款,你的消费验证码为:'.$data['check_number'].',请妥善保管,一经验证等同消费,请安排好验证时间！       【慧享园】';
            $phone = $data['phone'];
            $bool =sendMsg($phone,$content);
        }
        if ($data['cate'] == 1) {//VIP订单
            $w = array('user_id'=>$uid);
            // dump($w);
            $mail = current(M('user')->field('email')->where($w)->find());
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
	<div id="big_box" style="width: 40%;margin: 80px auto;">
		<div id="header">
			<img src="http://master.huishare.com/App/Home/View/Public/Images/help/120.png" alt="" /> <span style="font-family: 微软雅黑;font-weight: 700;font-size: 25;">慧享园</span>
		</div>
		<div style="border: #019386 3px solid;padding: 10px;">
			<p>尊敬的顾客你好</p><br/>
		  <div style="text-indent: 2em;">你的{$data[number]}号账单已经成功付款，感谢你对慧享园的支持，请静待卖家发货，祝你购物愉快！</div>
		  <div style="text-align: right;">{$time}</div>
		  <div style="text-align: right;">【慧享园】</div>
		</div>
		  
	</div>
  
</div>

</body>
</html>
str;
            sendEmail($mail,$title,$content,$author);
            $bool = true;
        }
      }
      if ($bool) {
        $out['msg'] = '用户付款成功';
        $out['data'] = null;
        $out['success'] = 1;
        $this->ajaxReturn($out);
      }


    }
  
}
