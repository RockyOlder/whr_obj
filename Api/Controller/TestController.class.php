<?php
namespace Api\Controller;
use Think\Controller;
class TestController extends Controller {
		function __construct()
	{

		 if (!IS_API) {
	        	die("你无权访问该页面！");
	        }
	}
    // 测试调用大众点评的数据
    public function index()
    {
        $id = I('request.version',1);
        $key = C('DZDP_KEY');
        $sec = C('DZDP_SEC');        
        $this->ajaxReturn($out);	       
    }  
  
}
