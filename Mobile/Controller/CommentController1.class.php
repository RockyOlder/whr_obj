<?php

namespace Mobile\Controller;

use Think\Controller;

class CommentController extends Controller {

    public function index() {
        //  $id = I('request.gid',0,'intval');
        $id = 2;
        if ($id) {

            $VipComment = D("VipComment c");

            $count = $VipComment->join('wrt_user AS u ON u.user_id=c.user_id')->where('c.gid=' . $id)->count();
            $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 2);
            $show = $page->show();
            //   print_r($show);exit;
            $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
            $goodsFind = $VipComment->field('c.*,u.user_id,u.user_name,u.face')
                    ->join('wrt_user AS u ON u.user_id=c.user_id')
                    //   ->join('wrt_vip AS v ON v.store_id=o.shop_id')
                    ->where('c.gid=' . $id)
                    ->limit($page->firstRow . ',' . $page->listRows)
                    ->select();
         //   print_r($goodsFind);
         //  dump($VipComment->getLastSql());
            //   $goodsFind['time'] = date("Y-m-d H:i:s", $goodsFind['time']);
            //  $goodsFind['action'] = 'edit';
        } else {
            $this->error($VipComment->getError());
        }
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        $this->assign('data', $goodsFind);
        $this->display();
    }

}

?>
