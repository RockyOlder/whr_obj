<?php

namespace Mobile\Controller;

use Think\Controller;

class CommentController extends Controller {

    public function index() {

         $id = I('request.id',0,'intval');
         // dump($id);
     //  $id = 2;
        if (!$id) {
            $this->error('请传入商品id');
        }

            $VipComment = D("VipComment c");

            $count = $VipComment->join('wrt_user AS u ON u.user_id=c.user_id')->where('c.gid=' . $id)->count();
            $page = initPage($count, $_COOKIE['n'] ? $_COOKIE['n'] : 5);
			$page->rollPage = 2;
            $show = $page->show();
            //   print_r($show);exit;
            $currentPage = empty($_GET['p']) ? 1 : intval($_GET['p']);
            $goodsFind = $VipComment->field('c.*,u.user_id,u.user_name,u.face')
                    ->join('wrt_user AS u ON u.user_id=c.user_id')
                    //   ->join('wrt_vip AS v ON v.store_id=o.shop_id')
                    ->where('c.gid=' . $id)
                    ->limit($page->firstRow . ',' . $page->listRows)
                    ->select();
           // dump($goodsFind);
          // dump($VipComment->getLastSql());
            //   $goodsFind['time'] = date("Y-m-d H:i:s", $goodsFind['time']);
            //  $goodsFind['action'] = 'edit';
        
        $this->assign("currentPage", $currentPage);
        $this->assign("totalPage", $page->totalPages);
        $this->assign("page", $show);
        foreach ($goodsFind as $k => $v) { 
            $v['pic'] = json_decode($v['pic'],true);
            // dump($v);die();
            // dump($v['star']);die();
            $star = floatval($v['star']);
            $star = (int)($star*100);
            //dump($star/5);  die();       
            $v['star'] = $star/5;
        //    print_r($star."<br/>");
            $goodsFind[$k] = $v;
            // dump($v);die();
        }

        $this->assign('data', $goodsFind);
        $this->display();
    }

}

?>
