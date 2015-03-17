<?php
namespace Api\Controller;
use Think\Controller;
use Think\Log;
class CommonController extends Controller {
  public $user;
		function __construct()
	{
    //调用父类的construct方法，免去覆盖父类的方法
    parent::__construct();
		 if (!IS_API) {
	        	die("你无权访问该页面！");
	        }
      $uid = I('request.userId',0,'intval');
      if ($uid) {
        $this->checkUser($uid);
      }
	}
  public function checkUser($uid){
      //查找用户的id和查看用户的状态
      $this->user = M('user')->field('nickname,is_lock')->where(array('user_id'=>$uid))->find();
      //dump($this->user);die();
      if (!is_null($this->user)) {
        if ($this->user['is_lock'] == 0) {
          return ;
        }else{
          $out['success'] = 0;
          $out['msg'] = $uid.'号会员管理员被锁定，请联系管理员！';
          $out['data'] = null;
          \Think\Log::write($out['msg'],'WARN');
          $this->ajaxReturn($out);
          }
      }else{
        $out['success'] = 0;
        $out['msg'] = "用户编号为".$uid."的会员，".'不存在，请注册，或者被管理员删除';
        $out['data'] = null;
        \Think\Log::write($out['msg'],'WARN');
        $this->ajaxReturn($out);
      }

  }
   
}
