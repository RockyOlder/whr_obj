<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class IndexController extends IsloginController {
	public function index() {
		//dump(session());

		// $data = sendMsg('18691988421','come on baby!');//调用发送短信方法
		// dump($data);
		// 验证用户的登录权限
		// $this->checkself();
		// dump(session());
			
		
		$this->display ();
		
		// 查询用户所有的权限
	}
	// 首页开始页面
	public function start() {
		
		$this->display ();
	}
	// 首页顶部
	public function top() {
		$this->assign('time',time());
		$this->display ();
	}
	// 首页左边
	public function left() {
		$data = $this->getleft ();
		// dump($data);
		$this->assign ( 'menu', $data );
		$this->display ();
	}
	// 首页下面中间分割框
	public function drag() {
		$this->display ();
	}
	// 用户退出方法
	public function loginout() {		
		admin_log('退出登录');
		session ( 'admin', null );
		session ( 'user_auth', null );
		$this->success ( '成功退出登录！', U ( 'Login/index' ) );
	}
}