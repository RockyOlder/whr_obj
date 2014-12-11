<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/whr/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <!-- <link href="/whr/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" /> -->
        <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.js"></script>
        <script type="text/javascript" src='/whr/App/Home/View/Public/Js/jquery.uploadify.min.js'></script>
        <!-- <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.idTabs.min.js"></script> -->
        <!-- <script type="text/javascript" src="/whr/App/Home/View/Public/Js/select-ui.min.js"></script> -->
        <!-- <script type="text/javascript" src="/whr/App/Home/View/Public/Js/kindeditor.js"></script> -->
        <link rel="stylesheet" type="text/css" href="/whr/App/Home/View/Public/Css/bootstrap.min.css">
            <link rel="stylesheet" href="/whr/App/Home/View/Public/Css/uploadify.css">
                <script type="text/javascript">
                    $(function(){
                        //简单验证
                        //  var xx= $("select>:selected").html()

                        //  var replaceStr = "&nbsp;";
                        //  var cat= xx.replace(new RegExp(replaceStr,'gm'),'')
                        // $(".pro_into").html(cat)
                        //    if($("#info_ding").text()==''){ 
                        //      $(".pro_into").text("顶级分类")
                        //   }
                        if($("#info_ding").val()==''){ 
                            $("#info_ding").val("0")
                        }
                        var img = "";
                        $('#upload_list').uploadify({
                            'swf'      : '/whr/App/Home/View/Public/Images/uploadify.swf',
                            'uploader' : '<?php echo U("Uploads/listUpload");?>',
                            'cancelImage':'/whr/App/Home/View/Public/Images/uploadify-cancel.png',
                            'buttonText' : '列表上传',
                            'multi': false,
                            'onUploadSuccess' : function(file, data, response) {
                                // alert(data);
                                obj= $.parseJSON(data);
                                img += "<img height='50px' src='"+obj.path+"'>";
                                $('#imgs').html(img);
                                var hid ="<input name='thumb_pic' type='hidden' value='"+obj.mid+"' />"
                               
                                $('#list_hidden').html(hid);
                            }
                        });
                
                    })
                    function deleteListPic(){
                        $(".up_list_pic").html('');
                        $('#list_hidden').html('');
                    }
                </script>
                </head>
                <style type="text/css">
                    .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
                    .pro select{width: 345px;height: 32px; }
                    .cat_img{margin-top: -40px;} 
                    /*  .top_cate{background-image: url(/whr/App/Home/View/Public/img/menu_minus.gif); width:10px; height:10px;} */
                </style>

                <body style="background: none;">

                    <div class="place">
                        <span>后台管理：</span>
                        <ul class="placeul">
                            <li><a href="#">分类管理</a></li>
                            <li><a href="#">添加分类</a></li>
                        </ul>
                    </div>
                    <form action="" method="post" name ="vform">
                        <input type ="hidden" name="cat_id" value="<?php echo ($info["cat_id"]); ?>">
                            <input type ="hidden" name="action" value="<?php echo ($data["action"]); ?>">
                                <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                                    <div class="formbody">

                                        <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>

                                        <ul class="forminfo">
                                            <li><label>分类名称</label><input name="cat_name" id="name" type="text" class="dfinput" value="<?php echo ($info["cat_name"]); ?>" /><i id="name_info">名称不能超过30个字符</i></li>
                                            <li><label>上级分类</label>
                                                <span class = 'pro'>
                                                    <select name = 'parent_id' id="type_on" class="form-control" >
                                                        <option class="pro_into" id="info_ding" value="0">顶级分类</option>
                                                        <?php if(is_array($arr)): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class = "top_cate" value="<?php echo ($vo["cat_id"]); ?>" <?php echo ($vo["selected"]); ?>><span><?php echo ($vo["cat_name"]); ?></span></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select></span>
                                            </li>
                                            <li><label>分类图片</label><div id="list_hidden"></div></li>
                                            <li style="position:relative;margin-bottom:5px;height:55px"><input name="" id="upload_list" type="file" class="dfinput" style=""/><i  id ="imgs" style="position:absolute;left:150px;top:-5px;"><img src="" style="" height="50px">
                                                        <?php if($info["cat_img"] != ''): ?><div class="up_list_pic">
                                                                <img class="cat_img" height='50px' src='<?php echo ($info["cat_img"]); ?>'>
                                                                    <img class="cat_img" src='/whr/App/Home/View/Public/Images/uploadify-cancel.png' class ='close' onclick = 'javascript:deleteListPic()'> 
                                                                        </div><?php endif; ?>
                                                                        </i></li>
                                                                        <li><label>描述</label><textarea rows="5"  cols='50' style="border:1px solid #A7B5BC" name ="intro" value="<?php echo ($info["intro"]); ?>"><?php echo ($info["intro"]); ?></textarea></li>



                                                                        <li><label>&nbsp;</label><input type="submit" class="btn btn-primary" value="确认<?php echo ($data["btn"]); ?>"  onclick="javascript:;" /></li>
                                                                        </ul>
                                                                        <div style="display:none" id="skuNotice" class="sku_tip">
                                                                            <span id="skuTitle2"></span>
                                                                        </div>
                                                                        </div>
                                                                        </form>

                                                                        </body>

                                                                        </html>