<?php
namespace Api\Controller;
use Think\Controller;
class CateController extends Controller {
		function __construct()
	{

		 if (!IS_API) {
	        	die("你无权访问该页面！");
	        }
	}
    // 获取顶级分类列表
    public function topCate(){
    		$id = I('request.version',1);
    		if ($id == 1) {
                $out['success']  = 1;
                $cate = S('top_cate');//读取缓存数据
                // dump($cate);
                // var_dump(empty($cate));die();
                if (empty($cate)) {
                    $sql = "select type_id,type_name,open_type from ".C('DB_PREFIX')."type where parent_id = 0 and type_level = 0";
                    // dump($sql);die();
                    $cate = M()->query($sql);

                    S("top_cate",$cate,600);
                }
    			$out['data'] = $cate;   			
    			$this->ajaxReturn($out);
    		}
	       
        }
    //根据父级id获取分类列表
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
    public function allCate(){
       $id = I('request.version',1);
            if ($id == 1) {
                $out['success']  = 1;
                $cate = S('all_cate');//读取缓存数据
                // dump($cate);
                // var_dump(empty($cate));die();
                if (empty($cate)) {
                    $sql = "select type_id,type_name,open_type from ".C('DB_PREFIX')."type where parent_id = 0 and type_level = 0";
                    // dump($sql);die();
                    $cate = M()->query($sql);
                    if (is_array($cate)) {
                        foreach ($cate as $k => $v) {
                            $sql = "select type_id,type_name,open_type from ".C('DB_PREFIX')."type where parent_id = $v[type_id] and type_level = 1";
                            // dump($sql);die();
                            $son = M()->query($sql);
                            $v['son'] = $son;
                            $cate[$k] = $v;
                        }
                    }
                    S("all_cate",$cate,600);
                }
                $out['data'] = $cate;               
                $this->ajaxReturn($out);
            }
    }
  
}
