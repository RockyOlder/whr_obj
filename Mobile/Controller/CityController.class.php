<?php
namespace Mobile\Controller;
use Think\Controller;
/**
 * 城市管理页面
 */
class CityController extends Controller {
    private $field = "REGION_ID,REGION_NAME";
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
        $data = $this->getSaveCity($id);
        //dump($data);
        $this->ajaxReturn($data);
    }
    //根据省的id查询出所有的城市列表
    function getcity($id) {
//      dump($id);
//      dump(empty($id));
        if (empty($id))
            return null;

        $sql = "select " . $this->field . " from " . C('DB_PREFIX') . "region where parent_id =" . $id;
//      dump($sql);
        return M()->query($sql);
    }



    //根据城市的id查询出所有的区列表
    function getvillage($id) {
        if (empty($id))
            return null;

        $sql = "select " . $this->field . " from " . C('DB_PREFIX') . "region where parent_id =" . $id;
        return M()->query($sql);
    }

}