<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class IndexController extends IsloginController {
	public function index() {
		// 验证用户的登录权限
		// $this->checkself();
		// dump(session());
			
		//Think\Build::buildController('app/Home','ClassSchedule');
		$this->display ();
		
		// 查询用户所有的权限
	}
	// 首页开始页面
	public function start() {
		
		$this->display ();
	}
	// 首页顶部
	public function top() {
		$this->display ();
	}
	// 首页左边
	public function left() {
		$data = $this->getleft ();
// 		dump($data);
		$this->assign ( 'menu', $data );
		$this->display ();
	}
	// 首页下面中间分割框
	public function drag() {
		$this->display ();
	}
	// 用户退出方法
	public function loginout() {
		session ( 'admin', null );
		session ( 'user_auth', null );
		$this->success ( '成功退出登录！', U ( 'Login/index' ) );
	}
}