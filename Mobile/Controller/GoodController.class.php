<?php
namespace Mobile\Controller;
use Think\Controller;
class GoodController extends Controller {
    public function index(){
        // 获取用户传递过来的id
        $id = I('request.id',0,'intval');
        $field = "goods_id,description,intro";
        //查找商品的属性和图文详情
        $data = M('goods')->field($field)->where(array('goods_id'=>$id))->find();
        $data['intro'] = htmlspecialchars_decode($data['intro']);
        $data['intro'] = str_replace('<img', "<img width=100%", $data['intro']);
        // dump($data);die();
        
        $type = M('specification_data')->field('type')->where(array('goods_id'=>$id))->find();
        $type = json_decode($type['type'],true);
        $this->assign('type',$type);
        // dump($type);die();
        $this->assign('info',$data);
    	$this->display();
        }
}