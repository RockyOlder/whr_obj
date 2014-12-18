<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/whr/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <!-- <link href="/whr/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" /> -->
        <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.js"></script>
        <!-- <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.idTabs.min.js"></script> -->
        <!-- <script type="text/javascript" src="/whr/App/Home/View/Public/Js/select-ui.min.js"></script> -->
        <!-- <script type="text/javascript" src="/whr/App/Home/View/Public/Js/kindeditor.js"></script> -->
        <link rel="stylesheet" type="text/css" href="/whr/App/Home/View/Public/Css/bootstrap.min.css">
            <link rel="stylesheet" href="/whr/App/Home/View/Public/Css/uploadify.css">
                <script src='/whr/App/Home/View/Public/Js/jquery.uploadify.min.js'></script>
                <script type="text/javascript">
                    $(function(){
                        // alert(1)
                        //简单验证
                      /*  var validate = {
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
                    })*/
                </script>
                <style type="text/css">
                    .pro{  float: left;line-height: 30px;margin-bottom: 10px; margin-left: 5px;}
                    #imgs_more{ width: 100%}
                    .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
                    .pro select{width: 345px;height: 32px; }
                    .box{ margin-left: 5px; font-size: 12px; margin-top: -3px; padding-left:5px; padding:3px;}
                    .forminfo li input{width: 345px;height: 32px;margin-left: 5px; }
                </style>
                </head>
                <body style="background: none;">

                    <div class="place">
                        <span>后台管理：</span>
                        <ul class="placeul">
                            <li><a href="#">合作商家管理</a></li>
                            <li><a href="#">添加生活导航商家</a></li>
                        </ul>
                    </div>
                    <form action="" method="post" name ="vform">
                            <input type ="hidden" name="bsid" value="<?php echo ($info["bsid"]); ?>">
                                <input type ="hidden" name="action" id="action" value="<?php echo ($data["action"]); ?>">
                                    <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                                        <div class="formbody">
                                            <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>
                                            <ul class="forminfo">
                                                <li><label>店铺名称</label><input name="bsname" id="name"  type="text" class="dfinput"  value="<?php echo ($info["bsname"]); ?>" /><i id="name_info">名称不能超过30个字符</i></li>
                                                <li><label>店铺电 话</label><input name="phone" type="text" class="dfinput" value="<?php echo ($info["phone"]); ?>"/><i>电话号码</i></li>
                                                <li><label>店铺客服qq 话</label><input name="qq" type="text" class="dfinput" value="<?php echo ($info["qq"]); ?>"/><i>qq</i></li>
                                                <li><label>店铺地址</label><input name="address" type="text" class="dfinput" value="<?php echo ($info["address"]); ?>" /><i>街道地址</i></li>
                                                <li style="height:85px"><label>店铺描述</label><textarea rows="5"  cols='50' style="border:1px solid #A7B5BC" name ="content" value="<?php echo ($info["content"]); ?>"><?php echo ($info["content"]); ?></textarea><i>描述</i></li>
                                                <li><label>店铺图片</label>
                                  <div id="list_hidden">
                               
                                    <input type ='hidden' name = "mid_pic" value="<?php echo ($info["mid_pic"]); ?>">
                                        <input type ='hidden' name = "list_pic" value="<?php echo ($info["list_pic"]); ?>">
                                            </div></li>
                                            <li style="position:relative;margin-bottom:5px;height:55px"><input name="list_pic" id="upload_list" type="file" class="dfinput" style="" value="<?php echo ($info["list_pic"]); ?>" /><i  id ="imgs" style="position:absolute;left:150px;top:-5px;">
                                                    <?php if($info["list_pic"] != ''): ?><div class="up_list_pic">
                                                            <img height='50px' src='<?php echo ($info["list_pic"]); ?>'>
                                                                <img src='/whr/App/Home/View/Public/Images/uploadify-cancel.png' class ='close' onclick = 'javascript:deleteListPic()'> 
                            </div><?php endif; ?>
                            </i></li>
                            <li><label>店铺图册</label><i></i></li> 
                            <li style="position:relative;margin-bottom:5px;height:55px"><input type = "file" id ="upload_more">
                             <i  id ="imgs_more" style="position:absolute;left:150px;top:-5px;">
                                 <div id = 'more_<?php echo ($k); ?>' class = ' more_list_pic' num = 0 > 
                                 </div>
                                 <?php if($info["more_pic"] != ''): if(is_array($info["more_pic"])): $k = 0; $__LIST__ = $info["more_pic"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div id = 'more_<?php echo ($k); ?>' class = ' more_list_pic' num = "<?php echo ($k); ?>" style=" float: left">
                                <img width='50px' src='<?php echo ($vo["mid"]); ?>' name ='path'>
                                <input type='hidden' name='path[]'  value='<?php echo ($vo["pic"]); ?>'/>
                                <input type='hidden' name='mid[]' value='<?php echo ($vo["mid"]); ?>'/>
                                <input type='hidden' name='pic_name[]' value='<?php echo ($vo["name"]); ?>'/>
                                <img src='/whr/App/Home/View/Public/Images/uploadify-cancel.png' class ='close' onclick = 'javascript:deletePic(<?php echo ($k); ?>)' > 
                                    </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                    </i></li>
                                    <li><label>店家负责人</label><input name="owner" id="notice" type="text" class="dfinput" value="<?php echo ($info["owner"]); ?>" /><i></i></li>  
                                <li><label>所属商家</label>
                                <select  class="form-control" name = 'bid' style="width: 345px;height: 32px;" >
                                    <option name = 'bid' class="house_into"  value="<?php echo ($region["id"]); ?>"><?php echo ($region["name"]); ?></option>
                                    <?php if(is_array($pro)): $i = 0; $__LIST__ = $pro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option name = 'bid'  value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </li>
                                    <li><label>&nbsp;</label><input name="" type="submit" class="btn btn-primary" value="确认<?php echo ($data["btn"]); ?>"  onclick="javascript:;" /></li>
                                </ul>

                            </div>
                          </form>

                   </body>
                                                    <script>


                                                        var list_pic = "";
                                                        $('#upload_list').uploadify({
                                                            'swf'      : '/whr/App/Home/View/Public/Images/uploadify.swf',
                                                            'uploader' : '<?php echo U("Uploads/listUpload");?>',
                                                            'cancelImage':'/whr/App/Home/View/Public/Images/uploadify-cancel.png',
                                                            'buttonText' : '列表上传',
                                                            'multi': false,
                                                            'onUploadSuccess' : function(file, data, response) {
                                                                // alert(data);
                                                                obj= $.parseJSON(data);
                                                                list_pic += "<img height='50px' src='"+obj.path+"'>";
                                                                list_pic +=" <img src='/whr/App/Home/View/Public/Images/uploadify-cancel.png' class ='close' onclick = 'javascript:deleteListPic()'> "
                                                                $('#imgs').html(list_pic);
                                                                var hid ="<input name='list_path' id='list_path' type='hidden' value='"+obj.path+"' />";
                                                                hid +="<input name='mid_pic' id='mid_pic' type='hidden' value='"+obj.mid+"' />"
                                                                hid +="<input name='list_pic' id='list_pic' type='hidden' value='"+obj.min+"' />"
                                                                $('#list_hidden').html(hid);
                                                            }
                                                        });
                                                        var img = '';
                                                        var num = $('.more_list_pic').last().attr('num')+1;

                                                        $('#upload_more').uploadify({
                                                            'swf'      : '/whr/App/Home/View/Public/Images/uploadify.swf',
                                                            'uploader' : '<?php echo U("Uploads/photo",'','');?>',
                                                            'cancelImage':'/whr/App/Home/View/Public/Images/uploadify-cancel.png',
                                                            'buttonText' : '缩略图上传',
                                                            'onUploadSuccess' : function(file, v, response) {
                                                                obj= $.parseJSON(v);
                                                                // console.log(obj)
                                                                img += "<div id = 'more_"+num+"' class = ' more_list_pic' num = '"+num+"'>"
                                                                img += "<img width='50px' src='"+obj.path+"' name ='path'>";
                                                                img += "<input type='hidden' name='path[]'  value='"+obj.path+"'/>";
                                                                img += "<input type='hidden' name='mid[]' value='"+obj.mid+"'/>";
                                                                img += "<input type='hidden' name='pic_name[]' value='"+obj.name+"'/>";
                                                                img += "<img src='/whr/App/Home/View/Public/Images/uploadify-cancel.png' class ='close' onclick = 'javascript:deletePic("+num+")'> ";
                                                                img += "</div>"
                                                                $('#imgs_more').append(img);
                                                                img = '';
                                                                num++;
                                                            }
                                                        });
                                                        function deletePic(num){
                                                            $("#more_"+num+"").html('');
                                                            // $('this').parent('.more_list_pic').remove();
                                                        }
                                                        function deleteListPic(){
                                                            $(".up_list_pic").html('');
                                                            $('#list_hidden').html('');
                                                        }
                                                        function openwindow()
                                                        {
                                                            var url = 'http://api.map.baidu.com/lbsapi/getpoint/'; //转向网页的地址;
                                                            var name="获取经纬"; //网页名称，可为空;
                                                            var iWidth='800'; //弹出窗口的宽度;
                                                            var iHeight='600'; //弹出窗口的高度;
                                                            //window.screen.height获得屏幕的高，window.screen.width获得屏幕的宽
                                                            var iTop = (window.screen.height-30-iHeight)/2; //获得窗口的垂直位置;
                                                            var iLeft = (window.screen.width-10-iWidth)/2; //获得窗口的水平位置;
                                                            window.open(url,name,'height='+iHeight+',,innerHeight='+iHeight+',width='+iWidth+',innerWidth='+iWidth+',top='+iTop+',left='+iLeft+',toolbar=no,menubar=no,scrollbars=auto,resizeable=no,location=no,status=no');
                                                        }
                                                        function ShowPage()
                                                        {
                                                            showModalDialog('http://api.map.baidu.com/lbsapi/getpoint/','example04','dialogWidth:400px;dialogHeight:300px;dialogLeft:200px;dialogTop:150px;center: yes;help:no;resizable:no;status:no')
                                                        }

                                                    </script>
                                                    <script type="Text/Javascript">
                                                  </script>
     </html>