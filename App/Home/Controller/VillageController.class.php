<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class VillageController extends IsloginController {

    public function index() {
        //  $data = $this->getdata();
        $village = M("village v");
        $count = $village->count();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 15);
        $show = $page->show();
        $find = $village->field('v.*,h.id as hid,p.id as pid,p.pname,h.name as hname')
                //  $find = $village->field('v.*,h.id as hid,p.id as pid,p.pname,h.name as hname,r.REGION_ID,r.REGION_NAME')
                ->join('wrt_houses AS h ON v.house_id=h.id')
                ->join('wrt_property AS p ON v.property_id=p.id')
                //       ->join('wrt_region AS r ON v.province=r.REGION_ID')
                ->limit($page->firstRow . ',' . $page->listRows)
                ->select();
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        $this->assign('data', $find);
        $this->display();
    }

    /* public function getdata() {
      $page = I('get.page', 1);
      $pageSize = I('get.pageSize', 20);
      // dump($page);
      // dump($pageSize);
      $limit = "limit " . ($page - 1) * $pageSize . ',' . $pageSize;
      $sql = "select * from " . C('DB_PREFIX') . "village " . $limit;
      // dump($sql);die();
      $data = M()->query($sql);
      // dump($data);die();
      return $data;
      }
     * 
     */

    public function add() {
        $data['action'] = 'add';
        $data['title'] = "添加";
        $data['btn'] = "添加小区";
        $action = I('post.action');
        $property = M("property");
        $house = M("Houses");
        $houselist = $house->select();
        $propertyList = $property->select();
        $pro = $this->getprovence();
        $this->assign('pro', $pro);
        $this->assign('list', $houselist);
        $this->assign('prolist', $propertyList);
        if (IS_POST) {
            //  print_r($_REQUEST);exit;
            $Village = D('Village');
            $data = $Village->create();
            if ($data) {
                if ($action == "add") {
                    $data["add_time"] = time();
                    if ($Village->add($data)) {
                        $this->success("用户添加成功！", U('/Home/village/index')); //  $url = U('/Home/village/index');
                    } else {
                        $this->error("用户添加失败！", U('/Home/village/add'));
                    }
                } elseif ($action == "edit") {

                    if ($Village->save($data)) {
                        $this->success("修改成功！", U('/Home/village/index')); //    $url = U('/Home/village/index');
                    } else {
                        $this->error("用户修改失败！", U('/Home/village/add'));
                    }
                }
            } else {
                $this->error($Village->getError(), '', 1);
            }
        }
        $id = I('get.id', 0);
        if ($id) {
            $data['action'] = 'edit';
            $data['title'] = "编辑小区";
            $data['btn'] = "编辑";

            $village = M("village v");
            $find = $village->field('v.*,h.id as hid,p.id as pid,p.pname,h.name as hname,r.REGION_ID,r.REGION_NAME')
                    ->join('wrt_houses AS h ON v.house_id=h.id')
                    ->join('wrt_property AS p ON v.property_id=p.id')
                    ->join('wrt_region AS r ON v.province=r.REGION_ID')
                    ->where('v.id=' . $id)
                    ->find();
            $this->assign('info', $find);
        }
        $this->assign('data', $data);
        $this->display();
    }

    public function del() {
        $id = I('get.id', 0);
        $admin = D('village');
        $result = $admin->where("id=$id")->delete();
        if ($result) {
            redirect($_SERVER["HTTP_REFERER"]);
        }
    }

}

?>
