<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class PropertyController extends IsloginController {

    public function index() {
        //echo 1;exit;
        //    $data = $this->getdata();
        $prop = M("Property");
        $data = $prop->select();
        // print_r($data);exit;
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
            if ($action == "add") {
                $user = D('property');
                if ($data = $user->create()) {
                    $data["add_time"]=time();
                    if ($user->add($data)) {
                        $url = U('/Home/property/index');
                        $this->success("用户添加成功！", $url);
                    } else {
                        $this->error("用户添加失败！", 'index');
                    }
                }
            } elseif ($action == "edit") {
                $admin = D("Property");
                if ($adminData = $admin->create()) {
                    if ($admin->save($adminData)) {
                        $url = U('/Home/property/index');
                        $this->success("修改成功！", $url);
                    } else {
                        $this->error("用户修改失败！", 'index');
                    }
                } else {
                    $this->error($admin->getError());
                }
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
