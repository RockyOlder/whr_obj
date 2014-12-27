<?php

// 对密码进行加密
function change($salt = "", $password = '') {
    // dump
    if ($password == '') {
        $password = md5(I('post.password'));
    }
    // var_dump($password);die();
    if (!empty($salt)) {
        // var_dump(md5($salt.$password));die;
        return md5($salt . $password);
    } else {
        return $password;
    }
}

// 对json数据的处理
function data() {
    $data = $_POST['json'];
    // var_dump($data);die();
    return $data = json_decode($data, true);
}

function _vialg($value) {

    $sbust = implode(",", $value);
    $word = D('ProKeyword');
    $wordlist = $word->where("id=1")->find();
    $list = json_decode($wordlist['pname']);
    foreach ($list as $v) {
        if (strstr($sbust, $v)) {
            $res = $v . "是关键字";
        }
    }
    return $res;
}
function initPage($totalRows, $listRows=8, $parameter = array()){
	$page=new \Think\Page($totalRows,$listRows,$parameter);
    $page->setConfig('prev',C('PAGER_CONFIG.prev'));
    $page->setConfig('next',C('PAGER_CONFIG.next'));
    $page->setConfig('first',C('PAGER_CONFIG.first'));
    $page->setConfig('last',C('PAGER_CONFIG.last'));
    $page->setConfig('theme',C('PAGER_CONFIG.theme'));
    $show=$page->show();
   	$currentPage=empty($_GET['p']) ? 1 : intval($_GET['p']);
    if($currentPage > $page->totalPages){
    	$_GET['p']=$page->totalPages;
    	$page=new \Think\Page($totalRows,$listRows,$parameter);
    	$page->setConfig('prev',C('PAGER_CONFIG.prev'));
	   	$page->setConfig('next',C('PAGER_CONFIG.next'));
	   	$page->setConfig('first',C('PAGER_CONFIG.first'));
	   	$page->setConfig('last',C('PAGER_CONFIG.last'));
	   	$page->setConfig('theme',C('PAGER_CONFIG.theme'));
    	$show=$page->show();
    }
	return $page;
}

//降低数据维度
function reduce_arr_dimension($arr){
	foreach ($arr as $arrItem){
		foreach ($arrItem as $subArrItem){
			$arrResult[]=$subArrItem;
		}
	}
	return $arrResult;
}

/*
 * 二维数组去重
 * $key参数为空时默认以二维数组中第1个子数组中的第一个索引作为$key值
 */
function assoc_unique($array2D, $key=null){
	if(!$key && $array2D){
		$outerKeys = array_keys($array2D);
		$innerKeys = array_keys($array2D[$outerKeys[0]]);
		$key=$innerKeys[0];
	}
    $tmp_arr = array();
    foreach($array2D as $k => $v) {
	    if(in_array($v[$key], $tmp_arr))//搜索$v[$key]是否在$tmp_arr数组中存在，若存在返回true
	    unset($array2D[$k]);
	    else
	    array_push($tmp_arr,$v[$key]);
    }
    sort($array2D);
    return $array2D;
}