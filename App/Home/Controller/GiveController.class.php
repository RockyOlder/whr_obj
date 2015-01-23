<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class GiveController extends IsloginController {

    public function good() {
        //    echo 1;exit;
        $vip = M('GiveLifeGoods g');
        $count = $vip->count();
        // dump($count);
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 10);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $find = $vip->field('g.*,w.lgname,w.list_pic')
                ->join('wrt_life_goods AS w ON w.lgid=g.goodid')
                ->limit($page->firstRow . ',' . $page->listRows)
                ->select();
        //循环数据设置推荐范围
        foreach ($find as $k => $v) {
            if ($v['is_all'] == 1) {
                $v['extent'] = "全国";
            }else{
                $w = array('REGION_ID'=>$v['city_id']);
                $extent = M('region')->field('REGION_NAME')->where($w)->find();
                // dump($extent);die();
                $v['extent'] = current($extent);
            }
            $find[$k]= $v;
        }   
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        $this->assign('data', $find);
        $this->display();
    }
    public function shop() {
        //    echo 1;exit;
        $vip = M('GiveLifeShop g');
        $count = $vip->count();
        // dump($count);
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 15);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $find = $vip->field('g.*,b.name,b.list_pic')
                ->join('wrt_business AS b ON b.id=g.shopid')
                ->limit($page->firstRow . ',' . $page->listRows)
                ->select();
        //循环数据设置推荐范围
        foreach ($find as $k => $v) {
            if ($v['is_all'] == 1) {
                $v['extent'] = "全国";
            }else{
                $w = array('REGION_ID'=>$v['range']);
                $extent = M('region')->field('REGION_NAME')->where($w)->find();
                // dump($extent);die();
                $v['extent'] = current($extent);
            }
            $find[$k]= $v;
        }                // dump($find);
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        $this->assign('data', $find);
        $this->display();
    }
    
    public function recommendedBusiness() {
         $action = I('post.action');
         $pro = $this->getprovence();
         $this->assign('pro', $pro);
        if ($action == "edit") {  $giveLifeShop= D("giveLifeShop");
         
              if ($data = $giveLifeShop->create()) {
             
                  $data["add_time"] = strtotime(I('post.add_time')); $data["deadline"] = strtotime(I('post.deadline'));
              
                if ($giveLifeShop->save($data)) {    $this->success("修改成功！", U('/Home/Give/shop')); } else {  $this->error("用户修改失败！", U('/Home/Give/recommendedBusiness'));  }
           
           } else { $this->error($giveLifeShop->getError()); } }

        $id = I('get.id', 0);
        if ($id) {
            
            $data['action'] = 'edit';
            $giveLifeShop= D("giveLifeShop");
            $region = M("region");
            $giveLifeGoodsFIND = $giveLifeShop->where("id=$id")->find();
            $regionProv = $region->where("REGION_ID=" . $giveLifeGoodsFIND['province'])->find();
            $giveLifeGoodsFIND['add_time'] = date("Y-m-d H:i:s", $giveLifeGoodsFIND['add_time']);
            $giveLifeGoodsFIND['deadline'] = date("Y-m-d H:i:s", $giveLifeGoodsFIND['deadline']);

            $this->assign('info', $giveLifeGoodsFIND);
            $this->assign("region", $regionProv);
        }
        //$this->redirect("home/del",array());

        $this->assign('data', $data);
        $this->display();
    }
        public function recommendedGoods() {
        $action = I('post.action');
       $pro = $this->getprovence();

        $this->assign('pro', $pro);
        if ($action == "edit") {
            $giveLifeGoods= D("giveLifeGoods");
           if ($data = $giveLifeGoods->create()) {

               $data["add_time"] = strtotime(I('post.add_time')); $data["deadline"] = strtotime(I('post.deadline'));
               
             if ($giveLifeGoods->save($data)) { $this->success("修改成功！", U('/Home/Give/good')); } else { $this->error("用户修改失败！", U('/Home/Give/recommendedGoods'));  }
         
          } else { $this->error($giveLifeGoods->getError()); } }

        $id = I('get.id', 0);
        if ($id) {
            
            $data['action'] = 'edit';
            $giveLifeGoods= D("giveLifeGoods");
            $region = M("region");
            $giveLifeGoodsFIND = $giveLifeGoods->where("id=$id")->find();
            $regionProv = $region->where("REGION_ID=" . $giveLifeGoodsFIND['province'])->find();
            $giveLifeGoodsFIND['add_time'] = date("Y-m-d H:i:s", $giveLifeGoodsFIND['add_time']);
            $giveLifeGoodsFIND['deadline'] = date("Y-m-d H:i:s", $giveLifeGoodsFIND['deadline']);

            $this->assign('info', $giveLifeGoodsFIND);
            $this->assign("region", $regionProv);
        }
        //$this->redirect("home/del",array());

        $this->assign('data', $data);
        $this->display();
    }
    
    public function ajax_del_shop() {
        // echo 1;exit;
    //    $id = I('request.id', 0,'intval');
        $id = I('get.id', 0);
        $model = D('give_life_shop'); $business=D("business");
        $vipFind=$model->where("id=$id")->find();
        $bool = $model->delete($id);
        if ($bool) {
           $business->where("id=".$vipFind['shopid'])->setDec('num');
            redirect($_SERVER["HTTP_REFERER"]);
        }else {
              $this->error("用户修改失败！", 'index');
        }
     /*   if ($bool) {
           $business->where("id=".$vipFind['shopid'])->setDec('num');
            $out['statue'] = 1;
            $out['msg'] = "操作成功";
        }else{
            $out['statue'] = 0;
            $out['msg'] = '操作失败';
        }*/
       // $this->ajaxReturn($out);
    }
    public function ajax_del_goods() {
        // echo 1;exit;
        $id = I('get.id', 0);
        //echo $id;exit;
        $model = D('give_life_goods');
        $goods= D("LifeGoods");
        $vipFind=$model->where("id=$id")->find();
        $bool = $model->delete($id);
        if ($bool) {
           $goods->where("lgid=".$vipFind['goodid'])->setDec('num');
            redirect($_SERVER["HTTP_REFERER"]);
        }else {
              $this->error("用户修改失败！", 'index');
        }
       /* if ($bool) {
           $goods->where("lgid=".$vipFind['goodid'])->setDec('num');
            $out['statue'] = 1;
            $out['msg'] = "操作成功";
        }else{
            $out['statue'] = 0;
            $out['msg'] = '操作失败';
        }
        * 
        */
    //    $this->ajaxReturn($out);
    }
}

?>
