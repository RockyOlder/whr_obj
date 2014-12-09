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