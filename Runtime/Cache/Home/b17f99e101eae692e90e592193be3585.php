<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/App/Home/View/Public/Css/bootstrap.min.css" rel="stylesheet" type="text/css">
            <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
                <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
                <script type="text/javascript" src="/App/Home/View/Public/Js/common.js"></script>
                <script language="javascript" type="text/javascript" src="/App/Home/View/Public/Js/My97DatePicker/WdatePicker.js"></script>
                <script type="text/javascript" src="/App/Home/View/Public/Js/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
                <style type="text/css">
                    .pro{  float: left;line-height: 30px; margin-left: 0px;margin-bottom: 10px;}
                    #BusinessAdmin{ width: 345px;}
                    .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
                    .pro select{width: 345px;height: 32px; }
                    .box{ margin-left: 5px; font-size: 12px; margin-top: -3px; padding-left:5px; padding:3px;}
                </style>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('.radiolist').each(function() {
                            if($("#if_show").val()==1 && $(this).val()==1){
                                $(this).attr({ checked: "checked"})
                            }else if($("#if_show").val()==0 && $(this).val()==0){
                                $(this).attr({ checked: "checked"})
                            }
                        });
                        if($("#if_show").val()==''){ $("#rdaoid").attr({ checked: "checked"}) }
                    });

                    $(function(){

                        if($(".pro_into").val()==''){  $(".pro_into").text("请选择"); }
                        if($(".cheng_in").val()==''){ $(".cheng_in").text("请选择"); }
                        if($(".house_into").val()==''){ $(".house_into").text("请选择"); }
                    
                        $('#addressAdd').bind('change',function(){
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
                        if($(".cheng_in").val()!==''){ area();}

                        $('form').submit(function(){
                     
                            if(!checkInput()){
                                $('.dfinput').each(function () {
                                    if($(this).val()==''){
                                        $(this).next().css("color","red");
                                        // $('.errorColor').css("color","red")
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
                                        str += "<option class='city_in' value="+val['REGION_ID']+">"+val['REGION_NAME']+"</option>";
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
                     //   bValid = bValid && checkLength( $("#titleEmpty"), "标题名字", 2, 16 );
                        bValid = bValid && checkEmpty( $("#addressAdd"), "\u8bf7选择省市！" );
                        //    bValid = bValid && checkEmpty( $("#city_list"), "\u8bf7选择市区！" );
                        $("#addressAdd").removeClass('ui-state-error')
                        bValid = bValid && checkEmpty( $("#val_list"), "\u8bf7选择区县！" );
                        $("#val_list").removeClass('ui-state-error') 
                        bValid = bValid && checkEmpty( $("#d412"), "开始时间不能为空！" );
                        $("#d412").removeClass('ui-state-error')
                        bValid = bValid && checkEmpty( $("#d413"), "结束时间不能为空！" );
                        $("#d413").removeClass('ui-state-error')
                   //     bValid = bValid && checkEmpty( $("#info"), "表述不能为空！" );
                   //     $("#info").removeClass('ui-state-error')
                        bValid = bValid && checkEmpty( $("#sort"), "竞价排名不能为空！" );
                        //bValid = bValid && checkRegexp( $("#username"), /^[a-z]([0-9a-z_])+$/i, "用户名只能是数字和字母组成" );
                        if(bValid==false){ setout(); }
                        return bValid;
                    }
                </script>
                </head>
                <body style="background: none;">

                    <div class="place">
                        <span>位置： </span>
                        <ul class="placeul">
                            <li><a href="<?php echo U('Index/start','','');?>">首页</a></li>
                            <li><a href="<?php echo U('Business/index','','');?>">服务商家</a></li>
                            <li>推荐服务商品</li>
                        </ul>
                    </div>
                    <form action="" method="post" name ="vform">
                        <input type ="hidden" name="sid" value="<?php echo ($info["lgid"]); ?>">
                            <input type ="hidden" name="action" value="<?php echo ($data["action"]); ?>">
                                <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                                    <input type="hidden" value="<?php echo ($info["if_show"]); ?>" id="if_show">
                                        <div class="formbody">
                                            <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>
                                            <ul class="forminfo">
                                           <!--     <li><label>标题</label><input name="title" type="text" class="dfinput" id="titleEmpty" /><i>标题不能超过6字</i></li> -->
                                                <li><label>发布人</label><input name="admin" type="text" id="BusinessAdmin" class="form-control" disabled="disabled" value="<?php echo ($data["name"]); ?>" /></li>
                                                <li><label>地址</label>
                                                    <span class = 'pro'>
                                                        <select name = 'province'  class="form-control" id="addressAdd" >
                                                            <option class="cheng_in" value="<?php echo ($info["REGION_ID"]); ?>"><?php echo ($info["REGION_NAME"]); ?></option>
                                                            <?php if(is_array($pro)): $i = 0; $__LIST__ = $pro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class = "pro_in" value="<?php echo ($vo["REGION_ID"]); ?>" ><?php echo ($vo["REGION_NAME"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                        </select>

                                                        <select name = 'city' style="display:none" id ="city_list" class="form-control" <!--onclick="saveCity()" -->>
                                                                <option class = "city_in" value="<?php echo ($info["city"]); ?>"></option>
                                                        </select>

                                                        <select name = 'area' style="display:none"  id ="val_list" class="form-control"  >
                                                            <option class="area_on" value="<?php echo ($info["area"]); ?>"></option>
                                                        </select>

                                                    </span> <i class="errorColor">请选择地址</i></li>
                                                <div style="display:none" id="skuNotice" class="sku_tip">
                                                    <span class="validateTips"></span>
                                                </div>
                                                <li><label>开始时间</label><input readonly="readonly" name="add_time"  type="text"  class="dfinputInfo" id="d412" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" value="" /><i class="errorColor">开始时间不能为空</i></li>
                                                <li><label>结束时间</label><input readonly="readonly" name="deadline" type="text" class="dfinputInfo" id="d413" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" value="" /><i class="errorColor">结束时间不能为空</i></li>
                                                <li><label>全国推荐</label><input name="is_all"  class="radiolist" id="rdaoid"  type="radio" value="1"><a class="box">是</a><input name="is_all"  class="radiolist" type="radio" value="0"><a class="box">否</a></li>
                                                            <li><label>竞价排名</label><input name="sort" type="text" class="dfinput" id="sort" /><i></i></li>
                                                            <li><label>&nbsp;</label><input name="" type="submit" class="btn btn-primary" value="提交"  onclick="javascript:;" /></li>
                                                            </ul>

                                            </div>
                       </form>

           </body>     
                                      

</html>