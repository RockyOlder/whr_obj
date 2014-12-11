<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class CategoryController extends IsloginController {

    public function index() {
        $list = $this->getdata();
        $tree = $this->getCatTree($list, 0);
   //     print_r($tree);exit;
        $this->assign('data', $tree);
        $this->display();
    }

    public function getdata() {
        $page = I('get.page', 1);
        $pageSize = I('get.pageSize', 20);

        $limit = "limit " . ($page - 1) * $pageSize . ',' . $pageSize;
        $sql = "select * from " . C('DB_PREFIX') . "category " . $limit;
        $data = M()->query($sql);
        return $data;
    }

    public function add() {
        $data['action'] = 'add';
        $data['title'] = "添加";
        $data['btn'] = "添加分类";
        $action = I('post.action');
        if (IS_POST) {
            if ($action == "add") {
                // //thumb_pic
             //  print_r(I('post.thumb_pic'));
                $user = D('Category');
                if ($data = $user->create()) {
                    if($data["parent_id"]!==0){
                       $data['cat_img']=I('post.thumb_pic'); 
                    }
                    $data['add_time'] = time();
                    if ($user->add($data)) {
                        $url = U('/Home/category/index');
                        $this->success("分类添加成功！", $url);
                    } else {
                        $this->error("分类添加失败！", 'index');
                    }
                }
            } elseif ($action == "edit") {
                $cat = D("Category");
                $cat_id = I('get.id', 0);
          //   print_r($_REQUEST);exit;
                if ($data = $cat->create()) {   
                    $trees = $this->getTree($cat, I('get.parent_id', 0));
                    $flag = true;
                    foreach ($trees as $v) {
                        if ($v['cat_id'] == $cat_id) {
                            $flag = false;
                            break;
                        }
                    }
                                      
                    if (!$flag) {   $url = U('/Home/category/add', '', false);  $this->error('父栏目选择错误!'); }
                    
                    if($data["parent_id"]!==0){ $data['cat_img']=I('post.thumb_pic');  }
                    
                    if ($cat->save($data)) {  $url = U('/Home/category/index');  $this->success("修改成功！", $url);
                    } else {
                        $url = U('/Home/category/add', '', false);  $this->error('修改失败!');
                    }
                } else {
                    $this->error($cat->getError());
                }
            }
        }
        $id = I('get.id', 0);
        $cat = M("Category");
        $catlist = $cat->select();
        if ($id) {
            $data['action'] = 'edit';
            $data['title'] = "编辑栏目";
            $data['btn'] = "编辑";
            $catfind = $cat->where("cat_id=$id")->find();
            $cattree = $this->getCatTree($catlist);
            $arr = array();
            $selected = 'selected';
            foreach ($cattree as $v) {
                if ($v['cat_id'] == $catfind['parent_id']) {
                    array_push($arr, array('cat_id' => $v['cat_id'], 'selected' => $selected, 'cat_name' => str_repeat('&nbsp', $v['lev']) . $v['cat_name']));
                } else {
                    array_push($arr, array('cat_id' => $v['cat_id'], 'cat_name' => str_repeat('&nbsp', $v['lev']) . $v['cat_name']));
                }
            }
        //    print_r($arr);exit;
            $this->assign('arr', $arr);
            $this->assign('info', $catfind);
        } else {
            $tree = $this->getCatTree($catlist);
            $arr = array();
            foreach ($tree as $v) {
                array_push($arr, array('cat_id' => $v['cat_id'], 'cat_name' => str_repeat('&nbsp', $v['lev']) . $v['cat_name']));
            }
            $this->assign('arr', $arr);
        }
        $this->assign('data', $data);
        $this->display();
    }

    public function del() {
        $id = I('get.id', 0);
        $cat = M("Category");
        $catlist = $cat->field('cat_id,cat_name,parent_id')
                ->where('parent_id=' . $id)
                ->select();
        if (!empty($catlist)) {
            $url = U('/Home/category/add', '', false);
            $this->error('有子栏目,删除失败');
        }
        $result = $cat->where("cat_id=$id")->delete();
        if ($result) {
            redirect($_SERVER["HTTP_REFERER"]);
        }
    }

    public function getCatTree($arr, $id = 0, $lev = 0) {
        $tree = array();
        foreach ($arr as $v) {
            if ($v['parent_id'] == $id) {
                $v['lev'] = $lev;
                $tree[] = $v;
                $tree = array_merge($tree, $this->getCatTree($arr, $v['cat_id'], $lev + 4));
            }
        }
        return $tree;
    }

    public function getTree($cat, $id = 0) {
        $tree = array();
        $cats = $cat->select();
        while ($id > 0) {
            foreach ($cats as $v) {
                if ($v['cat_id'] == $id) {
                    $tree[] = $v;

                    $id = $v['parent_id'];
                    break;
                }
            }
        }

        return array_reverse($tree);
    }

}

?>
