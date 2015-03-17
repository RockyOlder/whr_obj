<?php
function formantpost($data){
	// dump($_POST);
	$k=array_keys($_POST);
	// dump($k);
	$v = array_values($_POST);
	// dump($v);
	$sk = "";
	foreach ($k as $k1 => $v1) {

		
		// dump($v1);
		// dump($v[$k]);
		$sk .= '`'.$v1."`='".$v[$k1]."',";
	}
	$sk = substr($sk, 0,-1);
	// dump($sk);die();
	return $sk;
}