<?php
namespace Api\Controller;
use Think\Controller;
use Common\api\CClass\CU;
class SearchController extends Controller {
		function __construct()
	{

		 if (!IS_API) {
	        	die("你无权访问该页面！");
	        }
	}
	
	//根据首页的用户设置的喜好分类来搜索商品数据
  //没用
  
    function life()
  
     {
     	$id = I('request.version',1);
      $cityId = I('request.cityId',0,"intval");
     
      $areaId = I('request.areaId',0,"intval");
      //获取用户传递过来的分类id
      $search = I('request.search');
      $page = I('request.page',1,'intval');
      $pageSize = I('request.pageSize',20,'intval');
      if ($pageSize == 0) $pageSize =20;
      if ($page == 0) $page =1;
      $limit = " limit ".($page - 1)*$pageSize.",".$pageSize;
      // dump($limit);
      // 获取商品的分类id
     	if ($id == 1){
          
          $sql = "select lgid,lgname,lg.des,lg.list_pic,price,sold from ".C('DB_PREFIX')."business as b join ".C('DB_PREFIX')."life_goods as lg on lg.bid = b.id  WHERE 1=1 ";
          if ($cityId != 0) {
            $sql .="and b.city = $cityId ";
          }
          if ($areaId != 0) {
            $sql .="and b.area = $areaId ";
          }
          $sql .="and lgname like '%$search%' ";
          
          $sql .= $limit;
          $data = M()->query($sql);
          foreach ($data as $k => $v) {
            $v['is_my'] = "1";
            $data[$k] = $v;
          }
          /*// $sum = count($data);
          // if ($sum < $pageSize) { //如果数据库中的数据不能满足用户需求的话则在携程请求数
            // if (0) {
            // require_once("/xiec/API/CtripUnion.php");
            // $cu = new CU('group','SearchLife.php');
            // // 第二个参数为返回类型参数，支持string，json，xml，array，object，缺省默认执行对应方法中的respond_xml
            // $rt = $cu->Search_Tuan($_POST,'array');
            
            // echo "<meta charset='utf-8' />";
            // print_r($rt);
            // return $rt;
              $xie = $this->myself();
              // dump($xie);die();
              // json_decode($xie);
              // $xie = require '/xiec/example/searchLife/index.php';
              $xie = $xie['SearchProductRS']['GroupProductInfoList']['GroupProductInfo'];
              // $xie = $xie['SearchProductRS'];
              foreach ($xie as $k => $v) {
                // dump($v);
                $temp['lgid'] = $v['@attributes']['ProductID'] ;
                $temp['lgname'] = $v['@attributes']['HotelName'];
                $temp['server'] = $v['Descriptions']['Description']['Content']['Text'];
                $temp['list_pic'] = $v['ProductPictures']['ProductPicture'][1]['Content']['URL'];
                $temp['price'] = $v['ProductPrice']['SalePrice']['@attributes']['Price'];
                $temp['sold'] = $v['SalesStatistics']['SaledItemCount'];
                $temp['is_my'] = '0';
                // // dump($temp);
                $data[] = $temp;
              }
          }*/
          // dump($data);
          $out['date'] = $data;
          $out['success'] = 1;    
          $out['page'] = $page;       
          $this->ajaxReturn($out);
     	}
      
     }
     function lifePage()
  
     {
      $id = I('request.version',1);
      $cityId = I('request.cityId',0,"intval");
      $type = I('request.type',0,"intval");
      $areaId = I('request.areaId',0,"intval");
      //获取用户传递过来的分类id
      $search = I('request.search');
      $page = I('request.page',1,'intval');
      $pageSize = I('request.pageSize',20,'intval');
      if ($pageSize == 0) $pageSize =20;
      if ($page == 0) $page =1;
      $limit = " limit ".($page - 1)*$pageSize.",".$pageSize;
      // dump($limit);
      // 获取商品的分类id
      if ($id == 1){
          $field = " id,name,list_pic,star,type,des,latitude,longitude ";
          $sql = "select ".$field." from ".C('DB_PREFIX')."business  WHERE 1=1 ";
          if ($cityId != 0) {
            $sql .="and city = $cityId ";
          }
          if ($areaId != 0) {
            $sql .="and area = $areaId ";
          }
          if ($type != 0) {
            $sql .="and (parent_type = $type or type = $type) ";
          }
          $sql .="and name like '%$search%' ";
          
          $sql .= $limit;
          // dump($sql);
          $data = M()->query($sql);
          foreach ($data as $k => $v) {
            $v['is_my'] = "1";
            $data[$k] = $v;
          }          
          $out['date'] = $data;
          $out['success'] = 1;    
          $out['page'] = $page;       
          $this->ajaxReturn($out);
      }
      
     }

    
     

    function xie(){
        $city = I('request.city');
       $search = I('request.search');
       $page = I('request.page',1);
       $pageSize = I('request.pageSize',20);
        $url = "http://120.24.215.150/xiec/example/searchLife/index.php";
        // dump($url);
        $post_data=array(
          'city' =>$city,
          'search' => $search,
          'page' =>$page,
          'pageSize'=>$pageSize
          );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 'application/x-www-form-urlencoded');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

        $output = curl_exec($ch);
        curl_close($ch);
        if (!$output) {
          var_dump(curl_error($ch));
        }
        dump($output);
          return $output;
    }

    function myself(){
      $city = I('request.city');
       $search = I('request.search');
       $page = I('request.page',1);
       $pageSize = I('request.pageSize',20);
        $url = "127.0.0.1/wrt/xiec/example/searchLife/index.php";
        // dump($url);
        $post_data=array(
          'city' =>$city,
          'search' => $search,
          'page' =>$page,
          'pageSize'=>$pageSize
          );
        $data = "city =".$city."&search =".$search."&page=".$page."&pageSize = ".$pageSize;
      $ch = curl_init(); //初始化curl
      curl_setopt($ch, CURLOPT_HEADER,0);
      curl_setopt($ch, CURLOPT_URL, $url);//设置链接
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//设置是否返回信息
      curl_setopt($ch, CURLOPT_POST, 1);//设置为POST方式
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//POST数据
      curl_setopt($ch, CURLOPT_HTTPHEADER, array("application/x-www-form-urlencoded;charset=utf-8","Content-length:".strlen($data)));
      $response = curl_exec($ch);//接收返回信息
      if(curl_errno($ch)){//出错则显示错误信息
        print curl_error($ch);
      }
      curl_close($ch); //关闭curl链接
      dump($response);die();
      return $response;//显示返回信息
    }  
}

