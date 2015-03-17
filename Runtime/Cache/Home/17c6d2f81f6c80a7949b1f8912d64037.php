<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
        <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
        <script type="text/javascript" src="/App/Home/View/Public/Js/common.js"></script>
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">

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
                               bValid = bValid && checkLength( $("#name"), $("#name").prev().text(), 2, 16 );
                               bValid = bValid && checkEmpty( $("#type_on"), "\u8bf7选择分类！" );//notice

                                bValid = bValid && (checkRegexp( $("#phone"), /\d{3}-\d{8}|\d{4}-\d{7}/ , "\u7535话格式不正确！" ));
                                bValid = bValid && checkEmpty( $("#addressAdd"), "\u8bf7选择省市！" );
                           //     bValid = bValid && checkEmpty( $("#city_list"), "\u8bf7选择市区！" );
                                bValid = bValid && checkEmpty( $("#val_list"), "\u8bf7选择区县！" );
                                bValid = bValid && checkEmpty( $("#address"), "地址不能为空！" );
                                bValid = bValid && checkEmpty( $("#notice"), "店主姓名不能为空！" );
                          
                                if(bValid==false){ setout(); }
                                return bValid;
                            }
                            $('form').submit(function(){
                                if(!checkInput()){
                                    $('.dfinput').each(function () {
                                      //  alert($(this).prev().text())
                                        if($(this).val()==''){
                                            $(this).next().css("color","red");
                                            $('.errorColor').css("color","red")
                                        }
                                    });
                                    return false;
                                }
                                return true
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
                    .pro{  float: left;line-height: 30px;margin-bottom: 10px; margin-left: 5px;}
                    #imgs_more{ width: 100%}
                    .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
                    .pro select{width: 345px;height: 32px; }
                    .box{ margin-left: 5px; font-size: 12px; margin-top: -3px; padding-left:5px; padding:3px;}
                    .forminfo li input{width: 345px;height: 32px;margin-left: 5px; }
                    .close{ float: left;}
                </style>
                </head>
                <body style="background: none;">

                    <div class="place">
                       
                        <ul class="placeul">
                             <li><a href="<?php echo U('Index/start','','');?>">首页</a></li>
                            <li><a href="#">添加生活导航商家</a></li>
                        </ul>
                    </div>
                    <form action="" method="post" name ="vform">
                        <input type ="hidden" name="id" value="<?php echo ($data["id"]); ?>">
                            <input id="typeId" type ="hidden" name="id" value="<?php echo ($info["id"]); ?>">
                                <input type ="hidden" name="action" id="action" value="<?php echo ($data["action"]); ?>">
                                    <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                                        <div class="formbody">

                                            <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>

                                            <ul class="forminfo">
                                                <li style = "display:none"><label>生活导航商家编号</label><input name="number" type="text" class="dfinput" value="<?php echo ($info["id"]); ?>" disabled="disabled"/><i>不用输入，系统自动生成</i></li>
                                               <li><label>商家名称</label><input name="name" id="name"  type="text" class="dfinput"  value="<?php echo ($info["name"]); ?>" /><i id="name_info">名称不能超过30个字符</i></li>
                                                <li><label>分类</label>
                                                    <span class = 'pro'>
                                                        <select name = 'parent_type' id="type_on" class="form-control">
                                                            <option class="pro_into"  value="<?php echo ($info["parent_type"]); ?>"><?php echo ($info["type_name"]); ?></option>
                                                            <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class = "top_cate" value="<?php echo ($vo["type_id"]); ?>" ><?php echo ($vo["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                        </select>
                                                        <select name = 'type' style="display:none" id ="soncate" class="form-control" >

                                                        </select>
                                                    </span>
                                                    <i class="errorColor">分类不能为空</i></li> 
                                               
                                                <li><label>电 话</label><input name="phone" type="text" id="phone" class="dfinput" value="<?php echo ($info["mobile_phone"]); ?>"/><i>格式：0755-xxxxxxxx</i></li>
                                                <!--  <li><label>传 真</label><input name="fex" type="text" class="form-control"  value="<?php echo ($info["fex"]); ?>"/><i></i></li>  -->
                                                <li><label>地 址</label>
                                                    <span class = 'pro'>
                                                        <select name = 'province'  class="form-control" id="addressAdd" >
                                                            <option class="cheng_in" value="<?php echo ($info["province"]); ?>"><?php echo ($info["REGION_NAME"]); ?></option>
                                                            <?php if(is_array($pro)): $i = 0; $__LIST__ = $pro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class = "pro_in" value="<?php echo ($vo["region_id"]); ?>" ><?php echo ($vo["region_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                        </select>

                                                        <select name = 'city' style="display:none" id ="city_list" class="form-control" <!--onclick="saveCity()" -->>
                                                                <option class = "city_in" value="<?php echo ($info["city"]); ?>"></option>
                                                        </select>

                                                        <select name = 'area' style="display:none"  id ="val_list" class="form-control"  >
                                                            <option class="area_on" value="<?php echo ($info["area"]); ?>"></option>
                                                        </select>

                                                    </span> <i class="errorColor">地址不能为空</i>
                                                    <div style="display:none" id="skuNotice" class="sku_tip">
                                                        <span class="validateTips"></span>
                                                    </div>
                                                    <i></i></li>        
                                                <li><label>详细地址</label><input name="address" type="text" id="address" class="dfinput" value="<?php echo ($info["address"]); ?>" /><i>街道地址</i></li>
                                                <li style="height:85px"><label>商家描述</label><textarea rows="5"  cols='50' style="border:1px solid #A7B5BC" name ="des" value="<?php echo ($info["des"]); ?>"><?php echo ($info["des"]); ?></textarea><i>描述</i></li>
                                               <li><label>列表图片</label>
                                                    <div id="list_hidden">
                                                        <input type ='hidden' name = "list_path" value="<?php echo ($info["list_path"]); ?>">
                                                            <input type ='hidden' name = "mid_pic" value="<?php echo ($info["mid_pic"]); ?>">
                                                                <input type ='hidden' name = "list_pic" value="<?php echo ($info["list_pic"]); ?>">
                                                                    </div></li>
                                                                    <li style="position:relative;margin-bottom:5px;height:55px"><input name="list_pic" id="upload_list" type="file" class="dfinput" style="" value="<?php echo ($info["list_pic"]); ?>" /><i  id ="imgs" style="position:absolute;left:150px;top:-5px;">
                                                                            <?php if($info["list_pic"] != ''): ?><div class="up_list_pic">
                                                                                    <img height='50px' src='<?php echo ($info["list_pic"]); ?>'>
                                                                                        <img src='/App/Home/View/Public/Images/uploadify-cancel.png' class ='close' onclick = 'javascript:deleteListPic()'> 
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
                                                                                                                        <img src='/App/Home/View/Public/Images/uploadify-cancel.png' class ='close' onclick = 'javascript:deletePic(<?php echo ($k); ?>)' > 
                                                                                                                            </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                                                                                                            </i></li>
                                                <li><label>店铺星级</label><input name="star" id="notice" type="text" class="dfinput" value="<?php echo ($info["star"]); ?>"/><i></i></li>
                                                <li><label>店主姓名</label><input name="user_name" id="notice" type="text" class="dfinput" value="<?php echo ($info["user_name"]); ?>" /><i></i></li>  
                                                <li><label>競價排名</label><input name="sort" id="notice" type="text" class="dfinput" value="100" value="<?php echo ($info["sort"]); ?>" /><i></i></li>
                                                <li><label>是否鎖定</label><span style="line-height:30px"><input name="lock" id="lock" type="radio" class="dfinput" value="0" <?php if($info["lock"] == 0): ?>checked="checked"<?php endif; ?> style="width:50px"/>正常
                                                            <input name="lock" id="lock" type="radio" class="dfinput" value="1" style="width:50px" <?php if($info["lock"] == 1): ?>checked="checked"<?php endif; ?>/>鎖定</span><i></i></li>    
                                                                <li><label>经纬度</label><input name="jingwei" id="notice" type="text" class="dfinput" value="<?php echo ($info["jingwei"]); ?>" />
                                                                    <span style="display:inline;background:#F5F7F9;margin-left:50px;padding:15px 5px 5px 5px;border-radius:5px;cursor:pointer"> <a href="javascript:;" id ="get" onclick="openwindow()"><img src="/App/Home/View/Public/Images/t02.png"/> 获取</a></span><i></i></li>         
                                                                <li><label>&nbsp;</label><input name="" type="submit" class="btn btn-primary" value="确认<?php echo ($data["btn"]); ?>"  onclick="javascript:;" /></li>
                                                                </ul>

                                                                </div>
                                                                </form>

                                                                </body>
                                                                <script>


                                                                    var list_pic = "";
                                                                    $('#upload_list').uploadify({
                                                                        'swf'      : '/App/Home/View/Public/Images/uploadify.swf',
                                                                        'uploader' : '<?php echo U("Uploads/listUpload");?>',
                                                                        'cancelImage':'/App/Home/View/Public/Images/uploadify-cancel.png',
                                                                        'buttonText' : '列表上传',
                                                                        'multi': false,
                                                                        'onUploadSuccess' : function(file, data, response) {
                                                                            //alert(data);
                                                                            obj= $.parseJSON(data);
                                                                            list_pic += "<img height='50px' src='"+obj.path+"'>";
                                                                            list_pic +=" <img src='/App/Home/View/Public/Images/uploadify-cancel.png' class ='close' onclick = 'javascript:deleteListPic()'> "
                                                                            $('#imgs').html(list_pic);
                                                                            var hid ="<input name='list_path' id='list_path' type='hidden' value='"+obj.path+"' />";
                                                                            hid +="<input name='mid_pic' id='mid_pic' type='hidden' value='"+obj.mid+"' />"
                                                                            hid +="<input name='list_pic' id='list_pic' type='hidden' value='"+obj.min+"' />"
                                                                            $('#list_hidden').html(hid);
                                                                            list_pic = '';
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
                                                                            img += "<div id = 'more_"+num+"' class = ' more_list_pic' num = '"+num+"'>"
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
                                                                    /*     function deleteListPic(){
                                                                        $(".up_list_pic").html('');
                                                                        $('#list_hidden').html('');
                                                                    }*/
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
                                                                        //        getvallage($(".city_in").val());

                                                                        var pro = function() {
                                                                            var id=$("#typeId").val();

                                                                            $.ajax({
                                                                                url : "<?php echo U('typeAjax','','');?>",
                                                                                type : "post",
                                                                                data : "id="+id,
                                                                                dataType : "json",
                                                                                success : function(data){     
                                                                                    //        console.log(data)
                                                                                    //   alert(data) 
                                                                                    if(data != null){

                                                                                        var str=""
                                                                                                                                                   
                                                                                        str += "<option value="+data.type_id+">"+data.type_name+"</option>";
                                                                                                                                                               
                                                                                        $.each(data.list,function(key,val){
                                                                                            str += "<option value="+val['type_id']+">"+val['type_name']+"</option>";
                                                                                        })
                                                                                        $('#soncate').html(str);
                                                                                        $('#soncate').show(300);
                                                                                    }
                                                                                }
                                                                            });    
                                                                        }
                                                                        //  province();
                                                                                                                                               
                                                                        //       pro();
                                                                        $('#type_on').bind('change',function(){
                                                                                                                   
                                                                          $(this).parent().next().css("color","#7f7f7f")
                                                                            var id =$(this).val();
                                                                                                                                                  
                                                                            $.ajax({
                                                                                url : "<?php echo U('sonCate','','');?>",
                                                                                type : "post",
                                                                                data : "id="+id,
                                                                                dataType : "json",
                                                                                success : function(data){   
                                                                                                                                                          
                                                                                    if(data != null){
                                                                                        var str=""
                                                                                        $.each(data,function(key,val){
                                                                                            str += "<option  value="+val['type_id']+">"+val['type_name']+"</option>";
                                                                                        })
                                                                                        $('#soncate').html(str);
                                                                                        $('#soncate').show(300);
                                                                                    }
                                                                                }
                                                                            });         
                                                                        })  
                                                                        // alert($("#action").val())
                                                                        if($("#action").val()=='add'){  
                                                                        }else{ 
                                                                            pro(); }   

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