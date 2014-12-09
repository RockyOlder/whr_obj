<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/whr/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <!-- <link href="/whr/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" /> -->
        <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.js"></script>
        <script type="text/javascript" src='/whr/App/Home/View/Public/Js/jquery.uploadify.min.js'></script>
        <link rel="stylesheet" href="/whr/App/Home/View/Public/Css/uploadify.css">
            <link rel="stylesheet" type="text/css" href="/whr/App/Home/View/Public/Css/bootstrap.min.css"></link>
            <!-- <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.idTabs.min.js"></script> -->
            <!-- <script type="text/javascript" src="/whr/App/Home/View/Public/Js/select-ui.min.js"></script> -->
            <!-- <script type="text/javascript" src="/whr/App/Home/View/Public/Js/kindeditor.js"></script> -->
            <script type="text/javascript">
                $(function(){
                    // alert(1)
                    //简单验证
                    var validate = {
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
                                    <li><label>电 话</label><input name="mobile_phone" type="text" class="dfinput"  value="<?php echo ($info["mobile_phone"]); ?>"/><i>电话号码</i></li>
                                    <li><label>固定电话</label><input name="fax_mobile" type="text" class="dfinput"  value="<?php echo ($info["fax_mobile"]); ?>"/><i>固定电话号码</i></li>
                                    <li><label>邮政编码</label><input name="zip_code" type="text" class="dfinput"  value="<?php echo ($info["zip_code"]); ?>"/><i></i></li>
                                    <li><label>城 市</label>
                                        <span class = 'pro'>
                                            <select name = 'province' class="form-control" >
                                                <option class="cheng_in" value="<?php echo ($info["province"]); ?>"><?php echo ($region["REGION_NAME"]); ?></option>
                                                <?php if(is_array($pro)): $i = 0; $__LIST__ = $pro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class = "pro_in" value="<?php echo ($vo["region_id"]); ?>"><?php echo ($vo["region_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>
                                            <select name = 'city' style="display:none" id ="city_list" class="form-control" >
                                                <option class = "city_in" value="<?php echo ($info["city"]); ?>"></option>
                                            </select>

                                            <select name = 'area' style="display:none"  id ="val_list" class="form-control" >
                                                <option class="area_on" value="<?php echo ($info["area"]); ?>"></option>
                                            </select>

                                        </span>

                                        <div style="display:none" id="skuNotice" class="sku_tip">
                                            <span id="skuTitle2"></span>
                                        </div>
                                        <i></i></li>        
                                    <li><label>详细地址</label><input name="address" type="text" class="dfinput" value="<?php echo ($info["address"]); ?>" /><i>街道地址</i></li>
                                    <li ><label>商家描述</label><textarea rows="5"  cols='50' style="border:1px solid #A7B5BC" name ="des" value="<?php echo ($info["des"]); ?>"><?php echo ($info["des"]); ?></textarea><i>描述</i></li>
                                    <li><label>店主姓名</label><input name="user_name" id="notice" type="text" class="dfinput" value="<?php echo ($info["user_name"]); ?>" /><i></i></li>  
                                    <li><label>营业执照</label><input name="business_license" id="notice" type="text" class="dfinput" value="<?php echo ($info["user_name"]); ?>" /><i></i></li>
                                    <li><label>Q Q</label><input name="qq" id="notice" type="text" class="dfinput" value="<?php echo ($info["qq"]); ?>"/><i></i></li>
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
                                    $('.pro_in').click(function(){
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
                                    var province = function() {
                                        var id=$(".cheng_in").val();
                                        $.ajax({
                                            url : "<?php echo U('City/city','','');?>",
                                            type : "post",
                                            data : "id="+id,
                                            dataType : "json",
                                            success : function(data){                   
                                                if(data != null){
                                                    if($(".cheng_in").val()!==''){
                                                        var str=""
                                                        $.each(data,function(key,val){
                                                            str += "<option class='city_in' value="+val['region_id']+" onclick='javascript:getvallage("+val['region_id']+")'>"+val['region_name']+"</option>";
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
                                        //   alert(id)
                                        $.ajax({
                                            url : "<?php echo U('City/vallcage','','');?>",
                                            type : "post",
                                            data : "id="+id,
                                            dataType : "json",
                                            success : function(data){                       
                                                if(data != null){
                                                    if($(".city_in").val()!==''){
                                                        var str=""
                                                        $.each(data,function(key,val){
                                                            str += "<option class='city_in' value="+val['region_id']+">"+val['region_name']+"</option>";
                                                        })
                                                        $('#val_list').html(str);
                                                        $('#val_list').show(200);
                                                    }
                                                }
                                            }
                                        });  
                                    };
                                    area();
                                    province();
                                    // getvallage($(".city_in").val());
                                    province();
                                    getvallage($(".city_in").val());
 
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