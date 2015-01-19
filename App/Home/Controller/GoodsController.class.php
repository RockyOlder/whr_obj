<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class GoodsController extends IsloginController {

    public function index() {
        // $xx='绿色,红色,黄色';
        //$aa=  explode(',', $xx);
        // print_r($aa);exit;
       
        $goods = M("Goods");
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
        $count = $goods->where($where)
                ->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 12);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $data = $goods->field('goods_id,goods_name,list_img,description,if_show,price,number,inventory,goods_img')
                ->where($where)
                ->limit($page->firstRow . ',' . $page->listRows)
                ->select();
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
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
        //   $tree = $this->getCatTree($cagyList);
        $tree = $this->getCatTree($cagyList);
        $arr = array();
        foreach ($tree as $v) {
            array_push($arr, array('cat_id' => $v['cat_id'], 'cat_name' => str_repeat('&nbsp', $v['lev']) . $v['cat_name']));
        }
        $pro = $this->getprovence();
        $this->assign('vip', $vipList);
        $this->assign('list', $arr);
        $this->assign('pro', $pro);
        if (IS_POST) {


            $type = I('post.type');
            $path = I('post.path');
            $cat_id = I('post.cat_id');
            $mid = I('post.mid');
            $did = I('post.did', 0);
            $name = I('post.pic_name');
            foreach ($path as $k => $v) {
                $tem = "";
                $tem['pic'] = $v;
                $tem['mid'] = $mid[$k];
                $tem['name'] = $name[$k];

                $path[$k] = $tem;
            }
            $goods_img = json_encode($path);
            foreach ($type as $key => $v) {
                if ($v !== '') {
                    $arr[$key] = $v;
                }
            }
            $cat = M("Category");
            $catfind = $cat->where("cat_id=$cat_id")->find();
            $pid = $catfind['parent_id'];
            $restut = $cat->where("cat_id=$pid")->find();
            if (!$restut) {
                $url = U('/Home/goods/add', '', false);
                $this->error('父栏目不允许选择!');
            }
            if ($action == "add") {

                $goods = D('Goods');
                if ($data = $goods->create()) {
                    $data["add_time"] = time();
                    $data["goods_img"] = $goods_img;

                    if ($add = $goods->add($data)) {
                        $specificationData = D("SpecificationData");
                        if ($obj = $specificationData->create()) {
                            $_villa = _vialg($obj);
                            if (!empty($_villa)) {
                                $url = U('/Home/goods/add', '', false);
                                $this->error($_villa . '  添加失败!');
                            }
                            $obj['name'] = implode('|', $obj['name']);
                            $obj['type'] = json_encode($obj['type']);
                            //    print_r($arr);EXIT;
                            $obj['goods_id'] = $add;
                            if (!$dataAdd = $specificationData->add($obj)) {
                                $url = U('/Home/goods/index');
                                $this->error("商品属性添加失败！", $url);
                            }
                        }
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
                    $specificationData = D("SpecificationData");
                    if ($obj = $specificationData->create()) {
                        $_villa = _vialg($obj);
                        if (!empty($_villa)) {
                            $url = U('/Home/goods/add', '', false);
                            $this->error($_villa . '  添加失败!');
                        }
                        $obj['name'] = implode('|', $obj['name']);
                        $obj['type'] = json_encode($obj['type']);
                        $obj['goods_id'] = $data["goods_id"];
                        if ($did !== 'undefined') {
                            $specificationData->save($obj);
                            /* if (!$specificationData->save($obj)) {
                              $url = U('/Home/goods/add');
                              $this->error("属性修改失败！", $url);
                              }
                             * 
                             */
                        } else {
                            $specificationData->where("goods_id=" . $data["goods_id"])->delete();
                            if (!$specificationData->add($obj)) {
                                $url = U('/Home/goods/add');
                                $this->error("属性添加失败！", $url);
                            }
                        }
                        if ($goods->save($data)) {
                            $url = U('/Home/goods/index');
                            $this->success("修改成功！", $url);
                        } else {
                            $this->error("用户修改失败！", 'index');
                        }
                    }
                } else {
                    $this->error($goods->getError());
                }
            }
        }
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
            $goodsFind['goods_img'] = json_decode($goods_img, true);
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

    public function url_ajaxhinder() {
        $id = I('post.id', 0);
        $goods_id = I('post.goods_id', 0);
        // echo $goods_id;exit;
        $specification = M("Specification s");
        $specificationData = M("SpecificationData");
        $info = $specification->field('s.*,c.cat_id,c.cat_name')
                ->join('wrt_category AS c ON c.parent_id=s.parent_id')
                ->where('c.cat_id=' . $id)
                ->find();
        $result = $specificationData->where("goods_id=$goods_id")->find();
        if ($result) {
            $info['type'] = json_decode($result['type'], true);
            $info['dname'] = explode('|', $result['name']);
            $info['did'] = $result['did'];
        } else {
            $info['type'] = json_decode($info['type'], true);
        }
        $info['name'] = explode('|', $info['name']);

        $info['action'] = 'edit';
        $this->ajaxReturn($info);
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

    public function activity() {
        $action = I('post.action');
        if (IS_POST) {
            if ($action == "edit") {
                //  print_r(I('post.gid'));exit;
                $gid = I('post.gid');
                $goods = D("VipActGood");
                $vipList = $goods->where("gid=$gid")->find();
                if (isset($vipList)) {
                    $url = U('/Home/Goods/index', '', false);
                    $this->error('该商品已有活动!');
                }
                if ($data = $goods->create()) {
                    //      $data["goods_img"] = $goods_img;
                    if ($goods->add($data)) {
                        $url = U('/Home/Activity/index');
                        $this->success("修改成功！", $url);
                    } else {
                        $this->error("用户修改失败！", 'index');
                    }
                } else {
                    $this->error($goods->getError());
                }
            }
        }

        $id = I('get.id', 0);
        if ($id) {
            $data['action'] = 'edit';
            $data['title'] = "编辑商品";
            $data['btn'] = "编辑";
            $goods = M("Goods");
            $vipList = $goods->where("goods_id=$id")->find();
            //   print_r($vipList);exit;
        }
        $vip = D('VipActivity');
        $vipdata = $vip->select();
        $this->assign('vip', $vipdata);
        $this->assign('info', $vipList);
        $this->assign('data', $data);
        $this->display();
    }

}

?>
