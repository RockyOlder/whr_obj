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
              
              if($bool){
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
                $bool1 = M('user')->where($w)->setInc('user_money',$data[total]);
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
              // 更新下活动列表
              $bool = M('recharge')->where($w)->select();

              // dump(M('recharge')->getlastSql());
              // 获取活动的内容
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
    public function pay(){
      $alipay_config['partner']   = '2088411232819690';

        //商户的私钥（后缀是.pen）文件相对路径
        $alipay_config['private_key_path']  = 'key/rsa_private_key.pem';

        //支付宝公钥（后缀是.pen）文件相对路径
        $alipay_config['ali_public_key_path']= 'key/alipay_public_key.pem';

        // $bool = file_exists($alipay_config['ali_public_key_path']);
        //↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
        // dump($bool);

        //签名方式 不需修改
        $alipay_config['sign_type']    = strtoupper('RSA');

        //字符编码格式 目前支持 gbk 或 utf-8
        $alipay_config['input_charset']= strtolower('utf-8');

        //ca证书路径地址，用于curl中ssl校验
        //请保证cacert.pem文件在当前文件夹目录中
        $alipay_config['cacert']    = getcwd().'\\cacert.pem';

        //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
        $alipay_config['transport']    = 'http';
      // require_once("alipay.config.php");
      import("Org.Zhibao.lib.alipay_notify");
      // require_once("lib/alipay_notify.class.php");
      //计算得出通知验证结果
      $alipayNotify = new \AlipayNotify($alipay_config);
      // dump($alipayNotify);die();
      $verify_result = $alipayNotify->verifyNotify();
      // dump($verify_result);die();

      if($verify_result) {//验证成功
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //请在这里加上商户的业务逻辑程序代

        
        //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
        
          //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
        
        //商户订单号

        $out_trade_no = $_POST['out_trade_no'];

        //支付宝交易号

        $trade_no = $_POST['trade_no'];

        //交易状态
        $trade_status = $_POST['trade_status'];
        if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
              // 用订单号作为查询条件
              $w = array('number'=>$out_trade_no);
              $data['statue'] = 1;

              $data = M('order')->where($w)->save($data);
              // dump($data);
          }

        //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
              
        echo "success";   //请不要修改或删除
        
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      }
      else {
          //验证失败
          echo "fail";

          //调试用，写文本函数记录程序运行情况是否正常
          //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
      }
    }
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
    

  
}
