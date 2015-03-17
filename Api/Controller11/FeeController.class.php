<?php
namespace Api\Controller;
use Think\Controller;
class FeeController extends Controller {
		function __construct()
	{

		 if (!IS_API) {
	        	die("你无权访问该页面！");
	        }
	}
    // 获取获取水电费；
    public function water()
    {      
      $id = I('request.version',1);
        if ($id == 1) {
          $uid = I('request.userId',0,"intval");
          $start= I('request.startTime','');
          $end = I('request.endTime','');
          $page = I('request.page',1,'intval');
          $pageSize = I('request.pageSize',12,'intval');
          if ($page == 0) {
            $page = 1;
          }
          if ($pageSize == 0) {
            $pageSize = 12;
          }
          if (!$uid) {
            $out['success'] = 0;
            $out['msg'] =C('no_id');
            $out['data'] =null;
            $this->ajaxReturn($out);
          }
          //查询出用户的oid
          $oid = M('pro_owner')->field('id')->where(array('uid'=>$uid))->find();
            if (!$oid) {
              $out['success'] = 0;
              $out['msg'] ='你还没有申请为vip会员';
              $out['data'] =null;
              $this->ajaxReturn($out);
            }
            $oid = current($oid);
            $w = array('oid'=>$oid);
            //dump($start);
            //dump($end);
            $start = strtotime($start);
            $end = strtotime($end);            
            if ($start&& $end) {
              $w = "oid =".$oid." and date >=".$start." and date <=".$end;
            }
            //dump($w);
            $table = "pro_owner_bill";
            $field = "date,use_water,water_price,water_fee,use_elec,elec_price,elec_fee,use_gas,gas_price,gas_fee";
            $data = M($table)->field($field)->where($w)->page($page,$pageSize)->select();
            foreach ($data as $k => $v) {
              $v['date'] = 1000*$v['date'];
              // dump($v);die();
              $data[$k]=$v;
            }
            $out['success'] = 1;
            $out['msg']='成功';
            $out['data']=$data;
            $this->ajaxReturn($out);
        }       
    }
    // 获取获取管理费；
    public function manage()
    {      
      $id = I('request.version',1);
        if ($id == 1) {
          $uid = I('request.userId',0,"intval");
          $start= I('request.startTime','');
          $end = I('request.endTime','');   
          $page = I('request.page',1,'intval');
          $pageSize = I('request.pageSize',12,'intval');
          if ($page == 0) {
            $page = 1;
          }
          if ($pageSize == 0) {
            $pageSize = 12;
          }       
          if (!$uid) {
            $out['success'] = 0;
            $out['msg'] =C('no_id');
            $out['data'] =null;
            $this->ajaxReturn($out);
          }
          //查询出用户的oid
          $oid = M('pro_owner')->field('id')->where(array('uid'=>$uid))->find();
            if (!$oid) {
              $out['success'] = 0;
              $out['msg'] ='你还没有申请为vip会员';
              $out['data'] =null;
              $this->ajaxReturn($out);
            }
            $oid = current($oid);
            $w = array('oid'=>$oid);
            $start = strtotime($start);
            $end = strtotime($end);
            
            if ($start&& $end) {
              $w = "oid =".$oid." and date >=".$start." and date <=".$end;
            }
            //dump($w);
            $table = "pro_owner_bill";
            $field = "date,manage_fee";
            $data = M($table)->field($field)->where($w)->page($page,$pageSize)->select();
            foreach ($data as $k => $v) {
              $v['date'] = 1000*$v['date'];
              // dump($v);die();
              $data[$k]=$v;
            }
            $out['success'] = 1;
            $out['msg']='成功';
            $out['data']=$data;
            $this->ajaxReturn($out);
        }       
    }
    // 获取获取停车卡月费；
    public function car()
    {      
      $id = I('request.version',1);
        if ($id == 1) {
          $uid = I('request.userId',0,"intval");
          $start= I('request.startTime','');
          $end = I('request.endTime',''); 
          $page = I('request.page',1,'intval');
          $pageSize = I('request.pageSize',12,'intval');
          if ($page == 0) {
            $page = 1;
          }
          if ($pageSize == 0) {
            $pageSize = 12;
          }         
          if (!$uid) {
            $out['success'] = 0;
            $out['msg'] =C('no_id');
            $out['data'] =null;
            $this->ajaxReturn($out);
          }
          //查询出用户的oid
          $oid = M('pro_owner')->field('id')->where(array('uid'=>$uid))->find();
            if (!$oid) {
              $out['success'] = 0;
              $out['msg'] ='你还没有申请为vip会员';
              $out['data'] =null;
              $this->ajaxReturn($out);
            }
            $oid = current($oid);
            $w = array('oid'=>$oid);
            $start = strtotime($start);
            $end = strtotime($end);            
            if ($start&& $end) {
              $w = "oid =".$oid." and date >=".$start." and date <=".$end;
            }
            $table = "pro_owner_bill";
            $field = "date,car_fee";
            $data = M($table)->field($field)->where($w)->page($page,$pageSize)->select();
            foreach ($data as $k => $v) {
              $v['date'] = 1000*$v['date'];
              // dump($v);die();
              $data[$k]=$v;
            }
            $out['success'] = 1;
            $out['msg']='成功';
            $out['data']=$data;
            $this->ajaxReturn($out);
        }       
    }
   // 获取获取网络费；
    public function net()
    {      
      $id = I('request.version',1);
        if ($id == 1) {
          $uid = I('request.userId',0,"intval");
          $start= I('request.startTime','');
          $end = I('request.endTime','');  
          $page = I('request.page',1,'intval');
          $pageSize = I('request.pageSize',12,'intval');
          if ($page == 0) {
            $page = 1;
          }
          if ($pageSize == 0) {
            $pageSize = 12;
          }        
          if (!$uid) {
            $out['success'] = 0;
            $out['msg'] =C('no_id');
            $out['data'] =null;
            $this->ajaxReturn($out);
          }
          //查询出用户的oid
          $oid = M('pro_owner')->field('id')->where(array('uid'=>$uid))->find();
            if (!$oid) {
              $out['success'] = 0;
              $out['msg'] ='你还没有申请为vip会员';
              $out['data'] =null;
              $this->ajaxReturn($out);
            }
            $oid = current($oid);
            $w = array('oid'=>$oid);
            $start = strtotime($start);
            $end = strtotime($end);            
            if ($start&& $end) {
              $w = "oid =".$oid." and date >=".$start." and date <=".$end;
            }
            //dump($w);
            $table = "pro_owner_bill";
            $field = "date,net_fee";
            $data = M($table)->field($field)->where($w)->page($page,$pageSize)->select();
            foreach ($data as $k => $v) {
              $v['date'] = 1000*$v['date'];
              // dump($v);die();
              $data[$k]=$v;
            }
            $out['success'] = 1;
            $out['msg']='成功';
            $out['data']=$data;
            $this->ajaxReturn($out);
        }       
    }
    // 获取获取电话费；
    public function mobile()
    {      
      $id = I('request.version',1);
        if ($id == 1) {
          $uid = I('request.userId',0,"intval");
          $start= I('request.startTime','');
          $end = I('request.endTime','');  
          $page = I('request.page',1,'intval');
          $pageSize = I('request.pageSize',12,'intval');
          if ($page == 0) {
            $page = 1;
          }
          if ($pageSize == 0) {
            $pageSize = 12;
          }        
          if (!$uid) {
            $out['success'] = 0;
            $out['msg'] =C('no_id');
            $out['data'] =null;
            $this->ajaxReturn($out);
          }
          //查询出用户的oid
          $oid = M('pro_owner')->field('id')->where(array('uid'=>$uid))->find();
            if (!$oid) {
              $out['success'] = 0;
              $out['msg'] ='你还没有申请为vip会员';
              $out['data'] =null;
              $this->ajaxReturn($out);
            }
            $oid = current($oid);
            $w = array('oid'=>$oid);
            $start = strtotime($start);
            $end = strtotime($end);            
            if ($start&& $end) {
              $w = "oid =".$oid." and date >=".$start." and date <=".$end;
            }
            $table = "pro_owner_bill";
            $field = "date,mobile_fee";
            $data = M($table)->field($field)->where($w)->page($page,$pageSize)->select();
            foreach ($data as $k => $v) {
              $v['date'] = 1000*$v['date'];
              // dump($v);die();
              $data[$k]=$v;
            }
            $out['success'] = 1;
            $out['msg']='成功';
            $out['data']=$data;
            $this->ajaxReturn($out);
        }       
    }
    // 获取获取游泳费；
    public function swim()
    {      
      $id = I('request.version',1);
        if ($id == 1) {
          $uid = I('request.userId',0,"intval");
          $start= I('request.startTime','');
          $end = I('request.endTime','');  
          $page = I('request.page',1,'intval');
          $pageSize = I('request.pageSize',12,'intval');
          if ($page == 0) {
            $page = 1;
          }
          if ($pageSize == 0) {
            $pageSize = 12;
          }        
          if (!$uid) {
            $out['success'] = 0;
            $out['msg'] =C('no_id');
            $out['data'] =null;
            $this->ajaxReturn($out);
          }
          //查询出用户的oid
          $oid = M('pro_owner')->field('id')->where(array('uid'=>$uid))->find();
            if (!$oid) {
              $out['success'] = 0;
              $out['msg'] ='你还没有申请为vip会员';
              $out['data'] =null;
              $this->ajaxReturn($out);
            }
            $oid = current($oid);
            $w = array('oid'=>$oid);
            $start = strtotime($start);
            $end = strtotime($end);            
            if ($start&& $end) {
              $w = "oid =".$oid." and date >=".$start." and date <=".$end;
            }
            $table = "pro_owner_bill";
            $field = "date,swim_fee";
            $data = M($table)->field($field)->where($w)->page($page,$pageSize)->select();
            foreach ($data as $k => $v) {
              $v['date'] = 1000*$v['date'];
              // dump($v);die();
              $data[$k]=$v;
            }
            $out['success'] = 1;
            $out['msg']='成功';
            $out['data']=$data;
            $this->ajaxReturn($out);
        }       
    }
    // 获取获取健身费；
    public function fit()
    {      
      $id = I('request.version',1);
        if ($id == 1) {
          $uid = I('request.userId',0,"intval");
          $start= I('request.startTime','');
          $end = I('request.endTime','');    
          $page = I('request.page',1,'intval');
          $pageSize = I('request.pageSize',12,'intval');
          if ($page == 0) {
            $page = 1;
          }
          if ($pageSize == 0) {
            $pageSize = 12;
          }      
          if (!$uid) {
            $out['success'] = 0;
            $out['msg'] =C('no_id');
            $out['data'] =null;
            $this->ajaxReturn($out);
          }
          //查询出用户的oid
          $oid = M('pro_owner')->field('id')->where(array('uid'=>$uid))->find();
            if (!$oid) {
              $out['success'] = 0;
              $out['msg'] ='你还没有申请为vip会员';
              $out['data'] =null;
              $this->ajaxReturn($out);
            }
            $oid = current($oid);
            $w = array('oid'=>$oid);
            $start = strtotime($start);
            $end = strtotime($end);            
            if ($start&& $end) {
              $w = "oid =".$oid." and date >=".$start." and date <=".$end;
            }
            $table = "pro_owner_bill";
            $field = "date,fit_fee";
            $data = M($table)->field($field)->where($w)->page($page,$pageSize)->select();
            foreach ($data as $k => $v) {
              $v['date'] = 1000*$v['date'];
              // dump($v);die();
              $data[$k]=$v;
            }
            $out['success'] = 1;
            $out['msg']='成功';
            $out['data']=$data;
            $this->ajaxReturn($out);
        }       
    }
}
