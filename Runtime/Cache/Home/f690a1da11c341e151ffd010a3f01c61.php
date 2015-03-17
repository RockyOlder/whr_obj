<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo ($info["title"]); ?></title>
	<link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
	<style type="text/css">
		#info ul{height: auto;width: 100%;margin: 15px 35px;overflow: hidden;}
		#info ul li{height: 30px;width: 40%;float: left;text-indent: 2em;}
		li span{width:200px;display: block;float: left;}
		li img{float: left;}
	</style>
</head>
<body style="background: #FFFFFF;">
	<div class="place">

        <ul class="placeul">
            <li>位置：</li>
            <li><a href="<?php echo U('Index/start');?>">首页</a></li>
            <li>开发商管理</li>
            <li><a href="<?php echo U('SellerApp/developer');?>">开发商申请列表</a></li>
            <li><?php echo ($info["title"]); ?></li>
        </ul>
	</div>
	<div class="box">
		<div>
			<div class="title">
				<div style="text-align: center;font-size: 18px;height: 35px;">管理员信息</div>
				<div style="border:1px solid #D4E7F0;width:94%;margin:0 auto;"></div>
				<div id="info">
					<ul>
	            		<li>登录名：<?php echo ($info["name"]); ?></li>
	            		<li>绑定电话：<?php echo ($info["mobile"]); ?></li>
	            		<li>绑定邮箱：<?php echo ($info["email"]); ?></li>
	            		<li>真实姓名：<?php echo ($info["true_name"]); ?></li>
	        		</ul>
				</div>
				
			</div>
			<div class="title">
				<div style="text-align: center;font-size: 18px;height: 35px;">开发商相关基本信息</div>
				<div style="border:1px solid #D4E7F0;width:94%;margin:0 auto;"></div>
				<div id="info">
					<ul>
	            		<li>开发商名称：<?php echo ($shop["name"]); ?></li>
	            		<li>开发商电话：<?php echo ($shop["phone"]); ?></li>
	            		<li>负责人姓名：<?php echo ($shop["owner"]); ?></li>
	            		<li>开发商地址：<?php echo ($shop["address_info"]); ?></li>
	            		<li>开发商网址：<?php echo ($shop["url"]); ?></li>
	            		<li>联系人姓名：<?php echo ($shop["contact"]); ?></li>
	            		<li>联系人电话：<?php echo ($shop["adminPhone"]); ?></li>
	            		<li>职位身份：<?php echo ($shop["Posts"]); ?></li>
	            		<li>身份证号码：<?php echo ($shop["certificate"]); ?></li>
	        		</ul>
				</div>
				
			</div>
			<div class="btn_pass" style="text-align: center;margin: 20px 0px;">
				<input type="hidden" name="ajax_pass" value="<?php echo U('toPass');?>">
		        <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
		        <input type="button" name="" id="pass" value="通过" data-mini="true" style="background: #008000;border-radius: 5px !important;color: #FFFFFF;padding: 7px 30px;font-size: 16px;letter-spacing: 10px;font-weight: 700;"/>
			</div>
			<div id="end_copy" style="text-align: center;font-size: 16px;">
				<?php echo (C("web_copy")); ?>
			</div>
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
        	data:{'id':id,'life':2},
        	success:function(data){
        		if(data){
        			alert('操作成功');
        			location.href="<?php echo U('developer');?>";            			
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