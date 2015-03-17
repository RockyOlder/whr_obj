<?php
namespace Mobile\Controller;
use Think\Controller;
class LifeController extends Controller {
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
			$data[mobile] = I('post.mobile');
			$data[email] = I('post.email');
			$data[add_time] = time();
            $data[type] = 0;
            $data[role_id] = 5;
            $data[top_logo] = 'http://120.24.214.88/Uploads/cate/life.png';
            $data[top_name] = '慧享园-生活导航商家';
            $data[statue] = 3;
			$bool = M('admin')->add($data);
            if ($bool) {
                $data = array('uid'=>$bool,'group_id'=>5);
                M('auth_group_access')->add($data);
                session('admin_aid',$bool);
                $this->redirect('life/info','用户注册成功，请填写你的店铺详细信息！');
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
    // dump(session());     
        if (IS_POST) {
            // $data = $_POST;
            $shop = M('business_shop')->create();
            $business = M('business')->create();
            $path = I('post.path');
            $mid = I('post.mid');
            $name = I('post.pic_name');
            foreach ($path as $k => $v) {
                $tem = "";
                $tem['pic'] = $v;
                $tem['mid'] = $mid[$k];
                $tem['name'] = $name[$k];
                $path[$k] = $tem;
            }
            //   exit;
            $more_pic = json_encode($path);
            $business[more_pic] = $more_pic;
            // $data[more_pic] = $more_pic;
            // dump($shop);
            // dump($business);
            $bool=M('business')->data($business)->add();
            if ($bool) {
                $shop[shop_id] = $bool;
                M('business_shop')->data($shop)->add();
                $data = array('id'=>session('admin_aid'),'shop_id'=>$bool);
                M('admin')->save($data);
                $id = session('admin_aid');
                $this->redirect('life/success','店铺详细信息，成功输入');
            }else{
                $this->error('信息提交失败！');
            }
            
        }
        //查询出顶部分类
        $cate = $this->topCate();
        $this->assign('cate',$cate);
        //获取省份
        $pro = $this->getprovence();
        // dump($pro);
        $this->assign('pro',$pro);
        $this->display();
    }
    public function soncate(){
        $id = I('post.id');
        if (!$id) {
            $this->error('你无权访问该页面');
        }
        $w = array('parent_id'=>$id);
        $data = M('type')->field('type_id,type_name')->where($w)->select();
        $this->ajaxReturn($data);
    }
    public function success(){
        $this->success(U('info','hao '));
        // dump(session());die();
        $id = session('admin_aid');
        if (!$id) {
            $this->error('你无权访问该页面');
        }
        $w = array('id'=>$id);
        $data = M('admin')->field('name,mobile,email')->where($w)->find();
        $this->assign('info',$data);
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
    	$code = cookie('mobile.time')+60000;
    	if($code > time())$this->ajaxReturn('验证码已经发送，如果没有收到请检查你的手机号码刷新页面重新获取');
    	$mobile = I('request.mobile');
        //给客户手机发送验证码
        $code = mt_rand(99999,999999);
		cookie('mobile_code',$code,360);
		cookie('mobile.time',$code,3600);
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
        	$verify = I('request.mobile_code');//获取传递过来的验证码
        	$old = cookie('mobile_code');
        }else{
        	$verify = I('request.email_code');//获取传递过来的验证码
        	$old = cookie('email.code');
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
		cookie('email_code',$code,7200);
		cookie('email_time',$code,3600);
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
     * 验证码的显示框
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-01-22T09:44:01+0800
     * @return [type]                   [description]
     */
    public function server(){
       $this->display();
    }
    /**
     * 验证码的显示框
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-01-22T09:44:01+0800
     * @return [type]                   [description]
     */
    public function check($code){
        $verify = new \Think\Verify();
        
        // $code = strtoupper($code);
        // dump($_POST['verify']);die();
        $bool =$verify->check($code);
        if ($bool) {            
            return true;
        }else{
            return false;
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
    	$name = I('request.name');
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
        $bool = M('business')->where(array('name'=>$name))->find();        
        if(is_null($bool)){
            echo "success";
        }else{
            echo '该店铺名称已经存在，请起一个特别的名字';
        }
        
    }
     //获取城市省份列表
    function getprovence() {
        //查询出所有的省份
        $sql = "SELECT REGION_ID,REGION_NAME FROM " . C('DB_PREFIX') . "region where parent_id = 1";
        // dump($sql);
        return M()->query($sql);
    }
    //查询出顶部分类
    function topCate() {
        $sql = "select type_id,type_name from " . C('DB_PREFIX') . "type where parent_id = 0";
        // dump($sql);
        $data = M()->query($sql);
        // dump($data);
        return $data;
    }
}