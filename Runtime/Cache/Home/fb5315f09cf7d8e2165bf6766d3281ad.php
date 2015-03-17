<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>慧享园登录帮助页面</title>

<!--<script type="text/javascript" src="/App/Home/View/Public/Js/xiala.js"></script>-->


<style type="text/css">
*{ padding:0px; margin:0px;}
body{ width:100%; background:#efefef; font-family:"微软雅黑";}
.header{width:1000px; margin:0 auto; margin-top:10px;height:100px;line-height:100px;}
.logo{ float:left;}
.title{ margin-right:100px; font-size:40px; font-weight:bold; color:#019386;}
.nav{ width:1000px; margin:0 auto; margin-top:10px; height:45px; background:#019386; line-height:45px; color:#FFF;}
.nav ul{ list-style:none;}
.nav ul li{ float:left; padding:0px 100px 0px 20px;}
.nav li a{ color:#333; text-decoration:none;}

.menu_list{width:1000px;margin:auto; background:#FFF; border:1px solid #CCC;}
.menu_head{height:40px;line-height:40px;padding-left:15px;font-size:14px;color:#525252;cursor:pointer;border-bottom:1px solid #e1e1e1;position:relative;margin:0px;font-weight:bold;background:url(/App/Home/View/Public/Images/help/btn_2.png)950px center no-repeat;}

.menu_body{line-height:38px;backguound:#fff;}
.menu_body li{display:block; height:auto; line-height:38px;padding-left:15px; margin:10px;color:#777777;background:#fff;text-decoration:none;border-bottom:1px solid #e1e1e1;}
.menu_body li{text-decoration:none;}
.menu_body p{ padding-left:20px; line-height:35px;}
.menu_body span{ padding-left:20px; line-height:25px; font-size:13px;}
.menu_body .tt{ color:#F00}

</style>

</head>
<body>

<div class="header">
<div class="logo"><img src="/App/Home/View/Public/Images/help/120.png"></div>
<div class="title">慧享园后台帮助中心</div>
</div>

<div class="nav">
  	<ul>
		<li><a href="#">基本问题</a></li>
	</ul>
</div>

<div id="firstpane" class="menu_list">

  <h3 class="menu_head current">登录入口问题</h3>
	<div  class="menu_body ">
    <p><strong>1.管理员登陆入口</strong></p>
    <span>Q:登录入口？</span><br/>
	<p><span class="tt">A:请点击<a href="http://master.huishare.com/index.php?s=/Home/Login/index.html">慧锐通-管理员登陆入口</a></span>
    </p>
	<p><span class="tt">B:请点击<a href="http://master.huishare.com/life.php?s=/Home/Login/index.html">慧锐通-生活导航商家管理员登陆入口</a></span>
    </p>
	<p><span class="tt">C:请点击<a href="http://master.huishare.com/vip.php?s=/Home/Login/index.html">慧锐通-VIP商家管理员登陆入口</a></span>
    </p>
	<p><span class="tt">D:请点击<a href="http://master.huishare.com/server.php?s=/Home/Login/index.html">慧锐通-小区服务管理员登录入口</a></span>
    </p>
    <p><strong>2.如果你还没有账号</strong></p>
    <span>Q:注册入口</span><br/>
    <p><span class="tt">A:慧锐通管理员没有申请页面，请联系你的上级主管给你开通。</span>
    </p>
	<p><span class="tt">B:请点击<a href="http://master.huishare.com/mobile.php?s=life/register">慧锐通-生活导航商家管理员注册入口</a></span>
    </p>
	<p><span class="tt">C:请点击<a href="http://master.huishare.com/mobile.php?s=vip/register">慧锐通-VIP商家管理员注册入口</a></span>
    </p>
	<p><span class="tt">D:请点击<a href="http://master.huishare.com/mobile.php?s=property/register">慧锐通-开发商管理员注册入口</a></span>
    </p>
    <p>温馨提示：按照提示填写信息，注册完善后等待管理员的审核，审核通过你就可以用你的注册账号登陆做相应的操作！</span>
    </p>
    <p><strong>3.联系我们：</strong></p>
    <p>
公司名称： 慧锐通智能科技股份有限公司<br />

通讯地址： 深圳市龙华新区观澜街道观光路大富工业区慧锐通科技园<br />

邮政编码： 518110<br />

电话号码： 400 700 8828；86-0755-29576118<br />

传真号码： 86-0755-29576023</p>
	
   
</div>
<div style="margin-top: 30px;text-align: center;">
	<?php echo (C("web_copy")); ?>
</div>

</body></html>