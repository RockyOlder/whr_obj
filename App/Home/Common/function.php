<?php 
// 检查用户是否有权限访问
function checkpermission(){
	$go=MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
    $auth = new \Think\Auth();
    $check = $auth->check($go, session('admin.id'));
   	
    return $check;
}

function formantpost(){
	$_POST['pass_time'] = strtotime($_POST['pass_time']);
	// dump($_POST);
	$k=array_keys($_POST);
	// dump($k);
	$v = array_values($_POST);
	// dump($v);
	$sk = "";
	foreach ($k as $k1 => $v1) {

		if ($k1<3) {			
			continue;
		}
		// dump($v1);
		// dump($v[$k]);
		$sk .= $v1."='".$v[$k1]."',";
	}
	$sk = substr($sk, 0,-1);
	// dump($sk);die();
	return $sk;
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
        // dump($v[$v1]);
        $sk .= "`".$v1."`='".$v[$k1]."',";
    }
    $sk = substr($sk, 0,-1);
    // dump($sk);die();
    return $sk;
}
