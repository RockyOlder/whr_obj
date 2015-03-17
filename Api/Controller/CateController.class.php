<?php
namespace Api\Controller;
use Api\Controller\CommonController;
class CateController extends CommonController {
   /**
    * [获取顶级分类列表]
    * @author xujun
    * @email  [jun0421@163.com]
    * @date   2015-01-06T17:26:59+0800
    * @return [type]                   [description]
    */
    public function topCate(){
    	$id = I('request.version',1);
    	if ($id == 1) {
            $out['success']  = 1;
            $cate = S('top_cate');//读取缓存数据
            // dump($cate);
            // var_dump(empty($cate));die();
            if (empty($cate)) {
                $sql = "select type_id,type_name,open_type from ".C('DB_PREFIX')."type where parent_id = 0 and type_level = 0 and open_type=0";
                // dump($sql);die();
                $cate = M()->query($sql);

                S("top_cate",$cate,600);
            }
    		$out['data'] = $cate;   			
    		$this->ajaxReturn($out);
    	}
       
    }
    /**
     * 根据父级id获取分类列表
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-06T17:27:49+0800
     * @return [type]                   [description]
     */
    public function sonCate(){
        $id = I('request.version',1);
        $pid = I('request.pid',1);
        if ($id == 1) {
            $out['success']  = 1;
            // 设置缓存的名字
            $name = "son_cate_$pid";
            $cate = S($name);//读取缓存中的内容
            if (empty($cate)) {
                $sql = "select type_id,type_name,open_type from ".C('DB_PREFIX')."type where parent_id = $pid and type_level = 1";
                    // dump($sql);die();
                    $cate = M()->query($sql);

                    S($name,$cate,600);
            }
            $out['data'] = $cate;               
            $this->ajaxReturn($out);
        }
    }
    /**
     * 获取所有分类
     * @author xujun
     * @email  [jun0421@163.com]
     * @date   2015-01-06T17:30:12+0800
     * @return [type]                   [description]
     */
    public function allCate(){
       $id = I('request.version',1);
            if ($id == 1) {
                $out['success']  = 1;
                $cate = S('all_cate');//读取缓存数据
                // dump($cate);
                // var_dump(empty($cate));die();
                if (empty($cate)) {
                    $sql = "select type_id,type_name,open_type from ".C('DB_PREFIX')."type where parent_id = 0 and type_level = 0 and open_type = 0 order by sort desc";
                    // dump($sql);die();
                    $cate = M()->query($sql);
                    // dump($cate);die();
                    if (is_array($cate)) {
                        foreach ($cate as $k => $v) {
                            $sql = "select type_id,type_name,open_type from ".C('DB_PREFIX')."type where parent_id = $v[type_id] and type_level = 1";
                            // dump($sql);die();
                            $son = M()->query($sql);
                            $v['son'] = $son;
                            $cate[$k] = $v;
                        }
                    }
                    $cate[0]['type_id'] = '0';
                    $cate[0]['son'][0]['type_id'] = '0';
                    // dump($cate);
                    S("all_cate",$cate,600);
                }
                $out['data'] = $cate;               
                $this->ajaxReturn($out);
            }
    }
  
}
