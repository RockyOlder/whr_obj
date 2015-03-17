<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>导入住户月账单</title>
<link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
<link rel="stylesheet" type="text/css"
	href="/App/Home/View/Public/Css/bootstrap.min.css">
	<link rel="stylesheet" href="/App/Home/View/Public/Css/uploadify.css">
		<script src='/App/Home/View/Public/Js/jquery.uploadify.min.js'></script>
<script type="text/javascript">
 function check(){

        var data=$('#file').val();
        var id = $('#time_bill').val();
        var type = $('input[name=type]').val();
        // alert(type);
        // alert(id);
        if(type == 9){

            alert('你还没有选择账单类型！');
        }else if($.trim(data) == ''){
            alert('你还没有选择文件！');
        }else if($.trim(id) == ''){
            alert('你没有输入账单时间');
        }else{
            var url = $('#url_ajax').val();            
            $.ajax({
                'url': url,
                'data':{'file':data,'id':id,'type':type},
                'dataType': 'json',
                'type' : 'post',
                success:function(data){
                    if (data == 1) {
                        alert('账单导入成功');
                        window.location.href="<?php echo U('putIn');?>"
                    }else{
                        alert(data);
                    };
                },
                error:function(data){
                    alert('缺少参数');
                }
            })
        }
    }

</script>
<script type="text/javascript">
$(function(){
    $(".bill_type").click(function(){
        var num = parseInt($(this).val());
        $('input[name=type]').val(num)
        // alert(num);
        $('.model').eq(num).show(100).siblings('.model').hide(100);
    })
})
</script>
<style type="text/css">
    .pro {
    	float: left;
    	line-height: 30px;
    	margin-left: 0px;
    	margin-bottom: 10px;
    }

    .sku_tip {
    	background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);
    	border-radius: 4px;
    	box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);
    	color: #fff;
    	display: none;
    	left: 50%;
    	margin-left: -70px;
    	padding: 5px 10px;
    	position: fixed;
    	text-align: center;
    	top: 50%;
    	z-index: 25;
    }

    .pro select {
    	width: 345px;
    	height: 32px;
    }

    .box {
    	margin-left: 5px;
    	font-size: 12px;
    	margin-top: -3px;
    	padding-left: 5px;
    	padding: 3px;
    }
