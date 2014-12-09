<?php
namespace Api\Controller;
use Think\Controller;
class UserController extends Controller {
		function __construct()
	{

		 if (!IS_API) {
	        	die("你无权访问该页面！");
	        }
	}
    public function register(){
    		$id = I('post.version',1);
    		$username=I('post.phone',1);
    		$password = md5(I('post.password',1));
    		$salt = round(999,9999);
    		$password = change($password,$salt); 
    		$out['success'] = 0;

    		if ($id == 1) {
    			$sql = "insert into ".C('DB_PREFIX')."user set user_name = '$username',password = '$password',salt = $salt";
    			$bool = M()->query($sql);
    			if ($bool != '') {
    				$out['success']  = 1;
    				$out['msg']="注册成功";
                    $time=time();
                    $sql ="update ".C('DB_PREFIX')."user set reg_time=$time where user_name= '$username'";
                        // var_dump($sql);
                    M()->query($sql);
    			}else{
    				$out['msg']="注册失败";
    			}
    			$this->ajaxReturn($out);
    		}
	       
        }
    public function verify(){
    	$phone = I('post.phone',1);
    	// 获取版本号码
    	$id = I('post.version',1);
    	// dump($id);
    	//获取用户获取验证码的用途1 注册，2找回密码，3修改手机号码
    	$type =$data['type'];
    	if ($id==1) {
    		$num = round(99999,999999);
    		$num = 111111;
    		switch ($type) {
    			case '1':
    				$msg['content'] = "你正在注册慧锐通手机智能终端用户，你的验证码为$num,请千万不要泄露给别人，不过不是你本人操作，你可以不用理会！";
    				break;
    			case '2':
    				$msg['content'] = "你正在找回密码，你的验证码为$num,请千万不要泄露给别人";
    				break;
    			case '3':
    				$msg['content'] = "你正在修改手机号码，你的验证码为$num,请千万不要泄露给别人";
    				break;
    			default:
    				$msg['content'] = "测试阶段，验证码均为$num";
    				break;
    		}
    		$out['num']=$num;
    		$out['success'] = 1;
    		// dump($out);die();
    		$this->ajaxReturn($out);
    	}

    }
    public function checkname(){
    		$id = I('post.version',1);
    		$phone = I('post.phone',1);
	       $out['success'] = 0;
    		if ($id == 1) {
    			$sql = "select user_id from ".C('DB_PREFIX')."user where user_name = '$phone'";
    			$bool = M()->query($sql);
    			// var_dump($bool);die();
    			if (!empty($bool)) {    				
    				$out['msg']="用户名已经存在";
    			}else{
    				$out['msg']="用户名可以使用";
    				$out['success']  = 1;
    			}
    			$this->ajaxReturn($out);
    		}
        }
    public function login(){
    		$id = I('post.version',1);
    		$username = I('post.phone',1);
    		$password = md5(I('post.password',1));                        
            $plant = I('post.type',1);	
    		$out['success'] = 0;

    		if ($id == 1) {
    			$sql = "select user_id,salt,user_rank,password,user_rank,province,city,area,village,face,is_lock,face from ".C('DB_PREFIX')."user where user_name = '$username'";
    			// var_dump($sql);die();
    			$data = M()->query($sql);
    			// var_dump($data);
    			if (is_array($data)) {
    				$data = current($data);
                    // 判断用户是否被锁定
                    if($data['is_lock'] == 1){
                        $out['msg']="用户已经被锁定，请联系管理员";
                        $this->ajaxReturn($out);
                    }
    				$salt = $data['salt'];
    				$password = change($password,$salt); 
    				// dump($password);
                    // dump($data);
    				if ($password == $data['password']) {
                        unset($data['password']);//删除密码
    					$out['msg'] = "登录成功";
    					$out['success'] = 1;
    					$out['data'] = $data;
                        // 更新用户登陆了信息
                        $ip = $_SERVER["REMOTE_ADDR"];
                        // dump($ip);
                        // $ip = "183.15.5.189";
                        $city = $this->get_address_from_ip($ip);
                        // var_dump($city['content']['address_detail']['city']);die();
                        // 测试期间地区默认为深圳
                        if (isset($city['content']['address_detail']['city'])) {
                            $c=substr($city['content']['address_detail']['city'], 0,-3);
                            // dump($c);
                            $sql ="select region_id from ".C('DB_PREFIX')."region where region_level = 2 and region_name like '$c%'";
                            $data = M()->query($sql);
                            // dump($data);die();
                           if (is_array($data)) {
                                $city['content']['address_detail']['city_code'] = $data[0]['region_id'];
                           }
                        }
                        // dump($city);die();
                        $out['city']= $city;
                        // $time = time();
                        $sql ="update ".C('DB_PREFIX')."user set login_time=$time,login_ip = '$ip',plant=$plant where user_id = $data[user_id]";
                        // var_dump($sql);
                        M()->query($sql);
                        // var_dump($ip);die();
    				}else{
    					$out['msg'] = "密码输入不正确！";
    				}
    			}else{
    				$out['msg'] = "你的用户名不存在";
    			}   			
    			$this->ajaxReturn($out);
    		}
        }
        // 通过ip获取用户的地址
    function get_address_from_ip($ip)
  
     {
      if ($ip == "127.0.0.1") {
          $ip = "183.15.5.189";
      }
      // http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=218.192.3.42
     $url='http://api.map.baidu.com/location/ip?ak=ngscGvCT0ey3r6kCiWWxyvds&coor=bd09ll&ip='.$ip;
      // dump($url);
     $xml=file_get_contents($url);
     // // dump($xml);
     // $xml = substr($xml, 21,-1);
      // var_dump($xml);
     $data = json_decode($xml,true);
     // $data=simplexml_load_string($xml);
      // dump($data);
     return $data;
      
     }

   
  
}
