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
        $id = I('request.version',1);
        $goodid = I('request.goodid',0);
        $userid = I('request.userid',0);
        $shopid = I('request.shopid',0);
        $content = I('request.content',1);
        $star = I('request.star',1);
        $time = time();
        if ($id == 1) {
          if (!$goodid || !$userid || !$shopid ) {
            $out['success'] = 0;
            $out['msg']=C('no_id');
            $this->ajaxReturn($out);
          }
          $sql = "insert into ".C('DB_PREFIX')."comment set time=$time,shopid=$shopid,gid = $goodid,user_id=$userid,content ='$content',star =$star";
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
     public function shop()
    {
        $id = I('request.version',1);
        $shopid = I('request.shopid',0);
        if ($id == 1) {
          if (!$shopid ) {
            $out['success'] = 0;
            $out['msg']=C('no_id');
            $this->ajaxReturn($out);
          }
          $sql = "select id,content,star,user_id,time from ".C('DB_PREFIX')."comment where `lock` = 0 and shopid = $shopid";
         // dump($sql);
          $data = M()->query($sql);
          if ($data) {
             $out['success'] = 1;
              foreach ($data as $k => $v) {
                 // 查询出来用户的头像
                $sql = "select face,rank_name from ".C('DB_PREFIX')."user as u join ".C('DB_PREFIX')."user_rank as k on u.user_rank =k.rank_id  where user_id = $v[user_id]";
                $user = M()->query($sql);
                if (!empty($user)) {
                  $user = current($user);
                  $v['face'] =$user['face'];
                  $v['rank_name'] = $user['rank_name'];
                }
                $data[$k] =$v;
              }
              $out['data'] = $data;
          }else{
             $out['success'] = 0;
            $out['msg']="该商店没有评论";
          }
        }
        $this->ajaxReturn($out);
         
    }
     public function good()
    {
        $id = I('request.version',1);
        $goodid = I('request.goodid',0);
        $time = time();
        if ($id == 1) {
          if (!$goodid) {
            $out['success'] = 0;
            $out['msg']=C('no_id');
            $this->ajaxReturn($out);
          }
           $sql = "select id,content,star,user_id,time from ".C('DB_PREFIX')."comment where `lock` = 0 and gid = $goodid";
           // dump($sql);
          $data = M()->query($sql);
          if (!empty($data)) {
             $out['success'] = 1;
              foreach ($data as $k => $v) {
                 // 查询出来用户的头像
                $sql = "select face,rank_name from ".C('DB_PREFIX')."user as u join ".C('DB_PREFIX')."user_rank as k on u.user_rank =k.rank_id  where user_id = $v[user_id]";
                $user = M()->query($sql);
                if (!empty($user)) {
                  $user = current($user);
                  $v['face'] =$user['face'];
                  $v['rank_name'] = $user['rank_name'];
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
   
  
}
