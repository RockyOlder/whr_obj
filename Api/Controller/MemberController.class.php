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
        $area =I('request.areaId',0,'intval');
        $arr = array(
          'nickname' => I('request.nickName'),
          'email'    => I('request.email'),
          'true_name'     => I('request.name'),
          'village'      =>I('request.village'),
          'property'   =>I('request.property'),
        );
         // 获取用户id
        $user_id = I('request.userId',0,'intval');
        $out['success']=1;
        if (!$user_id) {
          $out['success'] = 0;
          $out['msg'] = C('no_id');
          $out['data'] = null;
          $this->ajaxReturn($out);
        }
        
        if ($id == 1)
        {
          // 根据用户所给的地区id和物业字段查询物业的id
          $w="area_id = $area and pname like '%".$arr['property']."%'";
          // dump($w);
          $property = M('property')->field('id,pname')->where($w)->find();
          // dump($property);die();
          if (!is_null($property)) {
              $arr['property_id'] = $property['id'];
              $arr['property'] = $property['pname'];            
          }else{
            $out['success'] = 0;
            $out['data'] = null;
            $out['msg'] = "你所在的物业没有与慧锐通合作，请联系物业！";
            $this->ajaxReturn($out);
          }
          // 根据物业查找用户的小区
          $w = "property_id =".$property['id']." and name like '%".$arr['village']."%'";
          // dump($w);
          $village = M('village')->field('id,name')->where($w)->find();
          // dump($village);
          if (!is_null($village)) {
              $arr['village_id'] = $village['id'];
              $arr['village'] = $village['name'];            
          }else{
            $out['success'] = 0;
            $out['data'] = null;
            $out['msg'] = "你所在的物业没有该小区，请联系小区管理员！";
            $this->ajaxReturn($out);
          }
          // dump($arr);
          $arr['user_rank'] = 2;
          $arr['user_id'] = I('request.userId',0,'intval');
          // dump($sql);
          $w= array('user_rank'=>2,'user_id'=>$arr['user_id']);
          $bool = M('user')->where($w)->find();
          if (!is_null($bool)) {
              $out['success'] = 1;
              $out['msg']="你已经是vip会员，不能再申请！";
              $out['data'] = null;
              $this->ajaxReturn($out);
          }
          // dump($arr);die();
          $bool = M('user')->save($arr);
          if ($bool) {
            $out['msg'] = "申请成功";
            $out['data'] = $arr;
            $out['success'] = 1;
          }else{
            $out['msg'] = "申请不成功";
            $out['data'] = null;
            $out['success'] = 1;
            
          }
          $this->ajaxReturn($out);
        }

         
    }
    public function good()
    {

        $id = I('request.version',1);
       $arr = array(
        'nickname' => I('request.nickName'),
        'email'    => I('request.email'),
        'true_name'     => I('request.name'),
        'city_name'          =>I('request.city'),
        'town_name'      =>I('request.village'),
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
          // 查询用户是否在申请中，防止用户重复申请
          $arr['user_id'] = $user_id;
          $arr['user_rank'] = 1;
          $bool = M('user')->save($arr);
          $out['data'] = $bool;
          if ($bool) {
            $out['msg'] = "信息成功保存";      
            $out['success'] = 1;
          }else{
            $out['msg'] = "信息输入失败";
            $out['success'] = 0;
            
          }
          $this->ajaxReturn($out);
        }

         
    }
   
}
