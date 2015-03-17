<?php
namespace Api\Controller;
use Api\Controller\CommonController;
class CollectController extends CommonController {
    // 添加商店收藏
    public function addshop()
    {
        $id = I('request.version',1);
        // $goodid = I('request.goodid',0);
        $userid = I('request.userid',0);
        $shopid = I('request.shopid',0);
        $time = time();
        if ($id == 1) {
          if (!$userid || !$shopid ) {
            $out['success'] = 0;
            $out['msg']=C('no_id');
            $this->ajaxReturn($out);
          }
          //判断用户是否已经收藏
          $sql ="select id from ".C('DB_PREFIX')."life_co_shop where shopid=$shopid and userid = $userid";
          // dump($sql);
          $data = M()->query($sql);
          if (!empty($data)) {
              $out['success'] = 0;
              $out['msg'] = "你已经收藏该商店";
              $this->ajaxReturn($out);
          }
          $sql = "insert into ".C('DB_PREFIX')."life_co_shop set time=$time,shopid=$shopid,userid = $userid";
         // dump($sql);
          $bool = M()->execute($sql);
          if ($bool) {
             $out['success'] = 1;
            $out['msg']="收藏成功";
          }else{
             $out['success'] = 0;
            $out['msg']="收藏插入失败";
          }
        }
        $this->ajaxReturn($out);
	       
    }
    //删除商店收藏
    public function delshop()
    {
        $id = I('request.version',1);
        // $goodid = I('request.goodid',0);
        $coid = I('request.id',0);
        $shopid = I('request.shopid',0);
        $time = time();
        if ($id == 1) {
          if (!$coid ) {
            $out['success'] = 0;
            $out['msg']=C('no_id');
            $this->ajaxReturn($out);
          }
          //判断用户是否已经收藏
          $sql ="select id from ".C('DB_PREFIX')."life_co_shop where id = $coid";
          // dump($sql);
          $data = M()->query($sql);
          if (empty($data)) {
              $out['success'] = 0;
              $out['msg'] = "该收藏已经删除";
              $this->ajaxReturn($out);
          }
          $sql = "delete from ".C('DB_PREFIX')."life_co_shop  where id = $coid";
         // dump($sql);
          $bool = M()->execute($sql);
          if ($bool) {
             $out['success'] = 1;
            $out['msg']="删除成功";
          }else{
             $out['success'] = 0;
            $out['msg']="删除失败";
          }
        }
        $this->ajaxReturn($out);
         
    }
     // 添加商店收藏
    public function addgood()
    {
        $id = I('request.version',1);
        // $goodid = I('request.goodid',0);
        $userid = I('request.userid',0);
        $goodid = I('request.goodid',0);
        $time = time();
        if ($id == 1) {
          if (!$userid || !$goodid ) {
            $out['success'] = 0;
            $out['msg']=C('no_id');
            $this->ajaxReturn($out);
          }
          //判断用户是否已经收藏
          $sql ="select id from ".C('DB_PREFIX')."life_co_good where goodid=$goodid and userid = $userid";
          $data = M()->query($sql);
          if (!empty($data)) {
              $out['success'] = 0;
              $out['msg'] = "你已经收藏该商店";
              $this->ajaxReturn($out);
          }
          $sql = "insert into ".C('DB_PREFIX')."life_co_good set time=$time,goodid=$goodid,userid = $userid";
         // dump($sql);
          $bool = M()->execute($sql);
          if ($bool) {
             $out['success'] = 1;
            $out['msg']="收藏成功";
          }else{
             $out['success'] = 0;
            $out['msg']="收藏插入失败";
          }
        }
        $this->ajaxReturn($out);
         
    }
    // 删除商品收藏
    public function delgood()
    {
        $id = I('request.version',1);
        // $goodid = I('request.goodid',0);
        $coid = I('request.id',0);
        $time = time();
        if ($id == 1) {
          if (!$coid) {
            $out['success'] = 0;
            $out['msg']=C('no_id');
            $this->ajaxReturn($out);
          }
          //判断收藏是否存在
          $sql ="select id from ".C('DB_PREFIX')."life_co_good where id=$coid";
          // dump($sql);
          $data = M()->query($sql);
          if (empty($data)) {
              $out['success'] = 0;
              $out['msg'] = "该收藏已经删除";
              $this->ajaxReturn($out);
          }
          $sql = "delete from ".C('DB_PREFIX')."life_co_good   where id = $coid";
         // dump($sql);
          $bool = M()->execute($sql);
          if ($bool) {
             $out['success'] = 1;
            $out['msg']="删除成功";
          }else{
             $out['success'] = 0;
            $out['msg']="删除失败";
          }
        }
        $this->ajaxReturn($out);
         
    }
  
}
