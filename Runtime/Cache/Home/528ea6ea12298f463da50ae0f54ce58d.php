<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/App/Home/View/Public/Css/bootstrap.min.css" rel="stylesheet" type="text/css">
            <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>


            <link rel="stylesheet" href="/App/Home/View/Public/Css/uploadify.css">
                <script src='/App/Home/View/Public/Js/jquery.uploadify.min.js'></script>
                <script type="text/javascript">
   
                </script>
                <style type="text/css">
                    .pro{  float: left;line-height: 30px; margin-left: 0px;margin-bottom: 10px;}

                    .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
                    .pro select{width: 345px;height: 32px; }
                    .box{ margin-left: 5px; font-size: 12px; margin-top: -3px; padding-left:5px; padding:3px;}
                </style>
                </head>
                <body style="background: none;">

                    <div class="place">
                        <span>位置： </span>
                        <ul class="placeul">
                            <li><a href="<?php echo U('Index/start','','');?>">首页</a></li>
                            <li><a href="<?php echo U('Seller/vipGood');?>">商品列表</a></li>
                            <li>推荐商品</li>
                        </ul>
                    </div>
                    <form action="" method="post" name ="vform">
                            <input type ="hidden" name="id" value="<?php echo ($info["id"]); ?>">
                            <input type ="hidden" name="action" value="<?php echo ($data["action"]); ?>">
                                <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                                    <div class="formbody">
                                        <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>
                                        <ul class="forminfo">
                                           <!-- <li><label>选择活动</label>
                                                <span class = 'pro'>
                                                    <select name ='aid' id="type_on" class="form-control" >
                                                        <?php if(is_array($vip)): $i = 0; $__LIST__ = $vip;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class = "top_cate" value="<?php echo ($vo["id"]); ?>" name="aid" ><?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select>
                                                </span>

                                                <i id="name_info">名称不能超过30个字符</i></li> -->
                                           <li><label>商品名字</label><input name="name" id="name" type="text" class="dfinput" value="<?php echo ($info["name"]); ?>"  /><i id="name_info">名称不能超过30个字符</i></li>
                                            <li><label>推荐标题</label><input name="title" type="text" class="dfinput"  value="<?php echo ($info["title"]); ?>" /><i>推荐标题</i></li>
                                            <li style="height:85px"><label>推荐描述</label><textarea rows="5"  cols='50' style="border:1px solid #A7B5BC; width: 345px;" id="description" name ="info" value="<?php echo ($info["info"]); ?>"><?php echo ($info["info"]); ?></textarea><i>描述</i></li>
                                            <li><label>排序</label><input name="sort" type="text" class="dfinput" value="<?php echo ($info["sort"]); ?>" /><i>作用于前台排序</i></li>
                                            <li><label>图片</label>
                                                <div id="list_hidden">
                                                    <input type ='hidden' name = "list_path" value="<?php echo ($info["list_path"]); ?>">
                                                        <input type ='hidden' name = "goods_img" value="<?php echo ($info["mid_pic"]); ?>">
                                                            <input type ='hidden' name = "pic" value="<?php echo ($info["pic"]); ?>">
                                                                </div></li>
                                                                <li style="position:relative;margin-bottom:5px;height:55px"><input name="list_img" id="upload_list" type="file" class="dfinput" style="" value="<?php echo ($info["pic"]); ?>" /><i  id ="imgs" style="position:absolute;left:150px;top:-5px;">
                                                                        <?php if($info["pic"] != ''): ?><div class="up_list_pic">
                                                                                <img height='50px' src='<?php echo ($info["pic"]); ?>'>
                                                                                    <img src='/App/Home/View/Public/Images/uploadify-cancel.png' class ='close' onclick = 'javascript:deleteListPic()'> 
                                                                                        </div><?php endif; ?>
                                                                                        </i></li>

                                                                                        <li><label>&nbsp;</label><input name="" type="submit" class="btn btn-primary" value="提交"  onclick="javascript:;" /></li>
                                                                                        </ul>

                                                                                        </div>
                                                                                        </form>

                                                                                        </body>     
                                                                                        <script>

                                                                                            var list_img = "";
                                                                                            $('#upload_list').uploadify({
                                                                                                'swf'      : '/App/Home/View/Public/Images/uploadify.swf',
                                                                                                'uploader' : '<?php echo U("Uploads/listUpload");?>',
                                                                                                'cancelImage':'/App/Home/View/Public/Images/uploadify-cancel.png',
                                                                                                'buttonText' : '图片上传',
                                                                                                'multi': false,
                                                                                                'onUploadSuccess' : function(file, data, response) {
                                                                                                    //   alert(1)
                                                                                                    obj= $.parseJSON(data);
                                                                                                    list_img += "<img height='50px' src='"+obj.path+"'>";
                                                                                                    list_img +=" <img src='/App/Home/View/Public/Images/uploadify-cancel.png' class ='close' onclick = 'javascript:deleteListPic()'> "
                                                                                                    $('#imgs').html(list_img);
                                                                                                    var hid ="<input name='list_path' id='list_path' type='hidden' value='"+obj.path+"' />";
                                                                                                    hid +="<input name='suolie_img' id='mid_pic' type='hidden' value='"+obj.mid+"' />"
                                                                                                    hid +="<input name='pic' id='list_pic' type='hidden' value='"+obj.min+"' />"
                                                                                                    $('#list_hidden').html(hid);
                                                                                                    list_pic = '';
                                                                                                    hid='';
                                                                                                }
                                                                                            });
                                                                                            function deletePic(num){
                                                                                                $("#more_"+num+"").html('');
                                                                                                // $('this').parent('.more_list_pic').remove();
                                                                                            }
                                                                                            /*      function deleteListPic(){
                                                                                                $(".up_list_pic").html('');
                                                                                                $('#list_hidden').html('');
                                                                                            }*/
                                                                                            function deleteListPic(){

                                                                                                $("#imgs img").remove();
                                                                                                $('#list_hidde input').remove();
                                                                                            }
                                    

                                                                                        </script>

                                                                                        </html>