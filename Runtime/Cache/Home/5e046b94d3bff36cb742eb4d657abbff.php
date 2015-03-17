<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
<link rel="stylesheet" type="text/css"
	href="/App/Home/View/Public/Css/bootstrap.min.css">
<link rel="stylesheet" href="/App/Home/View/Public/Css/uploadify.css">
<script src='/App/Home/View/Public/Js/jquery.uploadify.min.js'></script>
<script type="text/javascript">
                    
                                         
    function check(){
        var data=$('#file').val()
        var id = $('#village').val();

        if(data == ''){

            alert('你还没有选择文件！');
        }else if(id == ''){
            alert('你不是小区管理员，不能导入业主');
        }else{
            var url = $('#url_ajax').val();
            
            $.ajax({
                'url': url,
                'data':{'file':data,'id':id},
                'dataType': 'json',
                'type' : 'post',
                success:function(data){
				//console.log(data)
                    if (data == 1) {
                        alert('住户导入成功');
                        $('#file').val('');
                    }else{
                        alert('住户导入失败');
                    };
                },
                error:function(data){
                    alert('缺少参数');
                }
            })
        }
    }
                         
                    
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
			<li>住户管理</li>
			<li><?php echo ($data["title"]); ?></li>
		</ul>
	</div>
    <input type="hidden" value="<?php echo U('owner_ajax');?>" id="url_ajax">
	<!-- <form action="" method="post" name="vform"> -->
		<input type="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
			<div class="formbody">
				<div class="formtitle">
					<span><?php echo ($data["title"]); ?></span>
				</div>
				<ul class="forminfo">

					<li><label>所属小区:</label> <label><?php echo ($village["name"]); ?></label> 
                        <input type="hidden" name="property_id" value="<?php echo ($_SESSION['admin']['village']); ?>" id="village">
                        
					<i></i></li>
                    <li><label>业主账单样表</label>
                       <label style="width:auto;font-weight:400">温馨提示：如果你没有样板文件请 <a href="http://120.24.214.88/Uploads/file/user_info.xls">点击下载</a>否则选择文件直接上传</label>
                        </li>
					<li><label>业主信息表</label>
						<div id="list_hidden" style="line-height:30px;">
							<input type='text' name="file_path" value="">
						</div></li>
					<li style="position: relative; margin-bottom: 5px; height: 55px">
                        <input
						name="file" id="upload_file" type="file" class="dfinput"
						style="" value="" />
                        <input
                         id="file" type="hidden" class="dfinput"
                        style="" value="" />
                        <i id="imgs"
						style="position: absolute; left: 150px; top: -5px;"> 

					</i></li>
					<li><label>&nbsp;</label><input name="" type="submit"
						class="btn btn-primary" value="确认<?php echo ($data["btn"]); ?>"
						onclick="check()" /></li>
				</ul>
			</div>
	<!-- </form> -->
    <script type="text/javascript">
         var img = "";
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
                    img += "<input type='text' name='file' value='"+obj+"'>"
                  
                    $('#imgs').html(img);
                    var hid ="<input name='thumb_pic' type='hidden' value='"+obj+"' />"
                   
                    $('#list_hidden').html(hid);
                    $('#file').val(obj);
                    img = '';
                    hid='';
                }
            });
    
        
        function deletePic(){
                                                                                                                       
            $("#imgs img").remove();
            $('#list_hidde input').remove();
        }
    </script>


</body>
</html>