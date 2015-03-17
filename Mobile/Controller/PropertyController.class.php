<?php
namespace Mobile\Controller;
use Think\Controller;
class PropertyController extends Controller {
    /**
     * 输入手机号码
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-01-21T16:35:15+0800
     * @return [type]                   [description]
     */
    public function register(){
        if (IS_POST) {
        	//获取用户输入的密码是否一致！
        	$pass1 = I('post.passWord');
			$pass2 = I('post.passWordDemo');
			if($pass1 != $pass2){
				$this->error('注册失败，你的密码输入不一致！');
			}
        	$data['salt'] = mt_rand(999, 9999);
        	$data['name'] = I('post.userName');
			$data['password'] = change($data['salt'],md5($pass1));
			$data['mobile'] = I('post.mobile');
            $data['true_name'] = I('post.true_name');
			$data['email'] = I('post.email');
			
            // dump($data);die();
            
			cookie('register_admin',$data);
            // dump(cookie('register_admin'));
            // dump(U('info','',''));die();
            // dump(cookie('register_admin') != null);die();
            if (cookie('register_admin') != null) {
                $this->success('用户注册成功',U('Property/info'),1);
            }else{
                $this->error('注册失败！');
            }
                  
        }
        $this->display();
    }	
	/**
     * 输入手机号码
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-01-21T16:35:15+0800
     * @return [type]                   [description]
     */
    public function info(){       
        if (IS_POST) {  
            // dump($_POST);//die;
            // dump(cookie());          
            // 添加到开发商表中
            $developer = M('developer_sum')->create();
            
            // dump($developer);die;
            $developer['addtime'] = time();
            
            M()->startTrans();
            // dump($developer);
            $bool = M('developer_sum')->add($developer);

            // dump($bool);die();
            $data = cookie('register_admin'); 
            // dump($data);die();        
            // dump($data);//die(); 
            $data['add_time'] = time();
            $sql = "insert into `wrt_admin` set `salt`=$data[salt],`name`='$data[name]',
                `password`='$data[password]'
                ,`mobile`='$data[mobile]',`email`='$data[email]',
                `developer`='$bool',`add_time`=$data[add_time],
                `role_id`=2,
                `is_lock`=1,`top_logo`='http://120.24.214.88/Uploads/cate/house.png',
                `top_name`='慧享园-房地产开发商管理系统',`statue`=4,`flag`=1";
            $uid=M()->execute($sql);
            // dump($uid);
            if($uid){
                // $w = array('developer'=>$bool);
                // dump($w);
                // $uid = M('admin')->field('id')->where($w)->find();
                // dump(M('admin')->getlastSql());
                $sql = "SELECT `id` FROM `wrt_admin` WHERE developer = ".$bool." LIMIT 1 ";
                $uid = M()->query($sql);
                // dump($uid);
                $uid = $uid[0]['id'];
            } 
            // dump($uid);
            // dump(M('admin')->getlastSql());

            $data = array('uid'=>$uid,'group_id'=>2);
            // dump($data);
            $bool1 =  M('auth_group_access')->add($data);
            // dump($bool1);
            // dump($bool);
            // dump($uid);die();
              
            if ($bool && $bool1 && $uid) {
                 M()->commit();
                $this->success('用户注册成功，请等待审核',U('end',array('id'=>$uid),''),0);
            }else{
                M('auth_group_access')->where($data)->delete();
                if ($uid != 1) {
                    M('admin')->delete($uid);
                }                
                M('developer_sum')->delete($bool);
                M()->rollback();
                $this->error('用户注册失败');
            }
        }
        $pro = $this->getprovence();
        // dump($pro);
        $this->assign('pro',$pro);
        $this->display();
    }
    public function end(){
        // dump(session());
        $id = I('get.id');
        if (!$id) {
            $this->error('你无权访问该页面');
        }
        $w = array('id'=>$id);
        $data = M('admin')->field('name,mobile,email')->where($w)->find();
        // dump($data);
        $this->assign('info',$data);
        //将数据清除
        $this->display();
    }
    
