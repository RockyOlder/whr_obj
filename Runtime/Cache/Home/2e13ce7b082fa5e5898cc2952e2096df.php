<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>

        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
            <!-- <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css"> -->
            <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/common.js"></script>
            <script type="text/javascript" src ="/App/Home/View/Public/ueditor/editor_config.js"></script>
            <script type="text/javascript" src ="/App/Home/View/Public/ueditor/editor_all_min.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
            <link rel="stylesheet" href="/App/Home/View/Public/Css/uploadify.css">
                <script src='/App/Home/View/Public/Js/jquery.uploadify.min.js'></script>
                <script type="text/javascript">
                    $(function(){

                        if($(".house_into").val()==''){ $(".house_into").text("请选择")}
                        function setout(){
                            $('.validateTips').text()
                            $('#skuNotice').show();
                            var dingshi= setTimeout( function(){
                                $( '#skuNotice' ).fadeOut();
                            }, ( 1 * 1000 ) );  
                            return dingshi;
                        } 
                        function checkInput(){
                            var bValid = true;
                            bValid = bValid && checkLength( $("#goods_name"), "商品名字", 4, 128 );
                                
                            bValid = bValid && checkEmpty( $("#type_on"), "\u8bf7选择分类！" );
                            $("#type_on").removeClass('ui-state-error')
                            //      bValid = bValid && checkLength( $("#type_on"), "\u7528户名", 2, 16 );sales//ui-state-error
                            //   bValid = bValid && checkEmpty( $("#type_n"), "\u8bf7选择商家名称！" );
                                
                      //      bValid = bValid && checkEmpty( $("#marque"), "\u8bf7选择商品型号！" );
                          //  $("#marque").removeClass('ui-state-error')
                            bValid = bValid && checkRegexp( $("#price"), /([0-9])+$/i, "价格只能是数字组成" );
                            bValid = bValid && checkRegexp( $("#inventory"), /([0-9])+$/i, "库存只能是数字组成" );
                            bValid = bValid && checkEmpty( $("#addressAdd"), "\u8bf7选择省市！" );
                            //    bValid = bValid && checkEmpty( $("#city_list"), "\u8bf7选择市区！" );
                            $("#addressAdd").removeClass('ui-state-error')
                            bValid = bValid && checkEmpty( $("#val_list"), "\u8bf7选择区县！" );
                            $("#val_list").removeClass('ui-state-error') 
                            //  bValid = bValid && checkEmpty( $("#description"), "商家描述不能为空！" );
                            $("#description").removeClass('ui-state-error') 
                            if(bValid==false){ setout(); }
                            return bValid;
                        }
                        $('form').submit(function(){
                            if(!checkInput()){
                                $('.dfinput').each(function () {
                                    if($(this).val()==''){
                                        $(this).next().css("color","red");
                                        $('.errorColor').css("color","red")
                                    }
                                });
                                return false;
                            }
                            return true
                        })

                            
//                        $(".top_cate").each(function () {
//                            var top_cate=$(this).text();
//                            var parent= top_cate.substr(-1,1);
//                            $(this).text(top_cate.substring(0,top_cate.length-1))
//                        })
                            
                        $("#type_on").bind("change",function(){
                           
                            if($(this).val()==0){
                                alert("父栏目不能选择")
                            }       
                            
                            //alert($(this).text())
                        })  
                        /*   $('#village_id').bind('change',function(){
                                $(this).parent().next().css("color","#7f7f7f")
                            })
                         */
                        $(".dfinput").bind("focus",function(){
                            //   alert(1)
                            $('#skuNotice').hide();
                            $(this).addClass("focus");
                            $(this).next().css("color","#7f7f7f");
                            if($(this).hasClass("ui-state-error")){
                                $(this).removeClass( "ui-state-error" );
                                $(".validateTips").removeClass("errorTip").hide();	
                            }
                        }).bind("blur",function(){
                            $(this).removeClass("focus");
                            if($(this).val()==''){ 
                                $(this).next().css("color","red"); }
                            checkInput();
                        });
                    })
                </script>
                <style type="text/css">
                    .pro{  float: left;line-height: 30px; margin-left: 0px;margin-bottom: 10px;}

                    .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 40%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
                    .pro select{width: 345px;height: 32px; }
                    .box{ margin-left: 5px; font-size: 12px; margin-top: -3px; padding-left:5px; padding:3px;}
                    #detailDialog{}
                  #tableAdd{ margin-top: 10px;}
                    .imgSave{ float: left; margin-left:-140px; margin-top:-50px; position: absolute;}
                    .spanSave{margin-left:-3%; margin-top:-27px; float: left; position: absolute; font-size: 16px;}
                    .placeul li a{ color:#428bca; }
                    #detailDialog {
                            position:absolute;
                            height:auto;
                            margin-left :626px; 
                            margin-top: 38px;
                            width: 500px;
                            display:none;
                           /* -webkit-box-shadow: 0 0 10px #121a2a;
                            box-shadow: 0 0 20px #121a2a;
                            border-top: solid 1px #a7b5bc;
                            border-left: solid 1px #a7b5bc;
                            border-right: solid 1px #ced9df;
                            border-bottom: solid 1px #ced9df;*/
                           
                            padding:20px;
                            background-color:#FFF;
                            cursor:move;
                            z-index: 9999;
                    }
                    #detailDialog #close {
                            position:absolute;
                            right:10px;
                            top:8px;
                            width:15px;
                            height:15px;
                            line-height:11px;
                            border:1px solid rosybrown;

                            cursor:pointer
                    }
                    #detailDialog table,#detailDialog tr,#detailDialog td{
                            border-color:#d9d6c4;
                            background-color:#FFF;
                            cursor:default
                    }
                    #detailDialog table {
                            width:100%;
                    }
                    #detailDialog tr,#detailDialog td {
                            height:40px;
                    }
                    #detailDialog td span {
                            margin-left:10px;
                            margin-right:10px;
                            cursor:text
                    }
                    #detailDialog td{
                            text-align:left;
                    }
                    #detailDialog .label{
                            font-weight:600;
                            color:#654b24;
                            text-align:center;
                    }
                    #detailDialog .closeHover {
                            background-color:#f391a9;
                            color:#FFF
                    }
                    #detailDialog .closeMouseDown {
                            background-color:#aa2116;
                            color:#f6f5ec
                    }
                    #select_today{
                        float: left;
                    }

                    
                </style>
                </head>
                <body style="background: none;">

                    <div class="place">
                        <span>位置： </span>
                        <ul class="placeul">
                            <li><a href="<?php echo U('Index/start','','');?>">首页</a></li>
                            <li><a href="/index.php?s=/Home/Goods">商品管理</a></li>
                            <li>添加商品</li>
                        </ul>
                    </div>
                    <form action="" method="post" name ="vform">
                        <input type ="hidden" name="goods_id" id="shopGoodsID" value="<?php echo ($info["goods_id"]); ?>">
                            <input type ="hidden" name="action" value="<?php echo ($data["action"]); ?>">
                                <input type="hidden" value="/index.php?s=/Home/Goods/url_ajaxhinder" id="url_ajaxCalendar" name="url_ajaxCalendar" />
                                <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                                    <div class="formbody">
                                        <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>
                                        <div id="detailDialog">
                                            <span style=" font-size: 16px; margin-top: -5px; ">商品参数</span>
                                            <table cellpadding="0" cellspacing="0" border="1" id="tableAdd">

                                            </table>
                                        </div>
                                      <div style=" float: left; position:  absolute; margin-left: 670px;">
                                      
                                            <span class = 'pro'>
                                                <label style=" font-size: 14px; ">分类</label>
                                                <select name = 'cat_id' id="type_on" class="dfinputInfo" >
                                                    <option class="pro_category"  value="<?php echo ($info["cat_id"]); ?>"><?php echo ($info["cat_name"]); ?></option>
                                                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["parent_id"] == 0 ): ?><option class="top_cate" value="<?php echo ($vo["parent_id"]); ?>"><?php echo ($vo["cat_name"]); ?></option><?php endif; ?> 
                                                        <?php if($vo["parent_id"] != 0 ): ?><option class="top_cate" value="<?php echo ($vo["cat_id"]); ?>"><?php echo ($vo["cat_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                                </select>
                                            </span>
                                            <i id="type_info"></i>    
                                            
                                        </div>
                                        <ul class="forminfo">
                                            <li><label>商品名字</label><input name="goods_name" id="goods_name" type="text" class="dfinput" value="<?php echo ($info["goods_name"]); ?>" /><i id="name_info">名称不能超过128个字符</i></li>

                                            <!--    <li><label>商家名称</label>
                                                    <span class = 'pro'>
                                                        <select name ='store_id' id="type_n" class="dfinputInfo" >
                                                            <option class="pro_store"  value="<?php echo ($info["store_id"]); ?>"><?php echo ($info["store_name"]); ?></option>
                                                            <?php if(is_array($vip)): $i = 0; $__LIST__ = $vip;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class = "pro_into" value="<?php echo ($vo["store_id"]); ?>" name="store_id" ><?php echo ($vo["store_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                        </select>
                                                    </span>
    
                                                    <i id="name_info">名称不能超过30个字符</i></li>  

                                            <li><label>商品型号</label><input name="marque" type="text" id="marque" class="dfinput"  value="<?php echo ($info["marque"]); ?>"/><i>商品型号</i></li>-->
                                            <li><label>价 格</label><input name="price" type="text" id="price" class="dfinput"  value="<?php echo ($info["price"]); ?>"/><i>商品价格</i></li>
                                            <li><label>库 存</label><input name="inventory" type="text" id="inventory" class="dfinput"  value="<?php echo ($info["inventory"]); ?>"/><i></i></li>
                                            <li><label>地 址</label>
                                                <span class = 'pro'>
                                                    <select name = 'province'class="dfinput" id="addressAdd" >
                                                        <option class="cheng_in" value="<?php echo ($vipFind["province"]); ?>"><?php echo ($vipFind["REGION_NAME"]); ?></option>
                                                        <?php if(is_array($pro)): $i = 0; $__LIST__ = $pro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class = "pro_in" value="<?php echo ($vo["REGION_ID"]); ?>"><?php echo ($vo["REGION_NAME"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select></br>
                                                    <select name = 'city' style="display:none" id ="city_list" class="dfinput"  >
                                                        <option class = "city_in" value="<?php echo ($vipFind["city"]); ?>"></option>
                                                    </select></br>
                                                    <select name = 'area' style="display:none"  id ="val_list" class="dfinput" >
                                                        <option class="area_on" value="<?php echo ($vipFind["area"]); ?>"></option>
                                                    </select>
                                                </span>
                                                <div style="display:none" id="skuNotice" class="sku_tip">
                                                    <span class="validateTips"></span>
                                                </div>
                                                <i></i></li> 
                                            <input type="hidden" value="<?php echo ($info["list_img"]); ?>" id="img_list">
                                              <!--  <input type="hidden" value="<?php echo ($info["if_show"]); ?>" id="if_show"> -->
                                                    <li style="height:50px"><label>图文介绍</label></li>
                                                    <li><textarea rows="5"  cols='40' style="" name ="intro" id="intro" value="<?php echo ($info["content"]); ?>" ><?php echo ($info["intro"]); ?></textarea></li>
                                                    <li><label>自推自荐</label><textarea rows="5"  cols='50' style="border:1px solid #A7B5BC; width: 345px;" name ="sales" id="sales" value="<?php echo ($info["sales"]); ?>"><?php echo ($info["sales"]); ?></textarea><i>推荐。。</i></li>
                                                <!--    <li><label>是否上架</label><input name="if_show"  class="radiolist" id="rdaoid"  type="radio" value="1"><a class="box">是</a><input name="if_show"  class="radiolist" type="radio" value="0"><a class="box">否</a></li> -->
                                                                <li style="height:85px"><label>商家描述</label><textarea rows="5"  cols='50' style="border:1px solid #A7B5BC; width: 345px;" id="description" name ="description" value="<?php echo ($info["description"]); ?>"><?php echo ($info["description"]); ?></textarea><i>描述</i></li>
                                                                <li><label>列表图片</label>
                                                                    <div id="list_hidden">
                                                                        <input type ='hidden' name = "list_path" value="<?php echo ($info["list_path"]); ?>">
                                                                            <input type ='hidden' name = "goods_img" value="<?php echo ($info["mid_pic"]); ?>">
                                                                                <input type ='hidden' name = "list_img" value="<?php echo ($info["list_img"]); ?>">
                                                                                    </div>
                                                                                    </li>
                                                                                    <li style="position:relative;margin-bottom:5px;height:55px"><input name="list_img" id="upload_list" type="file" class="dfinput" style="" value="<?php echo ($info["list_pic"]); ?>" /><i  id ="imgs" style="position:absolute;left:150px;top:-5px;">
                                                                                            <?php if($info["list_img"] != ''): ?><div class="up_list_pic">
                                                                                                    <img height='50px' src='<?php echo ($info["list_img"]); ?>'>
                                                                                                        <img src='/App/Home/View/Public/Images/uploadify-cancel.png' class ='close' onclick = 'javascript:deleteListPic()'> 
                                                                                                            </div><?php endif; ?>
                                                                                                            </i>
                                                                                                            </li>
                                                                                                            <li><label>商品图册</label><i></i></li> 
                                                                                                            <li style="position:relative;margin-bottom:5px;height:55px"><input type = "file" id ="upload_more">
                                                                                                                    <i  id ="imgs_more" style="position:absolute;left:150px;top:-5px;">
                                                                                                                        <div id = 'more_<?php echo ($k); ?>' class = ' more_list_pic' num = 0 style=" float: left"> 
                                                                                                                        </div>
                                                                                                                        <?php if($info["goods_img"] != ''): if(is_array($info["goods_img"])): $k = 0; $__LIST__ = $info["goods_img"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div id = 'more_<?php echo ($k); ?>' class = ' more_list_pic' num = "<?php echo ($k); ?>" style=" float: left">
                                                                                                                                    <img width='50px' src='<?php echo ($vo["mid"]); ?>' name ='path'>
                                                                                                                                        <input type='hidden' name='path[]'  value='<?php echo ($vo["pic"]); ?>'/>
                                                                                                                                        <input type='hidden' name='mid[]' value='<?php echo ($vo["mid"]); ?>'/>
                                                                                                                                        <input type='hidden' name='pic_name[]' value='<?php echo ($vo["name"]); ?>'/>
                                                                                                                                        <img src='/App/Home/View/Public/Images/uploadify-cancel.png' class ='close' onclick = 'javascript:deletePic(<?php echo ($k); ?>)' > 
                                                                                                                                            </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                                                                                                                            </i></li>

                                                                                                                                            <li><label>&nbsp;</label><input name="" type="submit" class="btn btn-primary" value="确认<?php echo ($data["btn"]); ?>"  onclick="javascript:;" style=" margin-top: 5px;" /></li>
                                                                                                                                            </ul>

                                                                                                                                            </div>
                                                                                                                                            </form>

                                                                                                                                            </body>
                                                                                                                                            <script>
                                                                                                                                                var edit= new UE.ui.Editor({initialContent:'',initialFrameWidth:600});
                                                                                                                                                edit.render("intro");
                                                                                                                                                var list_img = "";
                                                                                                                                                $('#upload_list').uploadify({
                                                                                                                                                    'swf'      : '/App/Home/View/Public/Images/uploadify.swf',
                                                                                                                                                    'uploader' : '<?php echo U("Uploads/listUpload");?>',
                                                                                                                                                    'cancelImage':'/App/Home/View/Public/Images/uploadify-cancel.png',
                                                                                                                                                    'buttonText' : '列表上传',
                                                                                                                                                    'multi': false,
                                                                                                                                                    'onUploadSuccess' : function(file, data, response) {
                                                                                                                                                        //   alert(1)
                                                                                                                                                        obj= $.parseJSON(data);
                                                                                                                                                        list_img += "<img height='50px' src='"+obj.path+"'>";
                                                                                                                                                        list_img +=" <img src='/App/Home/View/Public/Images/uploadify-cancel.png' class ='close' onclick = 'javascript:deleteListPic()'> "
                                                                                                                                                        $('#imgs').html(list_img);
                                                                                                                                                        var hid ="<input name='list_path' id='list_path' type='hidden' value='"+obj.path+"' />";
                                                                                                                                                        hid +="<input name='suolie_img' id='mid_pic' type='hidden' value='"+obj.mid+"' />"
                                                                                                                                                        hid +="<input name='list_img' id='list_pic' type='hidden' value='"+obj.min+"' />"
                                                                                                                                                        $('#list_hidden').html(hid);
                                                                                                                                                        list_img = '';
                                                                                                                                                        hid='';
                                                                                                                                                    }
                                                                                                                                                });
                                                                                                                                                var img = '';
                                                                                                                                                var num = $('.more_list_pic').last().attr('num')+1;

                                                                                                                                                $('#upload_more').uploadify({
                                                                                                                                                    'swf'      : '/App/Home/View/Public/Images/uploadify.swf',
                                                                                                                                                    'uploader' : '<?php echo U("Uploads/photo",'','');?>',
                                                                                                                                                    'cancelImage':'/App/Home/View/Public/Images/uploadify-cancel.png',
                                                                                                                                                    'buttonText' : '缩略图上传',
                                                                                                                                                    'onUploadSuccess' : function(file, v, response) {
                                                                                                                                                        // alert(data);
                                                                                                                                                        obj= $.parseJSON(v);
                                                                                                                                                        // console.log(obj)
                                                                                                                                                        img += "<div id = 'more_"+num+"' class = ' more_list_pic' num = '"+num+"' style='float: left'>"
                                                                                                                                                        img += "<img width='50px' src='"+obj.path+"' name ='path'>";
                                                                                                                                                        img += "<input type='hidden' name='path[]'  value='"+obj.path+"'/>";
                                                                                                                                                        img += "<input type='hidden' name='mid[]' value='"+obj.mid+"'/>";
                                                                                                                                                        img += "<input type='hidden' name='pic_name[]' value='"+obj.name+"'/>";
                                                                                                                                                        img += "<img src='/App/Home/View/Public/Images/uploadify-cancel.png' class ='close' onclick = 'javascript:deletePic("+num+")'> ";
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
                                                                                                                                                /*      function deleteListPic(){
                                                                                                                                                    $(".up_list_pic").html('');
                                                                                                                                                    $('#list_hidden').html('');
                                                                                                                                                }*/
                                                                                                                                                function deleteListPic(){
                                                                                                                                   
                                                                                                                                                    $("#imgs img").remove();
                                                                                                                                                    $('#list_hidde input').remove();
                                                                                                                                                }

                                                                                                                                            </script>
                                                                                                                                            <script type="Text/Javascript">
                                
                                                                                                                                            /*    $(document).ready(function() {
                                                                                                                                                    $('.radiolist').each(function() {
                                                                                                                                                        if($("#if_show").val()==1 && $(this).val()==1){
                                                                                                                                                            $(this).attr({ checked: "checked"})
                                                                                                                                                        }else if($("#if_show").val()==0 && $(this).val()==0){
                                                                                                                                                            $(this).attr({ checked: "checked"})
                                                                                                                                                        }
                                                                                                                                                    });
                                                                                                                                                    if($("#if_show").val()==''){ $("#rdaoid").attr({ checked: "checked"}) }
                                                                                                                                                });
																																				*/
                                                          
                                                                                                                                                $(function(){
                                                                                                                                                    $("#detailDialog").draggable({
                                                                                                                                                        cancel:"table"
                                                                                                                                                    });
                                                                                                                                                    //   alert($('.area_on').val())
                                                                                                                                                    if($(".pro_category").val()==''){ 
                                                                                                                                                        $(".pro_category").text("请选择");
                                                                                                                                                    }else{
                                                                                                                                                        caculShop($(".pro_category").val(),$("#shopGoodsID").val())
                                                                                                                                                    }
                                                                                                                                                    if($(".pro_store").val()==''){ $(".pro_store").text("请选择"); }
                                                                                                                                                    if($(".cheng_in").val()==''){ $(".cheng_in").text("请选择"); }
                                                                                                                                                    //     addressAdd
                                                                                                                                                    $('#addressAdd').bind('change',function(){
                                                                                                                                                        $('#vallage').hide(200);
                                                                                                                                                        var id =$(this).val();
                                                                                                                                                        // alert(id);
                                                                                                                                                        $('#city').attr('pro',id);
                                                                                                                                                        $('#val_list').html("<p>请选择城市</p>")
                                                                                                                                                        $.ajax({
                                                                                                                                                            url : "<?php echo U('City/city','','');?>",
                                                                                                                                                            type : "post",
                                                                                                                                                            data : "id="+id,
                                                                                                                                                            dataType : "json",
                                                                                                                                                            success : function(data){                   
                                                                                                                                                                if(data != null){                                                                                                                              
                                                                                                                                                                    var str=""
                                                                                                                                                                    $.each(data,function(key,val){
                                                                                                                                                                        str += "<option class='city_in' value="+val['REGION_ID']+" onclick='javascript:getvallage("+val['REGION_ID']+")'>"+val['REGION_NAME']+"</option>";
                                                                                                                                                                    })
                                                                                                                                                                    //   $('#city_list').append(str)
                                                                                                                                                                    $('#city_list').html(str);
                                                                                                                                                                    $('#city_list').show(200);
                                                                                                                                                                }
                                                                                                                                                            }
                                                                                                                                                        });         
                                                                                                                                                    })   

                                                                                                                                                    $('#city_list').bind('change',function(){
                                                                                                                                                        //   alert(1)
                                                                                                                                                        var id=$(this).val();
                                                                                                                                                        
                                                                                                                                                        $.ajax({
                                                                                                                                                            url : "<?php echo U('City/city','','');?>",
                                                                                                                                                            type : "post",
                                                                                                                                                            data : "id="+id,
                                                                                                                                                            dataType : "json",
                                                                                                                                                            success : function(data){        
                                                                                                                                                           
                                                                                                                                                                if(data != null){
                                                                                                                                                                    $("#val_list .city_in").remove();
                                                                                                                                                                    if($(".city_in").val()!==''){
                              
                                                                                                                                                                        var str=""
                                                                                                                                                                        var inex= this//selected=selected
                                                                                                                                                                      
                                                                                                                                                                        $.each(data,function(key,val){
                                                                                                                                                                            str += "<option class='city_in' value="+val['REGION_ID']+" onclick='javascript:getvallage("+val['REGION_ID']+")'>"+val['REGION_NAME']+"</option>";
                                                                                                                                                                        })
                                                                                                                                                                        $('#val_list').append(str);
                                                                                                                                                                        $('#val_list').show(200);
                                                                                                                                                                    }
                                                                                                                                                                }
                                                                                                                                                            }
                                                                                                                                                              
                                                                                                                                                        });  
                                                                                                                                                    })
                                                                                                                                                    $('#type_on').bind('change',function(){
                                                                                                                                                        caculShop($(this).val())    
                                                                                                                           
                                                                                                                                                    });  
                                                                                                                                                    var province = function() {
                                                                                                                                                        var id=$(".city_in").val();
                                                                                                                                                        $.ajax({
                                                                                                                                                            url : "<?php echo U('City/citySave','','');?>",
                                                                                                                                                            type : "post",
                                                                                                                                                            data : "id="+id,
                                                                                                                                                            dataType : "json",
                                                                                                                                                            success : function(data){    
                                                                                                                                                                //  console.log(data)
                                                                                                                                                                if(data != null){
                                                                                                                                                                    if($(".cheng_in").val()!==''){
                                                                                                                                                                        var str=""
                                                                                                                                                                        str += "<option value="+data.REGION_ID+">"+data.REGION_NAME+"</option>";
                                                                                                                                                                        $.each(data.list,function(key,val){
                                                                                                                                                                            str += "<option class='city_in' value="+val['REGION_ID']+" onclick='javascript:getvallage("+val['REGION_ID']+")'>"+val['REGION_NAME']+"</option>";
                                                                                                                                                                        })
                                                                                                                                                                        $('#city_list').html(str);
                                                                                                                                                                        $('#city_list').show(200);
                                                                                                                                                                    }
                                                                                                                                                                }
                                                                                                                                                            }
                                                                                                                                                        });  
                                                                                                                                                    };
                                                                                                                                                    var area = function() {
                                                                                                                                                        var id=$(".area_on").val();
                                                                                                                                                        //       alert(id)
                                                                                                                                                        $.ajax({
                                                                                                                                                            url : "<?php echo U('City/vallcage','','');?>",
                                                                                                                                                            type : "post",
                                                                                                                                                            data : "id="+id,
                                                                                                                                                            dataType : "json",
                                                                                                                                                            success : function(data){      
                                                                                                                                                                //       console.log(data)
                                                                                                                                                                if(data != null){
                                                                                                                                                                    if($(".city_in").val()!==''){
                                                                                                                                                                        var str=""
                                                                                                                                                                        str += "<option value="+data.REGION_ID+">"+data.REGION_NAME+"</option>";
                                                                                                                                                                        $.each(data.list,function(key,val){
                                                                                                                                                                            str += "<option class='city_in' value="+val['REGION_ID']+">"+val['REGION_NAME']+"</option>";
                                                                                                                                                                        })
                                                                                                                                                                        $('#val_list').html(str);
                                                                                                                                                                        $('#val_list').show(200);
                                                                                                                                                                        str="";
                                                                                                                                                                    }
                                                                                                                                                                }
                                                                                                                                                            }
                                                                                                                                                        });  
                                                                                                                                                    };
                                                                                                                                                    province();
                                                                                                                                                    area();
                              
                                                                                                                                                    //     province();
                                                                                                                                                    //     getvallage($(".city_in").val());
                                                                                                                                                    //      pro();
                                                                                                                    
                                                                                                                                                })
                                                                                                                                                function getvallage(id){
            
                                                                                                                                                    var id = id;
                                                                                                                                                    $('#vallage').attr('city',id);
                                                                                                                                                    $.ajax({
                                                                                                                                                        url : "<?php echo U('City/vallage','','');?>",
                                                                                                                                                        type : "post",
                                                                                                                                                        data : "id="+id,
                                                                                                                                                        dataType : "json",
                                                                                                                                                        success : function(data){                       
                                                                                                                                                            if(data != null){
                                                                                                                                                                var str=""
                                                                                                                                                                $.each(data,function(key,val){
                                                                                                                                                                    str += "<option class='city_in' value="+val['REGION_ID']+">"+val['REGION_NAME']+"</option>";
                                                                                                                                                                })
                                                                                                                                                                $('#val_list').html(str);
                                                                                                                                                                $('#val_list').show(200);
                                                                                                                                                            }
                                                                                                                                                        }
                                                                                                                                                    });
        
                                                                                                                                                }
                                                                                                                                            
                                                                                                                                                function in_array(search,array){
                                                                                                                                                    for(var i in array){
                                                                                                                                                        if(array[i]==search){
                                                                                                                                                            return true;
                                                                                                                                                        }
                                                                                                                                                    }
                                                                                                                                                    return false;
                                                                                                                                                }
                                                                                                                                                var caculShop = function (vid,gid){
          
                                                                                                                                                    var id=vid;
                                                                                                                                               
                                                                                                                                                    $.ajax({
                                                                                                                                                        url :$("#url_ajaxCalendar").val(),
                                                                                                                                                        type : "post",
                                                                                                                                                        data: {"id":id,
                                                                                                                                                            'goods_id':gid},
                                                                                                                                                        
                                                                                                                                                        //  data : "id="+id,
                                                                                                                                                        dataType : "json",
                                                                                                                                                        success : function(data){     
                                                                                                                                                            console.log(data.type)
                                                                                                                                                            if(data.type != null){
                                                                                                                                                                //  alert(typeof(data.type))
                                                                                                                                                                var str="";
                                                                                                                                                           //     var labae="<span id='select_today'>商品参数</span>"
                                                                                                                                                                var auto=1;
                                                                                                                                                                $.each(data.type,function(key,val){
                                                                                                                                                                    if(!isNaN(key)){ 
                                                                                                                                                                        if(key==1){
                                                                                                                                                                           
                                                                                                                                                                            str+="<tr>";
                                                                                                                                                                            str+="<td class='label'>"+val+"</td><td><input type='text' name='type["+val+"]' class='dfinput'></td>";
                                                                                                                                                                     //       str+="<td rowspan='3' style='text-align:center' width='120px'><img class='imgSave' src='/App/Home/View/Public/img/20080527114121692.png' width='64px' height='64px'/><p class='spanSave'>商品的属性</p></td>"
                                                                                                                                                                            str+="<input type='hidden' name='parent_id' value='"+data.parent_id+"' class='dfinput'></tr>";
                                                                                                                                                                        }else{
                                                                                                                                                                            str+='<tr>';
                                                                                                                                                                            str+="<td class='label'>"+val+"</td><td><input type='text' name='type["+val+"]' class='dfinput'></td>";
                                                                                                                                                                            str+='</tr>';
                                                                                                                                                                        }                                                                      
                                                                                                                                                                    } else{                                                                       
                                                                                                                                                                        if(auto==1){
                                                                                                                                                                            str+="<tr>";
                                                                                                                                                                            str+="<td class='label'>"+key+"</td><td><input type='text' name='type["+key+"]' value='"+val+"' class='dfinput'></td>";
                                                                                                                                                                     //       str+="<td rowspan='3' style='text-align:center' width='120px'><img class='imgSave' src='/App/Home/View/Public/img/20080527114121692.png' width='64px' height='64px'/><p class='spanSave'>商品的属性</p></td>"
                                                                                                                                                                            str+="<input type='hidden' name='parent_id' value='"+data.parent_id+"' class='dfinput'></tr>";
                                                                                                                                                                        }else{
                                                                                                                                                                            str+='<tr>';
                                                                                                                                                                            str+="<td class='label'>"+key+"</td><td><input type='text' name='type["+key+"]' value='"+val+"' class='dfinput'></td>";
                                                                                                                                                                            str+='</tr>';
                                                                                                                                                                        }                                                           
                                                                                                                                                                    }                                                                         
                                                                                                                                                                    auto++                                                                  
                                                                                                                                                                })       
                                                                                                                                                                /*    $.each(data.name,function(key,val){                                                                        
                                                                                                                                                                    if(in_array(val,data.dname)){
                                                                                                                                                                        if(key==1){
                                                                                                                                                                            str+="<tr>";
                                                                                                                                                                            str+="<td class='label'>"+val+"</td><td><input type='checkbox' name='name["+val+"]' value='"+val+"' checked='true'  class='dfinput'></td>";
                                                                                                                                                                            str+="<td rowspan='3' style='text-align:center' width='120px'><img class='imgSave' src='/App/Home/View/Public/img/20080527114121692.png' width='64px' height='64px'/><p class='spanSave'>商品规格</p></td>"
                                                                                                                                                                            str+="<input type='hidden' name='did' value='"+data.did+"' class='dfinput'></tr>";
                                                                                                                                                                        }else{
                                                                                                                                                                            str+='<tr>';
                                                                                                                                                                            str+="<td class='label'>"+val+"</td><td><input type='checkbox' name='name["+val+"]' value='"+val+"' checked='true'  class='dfinput'></td>";
                                                                                                                                                                            str+='</tr>';
                                                                                                                                                                        }
                                                                                                                                                                        
                                                                                                                                                                    }else{
                                                                                                                                                                        if(key==1){
                                                                                                                                                                            str+='<tr>';
                                                                                                                                                                            str+="<td class='label'>"+val+"</td><td><input type='checkbox' name='name["+val+"]' value='"+val+"'  class='dfinput'></td>";
                                                                                                                                                                            str+="<td rowspan='3' style='text-align:center' width='120px'><img class='imgSave' src='/App/Home/View/Public/img/20080527114121692.png' width='64px' height='64px'/><p class='spanSave'>商品规格</p></td>"
                                                                                                                                                                            str+='</tr>';
                                                                                                                                                                        }else{
                                                                                                                                                                            str+='<tr>';
                                                                                                                                                                            str+="<td class='label'>"+val+"</td><td><input type='checkbox' name='name["+val+"]' value='"+val+"' class='dfinput'></td>";
                                                                                                                                                                            str+="<input type='hidden' name='did' value='"+data.did+"' class='dfinput'></tr>";
                                                                                                                                                                        }                                                                              
                                                                                                                                                                    }
                                                                                                                                                                })*/
                                                                                                                                                               //$("#detailDialog").append(labae);
                                                                                                                                                                $("#tableAdd").html(str);
                                                                                                                                                                $("#detailDialog").fadeIn(1500);
                                                                                                                                                                //  $("#detailDialog").show(800)
                                                                                                                                                            }else{
                                                                                                                                                                $("#detailDialog").hide(800) 
                                                                                                                                                            }
                                                                                                                                                        }
                                                                                                                                                    })
                                                                                                                                                              
                                                                                                                                                };  
                                                                                                                                                
                                                                                                                                            </script>

                                                                                                                                            </html>