<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

/**
 * 城市管理页面
 */
class CityController extends IsloginController {

    function index() {

// 		$data=$this->fullcity();
        //dump($data);
        $data = $this->getprovence();
        // dump($data);
        $this->assign('data', $data);
        $this->display();
    }

    //异步获取城市列表内容
    function city() {
        $id = I('post.id');
        if (!IS_AJAX || $id == "")
            return false;
        $data = $this->getcity($id);
        //dump($data);
        $this->ajaxReturn($data);
    }

    function citySave() {
        $id = I('post.id');
        if (!IS_AJAX || $id == "")
            return false;
        $data = $this->getSaveCity($id);
        //dump($data);
        $this->ajaxReturn($data);
    }

    //异步获取地区列表内容
    function vallage() {
        $id = I('post.id');
        if (!IS_AJAX || $id == "")
            return false;
        $data = $this->getvillage($id);
        //dump($data);
        $this->ajaxReturn($data);
    }

    function vallcage() {
        $id = I('post.id');
        if (!IS_AJAX || $id == "")
            return false;
        $data = $this->getvicare($id);
        //dump($data);
        $this->ajaxReturn($data);
    }

}