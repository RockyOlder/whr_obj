<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>第三方接口配置</title>
<link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
<link rel="stylesheet" type="text/css"	href="/App/Home/View/Public/Css/bootstrap.min.css">
<link rel="stylesheet" href="/App/Home/View/Public/Css/uploadify.css">
<script src='/App/Home/View/Public/Js/jquery.uploadify.min.js'></script>
<script type="text/javascript" src="/App/Home/View/Public/Js/artDialog.js"></script>
<link id="artDialogSkin" href="/App/Home/View/Public/Css/skin/aero/aero.css" rel="stylesheet" type="text/css" />


</head>
<style type="text/css">
	#password{padding-top:20px;margin-bottom:20px;width: 230px;height: 150px;position: absolute;top: 200px;left: 350px;background: pink;text-indent: 2em;}
	#password p{line-height: 25px;font-size: 18px;}
	#password input{height: 35px;font-size: 18;position: relative;top: 0;left: 0px;border: 1px solid #2AABD2;}
	#password2{padding-top:20px;margin-bottom:20px;width: 230px;height: 150px;position: absolute;top: 200px;left: 350px;background: pink;text-indent: 2em;display: none;}
	#password2 p{line-height: 25px;font-size: 18px;}
	#password2 input{height: 35px;font-size: 18;position: relative;top: 0;left: 0px;border: 1px solid #2AABD2;}
</style>
<body style="background: none;">

	<div class="place">
			<span>位置：</span>
		<ul class="placeul">
			<li><a href="<?php echo U('Index/start');?>">首页</a></li>
			<li>系统管理</li>
			<li>第三方接口配置</li>
		</ul>
	</div>
	<form1 action="" method="post" id="ctrip_form">
			<div class="formbody">
				<div class="formtitle">
					<span><?php echo ($data["title"]); ?></span>
				</div>
				<ul class="forminfo">
					<li><label>联盟ID</label><input name="uid" id="version"  type="text" class="dfinput"  value="<?php echo ($ctrip["uid"]); ?>" /><i id="version_info">携程联盟id</i></li>
                    <li><label>SID</label><input name="sid" id="des"  type="text" class="dfinput"  value="<?php echo ($ctrip["sid"]); ?>" /><i id="des_info"></i></li>
                    <li><label>站点密钥(APIKey) </label><input name="key" id="url"  type="text" class="dfinput"  value="<?php echo ($ctrip["key"]); ?>" /><i id="des_info">站点密钥</i></li>       
					<li><label>&nbsp;</label><input name="ok" type="button"
						class="btn btn-primary" value="确认<?php echo ($data["btn"]); ?>"
						onclick="javascript:;" id="ctrip"/>                        
                    </li>
				</ul>
			</div>
            <div id="password" style='display:none'>
            	<p>请输入你的密码</p>
            	<input type="password" name="password" id="password" value="miama"  style="display: block;"/>
            	<input type="submit"class="btn btn-success" value="确认"	style="margin-left: 50px;"/> 
            	
            </div>
	</form>
	
    <form2 action="<?php echo U('insert',array('act'=>'people'));?>" method="post">
            <div class="formbody">
                <div class="formtitle">
                    <span><?php echo ($people["title"]); ?></span>
                </div>
                <ul class="forminfo">
                    <li><label>App Key</label><input name="appKey" id="version"  type="text" class="dfinput"  value="<?php echo ($some["appKey"]); ?>" /><i id="version_info">站点密钥</i></li>
                    <li><label>App Secret </label><input name="secret" id="des"  type="text" class="dfinput"  value="<?php echo ($some["secret"]); ?>" /><i id="des_info">站点密码</i></li>       
                    <li><label>&nbsp;</label><input name="ok" type="button"
                        class="btn btn-primary" value="确认<?php echo ($people["btn"]); ?>"
                        onclick="javascript:;" id = "dazhong"/>
                        
                    </li>
                </ul>
            </div>
            <div id="password2" style='display:none'>
            	<p>请输入你的密码</p>
            	<input type="password" name="password" id="password" value="miama" style="display: block;" />
            	<input type="submit"class="btn btn-success" value="确认" style="margin-left: 50px;"/> 
            	
            </div>
    </form>
    <input type="hidden" value="<?php echo U('ajax_password');?>" id="url_pass">
    <input type="hidden" value="<?php echo U('insert',array('act'=>'ctrip'));?>" id="post_ctrip">
    <input type="hidden" value="<?php echo U('insert',array('act'=>'people'));?>" id="post_people">
    <script type="text/javascript">
    	//document.getElementById简化函数
	
         $(function(){
			$('#ctrip').bind('click',function(){
				var url = $('#url_pass').val();
				
			var _this = this;
			art.dialog({id:'menu_4834783', title:'菜单', content:'请输入密码：<input style="width:200px;border:1px solid #D0DEE5" id="M_dfd" type="password" value="" />',menuBtn:this,lock:true}, function(){
				var a = $('#M_dfd').val();

				if (a != '') {
					$.ajax({
					'url': url,
					'data':{'password':a},
					'dataType': 'json',
					'type' : 'post',
					'success':function(data){

						if (data== 1) {
							var uid =$('input[name=uid]').val();
							var sid =$('input[name=sid]').val();
							var key =$('input[name=key]').val();
							var url = $('#post_ctrip').val()
							$.ajax({
								'url': url,
								'data':{'uid':uid,'sid':sid,'key':key},
								'dataType': 'json',
								'type' : 'post',
								success:function(data){
									if (data == 1) {
										alert('修改成功');
									}else{
										alert('修改失败');
									};
								},
								error:function(data){
									alert('缺少参数');
								}
							})
						}else{
							alert('密码输入有误！');
						}
					},
					
					});
				};
				
			}).close(function(){
				_this.innerHTML = '弹出菜单';
			});
			_this.innerHTML = '关闭菜单';
                        
			return false;
		 	})
			$('#dazhong').bind('click',function(){
				var url = $('#url_pass').val();
				
			var _this = this;
			art.dialog({id:'menu_4834783', title:'菜单', content:'请输入密码：<input style="width:200px;border:1px solid #D0DEE5" id="M_dfd" type="password" value="" />',menuBtn:this,lock:true}, function(){
				var a = $('#M_dfd').val();

				if (a != '') {
					$.ajax({
					'url': url,
					'data':{'password':a},
					'dataType': 'json',
					'type' : 'post',
					'success':function(data){

						if (data== 1) {
							var appKey =$('input[name=appKey]').val();
							var secret =$('input[name=secret]').val();
							var url = $('#post_people').val()
							$.ajax({
								'url': url,
								'data':{'appKey':appKey,'secret':secret},
								'dataType': 'json',
								'type' : 'post',
								success:function(data){
									if (data == 1) {
										alert('修改成功');
									}else{
										alert('修改失败');
									};
								},
								error:function(data){
									alert('缺少参数');
								}
							})
						}else{
							alert('密码输入有误！');
						}
					},
					
					});
				};
				
			}).close(function(){
				_this.innerHTML = '弹出菜单';
			});
			_this.innerHTML = '关闭菜单';
                        
			return false;
		 	})
         })
        
        	
			
			
        

    </script>


</body>
</html>