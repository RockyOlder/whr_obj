<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

//开发商管理
class DeveloperController extends IsloginController {

    // 开发商总部列表页面
    public function index() {
        $devop=M("developer_sum");
        $count = $devop->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 10);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $data = $devop->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        $this->assign('data', $data);
        $this->display();
    }

    public function selectDeveloper() {
        $data = $this->getdata();
        echo json_encode($data);
        //$this->display ();
    }

    // 开发商分部列表页面
    public function sonlist() {
        $data = $this->getson();
        // dump($data);
        $this->assign('data', $data);
        $this->display();
    }

    public function del() {
        $id = I('get.id', 0);
        if (!empty($_GET['pid'])) {
            $id = I('get.pid', 0);
            $class = D('developer');
            $result = $class->where("id=$id")->delete();
        } elseif (!empty($_GET['id'])) {
            $class = D('developer_sum');
            $result = $class->where("id=$id")->delete();
        }

        if ($result) {
            redirect($_SERVER["HTTP_REFERER"]);
        }
    }

    // 添加和编辑开发商管理
    public function add() {
   //     echo 1;exit;
        //  print_r($_REQUEST);
        $data['action'] = 'add';
        $data['title'] = "添加开发商";
        $data['btn'] = "添加";
        // dump($_POST);die();
        if (IS_POST) {
            $time = time();
            $id = I('post.id');
            $father = I('post.father');
            $name = I('post.name');
            $action = I('post.action');
            $admin = I('post.admin');
            $sort = I('post.sort');
            $owner = I('post.owner');
            $phone = I('post.phone');
            $provence = I('post.provence');
            $city = I('post.city');
            $pid = I('post.pid');
            $notice = I('post.notice');
            if ($action == "add") {
                $msg = "添加";
                if ($father) {
                    $sql = "insert into " . C('DB_PREFIX') . "developer_sum set name='$name' , phone = '$phone',owner = '$owner',sort = $sort,addtime = $time,admin='$admin'";
                    // dump($sql);
                    $bool = M()->execute($sql);
                    // dump($bool);die();
                } else {
                    //  echo 2;exit;
                    $class = D('Developer');
                    if ($data = $class->create()) {
                        $bool = $class->add($data);
                    } else {
                        $this->error($class->getError());
                    }
                }
            } elseif ($action == "edit") {
                $msg = "编辑";
                if ($father) {
                    $sql = "update " . C('DB_PREFIX') . "developer_sum set name='$name' , phone = '$phone',owner = '$owner',sort = $sort,addtime = $time,admin='$admin' where id =$id";
                    // dump($sql);
                    $bool = M()->execute($sql);
                    // dump($bool);die();
                } else {
                    $sql = "update " . C('DB_PREFIX') . "developer set name='$name' , phone = '$phone',owner = '$owner',sort = $sort,addtime = $time,admin='$admin',province = $provence,city = $city,notice ='$notice' where id =$id";
                    // dump($sql);
                    $bool = M()->execute($sql);
                }
            }
            if ($bool) {
                //   $this->error($msg . "成功");
                $this->success($msg . "成功！", U('Developer/index'), 1, FALSE);
            } else {
                //$this->error($msg . "失败");
            }
        }
        // 如果是编辑开发商的话，传递一个开发商的id编号过来
        $id = I('get.id', 0);
        $data['id'] = $id;
        $pid = I('get.pid', 0);
        if ($id) {
            $data['action'] = 'edit';
            $data['title'] = "编辑开发商";
            $data['btn'] = "编辑";
            if ($pid) {
                $table = C('DB_PREFIX') . "developer";
            } else {
                $table = C('DB_PREFIX') . "developer_sum";
            }
            $sql = "select * from " . $table . " where id =$id";
            // dump($sql);
            $info = M()->query($sql);
            if (!empty($info)) {
                $info = current($info);
                if ($info['parent'] == NULL) {
                    $info['parent'] = 0;
                }
            }
            // dump($info);die();
            $this->assign('info', $info);
        }
        // 将数据传递给页面
        $this->assign('data', $data);
        $this->display();
    }

    public function class_Update() {
        //  print_r($_GET);EXIT;
        $id = I('get.id', 0);
        if (!empty($_POST)) {
            // echo 1;exit;
            $del_update = D('developer');
            if ($data = $del_update->create()) {
                $pid = $data['pid'];
                if ($del_update->save($data)) {
                    $url = U('Developer/delvePid', array('id' => $pid));
                    //   print_r($url);exit;
                    $this->success('修改成功!', $url);
                } else {
                    $url = U('Developer/delvePid', '', false);
                    $this->error('修改失败!');
                }
            } else {
                $url = U('Developer/delvePid', '', false);
                $this->error($del_update->getError());
            }
        } else {
            $del_update = M("developer");
            $class_find = $del_update->where("id=" . $id)->find();
            $this->assign("info", $class_find);
            $this->display('Developer:add');
        }
    }

    public function delvePid() {
        //echo 1;exit;
        $id = $_GET['id'];
        $obj = M('developer_sum');
        $data = $obj->where("id=" . $id)->find();
        //  print_r($data);exit;
        $data['action'] = 'edit';
        $pid = $this->getson();
        $this->assign('pid', $pid);

        $this->assign('data', $data);

        $this->display();
    }

    // 获取顶级开发商数据
    public function getdata() {
        $page = I('get.page', 1);
        $pageSize = I('get.pageSize', 20);
        // dump($page);
        // dump($pageSize);
        $limit = "limit " . ($page - 1) * $pageSize . ',' . $pageSize;
        $sql = "select * from " . C('DB_PREFIX') . "developer_sum " . $limit;
        // dump($sql);die();
        $data = M()->query($sql);
        // dump($data);die();
        return $data;
    }

    // 获取开发商的分公司
    public function getson() {
        $id = I('get.id', 0);
        $page = I('get.page', 1);
        $pageSize = I('get.pageSize', 20);
        $limit = "limit " . ($page - 1) * $pageSize . ',' . $pageSize;
        $sql = "select * from " . C('DB_PREFIX') . "developer where pid = $id " . $limit;
        $data = M()->query($sql);
        // dump($data);die();
        return $data;
    }

}