<?php
namespace Mobile\Controller;
use Think\Controller;
/**
* 上传
*/
class UploadsController extends Controller
{  
    function upload(){
        if ($_FILES) {
          $config = array(
          'maxSize' => 3145728,
          'rootPath' => './default/Uploads/',
          'savePath' => '',
          'saveName' => array('uniqid',''),
          'exts' => array('jpg', 'gif', 'png', 'jpeg'),
          'autoSub' => true,
          'subName' => array('date','Ymd')
          );
          $ftpConfig = array(
          'host' => '120.24.214.88', //服务器
          'port' => 21, //端口
          'timeout' => 90, //超时时间
          'username' => 'www', //用户名
          'password' => '4398eea99' //密码 
          );
          $upload = new \Think\Upload($config,'Ftp',$ftpConfig);// 实例化上传类

          $upload->maxSize = 3145728 ;// 设置附件上传大小
          $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
          $upload->rootPath = './default/Uploads/vip'; // 设置附件上传根目录
          $upload->savePath = ''; // 设置附件上传（子）目录
          // 上传文件
          $info = $upload->upload();
          // dump($info);
          // die();
          if(!$info) {// 上传错误提示错误信息
                echo $upload->getError();
          }else{// 上传成功       
              $path='http://120.24.214.88/Uploads/vip'.$info['Filedata']['savepath'].$info['Filedata']['savename'];  
              $this->ajaxReturn($path);
          }
        }
    }

    public function listUpload()
    {
      if (!empty($_FILES)) 
        {
        // dump($_FILES);
            //图片上传设置
            $config = array(
                'maxSize' => 3145728,
                'rootPath' => './Uploads/',
                'savePath' => 'vip/',
                'saveName' => array('uniqid',''),
                'exts' => array('jpg', 'gif', 'png', 'jpeg'),
                'autoSub' => true,
                'subName' => array('date','Ymd'),
                );
            $upload = new \Think\Upload($config);// 实例化上传类
            $info = $upload->upload();
            //判断是否有图
            if($info){
                // 实例化图片处理类
                $image = new \Think\Image();
                foreach($info as $file) {
                    $thumbWidth = array('mid'=>700,'min'=>200);//多张图片压缩的大小限制
                    $thumb_file = './Uploads/' . $file['savepath'] . $file['savename'];//图片的保存路径
                    foreach ($thumbWidth as $k=> $v) {
                       $save_path = './Uploads/' .$file['savepath']. $v."_" . $file['savename'];
                        $image->open( $thumb_file )->thumb( $v, $v )->save( $save_path ); //将图片压缩并保存
                        $out[$k]='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/Uploads/'.$file['savepath']. $v.'_' .$file['savename'];//保存图片压缩House的路径
                        
                    }
                    $out['path']='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/Uploads/'.$file['savepath'] .$file['savename'];//组合出原图片的路径
                    // json返回数据
                    $this->ajaxReturn($out);//info;die();
                }
            
            }else
            {
                $this->error($upload->getError());//获取失败信息
            }
        }
    }
    public function photo(){
     if (!empty($_FILES)) {
        // dump($_FILES);
            //图片上传设置
            $config = array(
                'maxSize' => 3145728,
                'rootPath' => './Uploads/',
                'savePath' => 'vip/',
                'saveName' => array('uniqid',''),
                'exts' => array('jpg', 'gif', 'png', 'jpeg'),
                'autoSub' => true,
                'subName' => array('date','Ymd'),
                );

            $upload = new \Think\Upload($config);// 实例化上传类                  
            $info = $upload->upload();
            if($info){
                $out['path']='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/Uploads/'.$info['file_upload']['savepath'].$info['file_upload']['savename'];
                $image = new \Think\Image();

                foreach($info as $file) {
                    $thumbWidth = array('mid'=>700);
                    $thumb_file = './Uploads/' . $file['savepath'] . $file['savename'];
                    foreach ($thumbWidth as $k=> $v) {
                       $save_path = './Uploads/' .$file['savepath']. $v."_" . $file['savename'];
                        $image->open( $thumb_file )->thumb( $v, $v )->save( $save_path );
                        $out[$k]='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/Uploads/'.$file['savepath']. $v.'_' .$file['savename'];
                      
                    }
                    $out['path']='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/Uploads/'.$file['savepath'] .$file['savename'];
                    $data = current($_FILES);
                    $arr = explode('.', $data['name']);
                    $out['name'] = $arr[0];
                $this->ajaxReturn($out);
            }
            
        }else{
                echo $this->error($upload->getError());
            }
    }
    }
    
   
}
