<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/whr/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript"  src="/whr/App/Home/View/Public/Js/jquery.js"></script>
<script type="text/javascript">
$(function(){	
	//顶部导航切换
	$(".nav li a").click(function(){
		$(".nav li a.selected").removeClass("selected")
		$(this).addClass("selected");
	})	
})	
</script>
</head>

<body>

    <div class="topleft">
    <a href="<?php echo U('Index/index','','');?>" target="_parent"><img src="/whr/App/Home/View/Public/Images/top_log.png" title="系统首页" / style="float:left; margin-right:20px;"></a>
    <p style="font-size:30px; color:#FFF; height:88px; line-height:88px;">慧锐通后台管理系统</p>
    </div>
        
    <ul class="nav">
    <li><a href="default.html" target="rightFrame" class="selected"><img src="/whr/App/Home/View/Public/Images/45.png"><h2>首页</h2></a></li>
    <li><a href="imgtable.html" target="rightFrame"><img src="/whr/App/Home/View/Public/Images/45.png"><h2>系统设置</h2></a></li>
    <li><a href="imglist.html"  target="rightFrame"><img src="/whr/App/Home/View/Public/Images/45.png"><h2>房地产开发商</h2></a></li>
    <li><a href="tools.html"  target="rightFrame"><img src="/whr/App/Home/View/Public/Images/45.png"><h2>物业管理</h2></a></li>
    <li><a href="computer.html" target="rightFrame"><img src="/whr/App/Home/View/Public/Images/45.png"><h2>生活导航</h2></a></li>
    <li><a href="tab.html"  target="rightFrame"><img src="/whr/App/Home/View/Public/Images/45.png"><h2>VIP特享</h2></a></li>
    </ul>
            
    <div class="topright">    
    <ul>
    <li><span><img src="/whr/App/Home/View/Public/Images/help.png"title="帮助"  class="helpimg"/></span><a href="#">帮助</a></li>
    <li><a href="#">关于</a></li>
    <li><a href="<?php echo U('Index/loginout','','');?>" target="_parent">退出</a></li>
    </ul>
     
    <div class="user">
    <span><?php echo ($_SESSION['admin']['name']); ?></span>
    <i>消息</i>
    <b>5</b>
    </div>    
    
    </div>

</body>
</html>