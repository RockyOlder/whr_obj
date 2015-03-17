<?php
namespace Api\Controller;
use Think\Controller;
class HotalController extends Controller {
		function __construct()
	{

		 if (!IS_API) {
	        	die("你无权访问该页面！");
	        }
	}
    // 酒店列表
    function hotalList(){
        //$this->admin_log('你访问网页了');
        $id = I('request.version',1,'intval');
        if ($id == 1) {
            
            //初始化携程的常亮
        $this->initDefine();
        // 引入携程的实例化类
        import("Org.Ctrip.class.CU");
        //要导入的xls文件，位于根目录下的Public文件夹
        $cu = new \CU('group','SearchLife.php');
        // dump($cu);
        //dump($_REQUEST);
        $this->admin_log(json_encode($_REQUEST));
        //$this->admin_log('城市：'.$_GET['city'].'/关键字：'.$_GET['keyword']);
        // 第二个参数为返回类型参数，支持string，json，xml，array，object，缺省默认执行对应方法中的respond_xml
        $_POST['city'] = I('request.city');
        $_POST['keyword'] = I('request.keyword');
        $rt = $cu->SearchLife($_POST,'array');
        //dump($rt);
        $data = $rt['SearchProductRS']['GroupProductInfoList']['GroupProductInfo']; 
        //dump($data);      
            foreach ($data as $k => $v) {
                //dump($v);die();
                $temp[]=array(
                    'hotelName'=>$v['@attributes']['HotelName'],
                    'url'=>$v['@attributes']['ProductURL'],
                    'ProductID'=>$v['@attributes']['ProductID'],
                    'price'=>$v['ProductPrice']['SalePrice']["@attributes"]['Price'],
                    'VendorInfos'=>$v['VendorInfos']['VendorInfoType']['VendorName'],
                    'pic'=>$v['ProductPictures']['ProductPicture'][1]['Content']['URL'],
                    'start'=>$v['ProductScores']['CommentScore'],
                );
                //dump($temp);

            }
            $out['data'] = $temp;
            $out['success']  = 1;
            $out['msg'] = '成功';
            $this->ajaxReturn($out);
        }
        
    }
    // 酒店详情
    function hotalinfo(){
        $id = I('request.version',1,'intval');
        if ($id == 1) {
            
            //初始化携程的常亮
        $this->initDefine();
        // 引入携程的实例化类
        import("Org.Ctrip.class.CU");
        //要导入的xls文件，位于根目录下的Public文件夹
        $cu = new \CU('group','Product_Detail.php');
        // dump($cu);die();
        // 第二个参数为返回类型参数，支持string，json，xml，array，object，缺省默认执行对应方法中的respond_xml
        $rt = $cu->Product_Detail($_POST,'array');
        //dump($rt);die(); 
        $data = $rt['ProductDetailRS']['ProductDetailInfoList']['ProductDetailInfo'];
        $info = array(
            'id'=>$data['@attributes']['ProductID'],
            'productUrl'=>$data['@attributes']['ProductURL'],
            'productname'=>$data['@attributes']['Name'],
            'hotalname'=>$data['@attributes']['ProductName'],
            'price'=>$data['ProductPrice']['SalePrice']['@attributes']['Price'],
            'm_price'=>$data['ProductPrice']['SalePrice']['@attributes']['Price'],
            'phone'=>$data['BookingPhones']['BookingPhone']['@attributes']['PhoneNumber'],
            'latitude' => $data["ProductItem"]["HotelItemList"]["HotelInfo"]["Position"]["LAT"],
            'longitude' =>$data["ProductItem"]["HotelItemList"]["HotelInfo"]["Position"]["LON"],
            'Description'=>$data["ProductItem"]["HotelItemList"]["HotelInfo"]['Description'],
            'address' => $data["ProductItem"]["HotelItemList"]["HotelInfo"]["AddressInfo"]["@attributes"]["Address"]
            );
        //获取商品的描述        
        $descript=$data['Descriptions']['Description'];
        //dump($descript);
        foreach ($descript as $k => $v) {
            $des[$k]['title'] = $v['Content']["@attributes"]['Title'];
            $des[$k]['content'] = $v['Content']['Text'];
        }
        $info['descript'] = $des;
        ///dump($info);die();
        //获取产品图片的信息
        //首页图片
        $info['first_pic'] =$data['ProductPictures']['ProductPicture'][1]['Content']["URL"];
        
        $pic = $data['ProductPictures']['ProductPicture'][0]['Content'];
        //循环出数据的图片
        foreach ($pic as $k => $v) {
            $temp[]=$v['URL'];
        }
        //顶部轮播图片
        $info['header_pic']=$temp;
        $pic = $data['ProductPictures']['ProductPicture'][2]['Content'];
        //循环出数据的图片
        foreach ($pic as $k => $v) {
            $con[$k]['title']=$v['@attributes']['Title'];
            $con[$k]['pic']=$v['URL'];
        }
        // 图文详情
        $info['content'] = $con;
        //获取产品的规则
        $info['rule'] = $data["ProductRule"]["RuleDescription"];
        //获取经纬度
        //dump($info);die();
        //$temp['pic']     ;  
        $out['data'] = $info;
        $out['success']  = 1;
        $out['msg'] = '成功';
        $this->ajaxReturn($out);
        }
        
    }
    function searchList(){
        $id = I('request.version',1,'intval');
        unset($_POST['version']);
        if ($id == 1) {
            // 酒店查询
            $this->initDefine();
            import("Org.Ctrip.class.CU");
            $cu = new \CU('hotel','OTA_HotelSearch.php');
            $_POST['indicator'] = 'true';
            $_POST['position_type']="502";
            // var_dump($_POST);die();
            $rt = $cu->OTA_HotelSearch($_POST,'array');
            dump($rt);
           
        }
        
    }
    //获取携程的酒店的城市id
    public function Ctrip_city(){
        $id = I('request.version',1,'intval');
        if ($id == 1) {
            $our_city = S('ctrip_our_city');
            //dump($our_city);
            if (!$out_city) {
                $our_city = $this->getArray();
                S('ctrip_our_city');
            }
            $out['data'] = $our_city;
            $out['success'] = 1;
            $out['msg'] = "成功获取城市信息";
            $this->ajaxReturn($out);
        }
        
    }
    // 初始化携程数据常亮
    public function initDefine(){
        define( "CU_DEVELOP", false ); // 是否开启开发者模式，打印调试信息

        define( "CU_ROOT", str_replace('\\','/',LIB_PATH)."Org/Ctrip/" );
        // dump(CU_ROOT);die();
        define( "CU_CLASS_PATH", CU_ROOT."class/" );
        define( "CU_COMM_PATH", CU_ROOT."comm/" );
        define( "CU_DATA_PATH", CU_ROOT."data/" );
        // var_dump(CU_DATA_PATH);die();
        if( !defined("CU_TOKEN_PATH") )
        {
            define( "CU_TOKEN_PATH", CU_DATA_PATH."json" ); // 重新定义路径即可覆盖授权文件
        }
    }
    //讲携程数据的城市地区获取数据
    private function getArray(){
        //$file = "./Data/static_ctrip/out_city.xml";
        $file = "./Data/static_ctrip/our_city.xml";
        //dump($file);
        //dump(file_exists($file));
        //获取字符串
       $data =  file_get_contents($file);
       // 转换为对象
       $data=simplexml_load_string($data) ;
       // 转换给json格式
       $data = json_encode($data);
       // 转换为数组反出
       $data = json_decode($data,true);

       return $data;
       //dump($data);
    }
    // 讲xml的字符串转换为array
    private function xmlToArray($data){
       // 转换为对象
       $data=simplexml_load_string($data) ;
       // 转换给json格式
       $data = json_encode($data);
       // 转换为数组反出
       $data = json_decode($data,true);

       return $data;
       //dump($data);
    }

    function admin_log($info){
    $arr = array(
        'admin_id' => session('admin.id'),
        'admin_name' =>session('admin.name'),
        'time' =>time(),
        'ip'=>get_client_ip(),
        'info'=>$info,
        );
    M('admin_log')->add($arr);

    }
}
