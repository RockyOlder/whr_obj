<?php 
// 用分类获取所有的商品
 function getcate($cate){
   
   // 根据穿入的分类id查找父类的id
 	$sql = "select parent_id from ".C('DB_PREFIX')."type where type_id =".$cate;
 	// dump($sql);
 	$data = M()->query($sql);
 	// dump($data);
 	if ($data[0]['parent_id'] != 0 ) {
 		$str= '('.$cate.')';
 	}else{
 		// 搜索出所有的子分类id
 		$sql ="select type_id from ".C('DB_PREFIX')."type where parent_id =".$cate;
 		// 执行sql语句
 		$data = M()->query($sql);
 		// dump($data);
 		$str = "";
 		if (is_array($data)) {

 			foreach ($data as $k => $v) {
 				if($k == 0){
 					$str .= $v['type_id'];
 				}else{
 					$str .= ','.$v['type_id'];
 				}
 			}
 			// dump($str);die();
 		}
 		$str= '('.$str.')';
 	}
 	//查找分类下面的商店id
 	$sql = "select id from ".C("DB_PREFIX")."business where type in ".$str;
 	// dump($sql);
 	$data = M()->query($sql);
 	$strid = '';
 	// dump($data);
 	if (is_array($data)) {
 		foreach ($data as $k => $v) {
 			if($k == 0){
 					$strid .= $v['id'];
 				}else{
 					$strid .= ','.$v['id'];
 				}
 		}
 		if ($strid) {
 			$strid = '('.$strid.')';
 		} 		
 	}
 	return $strid; //返回所有的商店的id字符串
}


//获取订单的编号
function getOrderId(){
	 return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
}
// 更新用户的积分
function updateSource($oid){
	  // 给用户添加相应的积分
      $sql ="select totle,user_id from ".C('DB_PREFIX')."order where oid=$oid";
      $id = M()->query($sql);
      // dump($id);
      if ($id) {
        $order = current($id);
        $sorce = $order['totle'];
      }
      // 查询设置的积分规则
      $sql ="select is_price from ".C('DB_PREFIX')."system where id = '4'";
      $system =M()->query($sql);
      // dump($system);
      if ($system) {
        $system = current($system);
      }
      $sorce = floor($sorce * $system['is_price']);
      // dump($sou)
      $sql ="update ".C('DB_PREFIX')."user set source = source+$sorce where user_id =$order[user_id]";
      // dump($sql);
      M()->execute($sql);
}
//多张图片上传的方法
function uploadMore(){
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
      $upload->rootPath = './default/Uploads/'; // 设置附件上传根目录
      $upload->savePath = ''; // 设置附件上传（子）目录
      // 上传文件
      $info = $upload->upload();
      // dump($info);
      //die();
      if(!$info) {// 上传错误提示错误信息
      echo $upload->getError();
      }else{// 上传成功
           

            foreach($info as $file) {
                $out['path']='http://120.24.214.88/Uploads/'.$file['savepath'].$file['savename'];
                // $image = new \Think\Image();
                // $thumbWidth = array('mid'=>700);
                // $thumb_file = $out['path'];
                // // dump($thumb_file);die();
                // foreach ($thumbWidth as $k=> $v) {
                //    $save_path = 'http://120.24.214.88/Uploads/thumb' .$file['savepath']. $v."_" . $file['savename'];
                //     $image->open( $thumb_file )->thumb( $v, $v )->save( $save_path );
                //     $out[$k]='http://120.24.214.88/Uploads/thumb'.$file['savepath']. $v.'_' .$file['savename'];
                  
                // }                   
                $arr = explode('.', $file['name']);
                $out['name'] = $arr[0];
                $tem[] = $out;
            }
          return json_encode($tem);
      }
    }
}
    //单张图片上传的方法
function uploud(){
    if (!empty($_FILES)) 
        {
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
          $info = $upload->upload();
          if($info){
              $out['path']='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'Uploads/'.$info['file_upload']['savepath'].$info['file_upload']['savename'];
              $image = new \Think\Image();

              foreach($info as $file) {
                  $out['success'] = 1;
                  $thumbWidth = array('url'=>250);
                  $thumb_file = './Uploads/' . $file['savepath'] . $file['savename'];
                  foreach ($thumbWidth as $k=> $v) {
                     $save_path = './Uploads/' .$file['savepath']. $v."_" . $file['savename'];
                      $image->open( $thumb_file )->thumb( $v, $v )->save( $save_path );
                      $out[$k]='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/Uploads/'.$file['savepath']. $v.'_' .$file['savename'];
                      
                      $arr=array('face'=>$out[$k],'user_id'=>$uid);
                      $bool = M('user')->save($arr);
                      // $bool = M()->query($sql);
                      if (!$bool) {
                          $out['success'] = 0;
                          $out['msg']="数据库写入失败";
                      }
                  }
                  // dump($out);die();
                  return $out['url'];
              //$this->ajaxReturn($out);
             }
          
          }else{
                  //echo $this->error($upload->getError());
                  return '';
          }
      }else{
        return '';
      } 
}

    // 讲数组转化为字符串
function formant($arr ){
    // dump($_POST);
    $k=array_keys($arr);
    // dump($k);
    $v = array_values($arr);
    // dump($v);
    $sk = "";
    foreach ($k as $k1 => $v1) {
        // dump($v1);
        // dump($v[$k]);
        $sk .= "`".$v1."`='".$v[$k1]."',";
    }
    $sk = substr($sk, 0,-1);
    // dump($sk);die();
    return $sk;
}