<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎登录后台管理系统</title>
<link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/style.css">
<script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
<script type="text/javascript" src="/App/Home/View/Public/Js/cloud.js"></script>
<script type="text/javascript" src="/App/Home/View/Public/Js/login.js"></script>
<script language="javascript">
	$(function(){
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
	$(window).resize(function(){  
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
    })  
});  
</script> 
<style type="text/css">
    li{
        position: relative;
    }
    li span{
        position: absolute;
        color: red;
        top: 50px ;
        left: 10px;
    }
    li img{
        position: absolute;
        top: 0px;
        left: 186px;
    }
</style>
</head>

<body style="background-color:#1c77ac; background-image:url(/App/Home/View/Public/Images/light.png); background-repeat:no-repeat; background-position:center top; overflow:hidden;">



    <div id="mainBody">
      <div id="cloud1" class="cloud"></div>
      <div id="cloud2" class="cloud"></div>
    </div>  


<div class="logintop">    
    <span>欢迎登录&nbsp&nbsp&nbsp&nbsp<?php echo ($logo); ?></span>    
    <ul>
    <li><a href="http://www.huishare.com">回首页</a></li>
    <li><a href="<?php echo U('Help/login');?>">帮助</a></li>
    </ul>    
    </div>
    
    <div class="loginbody">
    
    <span class="systemlogo"></span> 
    
    <div class="loginbox">
    
    <form name="form" method="post" action="">
        <input type="hidden" valu="<?php echo U('Index/index');?>" id="form_action" name="url_go">
    <ul>
    <li><input name="username" type="text" id="username" class="loginuser" value="<?php echo ($remeber["name"]); ?>" onclick="JavaScript:this.value=''"/><span id ="username_info"></span></li>
    <li><input name="password" type="password" id="password" class="loginpwd" value="<?php echo ($remeber["password"]); ?>" onclick="JavaScript:this.value=''"/><span id ="password_info"></span></li>
    <?php if($_SESSION['num']== 1): ?><li><input name="verify" type="text" class = "verify" value="验证码" onclick="JavaScript:this.value=''" style="width:200px;"/><img src="<?php echo U('verify','','');?>" style="width:150px;height:48px" onclick="this.src=this.src+'&'+Math.random(0,9999)" id='verifyImg'><span id ="verify_info"></span></li><?php endif; ?>
    <li><input type="button" class="loginbtn" value="登录"  onclick="checklogin()"  /><label><input name="remeber" type="checkbox" value="1" checked="checked" />记住密码</label><label><a href="<?php echo U('Passwd/index');?>">忘记密码？</a></label></li>
    </ul>
    
    </form>
    </div>
    
    </div>
    
    
    
    <div class="loginbm"><?php echo (C("web_copy")); ?></div>
	
    
</body>

</html>