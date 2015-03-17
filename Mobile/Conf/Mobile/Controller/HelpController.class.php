<?php
namespace Mobile\Controller;
use Think\Controller;
class HelpController extends Controller {
	/**
	 * 获取帮助页面
	 * @author xujun
	 * @email  [jun0421@163.com]
	 * @date   2015-01-06T17:33:03+0800
	 * @return [type]                   [description]
	 */
    public function index(){

        $this->display();
    }
    /**
     * 修改信息页面
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-06T18:39:26+0800
     * @return [type]                   [description]
     */
    public function change(){

    	$this->display();
    }
    /**
     * 帮助中的注册和登录
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-06T18:41:23+0800
     * @return [type]                   [description]
     */
    public function login(){
    	$this->display();
    }
    /**
     * 帮助中的如何成为vip
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-06T18:41:46+0800
     * @return [type]                   [description]
     */
    public function vip(){
    	$this->display();
    }
    /**
     * 帮助中的如何购买
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-06T18:42:19+0800
     * @return [type]                   [description]
     */
    public function buy(){
    	$this->display();
    }
    /**
     * 关于我们
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-06T19:50:36+0800
     * @return [type]                   [description]
     */
    public function about(){
        $this->display();
    }
    
}