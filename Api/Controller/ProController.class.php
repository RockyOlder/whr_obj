<?php
namespace Api\Controller;
use Api\Controller\CommonController;
class ProController extends CommonController {
  public $tem=array();
    /**
     * [notice 获取公告的内容]
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-03-26T10:01:34+0800
     * @return [type]                   [description]
     */
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
            // $where = array('proid'=>$proId,'pid'=>0);
            $where = "vid in(0,$proId) and pid = 0";
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
    /**
     * [noticelist 社区咨询列表]
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-03-26T10:01:48+0800
     * @return [type]                   [description]
     */
    public function noticelist(){
        $id = I('request.version',1,'intval');
        $proId = I('request.proId',0,'intval');
        $vid = I('request.vid',0,'intval');
        $userId = I('request.userId',0,'intval');
        $search = I('request.search');
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
            if ($search) {
              $where ="vid in (0,$vid) and proid = $proId and pid = 0 and sheild = 0 and ( title like '%$search%' or content like '%$search%')";
            }
            // 查找出用户的id
            if ($userId) {
                //查找用户的参与的id
                $w = array('uid'=>$userId);
                $pid = M('pro_notice')->distinct(true)->field('pid')->where($w)->select();
                //dump($pid);
                foreach ($pid as $k => $v) {
                  $tem[] = $v['pid'];
                }
                $where = "id in (".implode(',', $tem).") and sheild = 0";
                if ($search) {
                  $where .=' and title like %'.$search.'%';
                }
            }
            
            // dump($where);
            $page = ($page - 1) * $pageSize.",".$pageSize;
            // dump($pageSize);
            $field = "id,title,content,add_time,author,pic,comment_num";
             $data= M('pro_notice')->field($field)->where($where)->order('add_time desc')->limit($page)->select();
             // dump(M('pro_notice')->getLastSql());
             if ($data) {
                 foreach ($data as $k => $v) {
                 $v['add_time'] = date('m-d',$v['add_time']);
                 // $v['content'] = strip_tags($v['content']);
                 $v['content'] = htmlspecialchars_decode($v['content']);
                 $v['content'] = str_replace('&nbsp;', '', $v['content']);
                 $v['content'] = strip_tags($v['content']);
                 $data[$k]=$v;
               }
               $out['data'] = $data;
             }else{
                $out['data'] = array();
             }
             
            $this->ajaxReturn($out);
        }

    }
    
    /**
     * [noticeOne 资讯详情数据]
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-03-26T10:02:12+0800
     * @return [type]                   [description]
     */
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
            // dump($where);
            // 跟新物业咨询的浏览量
            M('pro_notice')->where($where)->setInc('views');
            // dump($pageSize);
            $data = M('pro_notice')->where($where)->find();
            $data['content'] = htmlspecialchars_decode($data['content']);
            $data['add_time'] = date('Y-m-d H:i:s',$data['add_time']);
            $where = array('pid'=>$noticeId,'sheild'=>0);
            // dump($where);
            $son = M('pro_notice')->field('id,content,add_time,uid,author')->where($where)->select();
            foreach ($son as $k => $v) {
              $v['add_time'] = date('Y-m-d H:i:s',$v['add_time']);
              $v['face'] = current(M('user')->field('face')->where(array('user_id'=>$v['uid']))->find());
              $son[$k]=$v;
            }
            $data['son'] = $son;
            $out['data'] = $data;
            $this->ajaxReturn($out);
        }

    }
     /**
      * [noticeBack 回复社区资讯]
      * @author xujun
      * @email  [jun0421@163.com]
      * @time   2015-03-26T10:02:22+0800
      * @return [type]                   [description]
      */
    public function noticeBack(){
        $id = I('request.version',1,'intval');
        $uid = I('request.userId',0,'intval');
        $author = I('request.nickname');
        $nid = I('request.noticeId',0,'intval');
        $content = maskWord(I('request.content'));

        if ($id == 1) {
          if (!$uid ||  !$nid) {
             $out['success'] = 0;
              $out['msg']=C('no_id');
              $this->ajaxReturn($out);
          }
          //跟新物业咨询的回复量
          $w = array('id'=>$nid);
          // dump($)
          M('pro_notice')->where($w)->setInc('comment_num');
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
        /**
         * [carList 邻里拼车列表]
         * @author xujun
         * @email  [jun0421@163.com]
         * @time   2015-03-26T10:02:40+0800
         * @return [type]                   [description]
         */
    public function carList(){
      // $data = sendMsg('18691988421','测试看看成功不');
      // dump($data);
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
              $out['data']=null;
              $this->ajaxReturn($out);
          }
        if ($id == 1) {
            $table = "pro_car";
            $out['success'] = 1; 
            // $where = array('proid'=>$proId, "pid" => 0,"sheild" =>0);
            $where = "vid = $proId and pid = 0 and sheild = 0 and pass_time >".time();
            
            $page = ($page - 1) * $pageSize.",".$pageSize;
            $field = "id,title,content,pic,author,add_time,views,uid";
            // dump($pageSize);
            $data = M($table)->field($field)->where($where)->order('add_time desc')->limit($page)->select();
            if ($data) {
              foreach ($data as $k => $v) {
              $v['add_time'] = date('Y-m-d H:i:s',$v['add_time']);
              $data[$k] =$v;
              }
            }else{$data = array();}
            $out['msg'] ="成功获取数据";
            $out['data'] = $data;          
            $this->ajaxReturn($out);
        }
    }
        /**
         * [activityList 邻里活动列表]
         * @author xujun
         * @email  [jun0421@163.com]
         * @time   2015-03-26T10:02:55+0800
         * @return [type]                   [description]
         */
    public function activityList(){
      // $data = sendMsg('18691988421','测试看看成功不');
      // dump($data);
      // echo strtotime('2015-03-15');
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
              $out['data']=null;
              $this->ajaxReturn($out);
          }
        if ($id == 1) {
            $table = "pro_activity";
            $out['success'] = 1; 
            // $where = array('proid'=>$proId, "pid" => 0,"sheild" =>0);
            $where = "vid = $proId and pid = 0 and sheild = 0 and pass_time >".time();
            $page = ($page - 1) * $pageSize.",".$pageSize;
            // dump($page);
            $field = "id,title,content,pic,author,add_time,views,uid";
            // dump($pageSize);
            $data = M($table)->field($field)->where($where)->order('add_time desc')->limit($page)->select();
            // dump($where);
            // dump($table);
            // dump($data);
            foreach ($data as $k => $v) {                
                $v['add_time'] = date('m-d',$v['add_time']);
                $data[$k] =$v;
            }
            // dump($data);
            $out['success'] = 1;
            $out['msg'] ="成功获取数据";
            $out['data'] = $data;          
            $this->ajaxReturn($out);
        }
    }
    /**
     * [carInfo 邻里拼车详情]
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-03-26T10:03:12+0800
     * @return [type]                   [description]
     */
    public function carInfo(){
        $id = I('request.version',1,'intval');
        $aid = I('request.actionId',0,'intval');
        // dump(!$proid);
        if (!$aid) {
             $out['success'] = 0;
              $out['msg']=C('no_id');
              $out['data']=null;
              $this->ajaxReturn($out);
          }
        if ($id == 1) {
            $table = "pro_car";
            // dump($table);
            $out['success'] = 1; 
            $w = array('id'=>$aid);
            // 更新浏览量
            M($table)->where($w)->setInc('views');
            // 搜索对应的详情
            
            $field ="id,title,content,pic,author,add_time,start_time,pass_time,views,phone,uid,address,number,more_pic";
            $data = M($table)->field($field)->where($w)->find();
            $data['add_time'] = date('m-d',$data['add_time']);
            $data['pass_time'] = date('Y-m-d H:i:s',$data['pass_time']);
            $w = array('pid'=>$aid);
            // dump($w);
            // dump($table);//查找所有的回复->field($field)
            $field = "id,content,author,add_time,uid";
            $son = M($table)->field($field)->where($w)->order('add_time asc')->select();
            // dump($son);die();
            $son = $this->getSon($table,$son);
            $data['son'] = $son;
            // dump($son);
            $out['data'] = $data;
            $out['success'] = 1;
            $out['msg'] = "成功获取数据";
            $this->ajaxReturn($out);
        }

    }
    /**
     * [activityInfo 邻里活动详情]
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-03-26T10:03:24+0800
     * @return [type]                   [description]
     */
    public function activityInfo(){
        $id = I('request.version',1,'intval');
        $aid = I('request.actionId',0,'intval');
        // dump(!$proid);
        if (!$aid) {
             $out['success'] = 0;
              $out['msg']=C('no_id');
              $out['data']=null;
              $this->ajaxReturn($out);
          }
        if ($id == 1) {
            $table = "pro_activity";
            // dump($table);
            $out['success'] = 1; 
            // 搜索对应的详情
            $w = array('id'=>$aid);
            // 更新浏览量
            M($table)->where($w)->setInc('views');
            
            $field = "id,title,content,pic,author,add_time,pass_time,views,number,address,more_pic,uid"; 
            // dump($w);           
            // dump($field);
            $data = M($table)->field($field)->where($w)->find();
            // dump(M($table)->getlastSql());
            // dump($data);
            $data['start_time'] = date('Y-m-d H:s',$data['add_time']);
            $data['end_time'] = date('Y-m-d H:s',$data['pass_time']);
            // dump($data);
            $out['data'] = $data;
            $out['success'] = 1;
            $out['msg'] = "成功获取数据";
            $this->ajaxReturn($out);
        }

    }
     /**
      * [actionSign 邻里活动报名]
      * @author xujun
      * @email  [jun0421@163.com]
      * @time   2015-03-26T10:03:38+0800
      * @return [type]                   [description]
      */
    public function actionSign(){
        $id = I('request.version',1,'intval');
        $aid = I('request.actionId',0,'intval');
        $uid = I('request.userId',0,'intval');       
        // dump(!$proid);
        if (!$aid || !$uid) {
             $out['success'] = 0;
              $out['msg']=C('no_id');
              $out['data']=null;
              $this->ajaxReturn($out);
          }
        if ($id == 1) {
             $arr = array(
              'aid'   =>  $aid,
              'uid'   =>  $uid,
              'phone' =>  I('request.userName'),
              'name'  =>  I('request.trueName')
              );
            $table = "pro_activity_sign";
            $bool =M($table)->where($arr)->find();
            if ($bool) {
              $out['msg'] = '你已经报名了';
              $out['success'] =0;
              $out['data'] = null;
              $this->ajaxReturn($out);
            }
            $arr['time'] = time();
            // dump($table);
            $out['success'] = 1; 
            $bool = M($table)->add($arr);
            if ($bool) {
              $out['success'] = 1;
              $out['data'] = $bool;
              $out['msg'] = "报名成功";
            }else{
              $out['success'] = 0;
              $out['data'] = $bool;
              $out['msg'] = "报名失败";
            }
            $this->ajaxReturn($out);
        }

    }
      /**
       * [isSign 检查邻里活动是否已经报名]
       * @author xujun
       * @email  [jun0421@163.com]
       * @time   2015-03-26T10:03:48+0800
       * @return boolean                  [description]
       */
    public function isSign(){
        $id = I('request.version',1,'intval');
        $aid = I('request.actionId',0,'intval');
        $uid = I('request.userId',0,'intval');       
        // dump(!$proid);
        if (!$aid || !$uid) {
             $out['success'] = 0;
              $out['msg']=C('no_id');
              $out['data']=null;
              $this->ajaxReturn($out);
          }
        if ($id == 1) {
             $arr = array(
              'uid'   =>  $uid,
              'aid' =>  $aid
              );
            $table = "pro_activity_sign";
            $bool =M($table)->where($arr)->find();
            if ($bool) {
              $out['msg'] = '你已经报名了';
              $out['success'] =1;
              $out['data'] = 1;
            }else{
              $out['msg'] = '你还没有报名了';
              $out['success'] =1;
              $out['data'] = 0;
            }            
            $this->ajaxReturn($out);
        }

    }
    /**
     * [delSign 邻里活动删除报名]
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-03-26T10:10:01+0800
     * @return [type]                   [description]
     */
    public function delSign(){
        $id = I('request.version',1,'intval');
        $aid = I('request.actionId',0,'intval');
        $uid = I('request.userId',0,'intval');       
        // dump(!$proid);
        if (!$aid || !$uid) {
             $out['success'] = 0;
              $out['msg']=C('no_id');
              $out['data']=null;
              $this->ajaxReturn($out);
          }
        if ($id == 1) {
             $arr = array(
              'uid'   =>  $uid,
              'aid' =>  $aid
              );
            $table = "pro_activity_sign";
            $bool =M($table)->where($arr)->delete();
            if ($bool) {
              $out['msg'] = '成功取消报名了';
              $out['success'] =1;
              $out['data'] = 1;
            }else{
              $out['msg'] = '取消报名失败';
              $out['success'] =1;
              $out['data'] = 0;
            }            
            $this->ajaxReturn($out);
        }

    }
        /**
         * [carAdd 邻里拼车添加]
         * @author xujun
         * @email  [jun0421@163.com]
         * @time   2015-03-26T10:10:11+0800
         * @return [type]                   [description]
         */
    public function carAdd(){
      //echo time('2015-03-15');die();
        $id = I('request.version',1,'intval');
        $proId = I('request.proId',0,'intval');
        //修改邻里拼车的时候获取数据
        $cid = I('request.id',0,"intval");
        $arr['title'] = maskWord(I('request.title'));
        $arr['content'] = maskWord(I('request.content'));
        $arr['vid'] = I('request.villageId');
        $arr['pass_time'] = strtotime(I('request.passTime'));
        $arr['start_time'] = I('request.startTime');
        $arr['add_time'] = time();
        $arr['uid'] = I('request.userId',0,'intval');
        $arr['author'] = $this->user['nickname'];
        $arr['address'] = I('request.address');
        $pic = uploadMore();
        if (!is_null($pic)) {
          $arr['more_pic'] = $pic;
          $pic = json_decode($pic,true);
          $arr['pic']=$pic[0]['path'];
        }          
          //dump($pic);die();
        $arr['number'] =  I('request.number',0,'intval');
        $arr['phone'] =  I('request.phone');
        $arr['pid'] = I('request.pid',0,'intval');
        $arr['proid'] = $proId;
       //dump($arr);die();
        if (!$proId && $arr['pid'] == 0) {
              $out['success'] = 0;
              $out['msg']=C('no_id');
              $this->ajaxReturn($out);
          }
        if ($id == 1) {
            // dump($arr);die();
            $arr['add_time'] = time();
            //查找用户所在小区
            $vid = M('user')->field('village_id,property_id')->where(array('user_id'=>$arr['uid']))->find();
            // dump($vid);
            if ($vid) {

              $arr['vid'] = $vid['village_id'];
              $arr['proid'] = $vid['property_id'];
            }
            if ($cid != 0) {
              $arr['id']=$cid;
              $bool = M("ProCar")->save($arr);
            }else{
              $bool = M("ProCar")->add($arr);
            }
            // dump(M('ProCar')->getlastSql());
           // dump($bool);
            if ($bool) {
              $out['success'] = 1; 
              if($arr['pid'] != 0){
                  $out['msg']='回复成功';
              }elseif($cid != 0){
                 $out['msg']='修改成功';
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
    
        /**
         * [activityAdd 发布邻里活动]
         * @author xujun
         * @email  [jun0421@163.com]
         * @time   2015-03-26T10:10:22+0800
         * @return [type]                   [description]
         */
    public function activityAdd(){
        $id = I('request.version',1,'intval');
        $proId = I('request.proId',0,'intval');
        $type = I('request.type',0,'intval');
        $arr['title'] = maskWord(I('request.title'));
        $arr['proid'] = I('request.proId',0,'intval');
        $arr['vid'] = I('request.villageId',0,'intval');
        $arr['content'] = maskWord(I('request.content'));
        $passTime =I('request.passTime');
        $arr['pass_time'] = strtotime($passTime);
        $arr['add_time'] = strtotime(I('request.startTime'));
        $arr['address'] = I('request.address');
        $arr['uid'] = I('request.userId',0,'intval');
        $arr['author'] = I('request.userName');
        $arr['phone'] = I('request.phone');

        $pic = uploadMore();
        if (!is_null($pic)) {
          $arr['more_pic'] = $pic;
          $pic = json_decode($pic,true);
          $arr['pic']=$pic[0]['path'];
        }
        $number = I('request.number',0,'intval');
        if ($number != 0) {
              $arr['number'] = $number;
            }
        // dump(!$proid);
        if (!$proId) {
              $out['success'] = 0;
              $out['msg']=C('no_id');
              $this->ajaxReturn($out);
          }
        if ($id == 1) {   
            //查找用户所在小区
            $vid = M('user')->field('village_id,property_id')->where(array('user_id'=>$arr['uid']))->find();
            // dump($vid);
            if ($vid) {

              $arr['vid'] = $vid['village_id'];
              $arr['proid'] = $vid['property_id'];
            }         
            // dump($arr);die();
            $arr['add_time'] = time();
            $table = 'pro_activity';
            
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
    /**
     * [propertyAdd 物管信息发布]
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-03-26T10:10:33+0800
     * @return [type]                   [description]
     */
    public function propertyAdd(){
        $id = I('request.version',1,'intval');
        $proId = I('request.proId',0,'intval');
        $type = I('request.type',0,'intval');
        $arr['title'] = maskWord(I('request.title'));
        $arr['content'] = maskWord(I('request.content'));
        $arr['uid'] = I('request.userId',0,'intval');
        $arr['owner'] = I('request.userName');
        $arr['author'] = I('request.userName');
        // $arr['pic'] = I('request.picture');

        $arr['address'] = I('request.address');
        $arr['pid'] = I('request.pid',0,'intval');

        $phone = I('request.phone');
        if ($_FILES) {
          $arr['pic'] = uploadMore();
          //dump($arr);die();
        }else{
          $arr['pic'] = '';
        }       
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
            if ($type != 2 && $phone) {
              $arr['phone'] = $phone;
            }
            
            // dump($pageSize);
            // dump($table);
            // 查找到用户的物业id
            $property = M('user')->field('property_id,village_id')->where(array('user_id'=>$arr['uid']))->find();
            // dump($property);
            $arr['proid'] = $property['property_id'];
            $arr['vid'] = $property['village_id'];
            // dump($table);
            // dump($arr);die();
            $bool = M($table)->add($arr);
            $out['data'] = $bool;
            if ($bool) {
              $out['success'] = 1; 

              if($arr['pid'] != 0){
                   //如果pid不等于0的时候那么提交的时候讲计数加个一
                  M($table)->where(array('id'=>$arr['pid']))->setInc('num');
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
         /**
          * [property 物管信息列表]
          * @author xujun
          * @email  [jun0421@163.com]
          * @time   2015-03-26T10:10:55+0800
          * @return [type]                   [description]
          */
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
            $where = "pid = 0 and uid = $uid";
            // dump($where);
            $page = ($page - 1) * $pageSize.",".$pageSize;
            $field = "id,owner as name,title,content,time,pic,num";//
            // dump($pageSize);
            $data = M($table)->field($field)->where($where)->order('time desc')->limit($page)->select();
            // dump(M($table)->getlastSql());
            // dump($data);
            // $sql = "select * from ".C('DB_PREFIX')."pro_repair where pid = 0 and uid = $uid and pass_time >".time();
            // dump($sql);
            // $data = M()->query($sql);
            // dump($data);
            if($data){
              foreach ($data as $k => $v) {
                $w = array('pid'=>$v['id']);
                $new = M($table)->field('time')->where($w)->order('time desc')->limit(1)->find();
                //dump($time);
                
                if ($new) {
                  $new = current($new);
                }else{
                  $new = 0;
                }
                $v['new'] = $new;
                $v['time'] = date('Y-m-d H:i:s',$v['time']);
                $data[$k] =$v;
              }
            }

            $out['data'] = $data;

            $this->ajaxReturn($out);
        }

    }
    /**
     * [propertyInfo 物管信息详情]
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-03-26T10:11:14+0800
     * @return [type]                   [description]
     */
      public function propertyInfo(){
      // $data = sendMsg('18691988421','测试看看成功不');
      // dump($data);
        $id = I('request.version',1,'intval');
        $msgId = I('request.msgId',0,'intval');
        $type = I('request.type',0,'intval');
        if ($page == 0) $page = 1;
        if($pageSize == 0) $pageSize = 20;
        // dump(!$proid);
        if (!$msgId) {
             $out['success'] = 0;
              $out['msg']=C('no_id');
              $this->ajaxReturn($out);
          }
        if ($id == 1) {
            $out['success'] = 1;
            $out['msg'] = "成功";
            $table = $this->changeTable($type);
            $where = "id = $msgId";

            $data= M($table)->where($where)->find();
            //dump($data);
            $data['time'] = date('Y-m-d H:i:s',$data['time']);
            //dump($data);
            // 查找出来用户的回复和物业的回复
            $field="id,time,content,owner,uid,pid";
            $son = M($table)->field($field)->where(array('pid'=>$data['id'],'sheild'=>0))->order('time asc')->select();
            if (!$son) {
              $son = array();
            }else{
              foreach ($son as $k => $v) {
                $fice = M('user')->field('face')->where(array('user_id'=>$v['uid']))->find();
                if ($fice) {
                  $v['pic'] = current($fice);
                }else{
                  $v['pic'] = "";
                }
                $v['time'] = date('Y-m-d H:i:s',$v['time']);
                $son[$k]=$v;
              }
            }
            $data['son'] = $son;
            $out['data'] = $data;

            $this->ajaxReturn($out);
        }

    }
    /**
     * [propertyDel 删除物管信息]
     * @author xujun
     * @email  [jun0421@163.com]
     * @time   2015-03-26T10:13:55+0800
     * @return [type]                   [description]
     */
    public function propertyDel(){
      // $data = sendMsg('18691988421','测试看看成功不');
      // dump($data);
        $id = I('request.version',1,'intval');
        $msgId = I('request.msgId',0,'intval');
        $type = I('request.type',0,'intval');
        if ($page == 0) $page = 1;
        if($pageSize == 0) $pageSize = 20;
        // dump(!$proid);
        if (!$msgId) {
             $out['success'] = 0;
              $out['msg']=C('no_id');
              $this->ajaxReturn($out);
          }
        if ($id == 1) {
            $out['success'] = 1;
            $out['msg'] = "成功";
            $table = $this->changeTable($type);
            $where = "id = $msgId";
            //删除用户的发布
            $data= M($table)->delete($msgId);
            //删除用户和物业的回复
            $bool = M($table)->where(array('pid'=>$msgId))->delete();
            if($data){
              $out['data'] = $data;
              $out['msg'] = '成功';
              $out['success'] = 1;
            }else{
              $out['data'] = 0;
              $out['msg'] = '失败';
              $out['success'] = 0;
            }
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
    private function twoTable($type){
        switch ($type) {
          case '1':
            $table = "pro_activity";
            break;         
          default:
             $table = "pro_car";
            break;
        }
        return $table;
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
      //单张图片上传
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
