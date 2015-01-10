<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/whr/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/whr/App/Home/View/Public/Js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
            <!-- <link href="/whr/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" /> -->
            <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.js"></script>
            <script type="text/javascript" src="/whr/App/Home/View/Public/Js/common.js"></script>
            <link rel="stylesheet" type="text/css" href="/whr/App/Home/View/Public/Css/bootstrap.min.css">
                <script src='/whr/App/Home/View/Public/Js/jquery.uploadify.min.js'></script>
                <script type="text/javascript">
                    $(function(){

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
                            bValid = bValid && checkLength( $("#pname"), "物业名称", 2, 16 );
                            bValid = bValid && checkEmpty( $("#address"), "详细地址不能为空！" );
                            bValid = bValid && checkEmpty( $("#addressAdd"), "请选择省市！" );
                            bValid = bValid && checkEmpty( $("#city_list"), "请选择市区！" );
                            bValid = bValid && checkEmpty( $("#val_list"), "请选择区县！" );
                            bValid = bValid && (checkRegexp( $("#phone"), /\d{3}-\d{8}|\d{4}-\d{7}/ , "电话格式不正确！" ));
                            bValid = bValid && checkEmpty( $("#manager"), "详细地址不能为空！" );
                            bValid = bValid && (checkRegexp( $("#manage_phone"), /(^1[0-9]{10}$)|(^00[1-9]{1}[0-9]{3,15}$)/ , "手机格式不正确！" ));
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
                </head>
                <style type="text/css">
                    .pro{  float: left;line-height: 30px;margin-bottom: 10px; margin-left: 0px; }
                    .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
                    .pro select{width: 345px;height: 32px; }
                    /*#val_list{width: 345px;height: 32px;  margin-left: 85px;} -*/
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
                        <input type ="hidden" name="id" value="<?php echo ($info["id"]); ?>">
                            <input type ="hidden" name="action" value="<?php echo ($data["action"]); ?>">
                                <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                                    <div class="formbody">

                                        <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>

                                        <ul class="forminfo">
                                            <li><label>物业名称</label><input name="pname" id="pname" type="text" class="dfinput" value="<?php echo ($info["pname"]); ?>" /><i id="name_info">名称不能超过30个字符</i></li>
                                            <li><label>详细地址</label><input name="address" id="address" type="text" class="dfinput" value="<?php echo ($info["address"]); ?>" /><i id="address_info">密码不能为空</i></li>
                                            <li><label>地 址</label>
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

                                                </span> <i class="errorColor">请选择地址</i></li>
                                            <li><label>物业电话</label><input name="phone" type="text" id="phone" class="dfinput" value="<?php echo ($info["phone"]); ?>" /><i>格式：0755-xxxxzz</i></li>
                                            <li><label>主管名字</label><input name="manager" type="text" id="manager" class="dfinput"  value="<?php echo ($info["manager"]); ?>"/><i>不能为空</i></li>
                                            <li><label>主管电话</label><input name="manage_phone" id="manage_phone" type="text" class="dfinput"  value="<?php echo ($info["manage_phone"]); ?>"/><i>格式：134xxxxxxxx</i></li>
                                            <input name="staue" value="0" type="hidden"  />
                                            <input name="add_time" value="0" type="hidden"  />


                                            <li><label>&nbsp;</label><input name="" type="submit" class="btn btn-primary" value="确认<?php echo ($data["btn"]); ?>"  onclick="javascript:;" /></li>
                                        </ul>
                                        <div style="display:none" id="skuNotice" class="sku_tip">
                                            <span class="validateTips"></span>
                                        </div>
                                    </div>
                                    </form>
                                    <script type="Text/Javascript">
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
                                                        //   alert(2)                                                                                            
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
                                                            str += "<option class='city_in' value="+val['region_id']+">"+val['region_name']+"</option>";
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