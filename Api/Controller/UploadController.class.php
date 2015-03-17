<?php
namespace Api\Controller;
use Api\Controller\CommonController;
class UploadController extends CommonController{
		function __construct()
	{

		 if (!IS_API) {
	        	die("你无权访问该页面！");
	        }
	}
	
	//上传用户头像信息
    function upFace()
  
     {
     	$id = I('request.version',1,'intval');
      $uid = I('request.user_id',0,'intval');
      if ($uid == 0) {
          $out['msg']=C("no_id");
          $out['success']=0;
          $this->ajaxReturn($out);
      }
     	// dump($id);die('my');
     	if ($id == 1){
          if (!empty($_FILES)) 
        {
           $out['url'] = null;
           $config = array(
                'maxSize' => 3145728,
                'rootPath' => './Uploads/',
                'savePath' => 'face/',
                'saveName' => array('uniqid',''),
                'exts' => array('jpg', 'gif', 'png', 'jpeg'),
                'autoSub' => true,
                'subName' => array('date','Ymd'),
                );

            $upload = new \Think\Upload($config);// 实例化上传类                  
            $info = $upload->upload();
            if($info){
                $out['path']='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'Uploads/'.$info['file_upload']['savepath'].$info['file_upload']['savename'];
                $image = new \Think\Image();

                foreach($info as $file) {
                    $out['success'] = 1;
                    $thumbWidth = array('url'=>150);
                    $thumb_file = './Uploads/' . $file['savepath'] . $file['savename'];
                    foreach ($thumbWidth as $k=> $v) {
                       $save_path = './Uploads/' .$file['savepath']. $v."_" . $file['savename'];
                        $image->open( $thumb_file )->thumb( $v, $v )->save( $save_path );
                        $out[$k]='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'Uploads/'.$file['savepath']. $v.'_' .$file['savename'];
                        
                        $arr=array('face'=>$out[$k],'user_id'=>$uid);
                        $bool = M('user')->save($arr);
                        // $bool = M()->query($sql);
                        if (!$bool) {
                            $out['success'] = 0;
                            $out['msg']="数据库写入失败";
                        }
                    }
                    $url = $out['url'];
                //$this->ajaxReturn($out);
               }
            
            }else{
                    //echo $this->error($upload->getError());
                    $out['success'] = 0;

                    $out['msg'] = $upload->getError();
                }
        }else{
          $out['success'] = 0;
          $out['url'] = null;
          $out['msg'] = "没有上传文件";
        }               
              
        $this->ajaxReturn($out);
     	}
     }
      
     
     //上传文件信息
     function upload()
     
     {
     
     	  $id = I('request.version',1);     
        // dump($id);die('my');
        if ($id == 1){
            $out['data'] = null;
               if (!empty($_FILES)) 
        {
           
           $config = array(
                'maxSize' => 3145728,
                'rootPath' => './Uploads/',
                'savePath' => 'file/',
                'saveName' => array('uniqid',''),
                'exts' => array('jpg', 'gif', 'png', 'jpeg'),
                'autoSub' => true,
                'subName' => array('date','Ymd'),
                );

            $upload = new \Think\Upload($config);// 实例化上传类                  
            $info = $upload->upload();
            if($info){
                $out['path']='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'Uploads/'.$info['file_upload']['savepath'].$info['file_upload']['savename'];
                $image = new \Think\Image();

                foreach($info as $file) {
                    $out['success'] = 1;
                    $thumbWidth = array('data'=>400);
                    $thumb_file = './Uploads/' . $file['savepath'] . $file['savename'];
                    foreach ($thumbWidth as $k=> $v) {
                       $save_path = './Uploads/' .$file['savepath']. $v."_" . $file['savename'];
                        $image->open( $thumb_file )->thumb( $v, $v )->save( $save_path );
                        $out[$k]='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'Uploads/'.$file['savepath']. $v.'_' .$file['savename'];
                        
                        
                    }
                    $out['success'] = 1;
                    $out['msg'] = "上传成功";
                //$this->ajaxReturn($out);
               }
            
            }else{
                    //echo $this->error($upload->getError());
                    $out['success'] = 0;

                    $out['msg'] = $upload->getError();
                }
        }else{
          $out['success'] = 0;

          $out['msg'] = "没有上传文件";
        }               
              
        $this->ajaxReturn($out);
        }
     
     }

   
  
}
