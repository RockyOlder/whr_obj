<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加开发商</title>
<link href="/whr/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.js"></script>
<link rel="stylesheet" type="text/css"
	href="/whr/App/Home/View/Public/Css/bootstrap.min.css">
	<link rel="stylesheet" href="/whr/App/Home/View/Public/Css/uploadify.css">
		<script src='/whr/App/Home/View/Public/Js/jquery.uploadify.min.js'></script>
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

					<li><label>所属物业</label> <span class='pro'> <select
							name='property_id' class="form-control">
								<option class="cheng" value="0">请选择</option>
								<?php if(is_array($property)): $i = 0; $__LIST__ = $property;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class="pro_in" value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["pname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</span> <i></i></li>

					<li><label>业主信息表</label>
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
                'swf'      : '/whr/App/Home/View/Public/Images/uploadify.swf',
                'uploader' : '<?php echo U("Uploads/file");?>',
                'cancelImage':'/whr/App/Home/View/Public/Images/uploadify-cancel.png',
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