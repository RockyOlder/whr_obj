<?php 
// 对密码进行加密
function change($salt="",$password=''){
	// dump
	if ($password == '') {
		$password = md5(I('post.password'));
	}	
	// var_dump($password);die();
	if (!empty($salt)) {
		// var_dump(md5($salt.$password));die;
		return md5($salt . $password);
	}else {
		return $password;
	}
}
// 对json数据的处理
 function data(){
	$data = $_POST['json'];
	// var_dump($data);die();
	return $data = json_decode( $data, true );
}
