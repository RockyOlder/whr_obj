<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <!-- <link href="/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" /> -->
        <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
        <script type="text/javascript" src="/App/Home/View/Public/Js/common.js"></script>
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
            <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
                <!-- <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.idTabs.min.js"></script> -->
                <!-- <script type="text/javascript" src="/App/Home/View/Public/Js/select-ui.min.js"></script> -->
                <!-- <script type="text/javascript" src="/App/Home/View/Public/Js/kindeditor.js"></script> -->
                <script type="text/javascript">
                    $(function(){
                        if($("#action").val()=='edit'){
                            $("#adminName").remove();
                            $("#password").remove();
                            $(".removeUser").remove()
                        }
                        
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
                            bValid = bValid && checkLength( $("#name"), "用户名", 2, 16 );
                            bValid = bValid && checkEmpty( $("#owner"), "负责人不能为空！" );
                            bValid = bValid && checkEmpty( $("#phone"), "开发商电话不能为空！" );
                            bValid = bValid && checkEmpty( $("#contact"), "联系人不能为空！" );//
                            bValid = bValid && checkEmpty( $("#adminPhone"), "联系人电话不能为空！" );//
                            bValid = bValid && (checkRegexp( $("#certificate"), /^(\d{6})(\d{4})(\d{2})(\d{2})(\d{3})([0-9]|X)$/ , "身份证格式不正确！" ));
                            if($("#action").val()=='add'){
                                bValid = bValid && checkLength( $("#adminName"), "管理员用户名", 2, 16 );
                                bValid = bValid && checkLength( $("#password"), "\u5bc6码", 6, 16 )
                            }

                            if(bValid==false){ setout(); }
                            return bValid;
                        }
                        $('form').submit(function(){
                            if(!checkInput()){
                                $('.dfinput').each(function () {
                                    //     alert($(this).val())
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
                <style>
                    .pro select{width: 345px;height: 32px; }  
                    .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
                    .pro{  float: left;line-height: 30px;margin-bottom: 10px; margin-left: 0px; }
                    label{ width: 120px;}
                   .info_start{ color: red;}
                </style>
                </head>
                <body style="background: none;">

                    <div class="place">
                        <span>位置：</span>
                        <ul class="placeul">
                            <li><a href="<?php echo U('Index/start');?>">首页</a></li>
                            <li><a href="/index.php?s=/Home/Developer">开发商管理</a></li>
                            <li>添加开发商</li>
                        </ul>
                    </div>
                    <form action="" method="post" name ="vform">
                        <input type ="hidden" name="id" value="<?php echo ($data["id"]); ?>">
                            <input type ="hidden" name="id" value="<?php echo ($info["id"]); ?>">
                                <input type ="hidden" name="action" value="<?php echo ($data["action"]); ?>" id="action">
                                    <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                                        <div class="formbody">

                                            <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>

                                            <ul class="forminfo">
                                                <li><label>开发商名字<a class="info_start">&nbsp; *</a></label><input name="name" id="name" type="text" class="dfinput" value="<?php echo ($info["name"]); ?>" /><i id="name_info">名称不能超过30个字符</i></li>
                                                <li><label>负 责 人<a class="info_start">&nbsp; *</a></label><input name="owner" id="owner" type="text" class="dfinput"  value="<?php echo ($info["owner"]); ?>"/><i></i></li>
                                                <li><label>开发商电话<a class="info_start">&nbsp; *</a></label><input name="phone" id="phone" type="text" class="dfinput"  value="<?php echo ($info["phone"]); ?>"/><i>电话号码</i></li>
                                                <li><label>开发商竞价</label><input name="sort" type="text" class="dfinput" value="<?php echo ($info["sort"]); ?>"/><i>竞价排序</i></li>
                                                <li><label>地 址</label>
                                                    <span class = 'pro'>
                                                        <select name = 'province'  class="form-control" id="addressAdd" >
                                                            <option class="cheng_in" value="<?php echo ($region["REGION_ID"]); ?>"><?php echo ($region["REGION_NAME"]); ?></option>
                                                            <?php if(is_array($pro)): $i = 0; $__LIST__ = $pro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class = "pro_in" value="<?php echo ($vo["REGION_ID"]); ?>" ><?php echo ($vo["REGION_NAME"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                        </select>

                                                        <select name = 'city' style="display:none" id ="city_list" class="form-control" <!--onclick="saveCity()" -->>
                                                                <option class = "city_in" value="<?php echo ($info["city"]); ?>"></option>
                                                        </select>

                                                        <select name = 'area' style="display:none"  id ="val_list" class="form-control"  >
                                                            <option class="area_on" value="<?php echo ($info["area"]); ?>"></option>
                                                        </select>
                                                    </span> </li>
                                                <li><label>详细地址</label><input name="address" id="address" type="text" class="dfinput" value="<?php echo ($info["address"]); ?>" /><i id="address_info">请输入地址</i></li>
                                                <li><label>网址</label><input name="url" id="url" type="text" class="dfinput" value="<?php echo ($info["url"]); ?>" /></li>
                                                <li><label>联系人<a class="info_start">&nbsp; *</a></label><input name="contact" id="contact" type="text" class="dfinput" value="<?php echo ($info["contact"]); ?>" /><i>联系人不能为空</i></li>
                                                <li><label>联系人电话</label><input name="adminPhone" id="adminPhone" type="text" class="dfinput" value="<?php echo ($info["adminPhone"]); ?>" /><i>联系人电话不能为空</i></li>
                                                <li><label>职位身份<a class="info_start">&nbsp; *</a></label><input name="Posts" id="Posts" type="text" class="dfinput" value="<?php echo ($info["Posts"]); ?>" /></li>
                                                <li><label>身份证号码<a class="info_start">&nbsp; *</a></label><input name="certificate" id="certificate" type="text" class="dfinput" value="<?php echo ($info["certificate"]); ?>" /><i>请输入18位的身份证号码</i></li>
                                                <li class="removeUser"><label>管理员用户名<a class="info_start">&nbsp; *</a></label><input name="adminName" id="adminName" type="text" class="dfinput" /><i>管理员用户名不能为空</i></li>
                                                <li class="removeUser"><label>密码<a class="info_start">&nbsp; *</a></label><input name="password" id="password" type="password" class="dfinput"  /><i>管理员密码不能为空</i></li>
                                                <li><label>&nbsp;</label><input name="" type="submit" class="btn btn-primary" value="确认<?php echo ($data["btn"]); ?>"  onclick="javascript:;" /></li>
                                            </ul>
                                        </div>
                                        <div style="display:none" id="skuNotice" class="sku_tip">
                                            <span class="validateTips"></span>
                                        </div>
                                        </form>
                                        <script type="text/javascript">
                                            $(function(){
                                                //   alert($('.area_on').val())
                                                if($(".pro_into").val()==''){ $(".pro_into").text("请选择"); }
                                                if($(".cheng_in").val()==''){ $(".cheng_in").text("请选择"); }
                                                $('#addressAdd').bind('change',function(){
                                                    $('#vallage').hide(200);
                                                    var id =$(this).val();
                                                    // alert(0);
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
                                                    $(this).parent().next().css("color","#7f7f7f")
                                                    var id=$(this).val();
                                                                                                                                                        
                                                    $.ajax({
                                                        url : "<?php echo U('City/city','','');?>",
                                                        type : "post",
                                                        data : "id="+id,
                                                        dataType : "json",
                                                        success : function(data){        
                                                            //   alert(2)                                                                                            
                                                            if(data != null){
                                                                $("#val_list .city_in").remove();
                                                                if($(".city_in").val()!==''){
                              
                                                                    var str=""
                                                                    var inex= this//selected=selected
                                                                                                                                                                      
                                                                    $.each(data,function(key,val){
                                                                        str += "<option class='city_in' value="+val['REGION_ID']+" onclick='javascript:getvallage("+val['REGION_ID']+")'>"+val['REGION_NAME']+"</option>";
                                                                    })
                                                                    if(str==''){$('#val_list').hide(200);}else{ $('#val_list').append(str); $('#val_list').show(200);}
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
                                                    $.ajax({
                                                        url : "<?php echo U('City/vallcage','','');?>",
                                                        type : "post",
                                                        data : "id="+id,
                                                        dataType : "json",
                                                        success : function(data){      
                                                            if(data != null){
                                                                if($(".city_in").val()!==''){
                                                                    var str=""
                                                                    str += "<option value="+data.REGION_ID+">"+data.REGION_NAME+"</option>";
                                                                    $.each(data.list,function(key,val){
                                                                        str += "<option class='city_in' value="+val['REGION_ID']+">"+val['REGION_NAME']+"</option>";
                                                                    })
                                                                    $('#val_list').html(str);
                                                                    $('#val_list').show(200);
                                                                }
                                                            }
                                                        }
                                                    });  
                                                };
                                                                                                                                              
                                                province();
                                                area();
 
                                            })
                                            function getvallage(id){
                                                //          alert(1)
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
                                        </script>
                                        </body>

                                        </html>