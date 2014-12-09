<?php
namespace Api\Controller;
use Think\Controller;
class UploadController extends Controller {
		function __construct()
	{

		 if (!IS_API) {
	        	die("你无权访问该页面！");
	        }
	}
	
	//上传用户头像信息
    function upFace()
  
     {
     	$id = I('request.version',1);
      $uid = I('request.user_id',0);
      if ($uid == 0) {
          $out['msg']=C("no_id");
          $out['success']=0;
          $this->ajaxReturn($out);
      }
     	// dump($id);die('my');
     	if ($id == 1){
                // dump($_FILES);
               $config = array(
                    'maxSize'  => 3145728,
                    'rootPath' => './Upload/face/',
                    'savePath' => '',
                    'saveName' => array('uniqid',''),
                    'exts'     => array('jpg', 'gif', 'png', 'jpeg'),
                    'autoSub'  => true,
                    'subName'  => array('date','Ymd'),
                    );

               $upload = new \Think\Upload($config);// 实例化上传类
               
               $info = $upload ->upload();
               
                if(!$info) {// 上传错误提示错误信息
                    $out['msg'] = $upload->getError();
                    $out['success']=0;
               }else{// 上传成功 获取上传文件信息
                    $out['msg'] =  "上传成功"; 
                    $out['url'] =  $info['savepath'].$info['savename'];                    
                    $sql = "update ".C('DB_PREFIX')."user set face = ($out[url]) where user_id = $uid";
                    $out['success']=M()->query($sql);
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
                // dump($_FILES);
             $config = array(
                  'maxSize'  => 3145728,
                  'rootPath' => './Upload/file/',
                  'savePath' => '',
                  'saveName' => array('uniqid',''),
                  'exts'     => array('jpg', 'gif', 'png', 'jpeg'),
                  'autoSub'  => true,
                  'subName'  => array('date','Ymd'),
                  );

             $upload = new \Think\Upload($config);// 实例化上传类
             
             $info = $upload ->upload();
             
              if(!$info) {// 上传错误提示错误信息
                  $out['msg'] = $upload->getError();
                  $out['success']=0;
             }else{// 上传成功 获取上传文件信息
                  $out['msg'] =  "上传成功"; 
                  $out['success']=1;
                  $out['url'] =  $info['savepath'].$info['savename'];
             }               
             $this->ajaxReturn($out);
        }
     
     }

   
  
}
