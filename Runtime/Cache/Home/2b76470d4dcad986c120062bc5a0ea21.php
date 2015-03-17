<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo ($info["title"]); ?></title>
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
            	
            	<h5>管理员所属开发商信息</h5>
            	<ul  data-role="listview">
            		<li>开发商名称：<?php echo ($shop["name"]); echo ($shop["store_name"]); ?></li>
            		<li>开发商地址：<?php echo ($shop["address"]); ?></li>            		
            		<li><span>营业执照：</span><img src="<?php echo ($shop["permit"]); ?>" alt="店铺营业执照" width="50" /></li>
            		<li><span>税务登记证：</span><img src="<?php echo ($shop["tax"]); ?>" alt="税务登记证" width="50" /></li>
            		<li><span>组织机构证：</span><img src="<?php echo ($shop["organize"]); ?>" alt="组织机构证" width="50" /></li>
            		<li><span>企业营业执照：</span><img src="<?php echo ($shop["company"]); ?>" alt="企业营业执照" width="50" /></li>
            		<li><span>基本开户许可证：</span><img src="<?php echo ($shop["basic"]); ?>" alt="基本开户许可证" width="50" /></li>
            		<li><span>负责人身份证：</span><img src="<?php echo ($shop["owner"]); ?>" alt="负责人身份证" width="50" /></li>
            		<li><span>代理人身份证：</span><img src="<?php echo ($shop["agent"]); ?>" alt="代理人身份证" width="50" /></li>
            		<li><span>慧锐通授权书：</span><img src="<?php echo ($shop["authz"]); ?>" alt="慧锐通授权书" width="50" /></li>
            	</ul>
            	
            </div>
        </div>
        <div>
        	<input type="hidden" name="ajax_pass" value="<?php echo U('toPass');?>">
            <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
            <input type="button" name="" id="pass" value="通过" data-mini="true"/></div>
        <div data-role="footer">
        	<h1><?php echo (C("web_copy")); ?></h1>
        </div>
     
		</div>
	</body>
    <script type="text/javascript">
        $('#pass').click(function(){
            var id = $('input[name=id]').val();
            var url = $('input[name=ajax_pass]').val();
            $.ajax({
            	type:"post",
            	url:url,
            	data:{'id':id},
            	success:function(data){
            		if(data){
            			alert('操作成功');
            			location.href="<?php echo U('app');?>";            			
            		}else{
            			alert('操作失败');
            		}
            	},
            	error:function(){
            		alert('操作失败');
            	}
            	
            });
        })
    </script>
</html>