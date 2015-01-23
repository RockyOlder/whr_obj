<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class MonthController extends IsloginController {

    public function index() {

        $type = session('admin.type');  $id = session('admin.shop_id');

        if (IS_POST) { $todaYyear = I('post.year_y');  $todayMonth = I('post.month_y'); $yearMonth = $todaYyear . '-' . $todayMonth; } 
        
        else { $yearMonth = date("Y-m"); $todaYyear = date("Y");  $todayMonth = date("m"); }
        //      echo $yearMonth;exit;
        if ($type !== '0' && $id !== '0') {      //vip
         
            $sql = "SELECT FROM_UNIXTIME(time,'%Y-%m-%d %H:%i:%S')as time,SUM(totle)as totle,oid,user_id,shop_id,v.store_id as id,v.store_name as name FROM " . C('DB_PREFIX') . "order AS o 
                    LEFT JOIN wrt_vip AS v ON v.store_id=o.shop_id
                    WHERE o.shop_id=" . $id." AND cate=" . $type." AND FROM_UNIXTIME(time,'%Y-%m-%d %H:%i:%S') LIKE '%".$yearMonth."%'
                    GROUP BY shop_id";
            $data = M()->query($sql);
           
        } else if ($type == '0' && $id !== '0') {   //导航 
            $sql = "SELECT FROM_UNIXTIME(time,'%Y-%m-%d %H:%i:%S')as time,SUM(totle)as totle,oid,user_id,shop_id,b.id,b.name FROM " . C('DB_PREFIX') . "order AS o 
                    LEFT JOIN wrt_business AS b ON b.id=o.shop_id
                    WHERE o.shop_id=" . $id." AND cate=" . $type." AND FROM_UNIXTIME(time,'%Y-%m-%d %H:%i:%S') LIKE '%".$yearMonth."%'
                    GROUP BY shop_id";
            $data = M()->query($sql);
            
        } else if ($type == '0' && $id == '0') {  //管理员  
         
            $sql = "SELECT FROM_UNIXTIME(time,'%Y-%m-%d %H:%i:%S')as time,SUM(totle)as totle,oid,user_id,shop_id,b.id,b.name FROM " . C('DB_PREFIX') . "order AS o 
                    LEFT JOIN wrt_business AS b ON b.id=o.shop_id
                    WHERE FROM_UNIXTIME(time,'%Y-%m-%d %H:%i:%S') LIKE '%".$yearMonth."%'
                    GROUP BY shop_id";
            $businessData = M()->query($sql);    $OrderDdata=array();
       
            foreach ($businessData  as $v){  if($v['name']!=''){ array_push($OrderDdata, $v); }  }  
            
            $vipSql = "SELECT FROM_UNIXTIME(time,'%Y-%m-%d %H:%i:%S')as time,SUM(totle)as totle,oid,user_id,shop_id,v.store_id as id,v.store_name as name FROM " . C('DB_PREFIX') . "order AS o 
                    LEFT JOIN wrt_vip AS v ON v.store_id=o.shop_id
                    WHERE FROM_UNIXTIME(time,'%Y-%m-%d %H:%i:%S') LIKE '%".$yearMonth."%'
                    GROUP BY shop_id";
            $vip = M()->query($vipSql);
     
       foreach ($vip  as $v){  if($v['name']!=''){ array_push($OrderDdata, $v); }  }  
    
       $data=$OrderDdata;
      }
     
        /*   $startZero=1; $startwo=1; $startout=1;  $count=1; // $arr['startZero']=0;
          foreach ($data as $v){ if($v['statue']==1){ $arr['startZero']=$startZero++; } if($v['statue']==2){ $arr['startwo']=$startwo++; } if($v['statue']==7){ $arr['startout']=$startout++; }else{$arr['startout']=0;}    $arr['count']=$count++; }   */
         
        for ($i = 2008; $i < 2025; $i++) {  $year_ceshi[] = $i;  }  for ($i = 1; $i <= 12; $i++) {  $month[] = $i; }
        
        $this->assign("todayYear", $todaYyear); $this->assign("todayMonth", $todayMonth); $this->assign("year", $year_ceshi); $this->assign("month", $month); $this->assign('data', $data);
        
        $this->display();
    }

}

?>
