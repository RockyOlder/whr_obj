<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎登录生活服务商家管理系统</title>
<link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/login.css">
<script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>

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

<body>


 


<div class="logintop">    
    <span>慧享园-生活服务商家登录系统</span>    
    <ul>
        <li><a href="http://www.huishare.com">回首页</a></li>
        <li><a href="<?php echo U('Help/login');?>">帮助</a></li>
    </ul>    
</div>
    
<div class="loginbody">
    
    <div class="systemlogo">
        <img src="/App/Home/View/Public/Images/login_80.png">
        <span class="box_title">慧享园-生活服务商家登录系统</span>
    </div> 
    
    <div class="loginbox">
    
        <form name="form" method="post" action="">
        <ul>
            <li><label class="title">账号登录</label></li>
        <li><input name="username" type="text" id="username" class="loginuser" value="<?php echo (cookie('login_username')); ?>" onclick="JavaScript:this.value=''"/><span id ="username_info"></span></li>
        <li><input name="password" type="password" id="password" class="loginpwd" value="<?php echo (cookie('login_passwd')); ?>" onclick="JavaScript:this.value=''"/><span id ="password_info"></span></li>
        <?php if($_SESSION['num']== 1): ?><li><input name="verify" type="text" class = "verify" value="验证码" onclick="JavaScript:this.value=''" /><img src="<?php echo U('verify','','');?>" style="width:150px;height:48px" onclick="this.src=this.src+'&'+Math.random(0,9999)"><span id ="verify_info"></span></li><?php endif; ?>
        <li><input name="" type="submit" class="loginbtn" value="登录"  onclick="javascript:;"  /><!-- <label><input name="remeber" type="checkbox" value="1" checked="checked" />记住密码</label> --><label><a href="<?php echo U('Passwd/index');?>">忘记密码？</a></label><label><a href="http://master.huishare.com/mobile.php?s=life/register" >立即申请</a></label></li>
        </ul>
        
        </form> 
    </div>
    <div class="login_img">
        <img src="/App/Home/View/Public/Images/login_life.png">
    </div>
    
</div>
    
    
    
    <div class="loginbm"><?php echo (C("web_copy")); ?></div>
	
    
</body>

</html>