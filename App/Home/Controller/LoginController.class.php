<?php

namespace Home\Controller;

use Think\Controller;

class LoginController extends Controller {
	public function index() {
		// dump(session());
		if (IS_POST) {
			// 实例化类
			$model = D ( 'admin' );
			// dump($model->create());开启自动验证
			if (! $model->create ()) {
				show_bug ( $model->getError () );
			}
			$name = I ( 'post.username', '' );
			// $verify = I ( 'post.verify' );//js判断了验证码，后台取消验证码验证
			// dump($verify);
			// dump(md5($verify));
			// dump(session());die();
			// if (! $this->check_verify ( $verify )) {
			// $this->error ( '验证码输入不正确' );
			// }
			// dump($name);
			// 查询出来数据库中的数据
			$data = $model->field ( 'id,name,password,pre,role_id,is_lock,agency_id,last_login,last_ip' )->where ( "name='$name'" )->select ();
			// dump()
			// dump($data);

			if (! empty ( $data ) && is_array ( $data )) {
				$data = current ( $data );
			} else {
				$this->error ( '不存在该管理员！' );
			}
			// 判断用户是否被锁定
			if ($data ['is_lock'] == 1) {
				$this->error ( '用户被管理员锁定，请联系上级主管！' );
			}
			// dump($data);
			// 加密用户密码
			$password = change( $data ['pre']);
			// dump($password);
			// dump($data['password'] == $password);die();
			if ($data ['password'] == $password) {
				$auth = array (
						'uid' => $data ['id'],
						'username' => $data ['name'] 
				);
				$admin = array (
						'id' => $data ['id'],
						'name' => $data ['name'],
						'pre' => $data ['pre'],
						'role_id' => $data ['role_id'] ,
						'login_time'=>$data ['last_login'],
						'login_ip'=>$data ['last_ip'],
						'nickname'=>$data ['nickname']
				);
				// 获取ip
				$ip = $_SERVER['HTTP-HOST'];
				$time = time();
				$sql = 'update '.C('DB_PREFIX').'user set last_ip = "'.$ip.'",last_login ='.$time.' where user_id ='.$data['id'];
				M()->query($sql);
				// 保存用户的session				
				session ( 'admin', $admin );
				session ( 'user_auth', $auth ); // 用来做权限验证
				                                // dump(session());
				
				$this->success ( '登录成功', U ( 'Index/index', '', '' ) );
			} else {
				$this->error ( '用户名或者密码输入错误' );
			}
		}
		$this->display ();
	}
	// 异步验证验证码是否正确
	public function check() {
		if (! IS_AJAX) {
			E ( '页面不存在' );
		}
		$code = I ( 'post.code' );
		// dump($code);
		// dump($this->check_verify ( $code ));
		$this->ajaxReturn ( $this->check_verify ( $code ) );
	}
	// 验证码方法
	public function verify() {
		$Verify = new \Think\Verify ();
		$Verify->fontSize = 30;
		$Verify->length = 4;
		// $Verify->imageH = 22;
		// $Verify->imageW = 110;
		$Verify->useNoise = false;
		$Verify->useImgBg = true;
		$Verify->entry ();
	}
	// 验证验证码是否输入正确
	function check_verify($code, $id = '') {
		$verify = new \Think\Verify ();
		return $verify->check ( $code, $id );
	}
}