<?php
namespace Api\Controller;
use Think\Controller;
class ShopController extends Controller {
		function __construct()
	{

		 if (!IS_API) {
	        	die("你无权访问该页面！");
	        }
	}
    // 获取商店列表
    public function slist()
    {
      $d= getDistance('113.935191','22.510551','113.936251','22.505476');
      // dump($d);
        $id = I('request.version',1,'intval');
          // 获取商店需要的数据
          $type = I('request.type',0,'intval');
          // dump($type);
          //获取商店城市的id
          $city_id = I('request.city_id',0,'intval');
          //获取商店的地区id
          $area_id = I('request.area_id',0,'intval');
          $page = I('request.page',1,'intval');
          $pageSize = I('request.pageSize',20,'intval');
          $sort = I('request.sort',0,'intval');
                     // dump($_POST);
          // var_dump($start);
          $limit = "limit ".($page-1)*$pageSize.",".$pageSize;
          $out['success']=1;
          if ($id == 1){
               $sql = "SELECT id,name,list_pic,star,type,des,latitude,longitude FROM ".C('DB_PREFIX')."business WHERE `lock` = 0 ";
               if ($type != 0 ) $sql .= "and (parent_type = $type or type = $type) ";
               if ($city_id != 0 ) $sql .= "and city = $city_id ";
               if ($area_id != 0 ) $sql .= "and area = $area_id ";
               switch ($sort) {
                 case '0':
                       $sql .= " order by sort desc ";
                   break;
                
                 case '2':
                       $sql .= " order by star desc ";
                  break;
                 case '3':
                       $sql .= " order by name asc ";
                   break;
               }
               $sql .=$limit;
               // dump($sql);
               $data = M()->query($sql); 
               // dump($data);
               if (!empty($data) && is_array($data)) {
                   foreach ($data as $k => $v) {
                     $sql  = "select type_name from ".C('DB_PREFIX')."type WHERE type_id = ".$v['type'];
                     $type = M()->query($sql);
                     // dump($type);
                     if ($type && is_array($type)) {
                       $type =current($type[0]);
                       $v['typename'] = $type;
                     }
                     if ($v['star'] == -1) {
                       $v['star'] = 5;
                     }
                     $data[$k]=$v;

                   }
                 }else{
                  $out['success'] = 0;
                 }  
               if ($sort == '1') { // 如果是按照离我最近来排序
                  $latitude = I('latitude');
                  $longitude = I('longitude');
                  foreach ($data as $k => $v) {
                      $v['distance'] = $this->getDistance($v['latitude'],$v['longitude'],$latitude,$longitude);
                    // $d = $this->getDistance('113.931207','22.505159','113.931418','22.505075');
                    // dump($d);

                      $data[$k] =$v;
                   // dump($k);//die();
                   // $str = $data[$k],
                  }
                  $data = $this->sysSortArray($data,'distance');
                  // dump($data);
               }
               $out['data']=$data;    
               $this->ajaxReturn($out);
          }

	       
    }
     // 获取商店详情和商品列表
    public function shopinfo()
    {
      // dump(time());
          $id = I('request.version',1);
          // 获取商店需要的数据
          $shopid = I('request.shopid',0,"intval");
           if ($shopid == 0) {
              $out['msg']=C("no_id");
              $out['success']=0;
              $this->ajaxReturn($out);
          }
                     // dump($_POST);
          // var_dump($start);
          $limit = "limit ".($page-1)*$pageSize.",".$pageSize;
          $out['success']=1;
          if ($id == 1){
              // 获取商店的详细信息
             /* $sql = "SELECT id,name,des,star,type,list_pic,mobile_phone,address,latitude,longitude FROM ".C('DB_PREFIX')."business WHERE `lock` = 0 and id = $shopid";
              */
             $sql = "SELECT * FROM ".C('DB_PREFIX')."business WHERE `lock` = 0 and id = $shopid";
              
              // dump($sql);
              $shopinfo = M()->query($sql);
              // dump($shopinfo);die();
              if (!empty($shopinfo) && is_array($shopinfo)) {
                $shopinfo = current($shopinfo);
                if ($shopinfo['star'] == '-1') {
                    $shopinfo['star'] = 5;
                }
                // 查询商店的类型名称
                $sql = "select type_name from ".C('DB_PREFIX')."type where type_id =".$shopinfo['type'];
                $data = M()->query($sql);
                if (!empty($data)) {
                   $shopinfo['typename'] = $data[0]['type_name'];
                }
                // 获取商店的评论条数
                $sql =" select count(*) as sum from ".C('DB_PREFIX')."business as b join ".C('DB_PREFIX')."life_goods as l on b.id = l.bid join ".C('DB_PREFIX')."comment as c on l.lgid = c.gid where b.id =$shopid";
                $data = M()->query($sql);
                if (!empty($data)) {
                   $shopinfo['comment'] = $data[0]['sum'];
                }
              }
              $out['shopinfo'] = $shopinfo;
              // dump($out);
              // 获取商店的商品信息
               $sql = "SELECT lgid,lgname,price,m_price,sold,list_pic,bid FROM ".C('DB_PREFIX')."life_goods WHERE `is_lock` = 0 and `bid` = $shopid";
              // dump($sql);
               // dump($sql);
               $goods = M()->query($sql); 
               foreach ($goods as $k => $v) {
                  $v['number']= $k+1;
                  $goods[$k] =$v;
               }
               $out['goods'] = $goods; 

               
               // 获取商店的评论3条
                $sql =" select count(*) as sum from ".C('DB_PREFIX')."business as b join ".C('DB_PREFIX')."life_goods as l on b.id = l.bid join ".C('DB_PREFIX')."comment as c on l.lgid = c.gid where b.id =$shopid";
                $data = M()->query($sql);
                if (!empty($data)) {
                   $shopinfo['comment'] = $data[0]['sum'];
                }
            
              // 获取推荐商品
                // dump(time());
                $sql = "select lgid,lgname,server,list_pic,cate_id,price,m_price from ".C('DB_PREFIX')."give_life_goods as g join ".C('DB_PREFIX')."life_goods as l on g.goodid =l.lgid where deadline > ".time()." order by g.sort desc limit 0,5";
                // dump($sql);
                $give = M()->query($sql);

                foreach ($give as $key => $value) {
                    $sql = "select type_name from ".C('DB_PREFIX')."type where type_id =".$value['cate_id'];
                    // dump($sql);
                    $data = M()->query($sql);
                    if (!empty($data)) {
                       $value['typename'] = $data[0]['type_name'];
                       $value['is_vip'] = '1';//添加是否是vip商品1代表是vip商品
                       $value['number'] = $key+1;
                    }
                    // dump($value);
                    $give[$key] =$value;
                    // dump($give);
                }
                // dump($give);
                $out['give'] = $give;
               // $num = count($data);
               // if ($num < $pageSize) {//如果数据少于请求数据则获取第三放数据
               //      # code...

                
               $this->ajaxReturn($out);
          }

         
    }
    // 商店商品列表
    public function goods()
    {
          $id = I('request.version',1);
          // 获取商店需要的数据
          $shopid = I('request.shopid',0);
          if ($id == 1) {            
                $out['data'] = null;
                $out['success']=0;
              if ($shopid == 0) {
                $out['msg']=C("no_id");
                $this->ajaxReturn($out);
              }
            $page = I('request.page',1);
            $pageSize = I('request.pageSize',20);
           // 获取商店的商品信息
             $sql = "SELECT lgid,lgname,lgnumber,des,list_pic,star,price,m_price,bid as shopid FROM ".C('DB_PREFIX')."life_goods WHERE `is_lock` = 0 and `bid` = $shopid ";
            // dump($sql);
             $sql .=$limit;
             // dump($sql);
             $goods = M()->query($sql);  
             
             $sql ="select count(*) as sum from ".C('DB_PREFIX')."life_goods WHERE `is_lock` = 0 and `bid` = $shopid";
             // dump($sql);
             $sum = M()->query($sql);
             // dump($sum);
             if ($sum) {
              $out['msg'] = "获取数据成功";
              $out['success'] = 1;
               $sum = current($sum);
               // dump($sum);
               $goods['sum'] = $sum['sum'];
               $goods['pagesum'] = ceil($sum['sum']/$pageSize);
               $goods['page'] = $page;
             }
             // $num = count($data);
             // if ($num < $pageSize) {//如果数据少于请求数据则获取第三放数据
             //      # code...
             // }
             $out['data'] = $goods;   
             $this->ajaxReturn($out);
          }

         
    }
    // 获取商品详情
    public function goodinfo()
    {
          $id = I('request.version',1);
          // 获取穿入的商品id
          $goodid = I('request.goodid',0);
          if ($goodid == 0) {
              $out['msg']=C("no_id");
              $out['success']=0;
              $this->ajaxReturn($out);
          }
          $out['success']=1;
          if ($id == 1){
               /*$sql = "SELECT lgid,lgnumber,lgname,des,list_pic,thumb_pic,pic,star,price,m_price,t_price,add_time,content,server,bid FROM ".C('DB_PREFIX')."life_goods WHERE `is_lock` = 0 and lgid = $goodid";
                // dump($sql);
               $data = M()->query($sql); */ 
               $field = 'lgid,lgnumber,lgname,des,list_pic,thumb_pic,pic,star,price,m_price,t_price,content,server,bid';
               $w= array('is_lock'=>0,'lgid'=>$goodid);
               $data = M('life_goods')->field($field)->where($w)->find();
               // dump($data);
               if ($data) {   
                  
                  if ($data['star'] == -1) {$data['star'] = 5;}
                 
                  // 查询出商品的评论总条数
                  $sql = 'select count(*) as sum from '.C('DB_PREFIX')."comment where gid = $goodid";
                  $sum = M()->query($sql);
                  if ($sum) {
                     $data['sum'] = $sum[0]['sum'];
                  }                  
                      
                  $out['good']=$data;  
                  //获取商店的id 
                  $bid = $data['bid'];
                  $sql ="SELECT id,name,mobile_phone,address,list_pic,latitude,longitude from ".C('DB_PREFIX')."business where id =$bid";
                  // dump($sql);   
                  $shop = M()->query($sql);
                  // dump($shop);
                  if ($shop) {
                    $out['shop'] = current($shop);
                  }
                  //获取商品的评论
                   $sql = "select id,content,star,user_id,time from ".C('DB_PREFIX')."comment where `lock` = 0 and gid = $goodid";
                   // dump($sql);
                  $comm = M()->query($sql);
                  if (!empty($comm)) {
                     $out['success'] = 1;
                      foreach ($comm as $k => $v) {
                         // 查询出来用户的头像
                        $sql = "select face,rank_name,user_name from ".C('DB_PREFIX')."user as u join ".C('DB_PREFIX')."user_rank as k on u.user_rank =k.rank_id  where user_id = $v[user_id]";
                        // dump($sql);
                        $user = M()->query($sql);
                        if (!empty($user)) {
                          $user = current($user);
                          $v['face'] =$user['face'];
                          $v['rank_name'] = $user['rank_name'];
                          $v['user_name'] = $user['user_name'];                        
                        }
                        $v['date'] = date('Y-m-d H:i:s',$v['time']);
                        $v['number'] = $k+1;
                        $comm[$k] =$v;
                      }
                      // dump($comm);
                      $out['comm'] = $comm;  
                  }           
               }else{
                $out['msg'] ="没有该商品详情";
                $out['success'] = 0;
               }
              $this->ajaxReturn($out);          
    
      }}
/**
 * 计算两个经纬之间的距离
 */
      function getDistance($lat1, $lng1, $lat2, $lng2)
 {
     $earthRadius = 6367000; //approximate radius of earth in meters
 
     /*
       Convert these degrees to radians
       to work with the formula
     */
 
     $lat1 = ($lat1 * pi() ) / 180;
     $lng1 = ($lng1 * pi() ) / 180;
 
     $lat2 = ($lat2 * pi() ) / 180;
     $lng2 = ($lng2 * pi() ) / 180;
 
     /*
       Using the
       Haversine formula
 
       http://en.wikipedia.org/wiki/Haversine_formula
 
       calculate the distance
     */
 
     $calcLongitude = $lng2 - $lng1;
     $calcLatitude = $lat2 - $lat1;
     $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);  $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
     $calculatedDistance = $earthRadius * $stepTwo;
 
     return round($calculatedDistance);
 }

 //对二维数组根据某个字段排序
function sysSortArray($ArrayData,$KeyName1,$SortOrder1 = "SORT_ASC",$SortType1 = "SORT_REGULAR")
{
    if(!is_array($ArrayData))
    {
        return $ArrayData;
    }
 
    // Get args number.
    $ArgCount = func_num_args();
 
    // Get keys to sort by and put them to SortRule array.
    for($I = 1;$I < $ArgCount;$I ++)
    {
        $Arg = func_get_arg($I);
        if(!eregi("SORT",$Arg))
        {
            $KeyNameList[] = $Arg;
            $SortRule[]    = '$'.$Arg;
        }
        else
        {
            $SortRule[]    = $Arg;
        }
    }
 
    // Get the values according to the keys and put them to array.
    foreach($ArrayData AS $Key => $Info)
    {
        foreach($KeyNameList AS $KeyName)
        {
            ${$KeyName}[$Key] = $Info[$KeyName];
        }
    }
 
    // Create the eval string and eval it.
    $EvalString = 'array_multisort('.join(",",$SortRule).',$ArrayData);';
    eval ($EvalString);
    return $ArrayData;
}
}
