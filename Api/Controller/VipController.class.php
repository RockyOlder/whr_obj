<?php
namespace Api\Controller;
use Think\Controller;
class VipController extends Controller {
		function __construct()
	{

		 if (!IS_API) {
	        	die("你无权访问该页面！");
	        }
	}
    /**
     * 获取vip首页信息
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-09T11:12:38+0800
     * @return [type]                   [description]
     */
    public function index()
    {
      // echo md5('111111');
      // $data = md5('5712'.md5('111111'));
      // dump($data);
      // die();
      // echo time('2014-12-28');
      //echo time('2015-01-16');
      //die();
        $id = I('request.version',1);
          if ($id == 1) {

                  $out['success'] = 1;
              // 获取活动的内容
              $act = M('vip_activity')->where("statue=0")->select();
              if ($act) {
                $act = current($act);
                $good = M('vip_act_good')->field('gid,price,o_price,pic')->where('aid ='.$act['id'])->order('sort desc')->limit(3)->select();
                if ($good) {
                  foreach ($good as $k => $v) {
                    $v['zhe'] = round($v['price']/$v['o_price'],1);//计算出来折扣
                    $v['number'] = $k+1;
                    $good[$k] = $v;
                  }
                  // dump($good);die();
                  $act['good'] = $good;
                }
                $out['header'] = $act;
              }
              // dump($data);
              // 获取所有的vip推荐
              $sql = "select gid,title,info,pic,type from ".C('DB_PREFIX')."vip_first_ad where deadline >".time()."  order by sort desc";
              // dump($sql);
              $data = M()->query($sql);

              // dump($data);
              if ($data) {
                  $h=0;
                  $g=0;
                  foreach ($data as $k => $v) {
                    
                    if ($v['type'] == '1') {
                      $h++;
                      $v['number'] = $h;
                      $hot[]=$v;
                    }else{
                       $g++;
                      $v['number'] = $g;
                      $give[]=$v;
                    }
                  }
                  $out['hot'] =$hot;
                  $out['give'] =$give;

              }else{
                  $out['success'] = 0;
                  $out['msg'] ='没有推荐商品';
              }
               $this->ajaxReturn($out);
          }       
    }
    //获取vip分类
    public function vipCate(){
        $id = I('request.version',1,'intval');
        if ($id == 1) {
            $data = S('category');

            if (!$data) {
              $sql ="select * from ".C('DB_PREFIX')."category";
              $data = M()->query($sql);
              if (!$data) {
                 $out['msg'] = '没有商品分类请你添加后再来获取';
                  $out['success'] = 0;
                  $out['data'] = null;
                  $this->ajaxReturn($out);
              }
               $data = $this->getCatTree($data);
               // dump($data);
               S('category',$data,600);
            }
            $out['data'] = $data;
            $out['success'] = 1;   
            $out['msg'] = '成功';
            $this->ajaxReturn($out);
        }

    }
     //获取vip商品列表
    public function vipGoods(){
        $id = I('request.version',1,'intval');
        $type = I('request.type',0,'intval');
        $sort = I('request.sort',0,'intval');
        $page = I('request.page',1,'intval');
        $pageSize = I('request.pageSize',20,'intval');
        if ($type == 0) {
          $out['success'] = 0;
          $out['msg'] = C('no_id');
          $this->ajaxReturn($out);
        }
        if ($id == 1) {
            switch ($sort) {
              case '0':
                    $s = "number desc";
                break;
              case '1':
                    $s = "price asc";
                break;
              case '2':
                    $s = "price desc";
                break;
              case '3':
                    $s = "add_time desc";
                break;
              default:
                $s = "number desc";
                break;
            }
           
            $out['data'] = M('goods')->field('goods_id,price,markdown,goods_name,list_img,number,store_id')->where("cat_id = $type")->order($s)->page($page,$pageSize)->select();
            // dump($out);
            $out['success'] = 1;           
            $this->ajaxReturn($out);
        }

    }
        public function vipsearch(){
        $id = I('request.version',1,'intval');
        $search = I('request.search');
        $sort = I('request.sort',0,'intval');
        $page = I('request.page',1,'intval');
        $pageSize = I('request.pageSize',20,'intval');
        
        if ($id == 1) {
            switch ($sort) {
              case '0':
                    $s = "number desc";
                break;
              case '1':
                    $s = "price asc";
                break;
              case '2':
                    $s = "price desc";
                break;
              case '3':
                    $s = "add_time desc";
                break;
              default:
                $s = "number desc";
                break;
            }           
            $out['data'] = M('goods')->field('goods_id,price,markdown,goods_name,list_img,number,store_id')->where("goods_name like '%$search%'")->order($s)->page($page,$pageSize)->select();
            // dump($out);
            $out['success'] = 1;           
            $this->ajaxReturn($out);
        }

    }
     //获取vip商品详情
    public function vipInfo(){
        // echo time();
        // echo "<br/>";
        // echo strtotime('2015-12-12');
        $id = I('request.version',1,'intval');
        $goodId = I('request.goodId',0,'intval');
        $type = I('request.type',0,'intval'); //如果是1的时候则表示是活动商品
        if ($goodId == 0) {
          $out['msg'] = C('no_id');
          $out['success'] = 0;
          $this->ajaxReturn($out);
        }
        if ($id == 1) {
           $data = M('goods')->field('goods_id,sales,store_id,goods_name,goods_img,description,price,weight')->where("goods_id ='$goodId'" )->find();
           // dump($data['store_id']);
           // 获取商店的电话和qq
           $store = M('vip')->field('mobile_phone,qq')->where('store_id='.$data['store_id'])->find();
           //获取商店的评论条数
           $sum = M('vip_comment')->field('count(*) as sum')->where('shopid='.$data['store_id'])->select();
           if ($sum) {
             $store['sum'] = $sum[0]['sum'];
           }
           $data['shop'] = $store;
            
            if ($type == 1) { //表示是活动商品
                $price = M('vip_act_good')->field('price')->where('gid='.$data['goods_id'])->find();
                // dump($price)
                $data['price'] = current($price);
            }
            $out['data'] = $data;
            $out['success'] = 1;           
            $this->ajaxReturn($out);
        }

    }
     //用户反馈信息
    public function userBack(){
        $id = I('request.version',1,'intval');
        $uid = I('request.userId',0,'intval');
        $uname = I('request.userName');
        if ($uid == 0) {
          $out['msg'] = C('no_id');
          $out['success'] = 0;
          $this->ajaxReturn($out);
        }        
        if ($id == 1) {
          
          $arr = array('uid' => $uid,'uname'=>$uname,'content'=>I('request.content'),'add_time'=>time() );
           $data = M('user_back')->add($arr);
           // dump($data);die();
           if (!$data) {
              $out['success'] = 0;  
              $out['msg'] = '提交反馈信息成功';  
           }else{
            $out['msg'] = '提交反馈信息成功';
            $out['success'] = 1;   
            }        
            $this->ajaxReturn($out);
        }

    }
     //活动商品列表
    public function actAll(){
        $id = I('request.version',1,'intval');
        $aid = I('request.activityId',0,'intval');
        $page = I('request.page',1,'intval');
        $pageSize = I('request.pageSize',20,'intval');
        if ($aid == 0) {
          $out['msg'] = C('no_id');
          $out['success'] = 0;
          $this->ajaxReturn($out);
        }        
        if ($id == 1) {
          $data = S('act_good_'.$aid);          
           if (!$data) {
              $out['success'] = 1; 
              $limit = ($page - 1)*$pageSize;
              $good = M('vip_act_good')->field('gid,price,o_price,pic,good_name')->where('aid ='.$aid)->order('sort desc')->limit($limit)->select();
                if ($good) {
                  foreach ($good as $k => $v) {
                    $v['zhe'] = round($v['price']/$v['o_price'],1);//计算出来折扣
                    $v['number'] = $k+1;
                    $good[$k] = $v;
                  }
                  $out['data'] = $good;
                }else{
                  $out['success']  = 0;
                  $out['msg'] = '没有此项活动，或者活动结束！';
                } 
           }else{
            $this->ajaxReturn($data);
            }
            S('act_good_'.$aid,$out,6000);  
            $this->ajaxReturn($out);
        }

    }
    //vip商品的收藏
    public function comment()
    {
         $id = I('request.version',1,'intval');
        // $goodid = I('request.goodid',0);
        $userid = I('request.userId',0,'intval');
        $goodid = I('request.goodId',0,'intval');
        $actId =I('request.actId',0,'intval');

        $time = time();
        if ($id == 1) {
          if (!$userid || !$goodid) {
            $out['success'] = 0;
            $out['msg']=C('no_id');
            $this->ajaxReturn($out);
          }
          $arr = array('goodid'=>$goodid,'userid'=>$userid);
          if ($actId) {
            $arr['type'] = $actId; //加入活动的id
          }

          //判断用户是否已经收藏
          $data = M('vip_collect')->where($arr)->find();
          if (!is_null($data)) {
              $out['success'] = 0;
              $out['msg'] = "你已经收藏该商品";
              $this->ajaxReturn($out);
          }
          $arr['time'] = time();
         
         // dump($sql);
          $bool = M('vip_collect')->add($arr);
          if ($bool) {
             $out['success'] = 1;
              $out['msg']="收藏成功";
          }else{
             $out['success'] = 0;
            $out['msg']="收藏插入失败";
          }
        }
        $this->ajaxReturn($out);         
    }
        public function commentDel()
    {
         $id = I('request.version',1,'intval');
        // $goodid = I('request.goodid',0);
        $collectId = I('request.collectId',0,'intval');

        if ($id == 1) {
          if (!$collectId) {
            $out['success'] = 0;
            $out['msg']=C('no_id');
            $this->ajaxReturn($out);
          }
          $arr = array('id'=>$collectId);

          //判断用户是否已经收藏
          // $data = M('vip_collect')->where($arr)->find();
          $data = M('vip_collect')->find($collectId);
          // dump($data);
          if (is_null($data)) {
              $out['success'] = 0;
              $out['msg'] = "你已经删除该收藏";
              $this->ajaxReturn($out);
          }        
         // dump($sql);
          $bool = M('vip_collect')->delete($collectId);
          if ($bool) {
             $out['success'] = 1;
              $out['msg']="删除收藏成功";
          }else{
             $out['success'] = 0;
            $out['msg']="收藏删除失败";
          }
        }
        $this->ajaxReturn($out);         
    }
    // 获取收藏的列表
     public function commentList()
    {
         $id = I('request.version',1,'intval');
        // $goodid = I('request.goodid',0);
        $uid = I('request.userId',0,'intval');
        $page = I('request.page',1,'intval');
        $pageSize = I('request.pageSize',20,'intval');
        if ($page == 0) $page = 1;
        if($pageSize == 0) $pageSize = 20;
        $limit ='limit '. ($page - 1) * $pageSize.",".$pageSize;

        if ($id == 1) {
          if (!$uid) {
              $out['success'] = 0;
              $out['msg']=C('no_id');
              $out['data'] = null;
              $this->ajaxReturn($out);
          }
          $field = "id,goodid,markdown as price ,goods_name,list_img,description as des";
          $sql = "select $field from ".C('DB_PREFIX')."vip_collect as v join ".C('DB_PREFIX')."goods as g on v.goodid = g.goods_id where userid = $uid ".$limit;
          // dump($sql);
          $vip = M()->query($sql);
          $data['vip'] = $vip;
          $field = "id,lgid as goodid,price ,lgname as goods_name,list_pic as list_img,des";
          $sql = "select $field from ".C('DB_PREFIX')."life_co_good as v join ".C('DB_PREFIX')."life_goods as g on v.goodid = g.lgid where userid = $uid ".$limit;
          // dump($sql);
          $life = M()->query($sql);
          $data['life'] = $life;
          //查找生活导航的收藏商店
          $field = "v.id,name,list_pic,star,type,des,latitude,longitude";
          $sql = "select $field from ".C('DB_PREFIX')."life_co_shop as v join ".C('DB_PREFIX')."business as g on v.shopid = g.id where userid = $uid ".$limit;
          //dump($sql);
          $shop = M()->query($sql);
            if ($shop) {
              foreach ($shop as $k => $v) {
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
                     $shop[$k]=$v;

                   }
            }
          $data['shop'] = $shop;
            $out['success'] = 1;
            $out['msg']='';
            $out['data'] = $data;
            $this->ajaxReturn($out);
      
        }        
    }


    /**

     * 获取分类的序列化

     */
    private function getCatTree($arr, $id = 0, $lev = 0) {
        $tree = array();
        foreach ($arr as $v) {
            if ($v['parent_id'] == 0) {
              $top[] = $v; 
            }
        }
        foreach ($top as $k => $v) {
          // dump($v);
          foreach ($arr as $k1 => $v1) {
            if ($v1['parent_id'] == $v['cat_id']) {
                $son[] = $v1; 
            }
          }
          // dump($son);
          $v['son'] = $son;
          $son = null;
          $tem[]=$v;

        }
        return $tem;
    }
   
    
    
  
}
