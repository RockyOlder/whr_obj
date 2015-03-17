<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>发布推送</title>
<link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
<link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
<script type="text/javascript">
    // alert(1)
    //简单验证
    var validate = {
    'title' : false,
    'content':false,
    'address':false
    };
    $('#title').blur(function(){
        alert(1);
        if($.trim($(this).val()) == ''){
            $('#title_info').text('消息标题不能为空').css('color','red');
            validate.title = false;
        }else{
            $('#title_info').text('');
            validate.title = true;
        }
    });
    $('#content').blur(function(){
        if($.trim($(this).html) == ''){
            $('#content_info').text('消息内容不能为空').css('color','red');
            validate.content = false;
        }else{
            $('#content_info').text('');
            validate.content = true;
        }
    });
    $('#city').blur(function(){
        if($.trim($(this).val()) == ''){
            $('#city_info').text('推送地区不能为空').css('color','red');
            validate.city = false;
        }else{
            $('#city_info').text('');
            validate.city = true;
        }
    });
    
    $('form').submit(function(){
        $('#title').trigger('blur');
        $('#content').trigger('blur');
        $('#city').trigger('blur');
        var isOK = validate.title && validate.content && validate.city
        if(!isOK){            
            return false;            
        }
        return true;
    });
     

</script>
<style type="text/css">
    .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
    .pro select{width: 345px;height: 32px; border: 1px solid #A7B5BC;}
    .cat_img{margin-top: -40px;} 
    .pro span{width: 345px;height: 32px; }
    #spanDes{ font-size: 13px; color: #7f7f7f; float: left; margin:0 300px; margin-top: -30px;}
    #pro_category{float: left; margin: 0 345px; margin-top: -25px;}
    /*  .top_cate{background-image: url(/App/Home/View/Public/img/menu_minus.gif); width:10px; height:10px;} */
    .push_back{background: #DDDDDD; }
    .nomal{background: none;}
    #boox{border-bottom: 3px solid #999999;width: 60%;padding: 35px;margin-top: 30px;margin-left: 35px;}
    #choce_area{background:#FFFFFF;width:91%;height:100%;position:absolute;right:0;top:0;margin:0 auto;display: none;}
    #pushtitle{font-size: 30px;}
    #boox ul {overflow: hidden;}
    #boox ul li{width: 25%;float: left;line-height: 35px;margin-bottom: 15px;}
    .marger{ margin-top: 8px; float: left;}
</style>
</head>
<body id="bigest" class="nomal">

	<div class="place">
		<span>位置：</span>
		<ol class="placeul">
            <li><a href="<?php echo U('Index/start');?>">首页</a></li>
			<li>推送管理</li>
			<li>推送消息</li>
		</ol>
	</div>
	<form action="" method="post" name="vform">
		<div class="formbody">
			<div class="formtitle">
				<span><?php echo ($data["title"]); ?></span>
			</div>
			<ul class="forminfo">
				
                <li><label>消息标题</label><input name="title" id="title" type="text" class="dfinput" value="" /><i id="title_info">别超过50字</i></li>
                <li><label>消息内容</label><textarea  name="content" id="content" cols="80" rows="10" class="textinput"></textarea><i id="content_info">别超过200字</i></li>
                <li><label>设备范围</label>
                    <input name="type" type="radio" value="0" checked="checked" />全部&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="type" type="radio" value="1" checked="checked" />android&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="type" type="radio" value="2" />ios<i id="type_info"></i></li>
                <li><label>用户范围</label>
                    <span class = 'pro'>
                        <select name = 'extent' id="extent" class="form-control" >                            
                            <?php if(is_array($extent)): $key = 0; $__LIST__ = $extent;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><option class = "top_cate" value="<?php echo ($key); ?>"><span><?php echo ($vo); ?></span></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </span>
                </li>
                <li id="send_push_Change" style=" display:  none;">
                <label>已选地区</label>
                </li>
                

                <input type="hidden" value="全国" name="push" id="push"> 
				<li><label>&nbsp;</label><input name="" type="submit"
					class="btn btn-primary" value="确认<?php echo ($data["btn"]); ?>"
					onclick="javascript:;" /></li>
			</ul>
		</div>
	
    <div id="choce_area">
    	<div id="boox">
    		<div id="pushtitle">
			<img src="/App/Home/View/Public/Images/close.png" id="push_close"/>&nbsp;&nbsp;推送地区选择		
			</div>
			
			<ul id = "choce_content">
				
			</ul>
			
		
    	</div>
    	<div style="padding:35px">
            <input type="button" value="确定" class="btn btn-success" id = 'area_ok'/>&nbsp;&nbsp;
            <input type="button" value="取消" class="btn btn-info" id="comeback"/>
        </div>
		<input type="hidden" name="url_ajax_choce" id="" value="<?php echo U('url_ajax_choce');?>" />
    </div>
    </form>
</body>
<script type="text/javascript">
   
   $('#extent').change(function(){
        var num = $(this).val();  
        if (num == 2) {
            var start = 'P'
        }else if(num == 3){
            var start = 'C'
        }else if(num == 4){
            var start = 'A'
        }else if(num == 5){
            var start = 'W'
        }else if(num == 6){
            var start = 'V'
        };      
        if(num != 1){        	
	        $.ajax({
	        	type:"post",
	        	url:$('input[name=url_ajax_choce]').val(),
	        	data:{'id':num},
	        	dataType : "json",
	        	success:function(data){
                if (data != 0) {
                    var str=""
                    var push='';
                    var roleDataBak='';
                    str=''
                    $("#send_push_Change span").each(function(){ $(this).remove();});
                    $.each(data,function(key,val){ 
                     
                        str += '<li><input type="checkbox" name="city[]" class="choced" value="'+start+val["id"]+'" />'+val["name"]+'</li>';                
                    })
                    $('#choce_content').html(str);
                    $('#bigest').attr('class','push_back');
                    $('#choce_area').show(200);
                    $("#send_push_Change").hide();
                    $(".choced").click(function(){
                     
                        if($(this).is(":checked"))
                         {  
                            roleDataBak=$(this).parent().text()+"&nbsp;&nbsp;";
                            push = '<span class="marger">'+roleDataBak+'</span>';       
                           $("#send_push_Change").append(push);
                         } 
                      
                    })
                };
                
	        	}
	        });
        }else{
        	$('#bigest').attr('class','nomal');
        }
    })

    $('#push_close,#comeback,#area_ok').bind('click',function(){


       $("#send_push_Change").toggle()
    	$('#choce_area').hide(200);
        $('#bigest').attr('class','nomal');
               roleDataBak='';
    })
    // $('.choced').bind('click',function(){
    //     var choce = $('.choced').val();
    // 	alert(choce.length);
    // })
   
</script>
</html>