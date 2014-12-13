<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class PointsController extends IsloginController {

    public function index() {
        
        $data['action'] = 'add';
        $data['title'] = "添加积分规则";
        $data['btn'] = "添加规则";
        $action = I('post.action');
        $goodsinte = M('GoodsIntegral');
        $goodsintefind = $goodsinte->find();
        if ($goodsintefind) {
            $data['action'] = 'edit';
            $this->assign('word', $goodsintefind);
        }
        if (IS_POST) {
            if ($action == "add") {
                $goodsinte = M('GoodsIntegral');
                if ($data = $goodsinte->create()) {
                    if ($goodsinte->add($data)) {
                        $url = U('/Home/Points/index');
                        $this->success("用户添加成功！", $url);
                    } else {
                        $this->error("用户添加失败！", 'index');
                    }
                }
            } elseif ($action == "edit") {
                 $goodsinte = M('GoodsIntegral');
                if ($data = $goodsinte->create()) {
                    if ($goodsinte->save($data)) {
                        $url = U('/Home/Points/index');
                        $this->success("修改成功！", $url);
                    } else {
                        $this->error("用户修改失败！", 'index');
                    }
                } else {
                    $this->error($goodsinte->getError());
                }
            }
        }
        $this->assign('data', $data);
        $this->display();
    }

}

?>
