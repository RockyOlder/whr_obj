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
	#show_info{position: absolute;top: 0;left: 0;width: 100%;height: 100%;padding: 5%;}
	#show_content{padding: 50px;background: #ffffff;}
	#show_head{overflow: hidden;}
	#show_head img{float: left;padding: 10px}
	#show_head ul{float: left;margin-top: 5px;}
	#show_head ul li{font-family: "微软雅黑";font-size: 18px;margin-bottom: 5px;}
	#show_content dl{}
	#show_content dl dt{font-size: 20px;}
	#show_content dl dt dd{font-size: 18px;padding: 5px;}
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
		<a class = "btn btn-primary" href="javascript:check();" onclick="check">查看消费卷</a>
	</div>
	
	<div id="show_info" style="display:none">
		<div id="show_content">
			
			
		</div>
	</div>
	<div id="give_msg" style="display:none;position: absolute;left: 30%;top: 35%;border-radius: 5px;overflow: hidden;width: 15%;">
		<dl>
			<dt style="background: #87CEEB;padding: 5px 20px 5px 3px;font-size: 20px;">提示信息</dt>
			<dd style="width: 100%;height: 100px;background: #FFFFFF;text-indent: 2em;font-size: 18px;">验证成功<br/>
				
			</dd>
			<dd style="width:100%;background: #FFFFFF;text-align: center;"><input type="button"  value="确定" onclick="closegive()" class="btn btn-success" /></dd>
		</dl>
	</div>
</body>
<script type="text/javascript">
	function check(){
		var num = $('input[name=number]').val(); 
		if($.trim(num) == ''){
			alert('请输入消费卷号码！再验证！');
		}else{
			$.post("<?php echo U('check_num');?>",{'data':num},function(data){
				if(data.statue == 0){
					var str = getstr(data.msg);
			        $('#give_msg').html(str);    
			        $('#give_msg').show(100);
				}else{
				var str = '<div id="show_head">';
				 str += '<img src="'+data.data.list_pic+'" alt="商品图片" width="100px;"/>';
				 str += 	'<ul>'
				 str += 	'<li>商品名称:'+data.data.lgname+'</li>'
				 str += 	'<li style="color:red">价格:'+data.data.price+'</li>'
				 str += 	'<li>数量:'+data.data.sum+'</li>'
				 str += 	'</ul>'
				 str += 	'</div>'
				 str += 	'<dl>'
				 str += 	'<dt>详细信息:</dt>'
				 str += 	'<dd>订单编号：'+data.data.number+'</dd>'
				 str += 	'<dd>订单状态：'+data.data.statue_msg+'</dd>'
				 str += 	'<dd>电子验证卷：'+data.data.check_number+'</dd>'
				 str += 	'<dd>消费状态：'+data.data.check_statue+'</dd>'
				 str += '</dl>'
				 str += 	'</div>'
				 if (data.data.statue == 1) {
				 	str +='<input type="button"  value="验证通过" class="btn btn-success" onclick="changedata('+data.data.oid+')" style = "margin-right:20px;"/>'
				 };
				 
				 str +='<input type="button"  value="取消" class="btn btn-info" onclick="closethis()"/>'
				 $('#show_content').html(str);
				 $('#show_info').show(100);
				}
	                         
	        },'json')
        }
	}
	function changedata(num){
			$.post("<?php echo U('change_date');?>",{'data':num},function(data){
				var str = getstr(data.msg);
	        $('#give_msg').html(str);    
	        $('#give_msg').show(100);
	        },'json')
	}
	function closethis(){
		$('#show_info').hide(100);
	}
	function closegive(){
		$('#give_msg').hide(100);
	}
	function getstr(msg){
		var str = '<dl>'
			str += '<dt style="background: #87CEEB;padding: 5px 20px 5px 3px;font-size: 20px;">提示信息</dt>'
			str += '<dd style="width: 100%;height: 100px;background: #FFFFFF;text-indent: 2em;font-size: 18px;">'+msg+'</dd>'
				
			
			str += '<dd style="width:100%;background: #FFFFFF;text-align: center;"><input type="button"  value="确定" onclick="closegive()" class="btn btn-success" /></dd>'
			str += '</dl>'
			return str;
	}
</script>
</html>