<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>消费卷验证</title>
<link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
<style type="text/css">
	.formbody{
		width: 100%;
		height: 100%;
		background: url();
	}
	#check{
		background: #eeeeee;
		padding: 20px;
		font-family: '微软雅黑';
		border: 1px solid #C6E5F3;
		position: absolute;
		top: 120px;
		right: 380px;
		width: 400px;
		height: 200px;
	}
	p{

		font-size: 28px;
	}
	#check span{
		color: #999999;
		font-size: 20px;
	}
	#check input{
		margin: 10px;
		border: 1px solid #C6E5F3;
		font-size: 20px;
		width: 300px;
	}
	#check a{
		display: block;
		text-align: center;
		width: 100%;
		font-size: 20px;
		line-height: 20px;
	}
</style>
</head>

<body style="background: none;">
	<div class="place">
		<span>位置：</span>
		<ul class="placeul">
            <li><a href="<?php echo U('Index/start');?>">首页</a></li>
			<li>电子消费劵管理</li>
			<li>消费卷验证</li>
		</ul>
	</div>
	
	<div class="formbody">
		<img src="/App/Home/View/Public/Images/check_bg.jpg" width='100%'>
	</div>
	<div id="check">
		<p>电子消费卷消费验证</p>		
		<span>请在下框中输入电子消费卷</span><br/>
		<input type="text" value="" name = 'number'><br/>
		<a class = "btn btn-primary" href="javascript:check();" onclick="check">验证</a>
	</div>
	
</body>
<script type="text/javascript">
	function check(){
		var num = $('input[name=number]').val(); 
		if($.trim(num) == ''){
			alert('请输入消费卷号码！再验证！');
		}else{
			$.post("<?php echo U('check');?>",{'data':num},function(data){
	            if (data) {
	                alert(data['msg']);
	            }                 
	        },'json')
        }
	}
</script>
</html>