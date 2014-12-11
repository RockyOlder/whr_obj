<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class GoodsController extends IsloginController {

    public function index() {
        $business = M("Goods");
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
        $data = $business->field('goods_id,goods_name,list_img,description,if_show,price,number,inventory,goods_img')
                ->where($where)
                //  ->limit($page->firstRow . ',' . $page->listRows)
                ->select();
        $this->assign('data', $data);
        $this->display();
    }

    public function add() {
        $data['action'] = 'add';
        $data['title'] = "添加";
        $data['btn'] = "添加商品";
        $action = I('post.action');
        $cagy = M("Category");
        $vip = M("Vip");
        $vipList = $vip->select();
        $cagyList = $cagy->select();
        $pro = $this->getprovence();
        $this->assign('vip', $vipList);
        $this->assign('list', $cagyList);
        $this->assign('pro', $pro);
        if (IS_POST) {
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
            $goods_img = json_encode($path);
          //  print_r($goods_img);exit;
            if ($action == "add") {
                $goods = D('Goods');
                if ($data = $goods->create()) {
                    $data["add_time"] = time();
                    $data["goods_img"] = $goods_img;

                    if ($goods->add($data)) {
                        $url = U('/Home/goods/index');
                        $this->success("用户添加成功！", $url);
                    } else {
                        $this->error("用户添加失败！", 'index');
                    }
                }
            } elseif ($action == "edit") {
                $goods = D("Goods");
                if ($data = $goods->create()) {
                    $data["goods_img"] = $goods_img;
                    if ($goods->save($data)) {
                        $url = U('/Home/goods/index');
                        $this->success("修改成功！", $url);
                    } else {
                        $this->error("用户修改失败！", 'index');
                    }
                } else {
                    $this->error($goods->getError());
                }
            }
        }
        //      echo 1;exit;

        $id = I('get.id', 0);
        if (!empty($_POST['goods_id'])) {
            $id = $_POST['goods_id'];
        }
        if ($id) {
            $data['action'] = 'edit';
            $data['title'] = "编辑商品";
            $data['btn'] = "编辑";
            $goods = M("Goods g");
            $goodsFind = $goods->field('g.*,c.cat_id,v.store_id,v.store_name,c.cat_name,r.REGION_ID,r.REGION_NAME')
                    ->join('wrt_category AS c ON g.cat_id=c.cat_id')
                    ->join('wrt_vip AS v ON v.store_id=g.store_id')
                    ->join('wrt_region AS r ON g.province=r.REGION_ID')
                    ->where('g.goods_id=' . $id)
                    ->find();
            $goods_img = $goodsFind['goods_img'];
        //    print_r($goods_img);exit;
            $goodsFind['goods_img'] = json_decode($goods_img, true);
           // print_r($goodsFind);exit;
            $this->assign('info', $goodsFind);
        }
        $this->assign('data', $data);
        $this->display();
    }

    public function del() {
        $id = I('get.id', 0);
        $goods = D("Goods");
        $result = $goods->where("goods_id=$id")->delete();
        if ($result) {
            redirect($_SERVER["HTTP_REFERER"]);
        }
    }

    public function details() {
        $id = I('post.id', 0);
        // echo 1;;exit;
        //  echo $id;exit;
        if ($id) {
            //  $data['action'] = 'edit';
            $data['title'] = "编辑商品";
            $data['btn'] = "编辑";
            $goods = M("Goods g");
            $goodsFind = $goods->field('g.*,c.cat_id,v.store_id,v.store_name,c.cat_name,r.REGION_ID,r.REGION_NAME')
                    ->join('wrt_category AS c ON g.cat_id=c.cat_id')
                    ->join('wrt_vip AS v ON v.store_id=g.store_id')
                    ->join('wrt_region AS r ON g.province=r.REGION_ID')
                    ->where('g.goods_id=' . $id)
                    ->find();
            //   $this->assign('info', $goodsFind);
        } else {
            $this->error($goods->getError());
        }
        $this->ajaxReturn($goodsFind);
        //  $this->assign('data', $data);
        //    $this->display();
    }

}

?>
