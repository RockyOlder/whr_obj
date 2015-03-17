<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>慧享园后台帮助页面</title>

<script type="text/javascript" src="/App/Home/View/Public/Js/xiala.js"></script>
<script type="text/javascript">
$(document).ready(function(){

	$("#firstpane .menu_body:eq(0)").show();
	$("#firstpane h3.menu_head").click(function(){
		$(this).addClass("current").next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
		$(this).siblings().removeClass("current");
	});
	
	$("#secondpane .menu_body:eq(0)").show();
	$("#secondpane h3.menu_head").mouseover(function(){
		$(this).addClass("current").next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
		$(this).siblings().removeClass("current");
	});
	
});
</script>

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

.menu_list{width:1000px;margin:20px auto; background:#FFF; border:1px solid #CCC;}
.menu_head{height:40px;line-height:40px;padding-left:15px;font-size:14px;color:#525252;cursor:pointer;border-bottom:1px solid #e1e1e1;position:relative;margin:0px;font-weight:bold;background:url(/App/Home/View/Public/Images/help/btn_2.png)950px center no-repeat;}
.menu_list .current{background:url(/App/Home/View/Public/Images/help/btn_1.png) center 0px 400px no-repeat;}
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

  <h3 class="menu_head">登录问题？</h3>
	<div style="display: none;" class="menu_body">
    <p><strong>1.怎么样登陆</strong></p>
    <span>Q:怎么登陆？</span><br/>
	<span class="tt">A:输入<a href="">http://master.huishare.com</a>进入后台，填写你的用户名和密码,输入验证码，点击"登录"按钮，根据页面操作即可。</span>
    <li><img src="/App/Home/View/Public/Images/help/lo.jpg"></li>
    
    <p><strong>2.忘记密码怎么办</strong></p>
    <span>Q:怎么找回密码？</span><br/>
	<span class="tt">A:1.在登陆页面点击”忘记密码“进入找回密码页面，填写你的帐户名,输入验证码，点击"提交"按钮，根据页面操作即可。</span>
    <li><img src="/App/Home/View/Public/Images/help/password-1.png"></li>
    <span class="tt">2.如果第一步账户名输入的是手机号，则在“验证身份页面”点击获取验证码”按钮，把发送到手机上的验证码输入到验证框里，然后点击”提交“按钮，根据页面操作即可。</span>
    <li><img src="/App/Home/View/Public/Images/help/password-2.png"></li>
    <span class="tt">3.如果第一步账户名输入的是邮箱，则在“验证身份页面”发送验证邮件”按钮，然后再点击“查看验证邮件”，将邮件收到的验证码输入验证框中。然后点击”提交“按钮，根据页面操作即可。</span>
    <li><img src="/App/Home/View/Public/Images/help/email-1.png"><img src="/App/Home/View/Public/Images/help/email-2.png"></li>
    <span class="tt">4.在“设置新密码”页面填写你的新密码以及确认新密码，点击”提交“按钮，根据页面操作即可。</span>
    <li><img src="/App/Home/View/Public/Images/help/password-3.png"></li>
    <span class="tt">5.按照上面的步骤操作则找回密码成功</span>
    <li><img src="/App/Home/View/Public/Images/help/password-4.png"></li>
	</div>
	
	<h3 class="menu_head current">怎样添加开发商</h3>
	<div style="display: none;" class="menu_body">
	 <p><strong>1.怎样添加开发商</strong></p>
     <span>Q:怎么添加开发商？</span><br/>
	 <span class="tt">进入后台首页，点击开发商管理下的“添加开发商”， 在添加开发商页面填写开发商名字、负责任姓名、开发商电话、省份以及公司总部地址等，然后点击“确认添加”按钮，根据页面操作即可。</span>
     <li><img src="/App/Home/View/Public/Images/help/kai-1.png"></li>
	</div>
	
	<h3 class="menu_head current">怎样添加物业</h3>
	<div style="display: none;" class="menu_body">
	 <p><strong>1.怎样添加物业</strong></p>
     <span>Q:怎么添加物业？</span><br/>
	 <span class="tt">A:进入后台首页，点击物业管理下的“添加添加物业”， 在添加物业页面填写物业名称、电话、地址、主管姓名及电话等，然后点击“确认添加”按钮，根据页面操作即可。</span>
     <li><img src="/App/Home/View/Public/Images/help/wuye-2.png"></li>
	</div>
	
	<h3 class="menu_head current">怎样添加小区</h3>
	<div style="display: none;" class="menu_body">
	 <p><strong>1.怎样添加小区</strong></p>
     <span>Q:怎么添加小区？</span><br/>
	 <span class="tt">A:进入后台首页，点击小区管理下的“添加小区”， 在添加小区页面填写小区名字，选择地址和所属物业，然后点击“确认添加小区”按钮，根据页面操作即可。</span>
     <li><img src="/App/Home/View/Public/Images/help/xiaoqu-3.png"></li>
	</div>
	
	<h3 class="menu_head current">怎样添加管理员</h3>
	<div style="display: none;" class="menu_body">
	 <p><strong>1.怎样添加管理员</strong></p>
     <span>Q:怎么添加管理员？</span><br/>
	 <span class="tt">A:进入后台首页，点击管理员管理下的“添加管理员”， 在添加管理员页面填写用户名、密码、确认密码、邮箱、选择角色，然后点击“确认添加”按钮，根据页面操作即可。</span>
     <li><img src="/App/Home/View/Public/Images/help/admin-4.png"></li>
	</div>
    
    
    <h3 class="menu_head current">怎样添加角色</h3>
	<div style="display: none;" class="menu_body">
	 <p><strong>1.怎样添加角色</strong></p>
     <span>Q:怎样添加角色？</span><br/>
	 <span class="tt">A:进入后台首页，点击角色管理下的“添加开角色”， 在添加开角色页面填写角色名字、权限描述，然后点击“确认添加”按钮，根据页面操作即可。</span>
     <li><img src="/App/Home/View/Public/Images/help/juese-5.png"></li>
	</div>
    
    
    
    <h3 class="menu_head current">怎样添加商品</h3>
	<div style="display: none;" class="menu_body">
	 <p><strong>1.怎样添加商品</strong></p>
     <span>Q:怎么添加商品？</span><br/>
    <span class="tt">A:1.进入后台首页，点击商品管理下的”添加分类“，在添加分类页面填写分类名称,上传分类图片、描述点击"确认添加分类"按钮，根据页面操作即可。</span>
    <li><img src="/App/Home/View/Public/Images/help/shangpin-6-1.png"></li>
    <span class="tt">2.再次点击的”添加分类“，在添加分类页面填写分类名称,选择顶级分类、上传分类图片、描述点击"确认添加分类"按钮，根据页面操作即可</span>
    <li><img src="/App/Home/View/Public/Images/help/shangpin-6-1.png"></li>
    <span class="tt">3.点击商品规格，在商品规格操作下的”编辑“按钮，选择分类、添加属性，点击“提交”按钮，根据页面操作即可。</span>
    <li><img src="/App/Home/View/Public/Images/help/guige-6-2.jpg"></li>
    <span class="tt">4.点击添加商品，在添加商品页面填写商品名字、选择分类、商品型号、价格、库存、地址、图文介绍、自推自荐、商家描述、列表图片、商品相册等，然后点击”确认添加商品“按钮，根据页面操作即可。</span>
    <li><img src="/App/Home/View/Public/Images/help/tianjia-6-4.png"></li>
    <span class="tt">5.按照上面的步骤操作就可成功添加商品</span>
    <li></li>
	</div>
    
    
    
    
    <h3 class="menu_head current">怎样添加会员</h3>
	<div style="display: none;" class="menu_body">
	 <p><strong>1.怎样添加会员</strong></p>
     <span>Q:怎么添加会员？</span><br/>
	 <span class="tt">A:进入后台首页，点击会员管理下的“添加会员”， 在添加会员页面填写用户名、密码、确认密码、选择所属小区和地址、添加用户头像、邮箱、昵称、真实姓名手机号码、固定电话以及详细地址等，然后点击“确认添加会员”按钮，根据页面操作即可。</span>
     <li><img src="/App/Home/View/Public/Images/help/huiyuan.png"></li>
	</div>
    
    
    
    <h3 class="menu_head current">怎样发布推送</h3>
	<div style="display: none;" class="menu_body">
	 <p><strong>1.怎样发布推送</strong></p>
     <span>Q:怎么发布推送？</span><br/>
	 <span class="tt">A:进入后台首页，点击推送管理下的“发布推送”， 在添加发布推送页面填写要发布的小希标题和内容、选择设备范围和用户范围等，然后点击“确认发送推送消息”按钮，根据页面操作即可。</span>
     <li><img src="/App/Home/View/Public/Images/help/tuisong-8.png"></li>
	</div>
    
    
    
    <h3 class="menu_head current">怎样添加广告</h3>
	<div style="display: none;" class="menu_body">
	 <p><strong>1.怎样添加广告</strong></p>
     <span>Q:怎么添加广告？</span><br/>
	 <span class="tt">A:进入后台首页，点击广告管理下的“添加广告”， 在添加广告名称、链接地址、选择开始时间和结束时间、上传图片，然后点击“提交按钮”按钮，根据页面操作即可。</span>
     <li><img src="/App/Home/View/Public/Images/help/guanggao-9.png"></li>
	</div>
    
    
    
    <h3 class="menu_head current">添加楼盘</h3>
	<div style="display: none;" class="menu_body">
	 <p><strong>1.怎样添加楼盘</strong></p>
     <span>Q:怎么添加楼盘？</span><br/>
	 <span class="tt">A:进入后台首页，点击楼盘管理下的“添加楼盘”， 在添加开发商页面填写楼盘名字、楼盘信息、选择所属开发商，然后点击“确认添加楼盘”按钮，根据页面操作即可。</span>
     <li><img src="/App/Home/View/Public/Images/help/loupan-10.png"></li>
	</div>
    
    
    
    <h3 class="menu_head current">添加住户</h3>
	<div style="display: none;" class="menu_body">
	 <p><strong>1.怎样添加业主</strong></p>
     <span>Q:怎么添加业主？</span><br/>
	 <span class="tt">A:进入后台首页，点击住户管理下的“添加业主”， 在添加业主页面填写业主姓名、电话、住址等，然后点击“确认添加业主”按钮，根据页面操作即可。</span>
     <li><img src="/App/Home/View/Public/Images/help/zhuhu-11.png"></li>
	</div>
    
    
    <h3 class="menu_head current">添加物业信息</h3>
	<div style="display: none;" class="menu_body">
	<p><strong>1.怎样添加公告</strong></p>
    <span>Q:怎么添加公告？</span><br/>
	<span class="tt">A:进入后台首页，点击物业信息管理下的“列表公告”， 在添加公告页面填写公告标题、内容以及图片、选择所属开发商、开始时间和结束时间，然后点击“确认添加公告”按钮，根据页面操作即可。</span>
    <li><img src="/App/Home/View/Public/Images/help/wuyexinxin-17.png"></li>
     
     <p><strong>1.怎样设置关键词</strong></p>
     <span>Q:怎么设置关键词？</span><br/>
	 <span class="tt">A:进入后台首页，点击物业信息管理下的“关键词设置”， 在设置关键词页面填写重要的关键词并用|隔开，然后点击“确认提交关键词”按钮，根据页面操作即可。</span>
     <li><img src="/App/Home/View/Public/Images/help/keyword.png"></li>
     </div>
     
    

    
    
    <h3 class="menu_head current">怎样验证电子消费券</h3>
	<div style="display: none;" class="menu_body">
	 <p><strong>1.怎样验证消费券</strong></p>
     <span>Q:怎么验消费券？</span><br/>
	 <span class="tt">A:进入后台首页，点击电子消费管理下的“消费券验证”， 在消费券验证面填写消费券编码，然后点击“验证按钮”按钮，根据页面操作即可。</span>
     <li><img src="/App/Home/View/Public/Images/help/xiaofeiquan.png"></li>
	</div>
    
    
    
    
      <h3 class="menu_head current">怎样添加活动</h3>
	<div style="display: none;" class="menu_body">
	 <p><strong>1.怎样添加活动</strong></p>
     <span>Q:怎么添加活动？</span><br/>
	 <span class="tt">A:进入后台首页，点击活动管理下的“活动列表”， 在活动列表页面点击右上角的“添加活动按钮”，、然后在演弹出的页面上填写活动标题、选择活动开始时间和结束时间，点击“提交“按钮，据页面操作即可。</span>
     <li><img src="/App/Home/View/Public/Images/help/huodong-12.png"></li>
	</div>
    
    
    <h3 class="menu_head current">系统管理</h3>
	<div style="display: none;" class="menu_body">
	 <p><strong>1.怎样上传APK</strong></p>
     <span>Q:怎么上传新版APK？</span><br/>
	 <span class="tt">A:进入后台首页，点击系统管理下的“上传apk”， 在上传apk页面填写版本号、添加内容、上传图片，然后点击“确认确认上传新版APK”按钮，根据页面操作即可。</span>
     <li><img src="/App/Home/View/Public/Images/help/sever-13.png"></li>
	</div>
	
</div>

</body></html>