</style>
</head>
<body style="background: none;">

	<div class="place">
        <span>位置： </span>
		<ul class="placeul">
            <li><a href="<?php echo U('Index/start');?>">首页</a></li>
            <li>物业信息管理</li>
			<li><a href="<?php echo U('putIn');?>">账单发布记录</a></li>
            <li>导入住户账单</li>
		</ul>
	</div>
	<!-- <form action="" method="post" name="vform"> -->
		<input type="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
			<div class="formbody">
				<div class="formtitle">
					<span><?php echo ($data["title"]); ?></span>
				</div>
				<ul class="forminfo">
                   
                    <li><label>账单类型 <span>*</span>  </label>
                        <input name="btn" type="radio"  value="0" class="bill_type"/>水费
                        <input name="btn" type="radio"  value="1" class="bill_type"/>电费
                        <input name="btn" type="radio"  value="2" class="bill_type"/>煤气费
                        <input name="btn" type="radio"  value="3" class="bill_type"/>管理费
                        <input name="btn" type="radio"  value="4" class="bill_type"/>停车费
                        <input name="btn" type="radio"  value="5" class="bill_type"/>网络费
                        <input name="btn" type="radio"  value="6" class="bill_type"/>电话费
                        <input name="btn" type="radio"  value="7" class="bill_type"/>健身费
                        <input name="btn" type="radio"  value="8" class="bill_type"/>游泳费
                        <input type="hidden" name = "type" value = "9">
                        <i id="name_info">必须选择一个账单类型，只能选择一个账单类型</i></li>
                     <li class ="model" style="display:none"><label>水费账单样表</label>
                       <label style="width:auto;font-weight:400">如果你没有样板文件请 <a href="http://120.24.214.88/Uploads/file/water.xls">点击下载</a>否则选择文件直接上传
                        </label></li>
                    <li class ="model" style="display:none"><label>电费账单样表</label>
                       <label style="width:auto;font-weight:400">如果你没有样板文件请 <a href="http://120.24.214.88/Uploads/file/elec.xls">点击下载</a>否则选择文件直接上传
                        </label></li>
                    <li class ="model" style="display:none"><label>煤气账单样表</label>
                       <label style="width:auto;font-weight:400">如果你没有样板文件请 <a href="http://120.24.214.88/Uploads/file/gas.xls">点击下载</a>否则选择文件直接上传
                        </label></li>
                    <li class ="model" style="display:none"><label>管理账单样表</label>
                       <label style="width:auto;font-weight:400">如果你没有样板文件请 <a href="http://120.24.214.88/Uploads/file/manage.xls">点击下载</a>否则选择文件直接上传
                        </label></li>
                    <li class ="model" style="display:none"><label>停车账单样表</label>
                       <label style="width:auto;font-weight:400">如果你没有样板文件请 <a href="http://120.24.214.88/Uploads/file/station.xls">点击下载</a>否则选择文件直接上传
                        </label></li>
                    <li class ="model" style="display:none"><label>网络账单样表</label>
                       <label style="width:auto;font-weight:400">如果你没有样板文件请 <a href="http://120.24.214.88/Uploads/file/net.xls">点击下载</a>否则选择文件直接上传
                        </label></li>
                    <li class ="model" style="display:none"><label>电话账单样表</label>
                       <label style="width:auto;font-weight:400">如果你没有样板文件请 <a href="http://120.24.214.88/Uploads/file/mobile.xls">点击下载</a>否则选择文件直接上传
                        </label></li>
                    <li class ="model" style="display:none"><label>健身账单样表</label>
                       <label style="width:auto;font-weight:400">如果你没有样板文件请 <a href="http://120.24.214.88/Uploads/file/fet.xls">点击下载</a>否则选择文件直接上传
                        </label></li>
                    <li class ="model" style="display:none"><label>游泳账单样表</label>
                       <label style="width:auto;font-weight:400">如果你没有样板文件请 <a href="http://120.24.214.88/Uploads/file/swim.xls">点击下载</a>否则选择文件直接上传
                        </label></li>
                    
					<li><label>账单时间</label><input name="time" type="text" class="dfinput" value="2015-01" id="time_bill" /><i id="name_info">时间格式：2015-01 （只输入年份和日期）</i></li>

					<li><label>业主账单表</label>
						<div id="list_hidden">
							<input type='text' style="line-height:30px;" name="file_path" value="你还没有选择任何文件" id="text_give">
						</div></li>
					<li style="position: relative; margin-bottom: 5px; height: 55px"><input
						name="file" id="upload_file" type="file" class="dfinput"
						style="" value="" />
                        <i id="imgs"
						style="position: absolute; left: 150px; top: -5px;"> 
                        <input
                         id="file" type="hidden" class="dfinput"
                        style="" value="" />
                         
                        <input type="hidden" value="<?php echo U('ajax_bill');?>" id="url_ajax">
                        
					</i></li>
					<li><label>&nbsp;</label><input name="" type="submit"
						class="btn btn-primary" value="确认<?php echo ($data["btn"]); ?>"
						onclick="check()" /></li>
				</ul>
			</div>
    <script type="text/javascript">
            $('#upload_file').uploadify({
                'swf'      : '/App/Home/View/Public/Images/uploadify.swf',
                'uploader' : '<?php echo U("Uploads/file");?>',
                'cancelImage':'/App/Home/View/Public/Images/uploadify-cancel.png',
                'buttonText' : '文件上传',
                'multi': false,
                'onUploadSuccess' : function(file, data, response) {
                    // alert(data);
                    obj= $.parseJSON(data);
                    // alert(obj);
                    $('#file').val(obj);
                    $('#text_give').val('你选择了一个文件');
                    
                }
            });
    
        
      
    </script>


</body>
</html>