<?php

namespace Home\Controller;

use Home\Controller\IsloginController;

class JoggleController extends IsloginController {
    /**
     * 第三方接口显示页面目前只显示和修改携程的数据
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-07T16:42:05+0800
     * @return [type]                   [description]
     */
    public function index() {
        $root = $this->getPath();
        // dump(file_exists($file));die();  
        $file = $root.'/ThinkPHP/Library/Org/Ctrip/data/json';     
        $data = json_decode(file_get_contents($file),true);
        //dump($data);
        $this->assign('ctrip',$data);
        $data['title']="携程配置";
        $data['btn']="修改";
        $this->assign('data',$data);
        $file = $root.'/Data/people';     
        $data = json_decode(file_get_contents($file),true);
        //dump($data);
        $this->assign('some',$data);
        $peopol['title']="大众点评配置";
        $peopol['btn']="修改";
        $this->assign('people',$peopol);
        // dump($data);
        $this->display();
    } 
    /**
     * 保存数据的json格式
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-07T19:59:53+0800
     * @return [type]                   [description]
     */
    public function insert(){
        $act = I('get.act');
        $root = $this->getPath();
        switch ($act) {
            case 'ctrip':
                $msg = "修改了携程的配置数据";
                $path = $root.'/ThinkPHP/Library/Org/Ctrip/data/json';
                break;
            case 'people':
                $msg = "修改了大众点评的配置数据";
                $path = $root.'/Data/people';
                break;            
            default:
                $this->error('参数错误');
                break;
        }
        $json = json_encode($_POST);
        //dump($json);die();
        $bool=file_put_contents($path, $json);
        if ($bool) {
           admin_log($msg);
           $this->success('修改成功',U('index'));
        }else{
            $this->error('修改失败');
        }
        //dump($_POST);die();
    }
    /**
     * 获取根目录的路径
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-07T19:29:55+0800
     * @return [type]                   [description]
     */
    public function getPath(){
        // 组合出文件的路径
        $start = str_replace('\\', '/', dirname(__FILE__));
        $start = str_replace('/App/Home/Controller', '', $start);
        //dump($start);
        
        // dump($file);
        return $start;
    }

}