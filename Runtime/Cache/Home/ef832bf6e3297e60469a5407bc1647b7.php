<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style>
*{ padding:0px; margin:0px;}
body { font-size:14px; font-family:"微软雅黑"; color: #666;}
.contain{ width:900px; margin:0 auto; background:#efefef;}
.logo{ width:900px; margin:0 auto; padding-bottom:20px;}
.nav{ width:650px; height:50px; margin:0 auto; background:url(/App/Home/View/Public/Images/passtt2.png) center 10px no-repeat; padding-top:50px;}
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
<form method="post" action="<?php echo U('sendEmail');?>">

<div class="item"><span>验证身份方式：</span><span style=" padding:5px 20px"><?php echo ($data["type"]); ?></span></div>
<div class="item">
<span>登录名：</span><?php echo ($data["name"]); ?><br><br>
<span>已验证<?php echo ($data["type"]); ?>：</span><?php echo ($data["bind"]); ?>;
<input type="hidden" name = "email" value="<?php echo ($data["email"]); ?>">
<input type="hidden" name = "id" value="<?php echo ($data["id"]); ?>">
<input type="hidden" name = "name" value="<?php echo ($data["name"]); ?>">
<input type="hidden" name = "true_name" value="<?php echo ($data["true_name"]); ?>">
</div>
<div class="item">
<span>&nbsp;</span>
<input name="" type="submit"  value="发送邮箱验证" style=" padding:2px 10px; background:#019386; color:#fff; font-size:24px; border:0px">
</div>

</div>
</form>
<div class="footer"><?php echo (C("web_copy")); ?> </div>
</html>