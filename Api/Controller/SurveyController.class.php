<?php
namespace Api\Controller;
use Think\Controller;
class SurveyController extends Controller {
		function __construct()
	{

		 if (!IS_API) {
	        	die("你无权访问该页面！");
	        }
	}
 

        // 社区调查列表
    public function index(){
        $id = I('request.version',1,'intval');
        $proId = I('request.propertyId',0,'intval');
        $page = I('request.page',1,'intval');
        $pageSize = I('request.pageSize',20,'intval');
        if ($page == 0) $page = 1;
        if($pageSize == 0) $pageSize = 20;
        // dump(!$proid);
        if (!$proId) {
             $out['success'] = 0;
              $out['msg']=C('no_id');
              $out['data']=null;
              $this->ajaxReturn($out);
          }
        if ($id == 1) {
              $table = "pro_survey";
            // $where = array('proid'=>$proId, "pid" => 0,"sheild" =>0);
            $where = "proid = $proId and sheild = 0 and pass_time >".time();
            $page = ($page - 1) * $pageSize.",".$pageSize;
            $field = "id,title,content,author,add_time,number,survey_verygood as best,survey_good as better,survey_general as good ,survey_nogood as bad,survey_bad as worst";
            // dump($pageSize);

            $data = M($table)->field($field)->where($where)->order('add_time desc')->limit($page)->select();
            foreach ($data as $k => $v) {
                $v['add_time'] = date('Y-m-d H:i:s',$v['add_time']);
                $data[$k] =$v;
            }
            $out['data'] = $data;
            $this->ajaxReturn($out);
        }
    } 
    //闲置交换列表
    public function fetchList(){
        $id = I('request.version',1,'intval');
        $proId = I('request.propertyId',0,'intval');
        $userId = I('request.userId',0,'intval');
        $page = I('request.page',1,'intval');
        $pageSize = I('request.pageSize',20,'intval');
        if ($page == 0) $page = 1;
        if($pageSize == 0) $pageSize = 20;
        // dump(!$proid);
        $out['success'] = 0;
        $out['data']=null;
        if (!$proId) {
             
              $out['msg']=C('no_id');              
              $this->ajaxReturn($out);
          }
        if ($id == 1) {
            $table = "pro_fetch";
            // $where = array('proid'=>$proId, "pid" => 0,"sheild" =>0);
            $where = "proid = $proId and sheild = 0 and pid = 0 and pass_time >".time();
            if ($userId) {
              $where .= " and uid =".$userId;
            }
            // dump($where);die();
            $page = ($page - 1) * $pageSize.",".$pageSize;
            $field = "id,add_time,title,content,pic,author";
            // dump($pageSize);

            $data = M($table)->field($field)->where($where)->order('add_time desc')->limit($page)->select();
            if (is_array($data)) {
              $out['success'] = 1;
              $out['msg'] = "获取数据成功";
              foreach ($data as $k => $v) {
                $v['add_time'] = date('Y-m-d',$v['add_time']);
                $data[$k] =$v;
              }
            }else{
              $out['msg'] ="该物业没有人发布闲置交换信息";
            }
            $out['data'] = $data;
            $this->ajaxReturn($out);
        }
    } 
    // 用户添/修改加用户通讯录
    public function addressAdd(){
        $id = I('request.version',1,'intval');
        $userId = I('request.userId',0,'intval'); //用户id
        $name = I('request.name');
        $phone = I('request.phone');
        $unit = I('request.unit');
        $pid = I('request.pid',0,'intval');
        // dump(!$proid);
         $out['success'] = 0;
        $out['data']=null;
        if (!$userId) {
            
              $out['msg']=C('no_id');
              
              $this->ajaxReturn($out);
          }
        if ($id == 1) {

              $table = "pro_phone_book";
              $arr = array(
                'uid'=>$userId,
                'name'=>$name,
                'phone'=>$phone,
                'unit'=>$unit
                );
                if ($pid) {
                  $arr['id'] = $pid;
                  $bool = M($table)->save($arr);
                  if ($bool) {
                      $out['success'] = 1;
                      $out['data'] = $bool;
                      $out['msg'] = '修改成功';
                    }else{
                      $out['msg'] = "修改失败";
                      $out['data'] = $bool;
                    }
            
                    $this->ajaxReturn($out);
                }
                $data = M($table)->field('id')->where($arr)->find();
                // dump(!is_null($data));
                if (!is_null($data)) {
                    $out['data'] = $data;
                    $out['msg'] = '已经存在该电话号码，不能重复添加相同的';
                    $this->ajaxReturn($out);
                }

                
                  $bool = M($table)->add($arr);

            if ($bool) {
              $out['success'] = 1;
              $out['data'] = $bool;
              $out['msg'] = '添加成功';
            }else{
              $out['msg'] = "添加失败";
              $out['data'] = $bool;
            }
            
            $this->ajaxReturn($out);
        }
    } 
    //获取用户通讯录
    public function getAddress(){
        $id = I('request.version',1,'intval');
        $userId = I('request.userId',0,'intval'); //用户id
        // dump(!$proid);
         $out['success'] = 0;
        $out['data']=null;
        if (!$userId) {
            
              $out['msg']=C('no_id');
              
              $this->ajaxReturn($out);
          }
        if ($id == 1) {

              $table = "pro_phone_book";
              $w = array(
                'uid'=>$userId
                );
                $data = M($table)->field('id,name,phone,unit')->where($w)->select();
                // dump(!is_null($data));
                if (!is_null($data)) {
                  $out['success'] = 1;
                    $out['data'] = $data;
                    $out['msg'] = '获取成功';
                    $this->ajaxReturn($out);
                }else{
                  $out['msg'] = '你未添加任何通讯录';
                }
            
            $this->ajaxReturn($out);
        }
    }
    //搜索用户通讯录
    public function searchPhone(){
        $id = I('request.version',1,'intval');
        $userId = I('request.userId',0,'intval'); //用户id
        $words = I('request.words'); //搜索关键字
        // dump(!$proid);
         $out['success'] = 0;
        $out['data']=null;
        if (!$userId) {
            
              $out['msg']=C('no_id');
              
              $this->ajaxReturn($out);
          }
        if ($id == 1) {

              $table = "pro_phone_book";
              $w = "uid = $userId and name like '%$words%'";
                $data = M($table)->field('id,name,phone,unit')->where($w)->select();
                // dump(!is_null($data));
                if (!is_null($data)) {
                  $out['success'] = 1;
                    $out['data'] = $data;
                    $out['msg'] = '获取成功';
                    $this->ajaxReturn($out);
                }else{
                  $out['msg'] = '你未添加任何通讯录';
                }
            
            $this->ajaxReturn($out);
        }
    }
    //修改用户通讯录
    public function changePhone(){
        $id = I('request.version',1,'intval');
        $aid = I('request.phoneId',0,'intval'); //用户id
        $name = I('request.name'); //修改的名称
        $content = I('request.content'); //用户id
        // dump(!$proid);
         $out['success'] = 0;
        $out['data']=null;
        if (!$aid) {
            
              $out['msg']=C('no_id');
              
              $this->ajaxReturn($out);
          }
        if ($id == 1) {

              $table = "pro_phone_book";
              $arr['id'] = $aid;
              if ($name == 'name') {
                $arr['name'] = $content;
              }elseif($name == 'phone'){
                $arr['phone'] = $content;
              }else{$arr['unit'] = $content;}
              // dump($w);
                $data = M($table)->save($arr);
                // dump($data);
                // dump(!is_null($data));
                if ($data) {
                  $out['success'] = 1;
                    $out['data'] = $data;
                    $out['msg'] = '修改成功';
                    $this->ajaxReturn($out);
                }else{
                  $out['msg'] = '修改失败';
                }
            
            $this->ajaxReturn($out);
        }
    }
    //修改用户通讯录
    public function delPhone(){
        $id = I('request.version',1,'intval');
        $aid = I('request.phoneId',0,'intval');
        // dump(!$proid);
         $out['success'] = 0;
        $out['data']=null;
        if (!$aid) {
            
              $out['msg']=C('no_id');
              
              $this->ajaxReturn($out);
          }
        if ($id == 1) {

              $table = "pro_phone_book";              
                $data = M($table)->delete($aid);
                // dump($data);
                // dump(!is_null($data));
                if ($data) {
                  $out['success'] = 1;
                    $out['data'] = $data;
                    $out['msg'] = '删除成功';
                    $this->ajaxReturn($out);
                }else{
                  $out['msg'] = '删除失败';
                }
            
            $this->ajaxReturn($out);
        }
    }
    public function fetchAdd(){
        $id = I('request.version',1,'intval');
        $userId = I('request.userId',0,'intval'); //用户id
        $title = maskWord(I('request.title'));
        $content = maskWord(I('request.content'));
        $passTime = I('request.passTime');

        // dump(!$proid);
         $out['success'] = 0;
        $out['data']=null;
        if (!$userId) {
            
              $out['msg']=C('no_id');
              
              $this->ajaxReturn($out);
          }
        if ($id == 1) {

              $table = "pro_fetch";
              $arr = array(
                'uid'=>$userId,
                'proid'=>I('request.propertyId',0,'intval'),
                'author'=>I('request.userName'),
                'content'=>$content,
                'title'=>$title,
                'pic' => I('request.pic'),
                'price' => I('request.price'),
                'pid' =>I('request.pid'),
                'pass_time'=>strtotime($passTime),
                'phone' => I('request.phone')
                );
                $data = M($table)->field('id')->where($arr)->find();
                // dump(!is_null($data));
                if (!is_null($data)) {
                    $out['data'] = $data;
                    $out['msg'] = '不能重复发布相同的信息';
                    $this->ajaxReturn($out);
                }
                $arr['add_time'] = time(); //加入添加的时间

            $bool = M($table)->add($arr);
            if ($bool) {
              $out['success'] = 1;
              $out['data'] = $bool;
              $out['msg'] = '添加成功';
            }else{
              $out['msg'] = "添加失败";
              $out['data'] = $bool;
            }
            
            $this->ajaxReturn($out);
        }
    } 
     public function fetchInfo(){
        $id = I('request.version',1,'intval');
        $fid = I('request.fetchId',0,'intval');
        // dump(!$proid);
         $out['success'] = 0;
        $out['data']=null;
        if (!$fid) {
            
              $out['msg']=C('no_id');
              
              $this->ajaxReturn($out);
          }
        if ($id == 1) {

              $table = "pro_fetch";
              $arr = array('id'=>$fid);
              //更新浏览量
              M($table)->where($arr)->setInc('views');
              $field = "id,add_time,title,content,pic,author,phone";
              $data = M($table)->field($field)->where($arr)->find();
            if ($data) {              
              $data['add_time'] = date('Y-m-d',$data['add_time']);              
              $out['success'] = 1;
              //获取交换详情的评论
              $field = "id,content,add_time,author,uid,type";
              $son = M($table)->field($field)->where(array('pid'=>$data['id']))->select();
              foreach ($son as $key => $value) {
                $w = array('pid' => $value['id']);
                $value['add_time'] = date('Y-m-d H:i:s',$value['add_time']);
                 $back = M($table)->field($field)->where($w)->find();
                 $value['back'] = $back;
                 $face = M('user')->field('face')->where(array('user_id'=>$value['uid']))->find();
                 if ($face) {
                   $value['face'] = current($face);
                 }
                 $son[$key] = $value;
              }              
              $data['son'] = $son;
              $out['data'] = $data;
              $out['msg'] = '成功获取数据';
            }else{
              $out['msg'] = "没有对应的数据";
              $out['data'] = $data;
            }
            
            $this->ajaxReturn($out);
        }
    } 

}
