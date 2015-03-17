<?php
namespace Api\Controller;

use Api\Controller\CommonController;
class MemberController extends CommonController {
    /**
     * 获取个人中心用户数据
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-09T17:18:17+0800
     * @return [type]                   [description]
     */
  public function index()
  {

      $id = I('request.version',1);
        // 获取用户id
      $user_id = I('request.userId',0,'intval');
      $out['success']=1;
      if (!$user_id) {
        $out['success'] = 0;
        $out['msg'] = C('no_id');
        $this->ajaxReturn($out);
      }
      
      if ($id == 1)
      {
        //获取用的积分及金额
        $sql  = "select user_id,source,user_money,face,true_name,user_name,user_rank,nickname from ".C('DB_PREFIX')."user where user_id = $user_id";
        $data = M()->query($sql);
        if ($data) {
            $data = current($data);
            $out['user'] = $data;
        }else{
          $out['msg'] = "没有你需要的用数据";
          $out['success'] = 0;
          $this->ajaxReturn($out);
        }
        // dump($data);
        $arr=array('0'=>'no_pay','1'=>'no_out','5'=>'no_get','6'=>'no_comm');
        foreach ($arr as $k => $v) {
          $where = array('user_id'=>$user_id,'is_end' => '0','statue' => $k,'cate'=>'1');
          $order[$v] = M('order')->where($where)->count();
        }
        $out['order'] = $order;
        // dump($order);
        $this->ajaxReturn($out);
      }

       
  }
  /**
   * 用户完善信息和申请vip
   * @author xujun
   * @email  [jun0421@163.com]
   * @date   2015-01-06T19:10:49+0800
   * @return [type]                   [description]
   */
  public function vip()
  {

      $id = I('request.version',1);
      $provenceId =I('request.provenceId',0,'intval');
      $cityId =I('request.cityId',0,'intval');
      $area =I('request.areaId',0,'intval');
      $phone = I('request.phone');
      $village_id =I('request.village',0,'intval');

      $arr = array(
        'province'=>$provenceId,
        'city'=>$cityId,
        'area'=>$area,
        'nickname' => I('request.nickName'),
        'email'    => I('request.email'),
        'true_name'     => I('request.name'),
        'village_id'      =>$village_id,
        // 'property_id'   =>I('request.property'),
        'flag'=>1,
      );
       // 获取用户id
      $user_id = I('request.userId',0,'intval');
      $out['success']=1;
      if (!$user_id) {
        $out['success'] = 0;
        $out['msg'] = C('no_id');
        $out['data'] = null;
        $this->ajaxReturn($out);
      }
      
      if ($id == 1)
      {
        
        
        // 根据物业查找用户的小区
        $w = "id =".$arr['village_id'];
        // dump($w);
        $village = M('village')->field('name,property_id')->where($w)->find();
        // dump($village);
        if (!is_null($village)) {
            $arr['village'] = $village['name']; 
            $arr['property_id'] = $village['property_id'];           
        }
        // 根据用户所给的地区id和物业字段查询物业的id
        $w="id = ".$arr['property_id'];
        // dump($w);
        $property = M('property')->field('pname')->where($w)->find();
        // dump($property);die();
        if (!is_null($property)) {
            $arr['property'] = $property['pname'];            
        }
        //dump($arr);
        //判断用户的电话和姓名是否在该物业的业主中并查询出用户的***oid
        $where = array('name'=>$arr['true_name'],'mobile'=>$phone,'property_id'=>$arr['village_id']);
        $up = array('uid'=>I('request.userId',0,'intval'));
        // dump($where);
        // dump($up);
        $bool = M('pro_owner')->where($where)->save($up);
        if ($bool) {
          $arr['user_rank'] = 2;
        }else{
          $arr['user_rank'] = 1;
        }
        $arr['user_id'] = I('request.userId',0,'intval');
        // dump($sql);
        $w= array('user_rank'=>2,'user_id'=>$arr['user_id']);
        $bool = M('user')->where($w)->find();
        if (!is_null($bool)) {
            $out['success'] = 1;
            $out['msg']="你已经是vip会员，不能再申请！";
            $out['data'] = null;
            $this->ajaxReturn($out);
        }
        //dump($arr);die();
        $bool = M('user')->save($arr);
        if ($bool) {
          //dump($arr);die();
          if ($arr['user_rank'] == 2) {
            //修改用户的申请进度
            $data = array('user_id'=>$arr['user_id'],'flag'=>2);
            M('user')->save($data);
            $out['msg'] = "申请成功";
            $out['data'] = $arr;
            $out['success'] = 1;
          }else{
            $out['msg'] = "申请成功,等待管理员审核";
            $out['data'] = $arr;
            $out['success'] = 1;
          }
          
        }else{
          $out['msg'] = "申请不成功";
          $out['data'] = null;
          $out['success'] = 1;            
        }
        $this->ajaxReturn($out);
      }

       
  }
  
