<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>成功发送邮件</title>
<style>
*{ padding:0px; margin:0px;}
body { font-size:14px; font-family:"微软雅黑"; color: #666;}
.contain{ width:900px; margin:0 auto; background:#efefef;}
.logo{ width:900px; margin:0 auto; padding-bottom:20px;}
.nav{ width:650px; height:50px; margin:0 auto; background:url(/App/Home/View/Public/Images/passtt3.png) center 10px no-repeat; padding-top:50px;}
.nav ul{ list-style:none;}
.nav ul li{ float:left; width:160px; text-align: center;}
.nav ul li a{ text-decoration:none; color:#333;}

.content{ width:650px; margin:0 auto;}
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

<div class="content">
<div class="item" style="float:left; width:80px;"><img src="/App/Home/View/Public/Images/gou.png"></div>

<div class="text" style="float:left; margin-bottom:20px">
<p>验证邮件已发送成功</p><br/>
<p>（请立即完成验证，邮箱验证不通过则修改邮箱失败）</p><br/>
<p>验证邮件24小时内有效，请尽快登录您的邮箱点击验证链接完成验证。</p>
</div>
</div>

<a href="<?php echo ($url); ?>" style="text-decoration: none;"><div class="item"><input name="" type="button" value="查看验证邮件"  style="color:#fff; border:none; background-color:#019386;cursor: pointer;"></div></a>
</div>

<div class="footer"><?php echo (C("web_copy")); ?></div>
</html>

</body>
</html>