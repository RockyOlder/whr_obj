<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style>
.menuset{ width:900px; margin:0 auto; padding:25px 15px 15px 15px;background:url(/Mobile/View/Public/images/ab--.png) center 70px no-repeat;}
ul{list-style:none;}
.menuset .menu{padding-top:2px;width:800px; height:100px; margin:0 auto; }
.menuset .menu li{float:left; padding:10px 0px;  height:70px; width:240px; text-align:center;}
.menuset .menu li a{display:block;float:left;color:#666;height:55px;line-height:15px;padding:0 60px;margin-left:2px; text-decoration:none; font-size:16px;}
.menuset .menu .bg  {background:url(/Mobile/View/Public/images/gIco7.png) center 42px no-repeat;color:#666; font-weight:800;}

.content-s{ width:800px; margin:0 auto; border:3px solid #CCC;}
.con-s{ padding-left:50px;}
</style>
</head>

<body>
<div class="menuset">
  <ul class="menu">
  <li ><a href="#"><img src="/Mobile/View/Public/images/t1.png" width="30" height="30" style=" float:left; margin-top:-7px; padding-right:5px;">设置登录名</a></li>
  <li><a href="#"><img src="/Mobile/View/Public/images/t2.png" width="30" height="30" style=" float:left; margin-top:-7px; padding-right:5px;">填写信息</a></li>
  <li class="bg"><a href="#"><img src="/Mobile/View/Public/images/gou.png" width="30" height="30" style=" float:left; margin-top:-7px; padding-right:5px;">注册成功</a></li>
 </ul>
 </div>
 
 
<div class="content-s">
<div class="con-s">
<h2>恭喜成功注册为慧享园的vip合作商家，你的账号为：</h2>
<div class="text-s" style=" margin-top:10px;">
<p>登录名:<?php echo ($info["name"]); ?></p>
<p>绑定手机：<?php echo ($info["mobile"]); ?></p>
<p>绑定邮箱：<?php echo ($info["email"]); ?></p>
</div>

</div>
</div>
</body>
</html>