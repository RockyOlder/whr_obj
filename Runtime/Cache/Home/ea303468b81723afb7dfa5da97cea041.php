<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加开发商</title>
<link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
<link rel="stylesheet" type="text/css"
	href="/App/Home/View/Public/Css/bootstrap.min.css">
	<link rel="stylesheet" href="/App/Home/View/Public/Css/uploadify.css">
		<script src='/App/Home/View/Public/Js/jquery.uploadify.min.js'></script>
		<script type="text/javascript">
                    $(function(){
                        // alert(1)
                        //简单验证
                        /*    var validate = {
                            'username' : false,
                            'type_id':false
                        };
                        $('#name').blur(function(){
                            if($.trim($(this).val()) == ''){
                                $('#name_info').text('商家名字不能为空').css('color','red');
                                validate.username = false;
                            }else{
                                $('#name_info').text('');
                                validate.username = true;
                            }
                        });
                        $('#soncate').change(function(){
                            if($.trim($(this).val()) == 0){
                                $('#type_info').text('请选择分类').css('color','red');
                                validate.type_id = false;
                            }else{
                                $('#type_info').text('');
                                validate.type_id = true;
                            }
                        });
                    
       
                        $('form').submit(function(){
                            $('#name').trigger('blur');
                            var isOK = validate.username && validate.type_id
                            if(!isOK){
                                if($(".pro_into").text()=="请选择"){
                                    $('#skuTitle2').text("您还未选择分类")
                                    $('#skuNotice').show();
                                    setTimeout( function(){
                                        $( '#skuNotice' ).fadeOut();
                                    }, ( 1 * 1000 ) ); 
                                    return false;
                                }
                            }
                            return true;
            
                        });
                         */
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
		<span>后台管理：</span>
		<ul class="placeul">
			<li><a href="#">合作商家管理</a></li>
			<li><a href="#">添加商品</a></li>
		</ul>
	</div>
	<form action="" method="post" name="vform">
		<input type="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
			<div class="formbody">
				<div class="formtitle">
					<span><?php echo ($data["title"]); ?></span>
				</div>
				<ul class="forminfo">
                    <li><label>业主账单样表</label>
                       <span>如果你没有样板文件请 <a href="http://120.24.214.88/Uploads/file/user_bill.xls">点击下载</a>否则选择文件直接上传</span>
                        </li>
					<li><label>账单时间</label><input name="time" id="name" type="text" class="dfinput" value="2015-01" /><i id="name_info">例子为2015年一月账单</i></li>

					<li><label>业主账单表</label>
						<div id="list_hidden">
							<input type='text' name="file_path" value="请选择文件再上传">
						</div></li>
					<li style="position: relative; margin-bottom: 5px; height: 55px"><input
						name="file" id="upload_file" type="file" class="dfinput"
						style="" value="" />
                        <i id="imgs"
						style="position: absolute; left: 150px; top: -5px;"> 

					</i></li>
					<li><label>&nbsp;</label><input name="" type="submit"
						class="btn btn-primary" value="确认<?php echo ($data["btn"]); ?>"
						onclick="javascript:;" /></li>
				</ul>
			</div>
	</form>
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