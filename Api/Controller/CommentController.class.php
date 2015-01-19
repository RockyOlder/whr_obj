<?php
namespace Api\Controller;
use Think\Controller;
class CommentController extends Controller {
		function __construct()
	{

		 if (!IS_API) {
	        	die("你无权访问该页面！");
	        }
	}
    // 添加评论
    public function add()
    {
        $id = I('request.version',1,'intval');
        $goodid = I('request.goodid',0,'intval');
        $userid = I('request.userid',0,'intval');
        $shopid = I('request.shopid',0,'intval');
        $content = I('request.content',1,'intval');
        $star = I('request.star',1,'intval');
        $pic = I('request.pic');
        $time = time();
        if ($id == 1) {
          if (!$goodid || !$userid ) {
            $out['success'] = 0;
            $out['msg']=C('no_id');
            $this->ajaxReturn($out);
          }
          $sql = "insert into ".C('DB_PREFIX')."comment set time=$time,shopid=$shopid,gid = $goodid,user_id=$userid,content ='$content',star =$star,pic='$pic'";
         // dump($sql);
          $bool = M()->execute($sql);
          if ($bool) {
             $out['success'] = 1;
            $out['msg']="评论成功";
          }else{
             $out['success'] = 0;
            $out['msg']="评论插入失败";
          }
        }
        $this->ajaxReturn($out);
	       
    }
     //商品的评论
     public function good()
    {
        $id = I('request.version',1,'intval');
        $goodid = I('request.goodid',0,'intval');
        $page = I('request.page',1,'intval');
        $pageSize = I('request.pageSize',20,'intval');
        if ($page == 0) {
          $page = 1;
        }
        if ($pageSize == 0) {
          $pageSize = 20;
        }
        $time = time();
        if ($id == 1) {
          if (!$goodid) {
            $out['success'] = 0;
            $out['msg']=C('no_id');
            $this->ajaxReturn($out);
          }
          $field="id,content,star,user_id,time";
          $w = array('lock' => 0 , 'gid' => $goodid);
          $data = M('comment')->field($field)->where($w)->page($page,$pageSize)->select();
          //  $sql = "select id,content,star,user_id,time from ".C('DB_PREFIX')."comment where `lock` = 0 and gid = $goodid";
          //  // dump($sql);
          // $data = M()->query($sql);
          if (!empty($data)) {
             $out['success'] = 1;
              foreach ($data as $k => $v) {
                 // 查询出来用户的头像
                $sql = "select face,rank_name,user_name from ".C('DB_PREFIX')."user as u join ".C('DB_PREFIX')."user_rank as k on u.user_rank =k.rank_id  where user_id = $v[user_id]";
                $user = M()->query($sql);
                if (!empty($user)) {
                  $user = current($user);
                  $v['face'] =$user['face'];
                  $v['rank_name'] = $user['rank_name'];
                  $v['user_name'] = $user['user_name'];
                }
                $data[$k] =$v;
              }
              $out['data'] = $data;
          }else{
             $out['success'] = 0;
            $out['msg']="该商品没有评论";
          }
        }
        $this->ajaxReturn($out);
         
    }
     // 添加评论
    public function vipAdd()//2014-12-16
    {
        $id = I('request.version',1,'intval');
        $goodid = I('request.goodid',0,'intval');
        $userid = I('request.userid',0,'intval');
        $content = I('request.content');
        $pic = I('request.pic');
        $star = I('request.star');
        $time = time();
        if ($id == 1) {
          if (!$goodid || !$userid ) {
            $out['success'] = 0;
            $out['msg']=C('no_id');
            $this->ajaxReturn($out);
          }
          $sql = "insert into ".C('DB_PREFIX')."vip_comment set time=$time,gid = $goodid,user_id=$userid,content ='$content',star =$star,pic='$pic'";
         // dump($sql);
          $bool = M()->execute($sql);
          if ($bool) {
             $out['success'] = 1;
              $out['msg']="评论成功";
          }else{
             $out['success'] = 0;
            $out['msg']="评论插入失败";
          }
        }
        $out['data'] =null;
        $this->ajaxReturn($out);
         
    } // 获取商品的评论
    public function getVip()//2014-12-16
    {
        $id = I('request.version',1,'intval');
        $goodid = I('request.goodid',0,'intval');
        $page = I('request.page',1,'intval');
        $pageSize = I('request.pageSize',20,'intval');
        if ($page == 0) {
          $page = 1;
        }
        if ($pageSize == 0) {
          $pageSize = 20;
        }
        if ($id == 1) {
          if (!$goodid ) {
            $out['success'] = 0;
            $out['msg']=C('no_id');
            $out['data'] =null;
            $this->ajaxReturn($out);
          }
          $w = array('gid' => $goodid,'lock'=>0);
          $data = M('vip_comment')->where($w)->page($page,$pageSize)->select();
          foreach ($data as $k => $v) {
            $v['time'] = date('Y-m-d H:i:s',$v['time']);
            $data[$k] = $v;
          }                  
        }
        $out['success'] = 1;
        $out['msg'] = "获取成功";
        $out['data'] =$data;
        $this->ajaxReturn($out);
         
    }
   
  
}
