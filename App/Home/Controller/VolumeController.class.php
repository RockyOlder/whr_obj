<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class VolumeController extends IsloginController {
    /**
     * 电子消费卷列表显示页面
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-07T16:37:09+0800
     * @return [type]                   [description]
     */
    public function index() {
        //dump(session());
        //dump(time());die();
        $table = M("order");
        $where = array('is_end'=>0,'cate'=>0,'shop_id'=>session('admin.shop_id'));
        // dump($where);die();
        //dump($_POST);
        if ($_POST['statue'] != '') {
            $where['check_statue']= $_POST['statue'];
        }
        //dump($_POST['number'] !='');
        if ($_POST['number'] !='') {
            $where['number']= $_POST[number];
        }
        //dump($where);
        $count = $table->where($where)
                ->count();
        $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 20);
        $show = $page->show();
     //   print_r($show);exit;
        $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
        $type = M("type");
        $typeList = $type->select();
        $field = "oid,number,statue,time,user_id,totle,price,sum,check_statue";
        $data = $table
                ->where($where)
                ->limit($page->firstRow . ',' . $page->listRows)
                ->select();
        $this->assign('type', $typeList);
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        $this->assign('data', $data);
        //分配订单状态到页面
        $statue = array('未消费','已经消费','已退款');
        $this->assign('statue',$statue);
        $this->display();
    }

    /**
     * 电子消费卷验证码
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-07T15:36:22+0800
     * @return [type]                   [description]
     */
    public function check() {
        if (IS_AJAX) {
            $number = I('post.data');
            // 查找电子消费码是否未验证
            
            $w = array('check_number'=>$number);
            $bool = M('order')->field('check_statue,oid')->where($w)->find();
            //dump($bool);die();
            if ($bool['check_statue'] == 0) {
                $data = array('oid'=>$bool['oid'],'check_statue'=>1);
                $n = M('order')->save($data);
                if($n){
                    $out['statue']=1;
                    $out['msg'] = "验证成功";
                }else{
                    $out['statue']=0;
                    $out['msg'] = "验证失败，因为数据修改失败";
                }
                

            }elseif($bool['check_statue'] == 1){
                $out['statue'] = 0;
                $out['msg'] = "改电子劵已经验证使用";
            }
            $this->ajaxReturn($out);
        }
        $this->display();
    }
  
  
}