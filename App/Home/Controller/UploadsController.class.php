<?php
namespace Home\Controller;
use Home\Controller\IsloginController;
/**
* 城市管理页面
*/
class UploadsController extends IsloginController
{
	function index(){
		dump($_SERVER['HTTP_HOST']);
// 		$data=$this->fullcity();
		//dump($data);
		$this->display();
	}
	
   public function upload(){
     if (!empty($_FILES)) {
     	// dump($_FILES);
            //图片上传设置
            $config = array(
				'maxSize' => 3145728,
				'rootPath' => './Uploads/',
				'savePath' => '',
				'saveName' => array('uniqid',''),
				'exts' => array('jpg', 'gif', 'png', 'jpeg'),
				'autoSub' => true,
				'subName' => array('date','Ymd'),
				);
            $upload = new \Think\Upload($config);// 实例化上传类
            $more = $upload->upload();
            //判断是否有图
            if($more){
                // $h =700;
                // $image = new \Think\Image();
                // $thumb_file = './Uploads/' . $file['savepath'] . $file['savename'];//图片的保存路径
                // $save_path = './Uploads/' .$file['savepath']. $h."_" . $file['savename'];
                // $image->open( $thumb_file )->thumb( $h, $h )->save( $save_path ); //将图片压缩并保存
            	// dump($images);die();
                $info='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/Uploads/'.$more['Filedata']['savepath'].$more['Filedata']['savename'];
                //返回文件地址和名给JS作回调用
                // $this->ajaxReturn($info);
                // $info='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/Uploads/'.$file['savepath']. $v.'_' .$file['savename'];
                echo $info;die();
            }
            else{
                $this->error($upload->getError());//获取失败信息
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
                'savePath' => 'list/',
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
                    $this->ajaxReturn($out);info;die();
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
                'savePath' => 'photo/',
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
