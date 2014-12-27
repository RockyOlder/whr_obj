<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/whr/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/whr/App/Home/View/Public/Css/bootstrap.min.css" rel="stylesheet" type="text/css">
            <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.js"></script>

            <script language="javascript" type="text/javascript" src="/whr/App/Home/View/Public/Js/My97DatePicker/WdatePicker.js"></script>
            <link rel="stylesheet" href="/whr/App/Home/View/Public/Css/uploadify.css">
                <script src='/whr/App/Home/View/Public/Js/jquery.uploadify.min.js'></script>
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
                        <span>后台管理：</span>
                        <ul class="placeul">
                            <li><a href="#">合作商家管理</a></li>
                            <li><a href="#">添加商品</a></li>
                        </ul>
                    </div>
                    <form action="" method="post" name ="vform">
                        <input type ="hidden" name="ad_id" value="<?php echo ($info["ad_id"]); ?>">
                            <input type ="hidden" name="action" value="<?php echo ($data["action"]); ?>">
                                <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                                    <div class="formbody">
                                        <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>
                                        <ul class="forminfo">
                                           <!-- <li><label>公告类型</label>
                                                <span class = 'pro'>
                                                    <select name ='type' id="type_on" class="form-control" >
                                                        <option class = "top_cate" value=""  >1</option>
                                                        <option class = "top_cate" value=""  >2</option>
                                                        <option class = "top_cate" value=""  >3</option>

                                                    </select>
                                                </span></li>  -->
                                            <li><label>广告名称</label><input name="ad_name" id="name" type="text" class="dfinput" value="<?php echo ($info["ad_name"]); ?>" /><i id="name_info">名称不能超过30个字符</i></li>
                                            <li><label>链接地址</label><input name="ad_url" type="text" class="dfinput"  value="<?php echo ($info["ad_url"]); ?>" /><i>商品价格</i></li>
                                            <li><label>开始时间</label><input readonly="readonly" name="start_time"  type="text"  class="dfinputInfo" id="d412" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" value="<?php echo (date('Y-m-d H:i:s',$info["start_time"])); ?>" /><i id="name_info"></i></li>
                                            <li><label>结束时间</label><input readonly="readonly" name="end_time" type="text" class="dfinputInfo" id="d412" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" value="<?php echo (date('Y-m-d H:i:s',$info["end_time"])); ?>" /><i id="name_info"></i></li>
                                            <li><label>图片</label>
                                                <div id="list_hidden">
                                                    <input type ='hidden' name = "list_path" value="<?php echo ($info["list_path"]); ?>">
                                                        <input type ='hidden' name = "goods_img" value="<?php echo ($info["mid_pic"]); ?>">
                                                            <input type ='hidden' name = "pic" value="<?php echo ($info["pic"]); ?>">
                                                                </div></li>
                                                                <li style="position:relative;margin-bottom:5px;height:55px"><input name="list_img" id="upload_list" type="file" class="dfinput" style="" value="<?php echo ($info["list_pic"]); ?>" /><i  id ="imgs" style="position:absolute;left:150px;top:-5px;">
                                                                        <?php if($info["pic"] != ''): ?><div class="up_list_pic">
                                                                                <img height='50px' src='<?php echo ($info["pic"]); ?>'>
                                                                                    <img src='/whr/App/Home/View/Public/Images/uploadify-cancel.png' class ='close' onclick = 'javascript:deleteListPic()'> 
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
                                                                                                'swf'      : '/whr/App/Home/View/Public/Images/uploadify.swf',
                                                                                                'uploader' : '<?php echo U("Uploads/listUpload");?>',
                                                                                                'cancelImage':'/whr/App/Home/View/Public/Images/uploadify-cancel.png',
                                                                                                'buttonText' : '图片上传',
                                                                                                'multi': false,
                                                                                                'onUploadSuccess' : function(file, data, response) {
                                                                                                    //   alert(1)
                                                                                                    obj= $.parseJSON(data);
                                                                                                    list_img += "<img height='50px' src='"+obj.path+"'>";
                                                                                                    list_img +=" <img src='/whr/App/Home/View/Public/Images/uploadify-cancel.png' class ='close' onclick = 'javascript:deleteListPic()'> "
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