<?php
namespace Api\Controller;
use Think\Controller;
class MemberController extends Controller {
		function __construct()
	{

		 if (!IS_API) {
	        	die("你无权访问该页面！");
	        }
	}
    // 获取个人中心用户数据
    public function index()
    {

        $id = I('request.version',1);
          // 获取用户id
        $user_id = I('request.userId',0,'intval');
        $out['success']=1;
        if (!$user_id) {
          $out['success'] = 0;
          $out['msg'] = C('no_id');
          $this->ajaxReturn($out);
        }
        
        if ($id == 1)
        {
          //获取用的积分及金额
          $sql  = "select user_id,source,user_money,face,true_name,user_name,user_rank from ".C('DB_PREFIX')."user where user_id = $user_id";
          $data = M()->query($sql);
          if ($data) {
              $data = current($data);
              $out['user'] = $data;
          }else{
            $out['msg'] = "没有你需要的用数据";
            $out['success'] = 0;
            $this->ajaxReturn($out);
          }
          // dump($data);
          $arr=array('no_pay','no_out','no_get','no_comm');
          for ($i=0; $i < 4; $i++) { 
            $sql = "select count(*) as sum from ".C('DB_PREFIX')."order where user_id=$id and statue = $i and is_end = 0";
            // dump($sql);
            $data =M()->query($sql);
            if ($data) {
              $key =$arr[$i];
              $order["$key"] = $data[0]['sum'];
            }
            // dump($data);die();
          }
          $out['order'] = $order;
          // dump($order);
          $this->ajaxReturn($out);
        }

	       
    }

    public function vip()
    {

        $id = I('request.version',1);
       $arr = array(
        'nickname' => I('request.nickName'),
        'email'    => I('request.email'),
        'true_name'     => I('request.name'),
        'city'          =>I('request.city'),
        'area'      =>I('request.area'),
        'village'      =>I('request.village'),
        'address'   =>I('request.address'),
        );
          // 获取用户id
        $user_id = I('request.userId',0,'intval');
        $out['success']=1;
        if (!$user_id) {
          $out['success'] = 0;
          $out['msg'] = C('no_id');
          $this->ajaxReturn($out);
        }
        
        if ($id == 1)
        {
          $d = M('user')->where(array('user_id'=>$user_id,'flag'=>1))->find();
          if (!is_null($d)) {
            $out['msg'] = "你已经申请了vip会员，请耐心等待审核";
            $out['success'] = 0;
            $this->ajaxReturn($out);     
          }
          // 查询用户是否在申请中，防止用户重复申请
         
          $str = formant($arr);
          //获取用的积分及金额
          $sql  = "update ".C('DB_PREFIX')."user set flag = 1,".$str." where user_id = $user_id";
          // dump($sql);
          $bool = M()->execute($sql);
          if ($bool) {
            $out['msg'] = "申请成功";
            $out['success'] = 1;
          }else{
            $out['msg'] = "申请不成功";
            $out['success'] = 0;
            
          }
          $this->ajaxReturn($out);
        }

         
    }
   
}
