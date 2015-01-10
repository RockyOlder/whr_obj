<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/whr/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <!-- <link href="/whr/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" /> -->
        <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.js"></script>
        <script type="text/javascript" src="/whr/App/Home/View/Public/Js/common.js"></script>

        <script type="text/javascript" src ="/whr/App/Home/View/Public/ueditor/editor_config.js"></script>
        <script type="text/javascript" src ="/whr/App/Home/View/Public/ueditor/editor_all_min.js"></script>
        <script type="text/javascript" src='/whr/App/Home/View/Public/Js/jquery.uploadify.min.js'></script>
        <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/whr/App/Home/View/Public/js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
            <link rel="stylesheet" type="text/css" href="/whr/App/Home/View/Public/Css/bootstrap.min.css">

                <link rel="stylesheet" href="/whr/App/Home/View/Public/Css/uploadify.css">

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
                                bValid = bValid && checkLength( $("#name"), "\u7528户名", 2, 16 );
                                bValid = bValid && checkLength( $("#password"), "\u5bc6码", 6, 16 )
                                bValid = bValid && checkEquals( $("#password"),$("#password2"), "\u4e24次密码输入不一致！" );
                                bValid = bValid && checkEmpty( $("#village_id"), "\u8bf7选择小区！" );
                                bValid = bValid && checkEmpty( $("#addressAdd"), "\u8bf7选择省市！" );
                                bValid = bValid && checkEmpty( $("#city_list"), "\u8bf7选择市区！" );
                                bValid = bValid && checkEmpty( $("#val_list"), "\u8bf7选择区县！" );
                                bValid = bValid && (checkRegexp( $("#mobile_phone"), /(^1[0-9]{10}$)|(^00[1-9]{1}[0-9]{3,15}$)/ , "\u624b机格式不正确！" ));
                                bValid = bValid && (checkRegexp( $("#fax_phone"), /\d{3}-\d{8}|\d{4}-\d{7}/ , "\u7535话格式不正确！" ));
                                bValid = bValid && (checkRegexp( $("#email"), /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "\u90ae箱格式不正确！" ));
                                //          bValid = bValid && checkLength( $("#name"), "地 址", 2, 30 );
                                //bValid = bValid && checkRegexp( $("#username"), /^[a-z]([0-9a-z_])+$/i, "用户名只能是数字和字母组成" );
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
                        .pro{  float: left;line-height: 30px;margin-bottom: 10px; margin-left: 0px; }

                        .pro select{width: 342px;height: 32px; }
                        .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
                    </style>
                    </head>
                    <body style="background: none;">

                        <div class="place">
                            <span>后台管理：</span>
                            <ul class="placeul">
                                <li><a href="#">会员管理</a></li>
                                <li><a href="#">添加会员</a></li>
                            </ul>
                        </div>
                        <form action="" method="post" name ="vform" id="item_form">
                            <input type ="hidden" name="id" value="<?php echo ($data["id"]); ?>">
                                <input type ="hidden" name="user_id" value="<?php echo ($info["user_id"]); ?>">
                                    <input type ="hidden" name="action" id="actionSave"  value="<?php echo ($data["action"]); ?>">
                                        <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                                            <div class="formbody">
                                                <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>
                                                <ul class="forminfo">
                                                    <li><label>用户名</label><input name="user_name" id="name" type="text" class="dfinput" value="<?php echo ($info["user_name"]); ?>" /><i id="name_info">名称不能超过30个字符</i></li>
                                                    <li class="pwsave"><label>密码</label><input name="password" id="password" type="password" class="dfinput" value="<?php echo ($info["name"]); ?>" /><i id="password_info">密码不能为空</i></li>
                                                    <li class="pwsave"><label>确认密码</label><input name="password2" id="password2" type="password" class="dfinput" value="<?php echo ($info["name"]); ?>" /><i id="passwd_inf2">两次密码要一致</i></li>
                                                    <li><label>所属小区</label>
                                                        <span class = 'pro'>
                                                            <select  id="village_id" class="form-control" name = 'village_id' style="width: 345px;height: 32px;" >
                                                                <option name = 'village_id' class="house_into"  value="<?php echo ($vfind["id"]); ?>"><?php echo ($vfind["name"]); ?></option>
                                                                <?php if(is_array($Vlist)): $i = 0; $__LIST__ = $Vlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option name = 'village_id'  value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                            </select>
                                                        </span>
                                                        <i class="errorColor">请选择小区</i> </li>
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
                                                        </span>
                                                        <i class="errorColor">请选择地址</i></li>  
                                                    <div style="display:none" id="skuNotice" class="sku_tip">
                                                        <span class="validateTips"></span>
                                                    </div>

                                                    <li><label>用户头像</label>                                                   
                                                        <div id="list_hidden">
                                                            <input type ='hidden' name = "face" value="<?php echo ($info["face"]); ?>">
                                                        </div></li>
                                                    <li style="position:relative;margin-bottom:5px;height:55px"><input name="list_pic" id="upload_list" type="file" class="dfinput" style="" value="<?php echo ($info["list_pic"]); ?>" /><i  id ="imgs" style="position:absolute;left:150px;top:-5px;">
                                                            <?php if($info["face"] != ''): ?><div class="up_list_pic">
                                                                    <img height='50px' src='<?php echo ($info["face"]); ?>'>
                                                                        <img src='/whr/App/Home/View/Public/Images/uploadify-cancel.png' class ='close' onclick = 'javascript:deleteListPic()'> 
                                                                            </div><?php endif; ?>
                                                                            </i></li>
                                                                            <li><label>手机号码</label><input name="mobile_phone" id="mobile_phone" type="text" class="dfinput" value="<?php echo ($info["mobile_phone"]); ?>" /><i>格式：13525155853</i></li>
                                                                            <li><label>固定电话</label><input name="fax_phone" id="fax_phone" type="text" class="dfinput"  value="<?php echo ($info["fax_phone"]); ?>"/><i>格式:0755-1234568</i></li>
                                                                            <li><label>邮箱</label><input name="email" type="text" id="email" class="dfinput"  value="<?php echo ($info["email"]); ?>"/><i>格式:xxxxxx@xx.com</i></li> 
                                                                            <li><label>真实姓名</label><input name="true_name" type="text" class="dfinput"  value="<?php echo ($info["true_name"]); ?>"/><i></i></li> 
                                                                            <li><label>详细地址</label><input name="address" type="text" class="dfinput"  value="<?php echo ($info["address"]); ?>"/><i></i></li>  
                                                                            <li><label>昵称</label><input name="nickname" type="text" class="dfinput"  value="<?php echo ($info["nickname"]); ?>"/><i></i></li>  
                                                                            <li><label>&nbsp;</label><input name="" type="submit" class="btn btn-primary" value="确认<?php echo ($data["btn"]); ?>"  onclick="javascript:;" /></li>
                                                                            <input name="reg_time" type="hidden" /><input name="salt" type="hidden" />
                                                                            </ul>

                                                                            </div>
                                                                            </form>
                                                                            <!-- <div id="map" style="border:1px solid red;width:100%;height:auto">ditu
                                                                                
                                                                            </div> -->

                                                                            </body>
                                                                            <script>
                                                                                //var edit= new UE.ui.Editor({initialContent:'',initialFrameWidth:450});
                                                                                // console.log(edit)
                                                                                // edit.render("intro");
                                                                                /*    UE.getEditor('intro', {
                                                                                    theme:"default", //皮肤
                                                                                    lang:"zh-cn",//语言
                                                                                    initialFrameWidth:600,  //初始化编辑器宽度,默认800
                                                                                    initialFrameHeight:320
                                                                                });
                                       var hid ="<input name='face' type='hidden' value='"+obj.mid+"' />"
                                                                                 */
                                                                                var list_pic = "";
                                                                                $('#upload_list').uploadify({
                                                                                    'swf'      : '/whr/App/Home/View/Public/Images/uploadify.swf',
                                                                                    'uploader' : '<?php echo U("Uploads/listUpload");?>',
                                                                                    'cancelImage':'/whr/App/Home/View/Public/Images/uploadify-cancel.png',
                                                                                    'buttonText' : '列表上传',
                                                                                    'multi': false,
                                                                                    'onUploadSuccess' : function(file, data, response) {
                                                                                        //alert(data);
                                                                                        obj= $.parseJSON(data);
                                                                                        list_pic += "<img height='50px' src='"+obj.path+"'>";
                                                                                        list_pic +=" <img src='/whr/App/Home/View/Public/Images/uploadify-cancel.png' class ='close' onclick = 'javascript:deleteListPic()'> "
                                                                                        $('#imgs').html(list_pic);
                                                                                        var hid ="<input name='face' type='hidden' value='"+obj.mid+"' />"
                                                                                        //   hid +="<input name='mid_pic' id='mid_pic' type='hidden' value='"+obj.mid+"' />"
                                                                                        //         hid +="<input name='list_pic' id='list_pic' type='hidden' value='"+obj.min+"' />"
                                                                                        $('#list_hidden').html(hid);
                                                                                        list_pic = '';
                                                                                        hid='';
                                                                                    }
                                                                                });
                                                                    
                                                                                function deleteListPic(){
                                                                                                                                   
                                                                                    $("#imgs img").remove();
                                                                                    $('#list_hidde input').remove();
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
                                                                                $(function(){
                                            
                                                                                    if($("#actionSave").val()=='edit'){
                                                   
                                                                                        $(".pwsave").remove();
                                                                                        //  $("#password2").remove(); 
                                                                                    }
                                            
                                            
                                                                                    $('#addressAdd').bind('change',function(){
                                                                                        //  $('#vallage').hide(200);
                                                                                        $(this).parent().next().css("color","#7f7f7f")
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
                                                                                        // alert(id)
                                                                                        $.ajax({
                                                                                            url : "<?php echo U('City/vallcage','','');?>",
                                                                                            type : "post",
                                                                                            data : "id="+id,
                                                                                            dataType : "json",
                                                                                            success : function(data){      
                                                                                                console.log(data)
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