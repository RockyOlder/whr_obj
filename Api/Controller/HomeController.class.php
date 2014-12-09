<?php
namespace Api\Controller;
use Think\Controller;
class HomeController extends Controller {
		function __construct()
	{

		 if (!IS_API) {
	        	die("你无权访问该页面！");
	        }
	}
    // 获取城市列表
    public function city()
    {
        $arr = array('a','b','c','d','e','f','g','h','i','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
		// $data = data();
		$id = I('request.version',1);
		if ($id == 1) 
        {
            $out['success']  = 1;
            $city = S('all_city');//读取缓存数据
            if (empty($city)) 
            {
                $city = array();
                foreach ($arr as $key => $value) {
                    $w = strtoupper($value);
                    $sql = "select region_id,region_code,region_name from ".C('DB_PREFIX')."region where region_initial = '$w' and region_level = 2";
                    // dump($sql);die();
                    $city[$value] = M()->query($sql);                    
                    // dump($w);die;
                }
                S("all_city",$city);                
            }
			$out['data'] = $city;    			
			$this->ajaxReturn($out);
		}
	       
    }
    // 获取首页数据
    public function home(){
        $id = I('request.version',1);
        $uid = I('request.user_id',1);
        // dump($_POST);
        // $ok = C('SHOW_HOME_LIST');
        // dump($ok);
        if ($id) {
            $sql ="select * from ".C('DB_PREFIX')."system";
            $data = m()->query($sql);
            if ($data[0]['statue'] == 1) { //表示首页爱好需要显示
                $sql ="select * from ".C('DB_PREFIX')."home_cate order by price desc";
                // dump($sql);
                $home_cate = M()->query($sql);
                // dump($home_cate);查询用户自己设置的快捷方式
                $sql ="select * from ".C('DB_PREFIX')."user_hobby where uid = $uid";
                // dump($sql);
                $user = M()->query($sql);
                if (!empty($user) && is_array($user)) {
                    foreach ($user as $k => $v) {
                        $home_cate[]=$v;
                    }
                }
                // dump($user);
                $out['home_cate'] = $home_cate;
            }
            if ($data[1]['statue'] == 1) { //表示推荐商品需要显示
                $time = time();
                // dump($time);
                $sql ="select * from ".C('DB_PREFIX')."home_give where `pass_time`> $time ";
                if ($data[1]['is_price'] == 1) {
                    $sql .= "order by price desc";
                }
                // dump($sql);
                $good = M()->query($sql);

                $out['good']= $good;
            }
            $out['success'] = 1;
            // dump($out);
            $this->ajaxReturn($out);
            
        }
    }
    //获取广告的图片和链接地址
    public function ad(){
        $id = I('request.version',1);
        $type = I('request.type',1);
        $time = time();
        if ($id == 1) {
            $out['success']  = 1;
            // 更新广告的浏览量
            $sql ="update ".C('DB_PREFIX')."ad SET skim = skim+1 where type =".$type;
            M()->query($sql);
            $name = "ad_".$type;
            $ad =S($name);//获取缓存
            if (empty($ad)) {
                $sql ="select ad_id,ad_name,pic,ad_url from ".C('DB_PREFIX')."ad where type = $type and end_time < $time limit 0,5";
                // dump($sql);
                $ad = M()->query($sql);
                S($name,$ad);
            }
            $out['data'] = $ad;
            $this->ajaxReturn($out);          
           
        }

    }  
    //获取统计数据
    public function adCount(){
        // dump($_REQUEST);
        $id = I('request.version',1);
        $adid = I('request.adid',0);
        $uid =I('request.uid',0);
        // dump($uid);
        if ($adid == 0 && $uid == 0) {
            $out['success'] = 0;
            $out['msg'] = C('no_id');
            $this->ajaxReturn($out);
        }
        $time = time(); //点击时间
        if ($id == 1) {
            $out['success']  = 1;
            // 更新广告的点击
            $sql ="update ".C('DB_PREFIX')."ad SET click = click+1 where type =".$adid;
            M()->query($sql);
            
            $sql ="insert  into ".C('DB_PREFIX')."ad_count set ad_id = $adid , uid = $uid ,time = $time";
            // dump($sql);
            $bool = M()->execute($sql);
            // dump($bool);
            if($bool){
                $out['data'] = $bool;
            }else{
                $out['success'] = 0;
            }  

            $this->ajaxReturn($out);       
           
        }

    }  
    //根据地址获取城市的区域列表
    public function cityArea(){
    	$id = I('request.version',1);
    	$city = I('request.cityid',234);
    	if ($id == 1) {
    		$out['success']  = 1;
    
    		$sql = "select region_id,region_code,region_name from ".C('DB_PREFIX')."region where parent_id = $city and region_level = 3";
    		// dump($sql);
    		$data = M()->query($sql);
    		if (is_array($data)) {
    			$out['data'] = $data;
    		}else{
    			$out['data'] = null;
    			$out['success'] = 0;
    			$out['msg'] = "没有你需要的地区信息";
    		}    		 
    
    		$this->ajaxReturn($out);
    		 
    	}
    
    }
    //根据地址获取城市的id
    public function getcityid(){
        $id = I('request.version',1);
        $city = I('request.cityname',234);
        if ($id == 1) {
            $out['success']  = 1;
    
            $sql = "select region_id,region_name from ".C('DB_PREFIX')."region where region_name like '$city%'";
            // dump($sql);
            $data = M()->query($sql);
            // dump($data);
            if (is_array($data)) {
                $out['city_id'] = $data[0]['region_id'];
            }else{
                $out['data'] = null;
                $out['success'] = 0;
                $out['msg'] = "没有你需要的地区id";
            }            
    
            $this->ajaxReturn($out);
             
        }
    
    }
   
  
}
