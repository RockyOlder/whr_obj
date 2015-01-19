<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class PropertyController extends IsloginController {

    public function index() {
        //echo 1;exit;
        //    $data = $this->getdata();
        $prop = M("Property");
        $count = $prop->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 15);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $data = $prop->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        $this->assign('data', $data);
        $this->display();
    }

    public function getdata() {
        $page = I('get.page', 1);
        $pageSize = I('get.pageSize', 20);
        $limit = "limit " . ($page - 1) * $pageSize . ',' . $pageSize;
        $sql = "select * from " . C('DB_PREFIX') . "property " . $limit;
        $data = M()->query($sql);
        return $data;
    }

    public function add() {
        $data['action'] = 'add';
        $data['title'] = "添加";
        $data['btn'] = "添加物业";
        $action = I('post.action');
        $pro = $this->getprovence();
        // dump($pro);
        $this->assign('pro', $pro);
        if (IS_POST) {
            //  print_r($action);exit;
            $user = D('property');
            $data = $user->create();
            if ($data) {
                if ($action == "add") {
                    $data["add_time"] = time();
                    if ($user->add($data)) {  $this->success("用户添加成功！", U('/Home/property/index'));//$url = U('/Home/property/index'); 
                    } else { $this->error("用户添加失败！", 'index'); }
                    } elseif ($action == "edit") {
                    if ($user->save($data)) {  $this->success("修改成功！", U('/Home/property/index'));//$url = U('/Home/property/index');
                    } else { $this->error("用户修改失败！", 'index'); }
                    }
            } else {
                $this->error($user->getError(),'',1);
            }
        }
        $id = I('get.id', 0);

        if ($id) {
            //  print_r($id);exit;
            $data['action'] = 'edit';
            $data['title'] = "编辑物业";
            $data['btn'] = "编辑";
            $prope = M("Property");
            $region = M("region");
            $propeList = $prope->where("id=" . $id)->find();
            //   print_r($propeList);exit;
            $provine = $propeList['province'];
            $regionProv = $region->where("REGION_ID=" . $provine)->find();
            //  print_r($propeList);exit;
            $this->assign("region", $regionProv);
            $this->assign('info', $propeList);
        }


        $this->assign('data', $data);
        $this->display();
    }

    public function del() {
        // echo 1;exit;
        $id = I('get.id', 0);

        $class = D('property');
        $result = $class->where("id=$id")->delete();

        if ($result) {
            redirect($_SERVER["HTTP_REFERER"]);
        }
    }

}

?>
