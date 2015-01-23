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
            <link rel="stylesheet" type="text/css" href="/default/App/Home/View/Public/Css/bootstrap.min.css">
                <!-- <script type="text/javascript" src="/default/App/Home/View/Public/Js/jquery.idTabs.min.js"></script> -->
                <!-- <script type="text/javascript" src="/default/App/Home/View/Public/Js/select-ui.min.js"></script> -->
                <!-- <script type="text/javascript" src="/default/App/Home/View/Public/Js/kindeditor.js"></script> -->
                <script type="text/javascript">
                    $(function(){

                        if($(".pro_into").val()==''){  $(".pro_into").text("请选择"); }
                        if($(".cheng_in").val()==''){ $(".cheng_in").text("请选择"); }
                        if($(".house_into").val()==''){ $(".house_into").text("请选择"); }
                    
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
                        bValid = bValid && checkLength( $("#name"), "\u5c0f区名字", 2, 16 );
                        bValid = bValid && checkEmpty( $("#addressAdd"), "\u8bf7选择省市！" );
                        bValid = bValid && checkEmpty( $("#city_list"), "\u8bf7选择市区！" );
                        bValid = bValid && checkEmpty( $("#val_list"), "\u8bf7选择区县！" );
                        bValid = bValid && checkEmpty( $("#house_id"), "\u8bf7选择省市！" );
                        bValid = bValid && checkEmpty( $("#property_id"), "\u8bf7选择楼盘！" );
                        bValid = bValid && checkEmpty( $("#val_list"), "\u8bf7选择物业！" );
                        //bValid = bValid && checkRegexp( $("#username"), /^[a-z]([0-9a-z_])+$/i, "用户名只能是数字和字母组成" );
                        if(bValid==false){ setout(); }
                        return bValid;
                    }
                </script>
                </head>
                <style type="text/css">
                    .pro{  float: left;line-height: 30px;margin-bottom: 10px; margin-left: 0px; }
                    .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
                    .pro select{width: 345px;height: 32px; }
                /*    #val_list{width: 345px;height: 32px;  margin-left: 85px;}*/
                </style>

                <body style="background: none;">

                    <div class="place">
                        <span>后台管理：</span>
                        <ul class="placeul">
                            <li><a href="#">管理员管理</a></li>
                            <li><a href="#">添加管理员</a></li>
                        </ul>
                    </div>
                    <form action="" method="post" name ="vform">
                        <input type ="hidden" name="add_time">
                            <input type ="hidden" name="id" value="<?php echo ($info["id"]); ?>">
                                <input type ="hidden" name="action" value="<?php echo ($data["action"]); ?>">
                                    <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                                        <div class="formbody">
                                            <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>
                                            <ul class="forminfo">
                                                <li><label>小区名字</label><input name="name" id="name" type="text" class="dfinput" value="<?php echo ($info["name"]); ?>" /><i id="name_info">名称不能超过30个字符</i></li>
                                                <li><label>地址</label>
                                                    <span class = 'pro'>
                                                        <select name = 'province'  class="form-control" id="addressAdd" >
                                                            <option class="cheng_in" value="<?php echo ($info["REGION_ID"]); ?>"><?php echo ($info["REGION_NAME"]); ?></option>
                                                            <?php if(is_array($pro)): $i = 0; $__LIST__ = $pro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class = "pro_in" value="<?php echo ($vo["region_id"]); ?>" ><?php echo ($vo["region_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                        </select>

                                                        <select name = 'city' style="display:none" id ="city_list" class="form-control" <!--onclick="saveCity()" -->>
                                                                <option class = "city_in" value="<?php echo ($info["city"]); ?>"></option>
                                                        </select>

                                                        <select name = 'area' style="display:none"  id ="val_list" class="form-control"  >
                                                            <option class="area_on" value="<?php echo ($info["area"]); ?>"></option>
                                                        </select>

                                                    </span> <i class="errorColor">请选择地址</i></li>
                                                <li><label>所属楼盘</label>
                                                    <span class = 'pro'>
                                                    <select  class="form-control" id="house_id" name= 'house_id' style="width: 345px;height: 32px;" >
                                                        <option name = 'house_id' class="house_into"  value="<?php echo ($info["hid"]); ?>"><?php echo ($info["hname"]); ?></option>
                                                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option name = 'house_id'  value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select>
                                                  </span>  <i class="errorColor">请选择楼盘</i>
                                                </li>
                                                <li><label>所属物业</label>
                                                    <span class = 'pro'>
                                                    <select  class="form-control" id="property_id" name = 'property_id' style="width: 345px;height: 32px;" >
                                                        <option name = 'property_id' class="pro_into"  value="<?php echo ($info["pid"]); ?>"><?php echo ($info["pname"]); ?></option>
                                                        <?php if(is_array($prolist)): $i = 0; $__LIST__ = $prolist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><option name = 'property_id'  value="<?php echo ($list["id"]); ?>"><?php echo ($list["pname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select>
                                                  </span>  <i class="errorColor">请选择物业</i>
                                                    <input name="add_time" type="hidden"  />
                                                    <li><label>&nbsp;</label><input name="" type="submit" class="btn btn-primary" value="确认<?php echo ($data["btn"]); ?>"  onclick="javascript:;" /></li>
                                            </ul>
                                            <div style="display:none" id="skuNotice" class="sku_tip">
                                                <span class="validateTips"></span>
                                            </div>

                                        </div>
                                        </form>
                                        </body>
                                        </html>