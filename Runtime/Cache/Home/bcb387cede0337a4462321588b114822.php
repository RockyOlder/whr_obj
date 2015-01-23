<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/default/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/default/App/Home/View/Public/Js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
        <!-- <link href="/default/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" /> -->
        <script type="text/javascript" src="/default/App/Home/View/Public/Js/jquery.js"></script>
        <script type="text/javascript" src="/default/App/Home/View/Public/Js/common.js"></script>
        <script type="text/javascript" src='/default/App/Home/View/Public/Js/jquery.uploadify.min.js'></script>
        <link rel="stylesheet" href="/default/App/Home/View/Public/Css/uploadify.css">
            <link rel="stylesheet" type="text/css" href="/default/App/Home/View/Public/Css/bootstrap.min.css"></link>
            <!-- <script type="text/javascript" src="/default/App/Home/View/Public/Js/jquery.idTabs.min.js"></script> -->
            <!-- <script type="text/javascript" src="/default/App/Home/View/Public/Js/select-ui.min.js"></script> -->
            <!-- <script type="text/javascript" src="/default/App/Home/View/Public/Js/kindeditor.js"></script> -->
            <script type="text/javascript">
                        $(function(){

                            if($("#addressAdd").val()==''){ $(".cheng_in").text("请选择")}
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
                                bValid = bValid && checkLength( $("#name"), "商家名称", 4, 16 );
                                bValid = bValid && (checkRegexp( $("#mobile_phone"), /(^1[0-9]{10}$)|(^00[1-9]{1}[0-9]{3,15}$)/ , "\u624b机格式不正确！" ));
                                bValid = bValid && (checkRegexp( $("#mobile"), /\d{3}-\d{8}|\d{4}-\d{7}/ , "\u7535话格式不正确！" ));
                                bValid = bValid && checkEmpty( $("#addressAdd"), "\u8bf7选择省市！" );
                         //       bValid = bValid && checkEmpty( $("#city_list"), "\u8bf7选择市区！" );
                                bValid = bValid && checkEmpty( $("#val_list"), "\u8bf7选择区县！" );
                                bValid = bValid && checkEmpty( $("#address"), "地址不能为空！" );
                                bValid = bValid && checkEmpty( $("#user_name"), "店主姓名不能为空！" );
                                bValid = bValid && checkEmpty( $("#business_license"), "营业执照不能为空！" );
                                bValid = bValid && checkEmpty( $("#qq"), "QQ不能为空！" );
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
                            $('#village_id').bind('change',function(){
                                $(this).parent().next().css("color","#7f7f7f")
                            })
                            $(".dfinput").bind("focus",function(){
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

                .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
                .pro select{width: 345px;height: 32px; }
                #val_list{width: 345px;height: 32px;  margin-left: 85px;}
            </style>
    </head>
    <body style="background: none;">

        <div class="place">
            <span>后台管理：</span>
            <ul class="placeul">
                <li><a href="#">合作商家管理</a></li>
                <li><a href="#">添加特享慧商家</a></li>
            </ul>
        </div>
        <form action="" method="post" name ="vform">
            <input type ="hidden" name="store_id" value="<?php echo ($info["store_id"]); ?>">
                <input type ="hidden" name="action" value="<?php echo ($data["action"]); ?>">
                    <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                        <div class="formbody">
                            <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>
                            <ul class="forminfo">
                                <li><label>商家名称</label><input name="store_name" id="name" type="text" class="dfinput" value="<?php echo ($info["store_name"]); ?>" /><i id="name_info">名称不能超过30个字符</i></li>
                                <li><label>手 机</label><input name="mobile_phone" type="text" id="mobile_phone" class="dfinput"  value="<?php echo ($info["mobile_phone"]); ?>"/><i>电话号码</i></li>
                                <li><label>固定电话</label><input name="fax_mobile" type="text" id="mobile" class="dfinput"  value="<?php echo ($info["fax_mobile"]); ?>"/><i>固定电话号码</i></li>
                            <!--    <li><label>邮政编码</label><input name="zip_code" type="text" class="dfinput"  value="<?php echo ($info["zip_code"]); ?>"/><i></i></li>  -->
                                <li><label>城 市</label>
                                    <span class = 'pro'>
                                        <select name = 'province'  class="form-control" id="addressAdd" >
                                            <option class="cheng_in" value="<?php echo ($region["REGION_ID"]); ?>"><?php echo ($region["REGION_NAME"]); ?></option>
                                            <?php if(is_array($pro)): $i = 0; $__LIST__ = $pro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class = "pro_in" value="<?php echo ($vo["region_id"]); ?>" ><?php echo ($vo["region_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>

                                        <select name = 'city' style="display:none" id ="city_list" class="form-control" <!--onclick="saveCity()" -->>
                                                <option class = "city_in" value="<?php echo ($info["city"]); ?>"></option>
                                        </select>

                                        <select name = 'area' style="display:none"  id ="val_list" class="form-control"  >
                                            <option class="area_on" value="<?php echo ($info["area"]); ?>"></option>
                                        </select>

                                    </span>
                                    <div style="display:none" id="skuNotice" class="sku_tip">
                                        <span class="validateTips"></span>
                                    </div
                                    <i></i></li>        
                                <li><label>详细地址</label><input name="address" type="text" class="dfinput" value="<?php echo ($info["address"]); ?>" /><i>街道地址</i></li>
                                <li ><label>商家描述</label><textarea rows="5"  cols='50' style="border:1px solid #A7B5BC" name ="des" value="<?php echo ($info["des"]); ?>"><?php echo ($info["des"]); ?></textarea><i>描述</i></li>
                                <li><label>店主姓名</label><input name="user_name" id="user_name" type="text" class="dfinput" value="<?php echo ($info["user_name"]); ?>" /><i></i></li>  
                                <li><label>营业执照</label><input name="business_license" id="business_license" type="text" class="dfinput" value="<?php echo ($info["user_name"]); ?>" /><i></i></li>
                                <li><label>Q Q</label><input name="qq" id="notice" type="text" id="qq" class="dfinput" value="<?php echo ($info["qq"]); ?>"/><i></i></li>
                                <input type="hidden" name="add_time">      
                                    <li><label>&nbsp;</label><input name="" type="submit" class="btn btn-primary" value="确认<?php echo ($data["btn"]); ?>"  onclick="javascript:;" /></li>

                            </ul>

                        </div>
                        </form>
                        <!-- <div id="map" style="border:1px solid red;width:100%;height:auto">ditu
                            
                        </div> -->

                        </body>
                        <script type="Text/Javascript">
                            $(function(){
                                //   alert($('.area_on').val())
                                //             if($(".pro_into").val()==''){ $(".pro_into").text("请选择"); }
                                //           if($(".cheng_in").val()==''){ $(".cheng_in").text("请选择"); }
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
                                                    str += "<option class='city_in' value="+val['region_id']+" onclick='javascript:getvallage("+val['region_id']+")'>"+val['region_name']+"</option>";
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
                                                        str += "<option class='city_in' value="+val['region_id']+" onclick='javascript:getvallage("+val['region_id']+")'>"+val['region_name']+"</option>";
                                                    })
                                                    $('#val_list').append(str);
                                                    $('#val_list').show(200);
                                                }
                                            }
                                        }
                                                                                                                                                              
                                    });  
                                })
                                                                                                                                                    
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
                                                str += "<option class='city_in' value="+val['region_id']+">"+val['region_name']+"</option>";
                                            })
                                            $('#val_list').html(str);
                                            $('#val_list').show(200);
                                        }
                                    }
                                });
        
                            }
                        </script>

                        </html>