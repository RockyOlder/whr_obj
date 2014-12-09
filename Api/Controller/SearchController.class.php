<?php
namespace Api\Controller;
use Think\Controller;
class SearchController extends Controller {
		function __construct()
	{

		 if (!IS_API) {
	        	die("你无权访问该页面！");
	        }
	}
	
	//根据首页的用户设置的喜好分类来搜索商品数据
    function cate()
  
     {
     	$id = I('request.version',1);
      //获取用户传递过来的分类id
      $cate = I('request.cate_id',0,'intval');
      $page = I('request.page',1,'intval');
      $pageSize = I('request.pageSize',20,'intval');
      if ($pageSize < 0) $pageSize =20;
      if ($page < 0) $page =1;
      $limit = " limit ".($page - 1)*$pageSize.",".$pageSize;
      // dump($limit);
      // 获取商品的分类id
     	if ($id == 1){
          
          $sql = "select * from ".C('DB_PREFIX')."life_goods WHERE ";
          if ($cate < 10) {
            $sql .="cate_pid = $cate ";
          }else{
            $sql .="cate_id =$cate ";
          }
          $sql .= $limit;
          // dump($sql);
          $data = M()->query($sql);
          // dump($data);
          $sum = count($data);
          // dump();die();
          if ($sum < $pageSize) { //如果数据库中的数据不能满足用户需求的话则在携程请求数据
            // 引入携程的sdk
            require_once("/xiechengAPI/CtripUnion.php");
            $str =<<<str
<!--版本信息:2014年3月-->
<!--团购产品查询请求xml-->
<?xml version="1.0" encoding="utf-8"?>
<!--接口提供方：携程；调用方：合作方-->
<Request>
<!--AllianceID:分销商ID;SID:站点ID;TimeStamp:响应时间戳（从1970年到现在的秒数）;RequestType:请求接口的类型;Signature:MD5加密串-->
<Header  AllianceID="29006" SID="467213" TimeStamp="xxxxxx"    RequestType=" Product_Get" Signature="xxxxxxx" />
<SearchProductRQ>
<!—查询条件>
<!--请求所有的产品类型的时候：<SearchCondition/> -->
<SearchCondition>
<!--酒店名称关键字模糊匹配，可去掉此节点-->
<KeywordList>
<Keyword>上海</Keyword>
</KeywordList>
<!--价格区间，可去掉此节点->
<PriceRange>
              <MinPrice>100</MinPrice>
<MaxPrice> </MaxPrice>
          </PriceRange>
<!--开团日期区间，可去掉此节点->
<DateRange>
              <StartDate>100</StartDate>
<EndDate> </EndDate>
          </DateRange>
<!--根据坐标请求，Type坐标类型 (1 高德)，可去掉此节点->
<Position Type="1">
<!--经度->
              <LON>100</LON>
<!--纬度->

<LAT> </LAT>
<!--距离公里数->
<Distance> </Distance>
          </Position>
<!--根据城市查询，可去掉此节点-->
<CityInfo>
<!-- CityID查询(如有CityID，CityName查询将不起作用)-->
<CityID>100</CityID>
<CityName> </CityName>
</CityInfo>
<ItemTypeList>
<!--产品类型（1是精选酒店，2餐饮美食，3酒店套餐，6特惠票券，7旅游度假）-->
<ItemType>1</ItemType>
</ItemTypeList>
</SearchCondition>
<!—产品显示设置>
<DisplaySettings >
<!—页面设置查询记录条数,设置数量限制后分页设置无效，如果不设置去掉节点-->
<PageSettings>
<!--每页产品条数-->
<PageSize>1</PageSize>
<!—当前页码-->
<CurrentPageIndex>1</CurrentPageIndex>
</PageSettings>
<!--限制显示条数，如果不设置去掉节点-->
<LimitNumber>
<!--选择记录数-->
<Topcount>1</Topcount>
</LimitNumber>
<!—排序0默认 2折扣从高到低 3价格从高到低 4价格从低到高 5销量从高到低 11点评从高到低>
<SortType>0</SortType>
</DisplaySettings>
</SearchProductRQ>
</Request>
str;
            # code...
          }
          $out['date'] = $data;
          $out['success'] = 1;           
          $this->ajaxReturn($out);
     	}
      
     }
    
   
  
}
