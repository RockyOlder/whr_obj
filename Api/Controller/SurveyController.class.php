<?php
namespace Api\Controller;
use Think\Controller;
use Api\Controller\CommonController;
class SurveyController extends CommonController {
  public $tem=array();
 

        // 社区调查列表
    public function index(){
        $id = I('request.version',1,'intval');
        $proId = I('request.propertyId',0,'intval');
        $vid = I('request.vid',0,'intval');
        $userId = I('request.userId',0,'intval');
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
            $where = "vid in (0,$vid) and proid = $proId and sheild = 0";// and pass_time >".time();
            //dump($userId != 0);
            if ($userId != 0) {
                // 查找用户的参加的调查编号
                $w=array('uid'=>$userId);
                $id = M('pro_survey_sign')->distinct(true)->field('sid')->where($w)->select();
                //dump($id);
                if ($id) {
                  foreach ($id as $k => $v) {
                    $tem[] =$v['sid'];
                  }                  
                }
                $where = "sheild = 0 and id in (".implode(',', $tem).")";
            }
            //dump($where);
            $page = ($page - 1) * $pageSize.",".$pageSize;
            $field = "id,title,content,author,add_time,number,survey_verygood as best,survey_good as better,survey_general as good ,survey_nogood as bad,survey_bad as worst";
            // dump($pageSize);

            $data = M($table)->field($field)->where($where)->order('add_time desc')->limit($page)->select();
            if ($data) {
              foreach ($data as $k => $v) {
                $v['add_time'] = date('Y-m-d H:i:s',$v['add_time']);
                $data[$k] =$v;
              }
            }else{
              $data = array();
            }
            $out['data'] = $data;
            $this->ajaxReturn($out);
        }
    } 
    //闲置交换列表
    public function fetchList(){
      //dump(time('2015-05-10'));
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
            $where = "vid = $proId and sheild = 0 and pid = 0";
            if ($userId) {
              $where .= " and uid =".$userId;
            }
            // dump($where);die();
            $page = ($page - 1) * $pageSize.",".$pageSize;
            $field = "id,add_time,title,content,pic,author";
            // dump($pageSize);

            $data = M($table)->field($field)->where($where)->order('add_time asc')->limit($page)->select();
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
            if (is_null($data)) {
              $data=array();
              $out['msg'] = "失败";
            }else{
              $out['msg'] = "成功";
            }
            $out['data'] = $data;
            $this->ajaxReturn($out);
        }
    } 
    //闲置交换删除
    public function fetchDel(){
        $id = I('request.version',1,'intval');
       if ($id == 1) {
          $fetchId = I('request.fetchId',0,'intval');
          // dump(!$proid);
          $out['success'] = 0;
          $out['data']=null;
          if (!$fetchId) {
                $out['msg']=C('no_id');              
                $this->ajaxReturn($out);
            }
            // 删除数据
            $bool = M('pro_fetch')->delete($fetchId);
            if ($bool) {
              $out['success']=1;
              $out['msg']='成功删除';
            }        
              $out['data'] = $bool;
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
        // dump(I('request.content'))
        $content = maskWord(I('request.content'));
        $passTime = I('request.passTime');
        // dump($passTime);die();

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
                'vid'=>I('request.villageId',0,'intval'),
                'author'=>I('request.userName'),
                'content'=>$content,
                'title'=>$title,
                'price' => I('request.price'),
                'pid' =>I('request.pid'),
                'pass_time'=>strtotime($passTime),
                'phone' => I('request.phone')
                );
              //查找用户所在小区
            $vid = M('user')->field('village_id,property_id')->where(array('user_id'=>$arr['uid']))->find();
            // dump($vid);
            if ($vid) {
              $arr['proid'] = $vid['property_id'];
              $arr['vid'] = $vid['village_id'];
            }
              $pic = uploadMore();
              if (!is_null($pic)) {
                $arr['more_pic'] = $pic;
                $pic = json_decode($pic,true);
                $arr['pic']=$pic[0]['path'];
              }              
              // dump($arr);die();
                $data = M($table)->field('id')->where($arr)->find();
                // dump(!is_null($data));
                if (!is_null($data)) {
                    $out['data'] = $data;
                    $out['msg'] = '不能重复发布相同的信息';
                    $this->ajaxReturn($out);
                }
                $arr['add_time'] = time(); //加入添加的时间
                // dump($arr);
                // dump($table);
            $bool = M($table)->add($arr);
            // dump($bool);
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
              /*//更新浏览量
              M($table)->where($arr)->setInc('views');*/
              $field = "id,add_time,title,content,pic,author,phone,price,more_pic";
              $data = M($table)->field($field)->where($arr)->find();
            if ($data) {              
              $data['add_time'] = date('Y-m-d',$data['add_time']);              
              $out['success'] = 1;
              //获取交换详情的评论
              $field = "id,content,add_time,author,uid,type";
              $son = M($table)->field($field)->where(array('pid'=>$data['id']))->select(); 
              //dump($son);die();    
              $son = $this->getSon($table,$son);
            // dump($son);       
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

    /**

    *获取子集评论

    */
    private function getSon($table,$son){
        $num = 1;
        foreach ($son as $k => $v) {
            $v['level'] = $num++;
            $tem[] = $v;
            //dump($v);
            $this->initSon($table,$v);
            $son =$this->tem;
            $this->tem = array();
            //dump($son);die();
            if (!empty($son)) {
              foreach ($son as  $m) {
                $m['level'] = $num++;
                $tem[] =$m;
              }
            }
            
        }
        foreach ($tem as $k => $v) {
          $v['add_time'] = date('Y-m-d H:i:s',$v['add_time']);
          $w=array('user_id'=>$v['uid']);

          $face = M('user')->field('face')->where($w)->find();
          //dump($face);die();
          $v['face'] = current($face);
          $tem[$k] = $v;
        }
        return $tem;
    }
    /**

     * 邻里拼车获取评论数据

     */
    private function initSon($table,$v){
      //self::tem=array();
        //查找该回复是否有楼主回复
        $w1=array('pid'=>$v['id']);
        // dump($w1);
        $field = "id,content,author,add_time,uid,phone";
        $next = M($table)->field($field)->where($w1)->select();
        // dump($next);//die();
        if ($next) {
            foreach ($next as $k => $s) {
              //$next['add_time'] = date('Y-m-d H:i:s',$next['add_time']);
            
            $s['level'] = 2;
            $s['ptime'] =  date('Y-m-d H:i:s',$v['add_time']);
            $s['pauthor'] = $v['author'];
            $s['pcontent'] = $v['content'];
            $this->tem[] = $s;
            // dump($next);//die();
            $son= $this->initSon($table,$s);
            // dump($son);//die();
            if(isset($son['content'])){
              $this->tem[] = $son;
              //self::tem[]=$son;
            }
          }
        }
        
    }
            /**
         
         * //单张图片上传的方法
         * @author xujun
         * @email  [jun0421@163.com]
         * @time   2015-01-20T08:50:38+0800
         * @return [type]                   [description]
         
         */
function uploud(){
    if (!empty($_FILES)) 
        {
         $config = array(
              'maxSize' => 3145728,
              'rootPath' => './Uploads/',
              'savePath' => 'list/',
              'saveName' => array('uniqid',''),
              'exts' => array('jpg', 'gif', 'png', 'jpeg'),
              'autoSub' => true,
              'subName' => array('date','Ymd'),
              );

          $upload = new \Think\Upload($config);// 实例化上传类                  
          $info = $upload->upload();
          $image = new \Think\Image();
          // dump($info);
          foreach($info as $file) {
              $thumbWidth = array('url'=>250);
              $thumb_file = './Uploads/' . $file['savepath'] . $file['savename'];
              foreach ($thumbWidth as $k=> $v) {
                 $save_path = './Uploads/' .$file['savepath']. $v."_" . $file['savename'];
                  $image->open( $thumb_file )->thumb( $v, $v )->save( $save_path );
                  $out='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/Uploads/'.$file['savepath']. $v.'_' .$file['savename'];     
              }
         }
          return $out;         
      }else{
        return '';
      }
  }

}
