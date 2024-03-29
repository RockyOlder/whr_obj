<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>生活导航申请详情信息</title>
		<link rel="stylesheet" href="/App/Home/View/Public/Css/jquery.mobile-1.4.5.min.css">
		<script src="/App/Home/View/Public/Js/jquery-1.8.3.min.js"></script>
		<script src="/App/Home/View/Public/Js/jquery.mobile-1.4.5.min.js"></script>
		<style type="text/css">
			li span{width:200px;display: block;float: left;}
			li img{float: left;}
		</style>
	</head>
	<body>
		<div data-role="page" id = "pageThree"> 
	    <div data-role="header">
	      <h1><?php echo ($info["title"]); ?></h1>
	    </div>
        <div data-role="content">
            <div id="person">
            	<h5>管理员信息</h5>
        		<ul  data-role="listview">
            		<li>登录名：<?php echo ($info["name"]); ?></li>
            		<li>绑定电话：<?php echo ($info["mobile"]); ?></li>
            		<li>绑定邮箱：<?php echo ($info["email"]); ?></li>
            		<li>真实姓名：<?php echo ($info["true_name"]); ?></li>
            		<li>申请角色：<?php echo ($info["role"]); ?></li>
        		</ul>
            	
            	<h5>管理员店铺信息</h5>
            	<ul  data-role="listview">
            		<li>店铺名称：<?php echo ($shop["name"]); echo ($shop["store_name"]); ?></li>
            		<li>店铺地址：<?php echo ($shop["address"]); ?></li>
            		
            		<li><span>营业执照：</span><img src="<?php echo ($shop["permit"]); ?>" alt="店铺营业执照" width="50" /></li>
            		<li><span>税务登记证：</span><img src="<?php echo ($shop["tax"]); ?>" alt="店铺营业执照" width="50" /></li>
            		<li><span>组织机构证：</span><img src="<?php echo ($shop["organize"]); ?>" alt="店铺营业执照" width="50" /></li>
            		<li><span>企业营业执照：</span><img src="<?php echo ($shop["company"]); ?>" alt="店铺营业执照" width="50" /></li>
            		<li><span>基本开户许可证：</span><img src="<?php echo ($shop["basic"]); ?>" alt="店铺营业执照" width="50" /></li>
            		<li><span>负责人身份证：</span><img src="<?php echo ($shop["owner"]); ?>" alt="店铺营业执照" width="50" /></li>
            		<li><span>代理人身份证：</span><img src="<?php echo ($shop["agent"]); ?>" alt="店铺营业执照" width="50" /></li>
            		<li><span>慧锐通授权书：</span><img src="<?php echo ($shop["authz"]); ?>" alt="店铺营业执照" width="50" /></li>
            	</ul>
            	
            </div>
        </div>
        <div><input type="button" name="" id="" value="通过" data-mini="true"/></div>
        <div data-role="footer">
        	<h1><?php echo (C("web_copy")); ?></h1>
        </div>
     
		</div>
	</body>
</html>