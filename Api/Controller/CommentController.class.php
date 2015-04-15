<?php
namespace Api\Controller;
use Api\Controller\CommonController;
class CommentController extends  CommonController{
    /**
     * [add 添加评论]
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-03-25T15:58:22+0800
     */
    public function add()
    {
        $id = I('request.version',1,'intval');
        $orderid = I('request.orderId',0,'intval');
        $goodid = I('request.goodid',0,'intval');
        $userid = I('request.userid',0,'intval');
        $shopid = I('request.shopid',0,'intval');
        $content = I('request.content');
        $star = I('request.star');
        $pic = I('request.pic');
        $time = time();
        if ($id == 1) {
          if (!$goodid || !$userid || !$orderid) {
            $out['success'] = 0;
            $out['msg']=C('no_id');
            $this->ajaxReturn($out);
          }
          $arr['time']=$time;
          $arr['shopid'] = $shopid;
          $arr['gid'] = $goodid;
          $arr['user_id'] = $userid;
          $arr['content'] = $content;
          $arr['star'] = $star;
          $pic = uploadMore();
          if (!is_null($pic)) {
            $arr['pic'] = $pic;
          } 
          // dump($arr);
          M()->startTrans();
          $bool = M('comment')->add($arr);
          // dump($bool);
          $data = array('oid'=>$orderid,'statue'=>7);
          $bool1 = M('order')->save($data);
          if ($bool && $bool1) {
            M()->commit();
             $out['success'] = 1;
            $out['msg']="评论成功";
          }else{
            M()->rollback();
             $out['success'] = 0;
            $out['msg']="评论插入失败";
          }
        }
        $this->ajaxReturn($out);
	       
    }
     /**
      * [good 商品的评论]
      * @author xujun
      * @email  [jun0421@163.com]
      * @time   2015-03-25T15:58:40+0800
      * @return [type]                   [description]
      */
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
     /**
      * [vipAdd 添加VIP评论]
      * @author xujun
      * @email  [jun0421@163.com]
      * @time   2015-03-25T15:59:17+0800
      * @return [type]                   [description]
      */
    public function vipAdd()//2014-12-16
    {
        $id = I('request.version',1,'intval');
        $goodid = I('request.goodid',0,'intval');
        $userid = I('request.userid',0,'intval');
        $content = I('request.content');
        $oid = I('request.orderId');
        $pic = uploadMore();
        if (!is_null($pic)) {
          $arr['pic'] = $pic;
        }   

        $star = I('request.star');
        $time = time();
        if ($id == 1) {
          if (!$goodid || !$userid ) {
            $out['success'] = 0;
            $out['msg']=C('no_id');
            $this->ajaxReturn($out);
          }
          //组合出添加的数组
          $arr['content'] = $content;
          $arr['gid'] = $goodid;
          $arr['user_id'] = $userid;
          $arr['time'] = $time;
          $arr['star'] = $star;
          // dump($arr);die();
          //$sql = "insert into ".C('DB_PREFIX')."vip_comment set time=$time,gid = $goodid,user_id=$userid,content ='$content',star =$star,pic='$pic'";
         // dump($sql);
         $w = array('oid'=>$oid);
         M()->startTrans();
         // dump($arr);
          $bool = M('vip_comment')->add($arr);
          // dump(M('vip_comment')->getlastSql();)
          // dump($bool);
          $statue = M('order')->field('statue,number')->where($w)->find();
          // dump($statue);
          $sql = "UPDATE `wrt_order_info` SET `is_comm`=1 WHERE ( `good_id` = '".$goodid."' ) AND ( `order_number` = '".$statue['number']."' )";
          $bool3 = M('order_info')->execute($sql);//修改商品评论状态
          // dump(M('order_info')->getlastSql());
          // dump($bool3);
          if($bool3){//查找用户是否评论完所有的商品
            $where = array('order_number'=>$statue['number']);
            $num = M('order_info')->where($where)->count();//计算商品数量
            // dump(M('order_info')->getlastSql());
            $where['is_comm'] = 1;
            // dump($num);
            $sum = M('order_info')->where($where)->count();
            // dump($sum);
            if ($sum == $num) {
                $bool1 = M('order')->where($w)->setInc('statue');
               
            }else{
              $bool1 = 1;
            }
          }else{
            $msg ="你已经评论过了，不能重复评论";
          }
          
          // 
          $w = array('goods_id'=>$goodid);
          $bool2 = M('goods')->where($w)->setInc('comm_num');
          // dump($bool2);
          if ($bool && $bool1 && $bool2) {
            M()->commit();
             $out['success'] = 1;
              $out['msg']="评论成功";
          }else{
            M()->rollback();
             $out['success'] = 0;
            $out['msg']=$msg;
          }
        }
        $out['data'] =null;
        $this->ajaxReturn($out);
         
    } 
    /**
     * [getVip 获取VIP商品的评论]
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-03-25T15:59:45+0800
     * @return [type]                   [description]
     */
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
