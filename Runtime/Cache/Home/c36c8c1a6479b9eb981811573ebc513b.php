<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo ($title); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="Text/Javascript" src="/whr/App/Home/View/Public/Js/jquery-1.8.1.min.js"></script>
<style type="text/css">
*{padding:0px;margin:0px;}
	body{
	background:	#0072E3;
	}
	#header-div{
	
	}
	.menu{
		cursor:pointer;
		border-bottom:1px solid 	#97CBFF;
	}
	dl{
	padding:0px;
		
	}
	.point{
		
	}
	dt{
	letter-spacing:1px;
	color:#ffffff;
	line-height:28px;
	font-size:14px;
	font-family:"微软雅黑","仿宋";
		text-indent:1em;
		background:#46A3FF;
	}
	dd{
	
	line-height:25px;
	  //border:1px solid pink;
	  //font-family:"仿宋","微软雅黑";
	  font-family:"微软雅黑","仿宋";
	  		
	}
	dd a{
	font-size:12px;
	color:#ffffff;
		border-bottom:1px dashed #ccc;
		text-indent:2em;
		display:block;
		width:100%;
		
		text-decoration:none;
	}
	a:hover{
		background:	#005AB5;
	}
	.click{
		background:	#005AB5;
	}
</style>
<script type="text/javascript">
$(function(){
	$('dd').hide();
	$('.menu').click(function(e){
		//var en = e ||window.event;
		$(this).siblings('dd').toggle(300).addClass('point');
	});
	$('dd').click(function(){
		//$(this).addClass('point').siblings('dd').removeClass('click');
	})
});
</script>
</head>
<body>
<div id="header-div">
   <?php if(is_array($menu)): $k = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><dl class="menu-ul">          
       <dt class ="menu" key ="<?php echo ($k); ?>"><?php echo ($vo["title"]); ?></dt> 
        <?php if(is_array($vo['son'])): $i = 0; $__LIST__ = $vo['son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?><dd class="menu-item" key ="<?php echo ($k); ?>"><a href="<?php echo U($s['name']),'','';?>" target="main-frame"><?php echo ($s["title"]); ?></a></dd><?php endforeach; endif; else: echo "" ;endif; ?>     
  </dl><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
   <!-- <div id="load-div" style="padding: 5px 10px 0 0; text-align: right; color: #FF9900; display: none;width:40%;float:right;"><img src="images/top_loader.gif" width="16" height="16" alt="<?php echo ($lang["loading"]); ?>" style="vertical-align: middle" /> <?php echo ($lang["loading"]); ?></div>
  --></div>
</div>

</body>
</html>