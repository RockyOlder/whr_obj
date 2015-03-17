<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="/App/Home/View/Public/Js/jquery-1.8.3.min.js"></script>
<script src="/App/Home/View/Public/Js/easy_validator.pack.js"></script>
<link href="/App/Home/View/Public/Css/validate.css" rel="stylesheet" type="text/css">
<title>无标题文档</title>
<style>
*{ padding:0px; margin:0px;}
body { font-size:14px; font-family:"微软雅黑"; color: #666;}
.contain{ width:900px; margin:0 auto; background:#efefef;}
.logo{ width:900px; margin:0 auto; padding-bottom:20px;}
.nav{ width:650px; height:50px; margin:0 auto; background:url(/App/Home/View/Public/Images/PASSTT2.png) center 10px no-repeat; padding-top:50px;}
.nav ul{ list-style:none;}
.nav ul li{ float:left; width:160px; text-align: center;}
.nav ul li a{ text-decoration:none; color:#333;}

.item{ width:500px; margin:0 auto; padding-bottom:50px;}
input{padding:5px 10px;}

.footer{ width:900px; margin:0 auto; border-top:1px solid #999; text-align:center; height:50px; line-height:50px; margin-top:50px;}
</style>
</head>

<body>
<div class="logo"><img src="/App/Home/View/Public/Images/passwd.png"></div>

<div class="contain">
<p style="width:600px; margin:0 auto; padding:20px;">找回密码</p>
<div class="nav">
<ul>
<li><a href="">填写账户名</a></li>
<li><a href="">身份验证</a></li>
<li><a href="">设置新密码</a></li>
<li><a href="">完成</a></li>
</ul>
</div>
<form method="get" action=""   name="validateForm1" >

<div class="item"><span>验证身份方式：</span><span style=" padding:5px 20px"><?php echo ($data["type"]); ?></span></div>
<div class="item">
<span>登录名：</span><?php echo ($data["name"]); ?><br><br>
<span>已验证<?php echo ($data["type"]); ?>：</span><?php echo ($data["bind"]); ?>;
<input name="mobile" value="<?php echo ($data["mobile"]); ?>" type="hidden">
<input name="type"  type = "hidden" value="1">
<input id="mobile_src" value="<?php echo U('sendMsg');?>" type="hidden">
</div>

<div class="item"><span style="float:left;line-height:30px">请填写手机校验码：</span>
	<input name="verify" type="text" value="" id='flightno' reg="\d{6}" tip="输入手机接收到的验证码" url="<?php echo U('check_code');?>">
	<input name="" type="button" value="获取验证码" id="btn" style=" background-color:#019386; color:#fff; font-weight:bold; border:none; padding:5px"></div>

<div class="item">
<span>&nbsp;</span>
<a href="<?php echo U('changeP',array('id'=>$data[id],'type'=>1),'');?>"><input name="" type="button"  value="提交" style=" padding:2px 10px; background:#019386; color:#fff; font-size:24px; border:0px"></a>
</div>
</form>
</div>
<script type="text/javascript">  
  flag = true;
  var wait=60;  
  function time(o) {  
        if (wait == 0) {  
            o.removeAttribute("disabled");            
            o.value="免费获取验证码";  
            wait = 60;  
        } else {  
            o.setAttribute("disabled", true);  
            o.value="重新发送(" + wait + ")";  
            wait--;  
            setTimeout(function() {  
                time(o)  
            },  
            1000)  
        }  
    } 
  function sendmsg(){
		url = $('#mobile_src').val();
		mobile = $('input[name=mobile]').val();
		if(mobile == ''){alert('请输入你的手机后获取');}else{
			$.ajax({
				type:"get",
				url:url,
				data:{'mobile':mobile},
				success:function(data){
					// alert(data);
					if (data ==1) {
						var flag = true;
					};
				}
			});
		} 
	}
document.getElementById("btn").onclick=function(){
	sendmsg();
	// alert(validate.statue);
	if(flag){
		alert('短信已经成功发送，请查看验证码并输入');
		flag = false;
		time(this);
	}else{
		alert('短信发送失败，请检查你的手机号码');
	}
}  
</script>
<div class="footer"><?php echo (C("web_copy")); ?> </div>
</html>