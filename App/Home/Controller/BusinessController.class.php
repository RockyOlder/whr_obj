<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class BusinessController extends IsloginController {

    public function index() {
        $business = M("business");
        if (IS_POST) {
            $name = I('post.name');
            $parent_type = I('post.parent_type');
            $address = I('post.address');
            if ($name)
                $where['name'] = array('LIKE', '%' . $name . '%');
            if ($address)
                $where['address'] = array('LIKE', '%' . $address . '%');
            if ($parent_type)
                $where['parent_type'] = array('LIKE', '%' . $parent_type . '%');
        }
        $count = $business->where($where)
                ->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 6);
        $show = $page->show();
        //   print_r($show);exit;
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $type = M("type");
        $typeList = $type->select();
        $data = $business->field('id,name,mobile_phone,fax_mobile,user_name,address,star,lock,list_pic')
                ->where($where)
                ->limit($page->firstRow . ',' . $page->listRows)
                ->select();
        $this->assign('type', $typeList);
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        $this->assign('data', $data);
        $this->display();
    }

    //  添加和编辑生活导航商家
    public function add() {

        $pro = $this->getprovence();
        // dump($pro);
        $this->assign('pro', $pro);
        if (IS_POST) {
            // 提交过来的时候讲列表图片组合为一个数组
            $business = D('business');
            $data = $business->create();
            if (!$data) {
                $this->error($business->getError(), '', 2);
            }

            $path = I('post.path');
            $mid = I('post.mid');
            $name = I('post.pic_name');
            foreach ($path as $k => $v) {
                $tem = "";
                $tem['pic'] = $v;
                $tem['mid'] = $mid[$k];
                $tem['name'] = $name[$k];

                $path[$k] = $tem;
            }
            //   exit;
            $more_pic = json_encode($path);

            //  dump($more_pic);exit;
            $city = I('post.city', 0);
            $id = I('post.id');
            $act = I('post.action');
            $arr = I('post.jingwei');
            $arr = explode(',', $arr);
            // dump($arr);die();
            $latitude = $arr[1];
            $longitude = $arr[0];
            // 组合出数据库中的数据
            $post = array(
                'name' => I('post.name', ''),
                'user_name' => I('post.user_name', ''),
                'latitude' => $latitude,
                'longitude' => $longitude,
                'star' => I('post.star'),
                'mobile_phone' => I('post.phone', ''),
                'province' => I('post.province', 0),
                'city' => I('post.city', ''),
                'area' => I('post.area', ''),
                'parent_type' => I('post.parent_type', 0),
                'list_pic' => I('post.list_pic', ''),
                'address' => I('post.address', ''),
                'des' => I('post.des', ''),
                'list_path' => I('post.list_path', ''),
                'mid_pic' => I('post.mid_pic', ''),
                'more_pic' => $more_pic,
                'type' => I('post.type'),
                'sort' => I('post.sort', 100),
                'more_pic' => $more_pic,
                'lock' => I('post.lock', 0)
            );
            $str = formant($post);
            //    print_r($post);exit;
            if ($act == 'add') {
                $sql = "insert into " . C('DB_PREFIX') . "business set " . $str;
                // dump($sql);die();
                $bool = M()->execute($sql);
                // dump($bool);
                if ($bool) {
                    $this->success("添加成功！", U('Business/index'), 1, FALSE);
                } else {
                    $this->error('添加失败');
                }
            }
            if ($act == 'edit') {
                // dump
                //  print_r($_REQUEST);exit;
                // echo 1;exit;
                $sql = "update " . C('DB_PREFIX') . "business set " . $str . " where id = $id";
                // dump($sql);die();
                $bool = M()->execute($sql);
                // dump($bool);
                if ($bool) {
                    $this->success("修改成功！", U('Business/index'), 1, FALSE);
                } else {
                    $this->error('修改失败');
                }
            }
        }

        //获取分类
        $cate = $this->topCate();
        //   $this->assign('cate', $cate);
        // dump($cate);
        $data['action'] = 'add';
        $data['title'] = "添加导航商家";
        $data['btn'] = "添加";
        $data['id'] = I('request.id', 0);
        $id = I('get.id', 0);
        if ($id) {
            // print_r($id);exit;
            $data['action'] = 'edit';
            $data['title'] = "编辑";
            $data['btn'] = "编辑";
            $update = M("business b");
            $type = M("Type");
            $find = $update->field('b.*,t.type_id,t.type_name,r.REGION_ID,r.REGION_NAME')
                    ->join('wrt_type AS t ON t.type_id=b.parent_type')
                    ->join('wrt_region AS r ON b.province=r.REGION_ID')
                    ->where('b.id=' . $id)
                    ->find();
            $class_find = $type->where("type_id=" . $find['parent_type'])->find();
            $cate = $type->where("parent_id=0 and type_id!=" . $class_find['type_id'])->select();
            //讲图册的图片显示出来
            $more_pic = $find['more_pic'];
            $find['more_pic'] = json_decode($more_pic, true);
            //组合出经纬度
            $find['jingwei'] = $find['longitude'] . "," . $find['latitude'];

            $this->assign("info", $find);
        }
        $this->assign('cate', $cate);
        $this->assign('data', $data);
        $this->display();
    }

    public function del() {
        // echo 1;exit;
        $id = I('get.id', 0);

        $class = D('business');
        $result = $class->where("id=$id")->delete();

        if ($result) {
            redirect($_SERVER["HTTP_REFERER"]);
        }
    }
    
     public function order() {
        $name=session('admin.name');
        $id = session('admin.id');
        if($name=='admin'){
            $this->redirect("Order/index"); 
        }
        $order = M("Order");
        $count = $order->where("bid=" . $id." and cate=0")->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 5);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $data = $order->where("bid=" . $id." and cate=0")
                ->limit($page->firstRow . ',' . $page->listRows)
                ->select();
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        $this->assign('data', $data);
        $this->display();
    }
    

    public function goods() {

        $lifeGood = M("LifeGoods l");
        if (IS_POST) {
            $lgname = I('post.lgname');
            $name = I('post.name');
            $type = I('post.type');
            if ($lgname)
                $where['lgname'] = array('LIKE', '%' . $lgname . '%');
            if ($name)
                $where['address'] = array('LIKE', '%' . $name . '%');
            if ($type)
                $where['type'] = array('LIKE', '%' . $type . '%');
        }
        $count = $lifeGood->where($where)
                ->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 5);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $type = M("type")->select();
        $data = $lifeGood->field('l.*,b.id,b.name')
                ->join('wrt_business AS b ON l.bid=b.id')
                ->where($where)
                ->limit($page->firstRow . ',' . $page->listRows)
                ->select();
        $this->assign('type', $type);
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        $this->assign('data', $data);
        $this->display();
    }

    // 添加导航商品
    public function goodsadd() {
        if (IS_POST) {
            $lifeGoods = D('lifeGoods');
            $data = $lifeGoods->create();
            if (!$data) {
                $this->error($lifeGoods->getError(), '', 2);
            }
            $id = I('post.id');
            $act = I('post.action', '');
            // 将图册的图片转换为json格式
            $path = I('post.path');
            $mid = I('post.mid');
            $name = I('post.pic_name');
            unset($_POST['path']);
            unset($_POST['mid']);
            unset($_POST['pic_name']);
            foreach ($path as $k => $v) {
                $tem = "";
                $tem['pic'] = $v;
                $tem['mid'] = $mid[$k];
                $tem['name'] = $name[$k];
                // dump
                $path[$k] = $tem;
            }
            $_POST['pic'] = json_encode($path);
            $goods_img = json_encode($path);
            $str = formantpost();
            if ($act == "add") {
                $sql = "insert into " . C('DB_PREFIX') . "life_goods set add_time=" . time() . "," . $str;
                // dump($sql);die();
                $bool = M()->execute($sql);

                if ($bool) {
                    $this->success('添加成功');
                } else {
                    $this->error('添加失败');
                }
            }
            if ($act == "edit") {
                $goods = D("lifeGoods");
                $data["pic"] = $goods_img;
                if ($goods->save($data)) {
                    $this->success("修改成功！", U('/Home/Business/goods'));
                } else {
                    $this->error("用户修改失败！", U('/Home/Business/goodsadd'));
                }
            }
        }

        $data['action'] = 'add';
        $data['title'] = "添加导航商品";
        $data['btn'] = "添加";
        $data['id'] = I('request.id', 0);
        $cate = $this->topCate();
        //$this->assign('cate', $cate);
        if ($data['id']) {
            $data['action'] = 'edit';
            $data['title'] = "编辑导航商品";
            $data['btn'] = "编辑";
            $type = M("Type");
            $info = M('life_goods')->where('lgid = ' . $data['id'])->find();
            $fin = $info['cate_pid'];
            $pic = $info['pic']; // dump($more_pic);
            $class_find = $type->where("type_id=" . $fin)->find();
            $cate = $type->where("parent_id=0 and type_id!=" . $class_find['type_id'])->select();
            $info['pic'] = json_decode($pic, true);
            $this->assign("find", $class_find);
            $this->assign("info", $info);
        }
        $this->assign('cate', $cate);
        $this->assign('data', $data);  //获取商店的信息
        $shop = $this->getshop();
        $this->assign('shop', $shop);
        $pro = $this->getprovence();        // 获取省份列表
        $this->assign('pro', $pro);       //获取分类
        // $data['action'] = 'add';
        $this->display();
    }

    // 异步获取次级分类
    public function sonCate() {
        //异步获取地区列表内容

        $id = I('post.id');
        if (!IS_AJAX || $id == "")
            return false;
        $data = $this->getsonCate($id);
        // dump($data);
        $this->ajaxReturn($data);
    }

    public function typeAjax($id) {
        // $id = I('post.id');
        $type = M("Type");
        $business = M("business");
        $find = $business->where('id = ' . $id)->find();
        $typeList = $type->where("type_id=" . $find['type'])->find();
        $typeList['list'] = $type->where("parent_id=" . $find['parent_type'] . " and type_id!=" . $typeList['type_id'])->select();
        $this->ajaxReturn($typeList);
    }

    public function GoodstypeAjax($id) {
        //  $id = I('post.id');
        $type = M("Type");
        $lifeGoods = M("lifeGoods");
        $find = $lifeGoods->where('lgid = ' . $id)->find();
        $typeList = $type->where("type_id=" . $find['cate_id'])->find();
        $typeList['list'] = $type->where("parent_id=" . $find['cate_pid'] . " and type_id!=" . $typeList['type_id'])->select();
        $this->ajaxReturn($typeList);
    }

    /**

     * 获取列表数据的方法


      private function getdata() {
      $page = I('get.page', 1);
      $pageSize = I('get.pageSize', 20);
      $limit = "limit " . ($page - 1) * $pageSize . ',' . $pageSize;
      $sql = "select * from " . C('DB_PREFIX') . "business " . $limit;
      $data = M()->query($sql);
      return $data;
      }
     */
}