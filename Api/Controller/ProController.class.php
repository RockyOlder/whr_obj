<?php
namespace Api\Controller;
use Think\Controller;
class ProController extends Controller {
		function __construct()
	{

		 if (!IS_API) {
	        	die("你无权访问该页面！");
	        }
	}
    // 获取公告的内容
    public function notice()
    {
     
        $id = I('request.version',1);
        $proId = I('request.proId',1,'intval');
          if (!$proId) {
             $out['success'] = 0;
              $out['msg']=C('no_id');
              $this->ajaxReturn($out);
          }
          if ($id == 1) {
            $where = array('proid'=>$proId,'pid'=>0);
            $data = M('pro_notice')->field('title,id')->where($where)->order('add_time desc')->limit(3)->select();
            // dump($data);
            if (!is_null($data)) {
                $out['data'] = $data;
                $out['success'] = 1;                
            }else{
                $out['data'] = $data;
                $out['success'] = 0;
               
            } 
            $this->ajaxReturn($out); 

          }
    }
    // 
    public function noticelist(){
        $id = I('request.version',1,'intval');
        $proId = I('request.proId',0,'intval');
        $page = I('request.page',1,'intval');
        $pageSize = I('request.pageSize',20,'intval');
        if ($page == 0) $page = 1;
        if($pageSize == 0) $pageSize = 20;
        // dump(!$proid);
        if (!$proId) {
             $out['success'] = 0;
              $out['msg']=C('no_id');
              $this->ajaxReturn($out);
          }
        if ($id == 1) {
            $out['success'] = 1; 
            $where = array('proid'=>$proId, "pid" => 0,"sheild" =>0);
            $page = ($page - 1) * $pageSize.",".$pageSize;
            // dump($pageSize);
            $out['data'] = M('pro_notice')->where($where)->order('add_time desc')->limit($page)->select();

            $this->ajaxReturn($out);
        }

    }
    //资讯详情数据
     public function noticeOne(){
        $id = I('request.version',1,'intval');
        $noticeId = I('request.noticeId',0,"intval");
        // dump(!$proid);
        if (!$noticeId) {
             $out['success'] = 0;
              $out['msg']=C('no_id');
              $this->ajaxReturn($out);
          }
        if ($id == 1) {
            $out['success'] = 1; 
            $where = array('id'=>$noticeId);
            // dump($pageSize);
            $data = M('pro_notice')->where($where)->find();
            $data['add_time'] = date('Y-m-d H:i:s',$data['add_time']);
            $where = array('pid'=>$noticeId);
            // dump($where);
            $son = M('pro_notice')->field('id,content,add_time,uid,author')->where($where)->select();
            $data['son'] = $son;
            $out['data'] = $data;
            $this->ajaxReturn($out);
        }

    }
     // 回复资讯
    public function noticeBack(){
        $id = I('request.version',1,'intval');
        $uid = I('request.userId',0,'intval');
        $author = I('request.nickname');
        $nid = I('request.noticeId',0,'intval');
        $content = I('request.content');

        if ($id == 1) {
          if (!$uid ||  !$nid) {
             $out['success'] = 0;
              $out['msg']=C('no_id');
              $this->ajaxReturn($out);
          }
          $arr=array(         
          'uid'=>$uid,
          'add_time'=>time(),
          'author'=>$author,
          "content" =>$content,
          "pid"=>$nid
          );
          $data = _vialg($arr);//检查数据是否含有关键字
          // dump($data);
          $bool = 0;
          if (is_null($data)) {
            $bool = 1;
          }
          // dump($arr);
          //判断用户输入的内容和标题是否有后台设置不允许的单词
          
          if ($bool) {
            $arr['sheild'] = 0;
          }
          $out['success'] = 1; 
           //判断是查询那个表中的内容          
          
          $for = M('pro_notice')->add($arr);

          $arr['id'] = $for;
          $out['data'] = $arr;
          $data['success'] = 1;                    
          $this->ajaxReturn($out);
        }


    }
        // 邻里拼车列表
    public function neighbour(){
      // $data = sendMsg('18691988421','测试看看成功不');
      // dump($data);
        $id = I('request.version',1,'intval');
        $proId = I('request.proId',0,'intval');
        $type = I('request.type',0,'intval');
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
            if ($type) {
              $table = "pro_activity";
            }else {$table = "pro_car";}
            $out['success'] = 1; 
            // $where = array('proid'=>$proId, "pid" => 0,"sheild" =>0);
            $where = "proid = $proId and pid = 0 and sheild = 0 and pass_time >".time();
            $page = ($page - 1) * $pageSize.",".$pageSize;
            $field = "id,title,content,pic,author,add_time,views";
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
        // 邻里拼车添加
    public function neighbourAdd(){
        $id = I('request.version',1,'intval');
        $proId = I('request.proId',0,'intval');
        $type = I('request.type',0,'intval');
        $arr['title'] = maskWord(I('request.title'));
        $arr['content'] = maskWord(I('request.content'));
        $arr['pass_time'] = strtotime(I('request.passTime'));
        $arr['uid'] = I('request.userId',0,'intval');
        $arr['author'] = I('request.userName');
        $arr['pic'] = I('request.picture');
        $arr['pid'] = I('request.pid',0,'intval');
        // dump(!$proid);
        if (!$proId) {
              $out['success'] = 0;
              $out['msg']=C('no_id');
              $this->ajaxReturn($out);
          }
        if ($id == 1) {
            // dump($arr);die();
            $arr['add_time'] = time();
            if ($type) {
              $table = "pro_activity";
            }else {$table = "pro_car";}
            
            // dump($pageSize);
            $bool = M($table)->add($arr);
           
            if ($bool) {
              $out['success'] = 1; 
              if($arr['pid'] != 0){
                  $out['msg']='回复成功';
              }else{
                 $out['msg']='发布成功';
              }
              
            }else{
               $out['success'] = 0;
              $out['msg']='提交失败';
              
            }

            $this->ajaxReturn($out);
        }
    }
    // 物管信息添加
    public function propertyAdd(){
        $id = I('request.version',1,'intval');
        $proId = I('request.proId',0,'intval');
        $type = I('request.type',0,'intval');
        $arr['title'] = maskWord(I('request.title'));
        $arr['content'] = maskWord(I('request.content'));
        $arr['pass_time'] = strtotime(I('request.passTime'));
        $arr['uid'] = I('request.userId',0,'intval');
        $arr['owner'] = I('request.userName');
        $arr['pic'] = I('request.picture');
        $arr['address'] = I('request.address');
        $arr['pid'] = I('request.pid',0,'intval');
        // dump(!$proid);
        if (!$arr['uid']) {
              $out['success'] = 0;
              $out['msg']=C('no_id');
              $this->ajaxReturn($out);
          }
        if ($id == 1) {
            // dump($arr);die();
            $arr['time'] = time();
            $table = $this->changeTable($type);
            
            // dump($pageSize);
            // dump($table);
            // dump($arr);
            $bool = M($table)->add($arr);
            $out['data'] = $bool;
            if ($bool) {
              $out['success'] = 1; 

              if($arr['pid'] != 0){
                  $out['msg']='回复成功';
              }else{
                 $out['msg']='发布成功';
              }
              
            }else{
               $out['success'] = 0;
              $out['msg']='提交失败';
              
            }

            $this->ajaxReturn($out);
        }
    }
         // 物管信息
    public function property(){
      // $data = sendMsg('18691988421','测试看看成功不');
      // dump($data);
        $id = I('request.version',1,'intval');
        $uid = I('request.userId',0,'intval');
        $type = I('request.type',0,'intval');
        $page = I('request.page',1,'intval');
        $pageSize = I('request.pageSize',20,'intval');
        if ($page == 0) $page = 1;
        if($pageSize == 0) $pageSize = 20;
        // dump(!$proid);
        if (!$uid) {
             $out['success'] = 0;
              $out['msg']=C('no_id');
              $this->ajaxReturn($out);
          }
        if ($id == 1) {
            $out['success'] = 1;
            $out['msg'] = "";
            $table = $this->changeTable($type);
            // dump($table);
            // $where = array('proid'=>$proId, "pid" => 0,"sheild" =>0);
            $where = "pid = 0 and uid = $uid and pass_time >".time();
            // dump($where);
            $page = ($page - 1) * $pageSize.",".$pageSize;
            $field = "rid,owner as name,title,content,time,pic";//
            // dump($pageSize);
            $data = M($table)->field($field)->where($where)->order('time desc')->limit($page)->select();
            // $sql = "select * from ".C('DB_PREFIX')."pro_repair where pid = 0 and uid = $uid and pass_time >".time();
            // dump($sql);
            // $data = M()->query($sql);
            // dump($data);
            foreach ($data as $k => $v) {
                $v['time'] = date('Y-m-d H:i:s',$v['time']);
                $data[$k] =$v;
            }
            $out['data'] = $data;

            $this->ajaxReturn($out);
        }

    }
    private function changeTable($type){
        switch ($type) {
          case '1':
            $table = "pro_decorate";
            break;
          case '2':
            $table = "pro_complaints";
            break;          
          default:
             $table = "pro_repair";
            break;
        }
        return $table;
    }
    
  
}