    /**
     * 发送短信
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-01-22T12:05:23+0800
     * @return [type]                   [description]
     */
    public function sendMsg(){
    	$code = cookie('mobile_time')+60000;
    	if($code > time())$this->ajaxReturn('验证码已经发送，如果没有收到请检查你的手机号码刷新页面重新获取');
    	$mobile = I('request.mobile');
        //给客户手机发送验证码
        $code = mt_rand(99999,999999);
        cookie('mobile',$mobile);
		cookie($mobile,$code,360);
		cookie('mobile_time',$code,3600);
        $msg = C('msg_start').$code.C('msg_end');
        $bool = sendMsg($mobile,$msg);
		if($bool){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(0);
		}
    }
	/**
     * 异步验证用户的短信验证码是否正确
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-01-22T12:05:23+0800
     * @return [type]                   [description]
     */
    public function ajax_check(){
    	//dump(cookie());
    	$type = I('request.type');//获取是判断手机还是邮箱的验证码1手机2邮箱
    	
        if($type == 1){
            $number = cookie('mobile');
        	$verify = I('request.mobile_code');//获取传递过来的验证码
        	$old = cookie($number);
        }else{
            $number = cookie('email');
        	$verify = I('request.email_code');//获取传递过来的验证码
        	$old = cookie($number);
        }
		if($old == $verify){            
			echo "success";
		}else{
			echo '验证码输入不正确';
		}
		
    }
	/**
     * 发送邮件
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-01-22T12:05:23+0800
     * @return [type]                   [description]
     */
    public function sendEmail(){
    	$code = cookie('email_time')+60000;
    	if($code > time())$this->ajaxReturn('验证码已经发送，如果没有收到请检查你的手机号码刷新页面重新获取');
//  	$ip = get_client_ip();
    	$mail = I('request.email');
        //给客户手机发送验证码
        $code = mt_rand(99999,999999);
        cookie('email',$mail,7200);
		cookie($mail,$code,7200);
		cookie('email_time',time(),3600);
        $msg = C('msg_start').$code.C('msg_end');
	 	import('Org.Util.Mail');
        $back = SendMail($mail,'注册验证码',$msg,'慧享园');
		if($back){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(0);
		}
    }
   
	/**
     * 异步验证用户是否存在
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-01-22T12:05:23+0800
     * @return [type]                   [description]
     */
    public function ajax_check_name(){
    	$name = I('request.userName');
    	$bool = M('admin')->where(array('name'=>$name))->find();        
		if(is_null($bool)){
			echo "success";
		}else{
			echo '用户名已经存在';
		}
		
    }
    /**
     * 异步验证邮箱是否存在
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-01-22T12:05:23+0800
     * @return [type]                   [description]
     */
    public function ajax_check_email(){
        $name = I('request.email');
        $bool = M('admin')->where(array('email'=>$name))->find();  
        // dump($name);
        // dump($bool);      
        if(is_null($bool)){
            cookie('email',$mail);
            echo "success";
        }else{
            echo '该邮箱已经注册，不能重复注册';
        }
        
    }
    /**
     * 异步验证用户手机是否存在
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-01-22T12:05:23+0800
     * @return [type]                   [description]
     */
    public function ajax_check_mobile(){
        $name = I('request.mobile');
        $bool = M('admin')->where(array('mobile'=>$name))->find();        
        if(is_null($bool)){
            cookie('mobile',$mobile);
            echo "success";
        }else{
            echo '该手机已经注册，不能重复注册';
        }
        
    }
    /**
     * 异步验证vip店铺名称是否存在
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-01-22T12:05:23+0800
     * @return [type]                   [description]
     */
    public function ajax_check_vip(){
        $name = I('request.name');
        $bool = M('developer_sum')->where(array('name'=>$name))->find();        
        if(is_null($bool)){
            echo "success";
        }else{
            echo '该名称已经存在，请起一个特别的名字';
        }
        
    }
     //获取城市省份列表
    function getprovence() {
        //查询出所有的省份
        $sql = "SELECT REGION_ID,REGION_NAME FROM " . C('DB_PREFIX') . "region where parent_id = 1";
        // dump($sql);
        return M()->query($sql);
    }
}