  /**
   * 个人中心我的发布
   * @author xujun
   * @email  [jun0421@163.com]
   * @date   2015-01-09T17:19:30+0800
   * @return [type]                   [description]
   */
  public function myself(){
    $id = I('request.version',0,'intval');
    $uid = I('request.userId',0,'intval');
    $type = I('request.type',0,'intval');
    if ($id == 1) {
      if (!$uid || !$type) {
          $out['data']=null;
         $out['msg'] = '失败';
         $out['success'] = 0;
         $this->ajaxReturn($out);
      }
      $w = array('uid'=>$uid,'pid'=>0);
        switch ($type) {
          case '1':
            $table="pro_fetch";
            $field = "id,add_time,title,content,pic,author";
            break;
          case '2':
            $table="pro_activity";
            $field = "id,title,content,pic,author,add_time,views,uid";
            break;
          case '3':
            $table="pro_car";
            $field = "id,title,content,pic,author,add_time,views,uid";
            break;           
        }
         $data = M($table)->field($field)->where($w)->select();
         if ($data) {
           foreach ($data as $k => $v) {
           $v['add_time'] = date('Y-m-d H:i:s',$v['add_time']);
           $data[$k] = $v;
          }
         }else{
            $data = array();
         }
         $join = array();
           if ($type == 2) {
              //查找我参加活动的id
              $where = array('uid'=>$uid);
              //dump($where);//
              $act = M('pro_activity_sign')->field('aid')->where($where)->select();
              if ($act) {
                foreach ($act as $k => $v) {
                  $aid = $v['aid'];
                }
              }
              $join = M($table)->field($field)->where($aid)->select();
              //dump($join);
           }elseif($type==3){
              // 查找用户参加的闲置交换id
              // dump($w);die();
             unset($w['pid']);
             // dump($w);
             // dump($table);
             $id = M($table)->distinct(true)->field('pid')->where($w)->select();
             // dump($id);
             // 组合数组
             if ($id) {
               foreach ($id as $k => $v) {
                  if ($v['pid'] != 0) {
                    $tem[] = $v['pid'];
                  }           
                }
             }
             $where = 'id in ('.implode(',', $tem).')';
             $join = M($table)->field($field)->where($where)->select();
             $my = array();
               foreach ($join as $k => $v) {
                 if ($v['title'] != "") {

                   $my[] = $v;
                 }
               }
             $join = $my;
             // 删除没有标题的用户
             //dump($join);die();
             
           }elseif($type == 1){
              // 查找用户参加的闲置交换id
              // dump($w);die();
             unset($w['pid']);
             $id = M($table)->distinct(true)->field('pid')->where($w)->select();
             //dump($id);
             // 组合数组
             if ($id) {
               foreach ($id as $k => $v) {
                  if ($v['pid'] != 0) {
                    $tem[] = $v['pid'];
                  }           
                }
             }
             $where = 'id in ('.implode(',', $tem).')';
             // dump($where);//->field($field)
             $join = M($table)->where($where)->select();
             // dump($m)
             $my = array();
               foreach ($join as $k => $v) {
                 if ($v['title'] != "") {
                   $my[] = $v;
                 }
               }
             $join = $my;
             // 删除没有标题的用户
             //dump($join);die();
             
           }
           foreach ($join as $k => $v) {
              $v['add_time'] =  date('Y-m-d H:i:s',$v['add_time']);
              $join[$k] = $v;
           }
         $out['join']=$join;
         $out['data']=$data;
         $out['msg'] = '成功';
         $out['success'] = 1;
         $this->ajaxReturn($out);

    }

  }
  /**
   * 获取地区的物业
   * @author xujun
   * @email  [jun0421@163.com]
   * @date   2015-01-09T17:19:30+0800
   * @return [type]                   [description]
   */
  public function property(){

    $id = I('request.version',0,'intval');
    $areaId = I('request.areaId',0,'intval');
    if ($id == 1) {
      if (!$areaId) {
         $out['data']=null;
         $out['msg'] = C('no_id');
         $out['success'] = 0;
         $this->ajaxReturn($out);
      }  
      $field = "id,pname";   
      $w = array('area'=>$areaId);
      $data = M('property')->field($field)->where($w)->select();       
         $out['data']=$data;
         $out['msg'] = '成功';
         $out['success'] = 1;
         $this->ajaxReturn($out);
    }

  }
  /**
   * 获取物业的小区
   * @author xujun
   * @email  [jun0421@163.com]
   * @date   2015-01-09T17:19:30+0800
   * @return [type]                   [description]
   */
  public function village(){
    $id = I('request.version',0,'intval');    
    $areaId = I('request.areaId',0,'intval');
    if ($id == 1) {
      if (!$areaId) {
         $out['data']=null;
         $out['msg'] = C('no_id');
         $out['success'] = 0;
         $this->ajaxReturn($out);
      }  
      $field = "id,name";   
      $w = array('area'=>$areaId);
      $data = M('village')->field($field)->where($w)->select();  
      // dump()     
         $out['data']=$data;
         $out['msg'] = '成功';
         $out['success'] = 1;
         $this->ajaxReturn($out);
    }

  }
  /**
   * 获取个人中心我的发布的相关数据
   * @author xujun
   * @email  [jun0421@163.com]
   * @date   2015-01-09T17:19:30+0800
   * @return [type]                   [description]
   */
  public function data(){

    $id = I('request.version',0,'intval');
    $userId = I('request.userId',0,'intval');
    if ($id == 1) {
      if (!$userId) {
         $out['data']=array();
         $out['msg'] = C('no_id');
         $out['success'] = 0;
         $this->ajaxReturn($out);
      }  
      //查找用户的闲置交换发布数量
      $w = array('pid'=>0,'uid'=>$userId);
      $data['fetch_my'] = M('pro_fetch')->where($w)->count();
      unset($w['pid']);//->distinct(true)->field('pid')
      //dump($w);
      $w= "pid != 0 and uid = $userId";
       
      $pid= M('pro_fetch')->distinct(true)->field('pid')->where($w)->select();
      if ($pid) {
        foreach ($pid as $k => $v) {
          if ($v['pid'] != 0) {
            $tem[] = $v['pid'];
          }
        }
      }else{
        $tem = array();
      }
      $w = "id in (".implode(',', $tem).") and pid =0";
      $in = M('pro_fetch')->where($w)->count();
      if ($in) {
        $data['fetch_in'] = $in;
      }else{
        $data['fetch_in'] = 0;
      }
      //查找用户的邻里活动发布数量
      $w = array('pid'=>0,'uid'=>$userId);
      $data['action_my'] = M('pro_activity')->where($w)->count();
      unset($w['pid']);//->distinct(true)->field('pid')
      //dump($w);       
      $pid= M('pro_activity_sign')->distinct(true)->field('aid')->where($w)->select();
      $data['action_in']= M('pro_activity_sign')->distinct(true)->field('aid')->where($w)->count();
      // if ($pid) {
      //   foreach ($pid as $k => $v) {
      //     if ($v['pid'] != 0) {
      //       $tem[] = $v['pid'];
      //     }
      //   }
      // }else{
      //   $tem = array();
      // }
      // $w = "id in (".implode(',', $tem).") and pid =0";
      // $in = M('pro_activity')->where($w)->count();
      // if ($in) {
      //   $data['action_in'] = $in;
      // }else{
      //   $data['action_in'] = 0;
      // }
      //查找用户的邻里拼车发布数量
      $w = array('pid'=>0,'uid'=>$userId);
      $data['car_my'] = M('pro_car')->where($w)->count();
      //unset($w['pid']);//->distinct(true)->field('pid')
      $w= "pid != 0 and uid = $userId";
      $pid = M('pro_car')->distinct(true)->field('pid')->where($w)->select();
      // 去除用户发布的数据
      if ($pid) {
        foreach ($pid as $k => $v) {
          if ($v['pid'] != 0) {
            $tem[] = $v['pid'];
          }
        }
      }else{
        $tem = array();
      }
      $w = "id in (".implode(',', $tem).") and pid =0";
      //dump($pid);die();
      $in = M('pro_car')->where($w)->count();
      if ($in) {
        $data['car_in'] = $in;
      }else{
        $data['car_in'] = 0;
      }
      //查找用户的社区资讯的评论条数发布数量
      $w = array('uid'=>$userId);
      $data['notice_comm'] = M('pro_notice')->distinct(true)->field('pid')->where($w)->count();
      //查找用户的社区调查的评论条数发布数量
      $w = array('uid'=>$userId);
      $data['survey_comm'] = M('pro_survey_sign')->where($w)->count();
        //dump($data);die();
         $out['data']=$data;
         $out['msg'] = '成功';
         $out['success'] = 1;
         $this->ajaxReturn($out);
    }

  }
  /**
   * 删除用户自己的发布
   * @author xujun
   * @email  [jun0421@163.com]
   * @time   2015-01-13T16:13:03+0800
   * @return [type]                   [description]
   */
  public function delete(){
      $id = I('request.version',0,'intval');
      $mId = I('request.id',0,'intval');
      $type = I('request.type',0,'intval');
      if ($id == 1) {
          $table = $this->changeTable($type);
          $bool = M($table)->delete($mId);
          // 删除子类的回复
          if($type == 2){M('activity_sign')->where(array('aid'=>$mId))->delete();
          }else{$this->deleteSon($table,$mId);}
          if ($bool) {
            $out['success'] = 1;
            $out['data'] = $bool;
            $out['msg'] = '成功';
          }else{
            $out['success'] = 0;
            $out['data'] = $bool;
            $out['msg'] = '失败';
          }
          $this->ajaxReturn($out);

      }
  }

  private function changeTable($type){
        switch ($type) {
          case '1':
            $table = "pro_fetch";
            break;
          case '2':
            $table = "pro_activity";
            break;          
          case '3':
            $table = "pro_car";
            break;   
        }
        return $table;
  }

  private function deleteSon($table,$mId){
      if (!$table || !$mId) {
        return;
      }
      // 查找出所有的子类
      $w = array('pid'=>$mId);
      $pid=M($table)->field('id')->where($w)->select();
      if($pid){
        foreach ($pid as $k => $v) {
          $this->deleteSon($table,$v['id']);
        }
        
      }
      M($table)->where($w)->delete();
  }
   
}
