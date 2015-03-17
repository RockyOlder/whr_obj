<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="/App/Home/View/Public/Js/jquery-1.8.3.min.js"></script>
<script src="/App/Home/View/Public/Js/easy_validator.pack.js"></script>
<link href="/App/Home/View/Public/Css/validate.css" rel="stylesheet" type="text/css">
<title>修改密码</title>
<style>
*{ padding:0px; margin:0px;}
body { font-size:14px; font-family:"微软雅黑"; color: #666;}
.contain{ width:900px; margin:0 auto; background:#efefef;}
.logo{ width:900px; margin:0 auto; padding-bottom:20px;}
.nav{ width:650px; height:50px; margin:0 auto; background:url(/App/Home/View/Public/Images/passtt3.png) center 10px no-repeat; padding-top:50px;}
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
<form method="post" action=""  name="validateForm1">
<div class="item">新登录密码：<input name="passord" type="password" id = 'flightno' reg="^\w{6,16}$" tip="输入六到十六位新密码"/></div>
<div class="item">确认新密码：<input name="newword" type="password"  id = 'flightno' reg="^\w{6,16}$" tip="与上面的密码保持一直"/></div>
<input type="hidden" name="id" value="<?php echo ($_GET['id']); ?>">
<div class="item">
<span>&nbsp;</span>
<input name="" type="submit"  value="提交" style=" padding:2px 10px; background:#019386; color:#fff; font-size:24px; border:0px">
</form>
</div>
</div>



<div class="footer"><?php echo (C("web_copy")); ?></div>
</body>
</html>