<?php
namespace Api\Controller;

use Api\Controller\CommonController;
class UserController extends CommonController {

    public function register(){
        //dump($this->user);
    		$id = I('request.version',1);
    		$username=I('request.phone',1);
    		$password = md5(I('request.password'));
    		$salt = mt_rand(999,9999);
    		$password = change($salt,$password); 
    		$out['success'] = 0;
            $time=time();

    		if ($id == 1) {
    			//$sql = "insert into ".C('DB_PREFIX')."user set user_name = '$username',password = '$password',reg_time=$time,salt = $salt";
    			$data = array('user_name'=>$username,'password'=>$password);
                $bool = M('user')->add($data);
                // dump($bool);
    			if ($bool != '') {
    				$out['success']  = 1;
                    $out['data']  = $bool;
    				$out['msg']="注册成功";

                    //给用户添加上一个首页爱好
                    $sql ="select user_id from ".C('DB_PREFIX')."user  where user_name= '$username'";
                        // var_dump($sql);
                    $data =M()->query($sql);
                    if ($data) {
                         $id = $data[0]['user_id'];
                          $data = S('home_cate_o');
                        if (!$data) {
                            $sql = 'select `title`,type_id from '.C('DB_PREFIX')."home_cate";
                            $data = M()->query($sql);
                            S('home_cate_o',$data,36000);
                        }                        
                         // dump($data);
                         foreach ($data as $k => $v) {
                             $data = array(
                                'uid'=>$id,
                                'title'=>$v['title'],
                                'type_id'=>$v['type_id']
                                );
                             M('user_hobby')->add($data);
                         }
                    }                   
    			}else{
    				$out['msg']="注册失败";
    			}
    			$this->ajaxReturn($out);
    		}
	       
        }
    public function verify(){
    	$phone = I('request.phone',1);
    	// 获取版本号码
    	$id = I('request.version',1);
    	// dump($id);
    	//获取用户获取验证码的用途1 注册，2找回密码，3修改手机号码
    	$type =$data['type'];
    	if ($id==1) {
    		$num = mt_rand(99999,999999);
    		// $num = 111111;
    		// switch ($type) {
    		// 	case '1':
    		// 		$msg['content'] = "您好！你正在注册慧锐通手机智能终端用户，您的短信校验码是：$num，请尽快按页面提示提交校验码，过期无效。请勿向任何人提供您收到的短信校验码。【慧享园】";
    		// 		break;
    		// 	case '2':
    		// 		$msg['content'] = "您好！你正在找回密码，您的短信校验码是：$num，请尽快按页面提示提交校验码，过期无效。请勿向任何人提供您收到的短信校验码。【慧享园】";
    		// 		break;
    		// 	case '3':
    		// 		$msg['content'] = "您好！你正在修改手机号码，您的短信校验码是：$num，请尽快按页面提示提交校验码，过期无效。请勿向任何人提供您收到的短信校验码。【慧享园】";
    		// 		break;
    		// 	default:
    		// 		$msg['content'] = "您好！您的短信校验码是：$num，请尽快按页面提示提交校验码，过期无效。请勿向任何人提供您收到的短信校验码。【慧享园】";
    		// 		break;
    		// }
            $msg = "您好！您的短信校验码是：".$num."，请尽快按页面提示提交校验码，过期无效。请勿向任何人提供您收到的短信校验码。【慧享园】";
            // dump($msg);
    		$out['num']=$num;
            $out['msg']=$msg;
    		$out['success'] = 1;
      //       dump($out);
    		// dump($msg);die();
           $data = sendMsg($phone,$msg);
           // dump($data);
    		$this->ajaxReturn($out);
    	}

    }
    public function checkname(){
    		$id = I('request.version',1);
    		$phone = I('request.phone',1);
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
        //修改用户手机号码
    public function changePhone(){
        $id = I('request.version',1);
        $userId = I('request.userId',0,"intval");
        $phone = I('request.phone',1);
        if ($userId == 0) {
            $out['success'] = 0;
            $out['msg'] =C('no_id');
            $this->ajaxReturn($out);
        }
       $out['success'] = 0;
        if ($id == 1) {
            $sql = "select user_id from ".C('DB_PREFIX')."user where user_name = '$phone'";
            // dump($sql);
            $bool = M()->query($sql);
            if ($bool) {
                $out['msg'] = '用户手机号码已经存在！';
                $out['success'] = 0;
                $this->ajaxReturn($out);
            }

            $sql = "update ".C('DB_PREFIX')."user set user_name = '$phone' where user_id = '$userId'";
            // dump($sql);
            $bool = M()->execute($sql);

            // var_dump($bool);die();
            if (!$bool) {                    
                $out['msg']="修改不成功";

            }else{
                $out['msg']="成功修改用户手机号码";
                $out['success']  = 1;
            }
            $this->ajaxReturn($out);
        }
    }
        //获取用户 昵称
    public function getNick(){
        $id = I('request.version',1);
        $userId = I('request.userId',0,"intval");
        if ($userId == 0) {
            $out['success'] = 0;
            $out['msg'] =C('no_id');
            $this->ajaxReturn($out);
        }
       $out['success'] = 0;
        if ($id == 1) {
            $sql = "select nickname from ".C('DB_PREFIX')."user where user_id = '$userId'";
            // dump($sql);
            $data = M()->query($sql);
            if (!$data) {
                $out['msg'] = '不存在该用户';
                $out['success'] = 0;
                $this->ajaxReturn($out);
            }else{
                $out['data']=current($data);
                $out['success']  = 1;
            }
            $this->ajaxReturn($out);
        }
    }
        //修改用户昵称
    public function changeNick(){
        //dump($this->user);
        $id = I('request.version',1);
        $userId = I('request.userId',0,"intval");
        $nickName = I('request.nickName','');
         $out['success'] = 0;
         $out['data'] = array();
        if ($userId == 0) {           
            $out['msg'] =C('no_id');
            $this->ajaxReturn($out);
        }elseif($nickName == ''){
            $out['msg'] ='用户名不能为空';
            $this->ajaxReturn($out);
        }
        if ($id == 1) {
            $sql = "select user_id from ".C('DB_PREFIX')."user where nickname = '$nickName'";
            // dump($sql);
            $bool = M()->query($sql);
            if ($bool) {
                $out['msg'] = '昵称不能和原来的一样';
                $out['success'] = 0;
                $this->ajaxReturn($out);
            }

            $sql = "update ".C('DB_PREFIX')."user set nickname = '$nickName' where user_id = '$userId'";
            // dump($sql);
            $bool = M()->execute($sql);

            // var_dump($bool);die();
            if (!$bool) {                    
                $out['msg']="修改不成功";

            }else{
                $out['msg']="成功修改用户昵称";
                $out['success']  = 1;
            }
            $this->ajaxReturn($out);
        }
    }
     public function changeEmail(){
        //dump($this->user);die();
        $id = I('request.version',1);
        $userId = I('request.userId',0,"intval");
        $email = I('request.email','');
         $out['success'] = 0;
        if ($userId == 0) {           
            $out['msg'] =C('no_id');
            $this->ajaxReturn($out);
        }
        if ($id == 1) {
            $sql = "select user_id from ".C('DB_PREFIX')."user where email = '$email'";
            // dump($sql);
            $bool = M()->query($sql);
            if ($bool) {
                $out['msg'] = '邮箱不能和原来的一样';
                $out['success'] = 0;
                $this->ajaxReturn($out);
            }

            $sql = "update ".C('DB_PREFIX')."user set email = '$email' where user_id = '$userId'";
            // dump($sql);
            $bool = M()->execute($sql);

            // var_dump($bool);die();
            if (!$bool) {                    
                $out['msg']="修改不成功";

            }else{
                $out['msg']="成功修改用户邮箱";
                $out['success']  = 1;
            }
            $this->ajaxReturn($out);
        }
    }
    public function login(){
    		$id = I('request.version',1);
    		$username = I('request.phone',1);
    		$password = md5(I('request.password'));                        
            $plant = I('request.type',1);	
    		$out['success'] = 0;

    		if ($id == 1) {
                //$field='user_id,user_name,email,salt,user_rank,password,user_rank,province,city,area,village,face,is_lock,face,nickname,true_name,reg_time,is_forgot';
    			$sql = "select * from ".C('DB_PREFIX')."user where user_name = '$username'";
    			// var_dump($sql);die();
    			$data = M()->query($sql);
    			// var_dump($data);
    			if (is_array($data)) {
    				$data = current($data);
                    $data['reg_time'] = date('Y-m-d',$data['reg_time']);
                    // 判断用户是否被锁定
                    if($data['is_lock'] == 1){
                        $out['msg']="用户已经被锁定，请联系管理员";
                        $this->ajaxReturn($out);
                    }
    				$salt = $data['salt'];
    				$password = change($salt,$password); 
    				// dump($password);
        //             dump($data);
    				if ($password == $data['password']) {
                        unset($data['password']);//删除密码
    					$out['msg'] = "登录成功";
    					$out['success'] = 1;
                        
                        $version = M('region_sys')->field('address_version')->where('id=1')->find();

                        $out['address_version'] = $version['address_version'];

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
                            $region = M()->query($sql);
                            // dump($data);die();
                           if (is_array($region)) {
                                $city['content']['address_detail']['city_code'] = $region[0]['region_id'];
                           }
                        }
                        // dump($city);die();
                        $out['city']= $city;
                        $time = time();
                        // dump($data);
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
        // 判断用户修改密码的时候是否输入正确
    public function checkPwd(){
        // phpinfo();
        $id = I('request.version',1);
        $userId = I('request.userId',0,"intval");
        $password = I('request.password');
        // dump($password);
        // dump(md5($password));
        // dump(md5(4073 . md5('')));
        if ($userId == 0) {
            $out['success'] = 0;
            $out['msg'] =C('no_id');
            $this->ajaxReturn($out);
        }
        if ($id == 1) {
            // 查询出用户的前缀
            $sql ="select salt,password from ".C('DB_PREFIX')."user where user_id =$userId";
            // dump($sql);
            $data =M()->query($sql);
            if ($data) {
                $data = current($data);
               $salt =$data['salt'];
               $pass = $data['password'];
            }
            // dump($data);
            // dump($password);
            $password = change($salt,$password);
            // dump($password);
            if ($password != $pass) {
                $out['success'] = 1;
                $out['msg'] ='密码正确！';

            }else{
                 $out['success'] = 0;
                $out['msg'] ='密码错误！';

            }
            $this->ajaxReturn($out);
        }
    }
          //修改用户 密码
    public function changePwd(){
        $id = I('request.version',1);
        $userId = I('request.userId',0,"intval");
        $password = md5(I('request.password'));
        $newpwd = md5(I('request.newPwd',''));
         $out['success'] = 0;
        if ($userId == 0) {           
            $out['msg'] =C('no_id');
            $this->ajaxReturn($out);
        }elseif($password == '' || $newpwd == ''){
            $out['msg'] ='密码不能为空';
            $this->ajaxReturn($out);
        }
        if ($id == 1) {
           // 查询出用户的前缀
                $sql ="select salt,password from ".C('DB_PREFIX')."user where user_id =$userId";
                // dump($sql);
                $data =M()->query($sql);
                if ($data) {
                    $data = current($data);
                   $salt =$data['salt'];
                   $pass = $data['password'];
                }
                //dump($salt);
                //dump($password);
                //dump($data);
                $password = change($salt);
                //dump($pass);
                //dump($password);die();
                if ($password != $pass) {
                    $out['success'] = 0;
                    $out['msg'] ='原密码输入不正确！';
                    $this->ajaxReturn($out);
                }else{
                    $password = change($salt,$newpwd);
                    $sql = "update ".C('DB_PREFIX')."user set password ='$password' where user_id=$userId";
                    // dump($sql);
                    $bool = M()->execute($sql);
                    // dump($bool);
                    if ($bool) {
                        $out['success'] = 1;
                        $out['msg'] ="你的密码已经成功修改！";
                    }else{
                        $out['success'] = 0;
                        $out['msg'] = '密码修改失败！';
                    }
                }
            $this->ajaxReturn($out);
        }
    }
              //修改用户 密码
    public function restPwd(){
        $id = I('request.version',1);
        $userName = I('request.userName');
        $password = md5(I('request.password'));
         $out['success'] = 0;
        if ($userName == '') {           
            $out['msg'] ="用户名不能为空";
            $out['success'] = 0;
            $out['data'] = null;
            $this->ajaxReturn($out);
        }elseif($password == ''){
            $out['msg'] ='密码不能为空';
            $out['success'] = 0;
            $out['data'] = null;
            $this->ajaxReturn($out);
        }
        if ($id == 1) {
           // 查询出用户的前缀
                $sql ="select salt from ".C('DB_PREFIX')."user where user_name ='$userName'";
                //dump($sql);
                $data =M()->query($sql);
                if ($data) {
                    $data = current($data);
                   $salt =$data['salt'];
                }
                //dump($salt);
                $password = change($salt,$password);        
                $sql = "update ".C('DB_PREFIX')."user set password ='$password' where user_name='$userName'";
                // dump($sql);
                $bool = M()->execute($sql);
                // dump($bool);
                if ($bool) {
                    $out['success'] = 1;
                    $out['msg'] ="成功重置密码！";
                }else{
                    $out['success'] = 0;
                    $out['msg'] = '重置密码失败！';
                }
                
            $this->ajaxReturn($out);
        }
    }
    //检查是否有新版本
    public function checkVersion(){
        $version_id = I('request.version',1,"intval");
        $data = array();
            $sql = "SELECT version,des,url FROM " . C('DB_PREFIX') ."version WHERE is_ok = 1";
            // var_dump($sql);
            $version_info = M()->query($sql);
            // var_dump($version_info);die;
            if (is_array($version_info)) {
                $data = current($version_info);
            }
            // var_dump(empty($data))
        if (empty($data)) {
            $out['success'] = 0;
            $out['msg']="没有新版本";
            $this->ajaxReturn($out);
        } else {
            $out['success'] = 1;
            $out['data']=$data;
            $this->ajaxReturn($out);
        }
    }
    /**
     * 根据地区id获取物业的列表
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-01-19T09:24:14+0800
     * @return [type]                   [description]
     */
    public function getProList(){
        $id = I('request.version',0,'intval');
        if ($id == 1) {
            $areaId = I('request.areaId',0,'intval');
            if (!$areaId) {
                $out['data'] = null;
                $out['success'] = 0;
                $out['msg'] ='失败';
                $this->ajaxReturn($out);
            }
            $w = array('area'=>$areaId);
            $data = M('property')->field('id,pname as name')->where($w)->select();
            if ($data) {
                $out['data'] = $data;
            }else{
                $out['data'] = array();
            }
            $out['success'] = 1;
            $out['msg'] = '成功';
            $this->ajaxReturn($out);
        }
    }
    /**
     * 根据物业id获取小区的列表
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-01-19T09:24:14+0800
     * @return [type]                   [description]
     */
    public function getVilList(){
        $id = I('request.version',0,'intval');
        if ($id == 1) {
            $propertyId = I('request.propertyId',0,'intval');
            if (!$propertyId) {
                $out['data'] = null;
                $out['success'] = 0;
                $out['msg'] =C('no_id');
                $this->ajaxReturn($out);
            }
            $w = array('property_id'=>$propertyId);
            $data = M('village')->field('id,name')->where($w)->select();
            if ($data) {
                $out['data'] = $data;
            }else{
                $out['data'] = array();
            }
            $out['success'] = 1;
            $out['msg'] = '成功';
            $this->ajaxReturn($out);
        }
    }
    /**
     * 用户绑定第二个小区
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-01-19T09:24:14+0800
     * @return [type]                   [description]
     */
    public function bandTwo(){
        $id = I('request.version',0,'intval');
        if ($id == 1) {
            $propertyId = I('request.propertyId',0,'intval');
            $userId = I('request.userId',0,'intval');
            $villageId = I('request.villageId',0,'intval');
            $name = I('request.name');
            $mobile = I('request.mobile');
            if (!$propertyId || $userId || $villageId) {
                $out['data'] = null;
                $out['success'] = 0;
                $out['msg'] =C('no_id');
                $this->ajaxReturn($out);
            }
            //查找用户要绑定的小区是否有用户提供的电话和姓名如果没有就不能添加
            $w = array('name'=>$name,'mobile'=>$mobile,'property_id'=>$villageId);

            $data = M('pro_owner')->where($w)->find();

            if ($data) {
                $up = array('id'=>$data['id'],'uid'=>$userId);

                $out['data'] = M('pro_owner')->save($up);                
                $out['msg'] = '添加成功';
            }else{
                $out['msg'] = '你要添加的小区没有你的信息，请核对信息后重试';
                $out['data'] = array();
            }
            $out['success'] = 1;
            $this->ajaxReturn($out);
        }
    }
     /**
     * 获取用户的所有小区
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-01-19T09:24:14+0800
     * @return [type]                   [description]
     */
    public function getUserVil(){
        $id = I('request.version',0,'intval');
        if ($id == 1) {
            $userId = I('request.userId',0,'intval');
            if (!$userId) {
                $out['data'] = null;
                $out['success'] = 0;
                $out['msg'] =C('no_id');
                $this->ajaxReturn($out);
            }
            $w = array('uid'=>$userId);
            //查找用户的小区id
            $data = M('pro_owner')->field('property_id')->where($w)->select();
            foreach ($data as $k => $v) {
                $tem[] = $v['property_id'];
            }
            $w = 'id in ('.implode(',', $tem).')';
            $data = M('village')->field('id,name')->where($w)->select();
            if ($data) {
                $out['data'] = $data;               
            }else{
               $out['data'] = array();
            }
            $out['msg'] = '成功';
            $out['success'] = 1;
            $this->ajaxReturn($out);
        }
    }
        /**

        *
        *下面是函数，上面是方法
        */
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
