<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class ProInfoController extends IsloginController {

    public function index() {
        $house = M("ProNotice p");

        $count = $house->join('wrt_property AS y ON p.proid=y.id')->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 20);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
       
        $data = $house->field('p.*,y.id as yid,y.pname')->join('wrt_property AS y ON p.proid=y.id') ->limit($page->firstRow . ',' . $page->listRows)->select();
        
        if (empty($data)) { $this->redirect("add"); }
    
        $this->assign("currentPage", $currentPage); $this->assign("totalPage", $page->totalPages); $this->assign("page", $show); $this->assign('data', $data);
        $this->display();
    }

    public function add() {
        $data['action'] = 'add'; $data['title'] = "添加"; $data['btn'] = "添加公告";
     
        $action = I('post.action');  $pro = M('property');
      
        $proList = $pro->select();
        $this->assign('pro', $proList);
     
        if (IS_POST) {
            $pntice = D('ProNotice');
            $data = $pntice->create();
          if ($data) {
              if ($action == "add") {
                    $_villa = _vialg($data);
                   if (!empty($_villa)) {  $this->error($_villa . '  添加失败!',U('/Home/proInfo/add', '', false)); }
                  //     print_r($_REQUEST);EXIT;
                     $data['add_time'] = time();
                     $data['content'] = $_POST['content'];
                    if ($pntice->add($data)) {  $this->success("用户添加成功！", U('/Home/proInfo/index')); } else { $this->error("用户添加失败！", U('/Home/proInfo/index')); }
                
             } elseif ($action == "edit") {
             
                    if ($pntice->save($data)) { $this->success("修改成功！", U('/Home/proInfo/index'));} else { $this->error('修改失败!',U('/Home/proInfo/add', '', false));
                        
           } } } else { $this->error($pntice->getError()); } }
                    
        $id = I('get.id', 0);
        if ($id) {
            $data['action'] = 'edit';
            $data['title'] = "编辑公告";
            $data['btn'] = "编辑";
            $house = M("ProNotice p");
            $info = $house->field('p.*,y.id as yid,y.pname')
                    ->join('wrt_property AS y ON p.proid=y.id')
                    ->where('p.id=' . $id)
                    ->find();
            $this->assign('info', $info);
        }

         session('table', base64_encode('ProNotice'));
        if (I('get.nid')) { session('id', I('get.nid'));$this->redirect('activein');}
        

        $this->assign('data', $data);
        $this->display();
    }

    public function word() {
        $data['action'] = 'add'; $data['title'] = "添加/修改"; $data['btn'] = "提交关键词";
    
        $action = I('post.action');
     
        $word = M('ProKeyword');  $wordfind = $word->find();
     
        if ($wordfind) {
            $data['action'] = 'edit';
            $wordfind['pname'] = implode(",", json_decode($wordfind['pname']));
            $this->assign('word', $wordfind);
        }
        if (IS_POST) {
             $word = D('ProKeyword');
             $data = $word->create();
          if ($data) { 
              $data['pname'] = json_encode(explode(",", $data['pname']));// $dataname = explode(",", $data['pname']);
              
             if ($action == "add") {

                if ($wordfind) {  $this->error('已有关键设置,添加失败!',U('/Home/proInfo/word', '', false));  }   //  $url = U('/Home/proInfo/word', '', false);

                    if ($word->add($data)) { $this->success("用户添加成功！", U('/Home/ProInfo/word')); } else { $this->error("用户添加失败！", U('/Home/ProInfo/word'));}
                
              } elseif ($action == "edit") {
                    
                    if ($word->save($data)) { $this->success("修改成功！", U('/Home/ProInfo/word')); } else { $this->error("用户修改失败！", U('/Home/ProInfo/word'));
                        
          } } } else { $this->error($word->getError());  } }
          
        $this->assign('data', $data);
        $this->display();
    }

    public function examine() {
        $data['action'] = 'add'; $data['title'] = "添加"; $data['btn'] = "添加调查";
     
        $action = I('post.action');
      
        $prosury = M("ProSurvey"); $count = $prosury->count();
      
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 2);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $prolist = $prosury->limit($page->firstRow . ',' . $page->listRows)->select();
       
        $this->assign("currentPage", $currentPage); $this->assign("totalPage", $page->totalPages); $this->assign("page", $show); $this->assign('pro', $prolist);
        if (IS_POST) {
    
            if (I('post.pid')) {session('table', base64_encode('ProSurvey')); session('pid', I('post.pid'));$this->redirect('urlAJAX'); }
      
             $prosuvey = D('ProSurvey');
             $data = $prosuvey->create();
          if ($data) {
               if ($action == "add") {  $data['Release_time'] = time(); $data['add_time'] = time();
            
                    if ($prosuvey->add($data)) { $this->success("用户添加成功！", U('/Home/proInfo/examine')); } else { $this->error("用户添加失败！", U('/Home/proInfo/examine')); }
                
               } elseif ($action == "edit") {

                    if ($prosuvey->save($data)) {$this->success('修改成功!', U('/Home/proInfo/examine')); } else { $this->error("修改失败！", U('/Home/proInfo/examine'));
                        
               } } } else { $this->error($prosuvey->getError()); } }
                    
        $this->assign('data', $data);
        $this->display();
    }
    public function urlAJAX() {
        $id = session('pid');
        $table = base64_decode(session('table'));
        $pro = M("$table");
        $info = $pro->where("id=" . $id)->find();
        $info['action'] = 'edit';
        $this->ajaxReturn($info);
    }
    public function carpool() {
        $data['action'] = 'add'; $data['title'] = "添加"; $data['btn'] = "添加调查";
    
        $action = I('post.action');
     
        $procar = M("ProCar"); $count = $procar->where("pid=0")->count();
       
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 10);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $prolist = $procar->where("pid=0")->limit($page->firstRow . ',' . $page->listRows)->select();
       
        $this->assign("currentPage", $currentPage); $this->assign("totalPage", $page->totalPages); $this->assign("page", $show); $this->assign('pro', $prolist);
        if (IS_POST) {
             $procar = D("ProCar");
             $data = $procar->create();
          if ($data) {
              if ($action == "add") { $data['add_time'] = time();
            
                    if ($procar->add($data)) { $this->success("用户添加成功！",  U('/Home/proInfo/carpool')); } else {$this->error("用户添加失败！",  U('/Home/proInfo/carpool'));}
                
               } elseif ($action == "edit") {
                
                    if ($procar->save($data)) { $this->success('修改成功!', U('/Home/proInfo/carpool'));} else {$this->error("修改失败！", U('/Home/proInfo/carpool'));
                        
             } } } else { $this->error($procar->getError()); } }
             
        session('table', base64_encode('ProCar'));
        if (I('get.id')) { session('id', I('get.id'));$this->redirect('activein');}
        if (I('post.pid')) { session('pid', I('post.pid'));$this->redirect('urlAJAX'); }
        $this->assign('data', $data);
        $this->display();
    }

    public function active() {
        $data['action'] = 'add'; $data['title'] = "添加"; $data['btn'] = "添加调查";
     
        $action = I('post.action');
       
        $proactiv = M("ProActivity");  $count = $proactiv->where('pid=0')->count();
        //    session('table', null); // 删除table //   session('id', null); // 删除id
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 15);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $prolist = $proactiv->limit($page->firstRow . ',' . $page->listRows)->select();
       
        $this->assign("currentPage", $currentPage); $this->assign("totalPage", $page->totalPages); $this->assign("page", $show); $this->assign('pro', $prolist);
        if (IS_POST) {
            $proactiv = D("ProActivity");
            $data = $proactiv->create();
          if ($data) {
              if ($action == "add") {$data['add_time'] = time();
                   
                  if ($proactiv->add($data)) { $this->success("用户添加成功！", U('/Home/proInfo/active')); } else { $this->error("用户添加失败！", U('/Home/proInfo/active')); }
                
              } elseif ($action == "edit") {
                  
                  if ($proactiv->save($data)) { $this->success('修改成功!', U('/Home/proInfo/active')); } else { $this->error("修改失败！", U('/Home/proInfo/active'));
                        
            } } } else { $this->error($proactiv->getError()); } }
            
        session('table', base64_encode('ProActivity'));
        if (I('get.id')) { session('id', I('get.id'));$this->redirect('activein');}
        if (I('post.pid')) { session('pid', I('post.pid'));$this->redirect('urlAJAX'); }
        
        $this->assign('data', $data);
        $this->display();
    }

    public function hinder() {
        $data['action'] = 'add'; $data['title'] = "添加";  $data['btn'] = "添加调查";
      
        $action = I('post.action');
     
        $prorepair = M("ProRepair"); $count = $prorepair->where("pid=0")->count();
      
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 15);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $prolist = $prorepair->where("pid=0")->limit($page->firstRow . ',' . $page->listRows)->select();
     
        $this->assign("currentPage", $currentPage); $this->assign("totalPage", $page->totalPages); $this->assign("page", $show); $this->assign('pro', $prolist);
        if (IS_POST) {
            $prorepair = D("ProRepair");
            $data = $prorepair->create();
         if ($data) {
             if ($action == "add") { $data['time'] = time();
            
                 if ($prorepair->add($data)) { $this->success("用户添加成功！", U('/Home/proInfo/hinder'));} else { $this->error("用户添加失败！", U('/Home/proInfo/hinder')); }

             } elseif ($action == "edit") {
                    $prorepair->where(array('id' => I('post.id')))->setInc('num');
                    $data['pid'] = I('post.id');$data['time'] = time();
                    
                 if ($prorepair->add($data)) { $this->success('回复成功!', U('/Home/proInfo/hinder')); } else { $this->error("回复失败！", U('/Home/proInfo/hinder'));
                        
            } } } else { $this->error($prorepair->getError()); } }
            
        session('table', base64_encode('ProRepair'));
        if (I('get.id')) { session('id', I('get.id'));$this->redirect('activein');}
        if (I('post.pid')) { session('pid', I('post.pid'));$this->redirect('urlAJAX'); }

        $this->assign('data', $data);
        $this->display();
    }

    public function decorate() {
        $data['action'] = 'add'; $data['title'] = "添加"; $data['btn'] = "添加调查"; $action = I('post.action');
     
        $pro = M("ProDecorate"); $count = $pro->where("pid=0")->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 15);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $prolist = $pro->where("pid=0")->limit($page->firstRow . ',' . $page->listRows)->select();
    
        $this->assign("currentPage", $currentPage); $this->assign("totalPage", $page->totalPages);  $this->assign("page", $show); $this->assign('pro', $prolist);
        if (IS_POST) {
             $pro = D("ProDecorate");
             $data = $pro->create();
           if ($data) {
               
              if ($action == "add") {$data['add_time'] = time();
              
                   if ($pro->add($data)) { $this->success("用户添加成功！", U('/Home/proInfo/decorate'));} else { $this->error("用户添加失败！", U('/Home/proInfo/decorate')); }
                
               } elseif ($action == "edit") {
                    $pro->where(array('id' => I('post.id')))->setInc('num');
                    $data['pid'] = I('post.id');$data['time'] = time();
                  
                    if ($pro->add($data)) { $this->success('回复成功!', U('/Home/proInfo/decorate'));} else { $this->error("回复失败！", U('/Home/proInfo/decorate'));
                        
             } } } else { $this->error($pro->getError()); } }
                    
        session('table', base64_encode('ProDecorate'));
        if (I('get.id')) { session('id', I('get.id'));$this->redirect('activein');}
        if (I('post.pid')) { session('pid', I('post.pid'));$this->redirect('urlAJAX'); }
        $this->assign('data', $data);
        $this->display();
    }

    public function repair() {
        $data['action'] = 'add'; $data['title'] = "添加"; $action = I('post.action');
      
        $pro = M("ProComplaints"); $count = $pro->where("pid=0")->count();
      
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 15);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $prolist = $pro->where("pid=0")->limit($page->firstRow . ',' . $page->listRows)->select();
    
        $this->assign("currentPage", $currentPage); $this->assign("totalPage", $page->totalPages); $this->assign("page", $show); $this->assign('pro', $prolist);
        if (IS_POST) {
            $pro = D("ProComplaints");
            $data = $pro->create();
          if ($data) {
              if ($action == "add") {$data['add_time'] = time();
            
                if ($pro->add($data)) { $this->success("用户添加成功！", U('/Home/proInfo/repair'));} else {$this->error("用户添加失败！", U('/Home/proInfo/repair'));}

              } elseif ($action == "edit") {
                    $pro->where(array('id' => I('post.id')))->setInc('num');
                    $data['pid'] = I('post.id'); $data['time'] = time();
                    
                 if ($pro->add($data)) { $this->success('回复成功!', U('/Home/proInfo/repair'));} else {$this->error("回复失败！", U('/Home/proInfo/repair'));
                        
            } } } else {$this->error($pro->getError());} }
            
        session('table', base64_encode('ProComplaints'));
        if (I('get.id')) { session('id', I('get.id'));$this->redirect('activein');}
        if (I('post.pid')) { session('pid', I('post.pid'));$this->redirect('urlAJAX'); }
        $this->assign('data', $data);
        $this->display();
    }
    public function activein() {
        $id = session('id');
        $table = base64_decode(session('table'));
        //  print_r($_SESSION);EXIT;
        $pro = M("$table");
        $info = $pro->where("id=" . $id)->find();
        $count = $pro->where("pid=" . $info['id'] . " and sheild=0")->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 15);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $info['list'] = $pro->where("pid=" . $info['id'] . " and sheild=0")->limit($page->firstRow . ',' . $page->listRows)->select();
        $pid = I('get.sheild');
        if ($pid) {$obj = D("$table");if ($obj->where(array('id' => $pid))->setInc('sheild')) {redirect($_SERVER["HTTP_REFERER"]); } }
        
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        $this->assign('info', $info);
        $this->display();
    }

    public function swap() {
        $name = session('admin.name');
      
        $data['action'] = 'add'; $data['title'] = "添加"; $data['btn'] = "闲置交换"; $action = I('post.action');
      
        $pro = M("ProFetch"); $count = $pro->where("pid=0")->count();
        //  session('table', null); // 删除table//  session('id', null); // 删除id
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 15);
        $show = $page->show();
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $prolist = $pro->where("pid=0")->limit($page->firstRow . ',' . $page->listRows)->select();
     
        $this->assign("currentPage", $currentPage); $this->assign("totalPage", $page->totalPages);  $this->assign("page", $show); $this->assign('pro', $prolist);
        if (IS_POST) {
           $pro = D("ProFetch");
           $data = $pro->create();
          if ($data) {
              if ($action == "add") {
                    $data['add_time'] = time();
                    if ($pro->add($data)) {$this->success("用户添加成功！",  U('/Home/proInfo/swap'));} else { $this->error("用户添加失败！", 'index');}

               } elseif ($action == "edit") {
                        
                    if ($pro->save($data)) {$this->success('修改成功!', U('/Home/proInfo/swap'));} else { $this->error("修改失败！", U('/Home/proInfo/swap'));
                       
          } } } else {$this->error($pro->getError()); } }
                        
        session('table', base64_encode('ProFetch'));
        if (I('get.id')) { session('id', I('get.id'));$this->redirect('activein');}
        if (I('post.pid')) { session('pid', I('post.pid'));$this->redirect('urlAJAX'); }

        $this->assign('username', $name);
        $this->assign('data', $data);
        $this->display();
    }

}

?>
