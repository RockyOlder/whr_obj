<?php
namespace Mobile\Controller;
use Think\Controller;
class GoodController extends Controller {
    public function index(){
        // 获取用户传递过来的id
        $id = I('request.id',0,'intval');
        $field = "goods_id,description";
        //查找商品的属性和图文详情
        $data = M('goods')->field($field)->where(array('goods_id'=>$id))->find();
        // dump($data);
        $this->assign('info',$data);
    	$this->display();
        }
}