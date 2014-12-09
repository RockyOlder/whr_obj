<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class VillageController extends IsloginController {

    public function index() {
        //  $data = $this->getdata();
        $village = M("village v");
        $find = $village->field('v.*,h.id as hid,p.id as pid,p.pname,h.name as hname,r.REGION_ID,r.REGION_NAME')
                ->join('wrt_houses AS h ON v.house_id=h.id')
                ->join('wrt_property AS p ON v.property_id=p.id')
                ->join('wrt_region AS r ON v.province=r.REGION_ID')
                ->select();
        
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
            if ($action == "add") {
                $Village = D('Village');
                if ($data = $Village->create()) {
                          $data["add_time"] = time();
                    if ($Village->add($data)) {
                        $url = U('/Home/village/index');
                        $this->success("用户添加成功！", $url);
                    } else {
                        //  echo 2;exit;
                        $this->error("用户添加失败！", 'index');
                    }
                }
            } elseif ($action == "edit") {
                $village = D("village");
                if ($villageData = $village->create()) {
                    if ($village->save($villageData)) {
                        $url = U('/Home/village/index');
                        $this->success("修改成功！", $url);
                    } else {
                        $this->error("用户修改失败！", 'index');
                    }
                } else {
                    $this->error($village->getError());
                }
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
