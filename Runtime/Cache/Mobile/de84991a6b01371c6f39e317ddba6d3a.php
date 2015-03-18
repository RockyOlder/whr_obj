<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/whr_obj/Mobile/View/Public/css/validate.css" rel="stylesheet" type="text/css">
<script src="/whr_obj/Mobile/View/Public/js/jquery-1.4.2.min.js"></script>
<script src="/whr_obj/Mobile/View/Public/js/easy_validator.pack.js"></script>
<style>
*{ padding:0px; margin:0px;}
body{ width:100%; margin:0 auto; font-family:"微软雅黑";}
.container{ width:700px; margin:0 auto;}
.title{ width:300px; margin:0 auto;}
.title h2{ width:300px; margin:0 auto; text-align:center; height:50px; line-height:50px; font-size:40px; color:#019386; font-weight:600;}
.menuset{ width:100%; margin:0 auto; padding:25px 15px 15px 15px;background:url(/whr_obj/Mobile/View/Public/images/ab--.png) center 70px no-repeat;}
ul{list-style:none;}
.menuset .menu{padding-top:2px;width:800px; height:100px; margin:0 auto; }
.menuset .menu li{float:left; padding:10px 0px;  height:70px; width:240px; text-align:center;}
.menuset .menu li a{display:block;float:left;color:#666;height:55px;line-height:15px;padding:0 60px;margin-left:2px; text-decoration:none; font-size:16px;}
.menuset .menu .bg  {background:url(/whr_obj/Mobile/View/Public/images/gIco7.png)center 42px no-repeat;color:#666; font-weight:800;}
.content{ width:40%; margin:0 auto;}
.name{ width:60%; margin:50px 0px 30px 100px;}
.tel{width:60%; margin:0px 0px 30px 100px;}
.con{ width:90%; margin-left:100px; height:35px; margin-top:20px;}
.province{ float:left; width:200px;}
 select{ width:170px; height:30px;}
.describe{ width:80%; margin-left:100px; margin-top:30px;}
.QQ{ width:80%; margin-left:100px; margin-top:30px;}
.tt{ width:200px; text-align:right;}
.postal{ width:80%; margin-left:100px; margin-top:30px;}
.photo{ width:80%; height:100px; margin-left:100px; margin-top:30px;}
.conten{ width:450px; margin:0 auto; padding-top:50px;}
.username{ height:50px; margin:5px 0px; line-height:40px;}
.password{ height:50px; margin:5px 0px; line-height:40px;}
.newsword{ height:50px; margin:5px 0px; line-height:40px;}
.email{ height:50px; margin:5px 0px; line-height:40px;}
.phone{ height:50px; margin:5px 0px; line-height:40px;}
input{ padding:7px 10px;}
.ma{ height:50px; margin:5px 0px; line-height:40px;}

.btn{margin-top:20px;}
#next{width:250px; padding:5px 0px; color:#fff; background-color:#019386; font-size:24px; font-weight:bold; border:none;}

</style>

<script type="text/javascript">  
    var b = new Boolean();  
    b = false;  
    var b2 = new Boolean();  
    b2 = false;  
    function checkSubmit(){  
        var userName = form.userName.value;  
        var passWord = form.passWord.value;  
        var passWordDemo = form.passWordDemo.value;  
        var email =  form.email.value;  
        if(userName!=0){  
            if(passWord!=0){  
                if(passWordDemo!=0){  
                    if(email!=0)  
                    {  
                        if(b){  
                            if(userName.length<20 && userName.length>6)  
                            {  
                                if(passWord.length<25 && passWord.length>6){  
                                    if(b2){  
                                        document.form1.submit();  
                                    }else{  
                                        alert("两次输入的密码不一致！");  
                                    }  
                                }else{  
                                    alert("密码长度必须在6-25个字符之间！");  
                                }  
                                  
                            }else{  
                                alert("用户名长度必须在5-20个字符之间！")  
                            }  
                        }else{  
                            alert("请您确认您的邮箱是否填写正确！");                             
                        }  
                    }else{  
                        alert("请您先填写用来找回密码的邮箱！");  
                    }  
                }else{  
                    alert("您还没有填写确认密码!");  
                }  
            }else{  
                alert("请您先填写要注册的用户密码！");  
            }  
        }else{  
            alert("请您先填写要注册的用户名！");  
        }  
    }  
      
    function isPassWord(passWord,passWordDemo){  
      
        var passWord = document.getElementById(passWord).value;  
        var passWordDemo = document.getElementById(passWordDemo).value;  
  
          
        if(passWordDemo　!= passWord){  
            document.getElementById('spantest2').innerText = "两次输入的密码不一致！ ";  
            b2 = false;  
            return false;  
        }else{  
            document.getElementById('spantest2').innerText = "正确";  
            b2 = true;  
            return true;  
        }  
    }  
      
    function isEmail(email) {   
    var strEmail=document.getElementById(email).value;   
    if (strEmail.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) != -1)   
    {   
            document.getElementById('spantest').innerText = "邮箱格式正确";  
            b = true;  
            return true;   
    }else{   
            document.getElementById('spantest').innerText = "邮箱格式错误！";  
            document.getElementById(email).focus();   
            b = false;  
            return false;   
    }   
      
  
}   
</script>  

</head>

<body>
<div class="container">
<div class="menuset">
  <ul class="menu">
  <li class="bg"><a href="#"><img src="/whr_obj/Mobile/View/Public/images/tit1.png" width="30" height="30" style=" float:left; margin-top:-7px; padding-right:5px;">设置登录名</a></li>
  <li><a href="#"><img src="/whr_obj/Mobile/View/Public/images/t2.png" width="30" height="30" style=" float:left; margin-top:-7px; padding-right:5px;">填写信息</a></li>
  <li style=" padding:10px 0px 0px 0px;"><a href="#"><img src="/whr_obj/Mobile/View/Public/images/t3.png" width="30" height="30" style=" float:left; margin-top:-7px; padding-right:5px;">注册成功</a></li>
 </ul>
 </div>
 <div style="text-align:center;font-size:25px ;">慧享园的生活导航合作商家注册页面</div>
<div class="conten">

<form action="" method="post" >
  <div class="username"><span style=" margin-left:16px;">用户名：</span><input name="userName" type="text"  id="groupname" reg="[a-z | A-Z]\w{5,15}"  tip="英文字母开头，大于六位，小于16位"  url="<?php echo U('ajax_check_name','','');?>"/><p style="color:#666; float:right">*一旦注册不可更改</p></div>
  <div class="password"><span>设置密码：</span><input name="passWord" type="password" id="groupname" reg="[0-9 | A-Z | a-z]{6,16}"  tip="请输入你的密码"/><p style="color:#666; float:right">*至少6位的数字字母</p></div>
  <div class="newsword"><span>确认密码：</span><input name="passWordDemo" type="password" id="groupname" reg="[0-9 | A-Z | a-z]{6,16}" tip="请保证两次的密码一致"/></div>
  <div class="username"><span>您的昵称：</span><input name="true_name" type="text"  id="flightno" reg=""  tip="管理系统中显示的名字"/><p style="color:#666; float:right;  position: absolute; margin-left: 305px; margin-top: -38px;">*此管理系统中显示的名字</p></div>
  <div class="email">
  <span>邮箱验证：</span><input name="email" type="text" id="groupname" url="<?php echo U('ajax_check_email','','');?>" reg="^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$" tip="邮箱地址，如wrt_cloud@163.com">
  <input name="" type="button" value="获取验证码" id="btn" style=" background-color:#019386; color:#fff; font-weight:bold; border:none; padding:8px">
  <script type="text/javascript">  
  var wait=60;  
  function time(o) {  
        if (wait == 0) {  
            o.removeAttribute("disabled");            
            o.value="免费获取验证码";  
            wait = 60;  
        } else {  
            o.setAttribute("disabled", true);  
            o.value="重新发送(" + wait + ")";  
            wait--;  
            setTimeout(function() {  
                time(o)  
            },  
            1000)  
        }  
    } 
    
document.getElementById("btn").onclick=function(){time(this);sendemail()}  
</script>  
  </div>
  
  <div class="ma">
  	<span style=" float:left; padding-left:22px;">验证码:</span>
  	<input name="email_code" type="text" style="float:left; width:80px; margin:0px 5px;" id="flightno"  url="<?php echo U('ajax_check',array('type'=>2),'');?>" reg="^\d{6}$" tip="请输入邮箱收到的验证码">
  
  </div>
  
  <div class="phone">
  <span>手机号码：</span><input name="mobile" type="text" id="str" reg="^1\d{10}$"  url="<?php echo U('ajax_check_mobile','','');?>"  tip="国内手机号码">
  <input name="" type="button" value="获取验证码"  id="bton" style=" background-color:#019386; color:#fff; font-weight:bold; border:none; padding:8px">
  <script type="text/javascript">  
  var wait=60;  
  function time(o) {  
        if (wait == 0) {  
            o.removeAttribute("disabled");            
            o.value="免费获取验证码";  
            wait = 60;  
        } else {  
            o.setAttribute("disabled", true);  
            o.value="重新发送(" + wait + ")";  
            wait--;  
            setTimeout(function() {  
                time(o)  
            },  
            1000)  
        }  
    }  
document.getElementById("bton").onclick=function(){time(this);sendmsg()}  
</script>  
  </div>
  
  <div class="ma">
  	<span style=" float:left; padding-left:22px;">验证码:</span>
  	<input name="mobile_code" type="text"  style="float:left; width:80px; margin:0px 5px;" id="flightno"  url="<?php echo U('ajax_check',array('type'=>1),'');?>" reg="^\d{6}$" tip="请输入手机收到的验证码">
  	
  </div>



<div class="btn">
<div class="form-item" style=" margin-left:90px;">
	<input class="form-checkbox" type="checkbox" name="" id="J_Agreement" checked="">
	<label>同意<a href="<?php echo U('server');?>" style="color:#019386;">《慧享园服务协议》</a></label>
</div>
    
  
  <div class="form-item form-item-short" style="margin:20px 0px 0px 90px; height:50px;">
 <input type="submit"    id="next" value="下一步" style=" width:250px; padding:5px 0px; color:#fff; background-color:#019386; font-size:24px; font-weight:bold; border:none;"/>
  </form>
  <input type="hidden" name="email_src" id="email_src" value="<?php echo U('sendEmail','','');?>" />
  <input type="hidden" name="mobile_src" id="mobile_src" value="<?php echo U('sendMsg','','');?>" />
</div>
</div>
</div>
<script type="text/javascript">
	function sendemail(){
		url = $('#email_src').val();
			email = $('input[name=email]').val();
			if(email == ''){alert('请输入你的邮箱后获取');}else{
				$.ajax({
					type:"get",
					url:url,
					data:{'email':email},
					success:function(data){
						if(data){
							alert('邮件已经成功发送，请查看验证码并输入');
						}else{
							alert('短信发送失败，请检查你的邮箱号码');
						}
					}
				});
			}
	}
	function sendmsg(){
		url = $('#mobile_src').val();
			mobile = $('input[name=mobile]').val();
			if(mobile == ''){alert('请输入你的手机后获取');}else{
				$.ajax({
					type:"get",
					url:url,
					data:{'mobile':mobile},
					success:function(data){
						if(data){
							alert('短信已经成功发送，请查看验证码并输入');
						}else{
							alert('短信发送失败，请检查你的手机号码');
						}
					}
				});
			}
	}

</script>
</div>
</body>
</html>