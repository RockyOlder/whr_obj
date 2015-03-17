<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加业主</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
            <link rel="stylesheet" href="/App/Home/View/Public/Css/uploadify.css">
        <script type="text/javascript" src="/App/Home/View/Public/Js/common.js"></script>
                <script src='/App/Home/View/Public/Js/jquery.uploadify.min.js'></script>
                <script type="text/javascript">
                    //alert(1)
                    //简单验证
        
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
                              
                              if($("#ceshi").val()!==''){}  
                      if($("#developerRole").val()==0){  bValid = bValid && checkEmpty( $("#property_id"), "\u8bf7选择小区！" );}
                              $("#property_id").removeClass('ui-state-error')
                                bValid = bValid && checkEmpty( $("#mobile"), "业主电话不能为空！" );
                                bValid = bValid && checkEmpty( $("#address"), "业主地址不能为空！" );
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
                    });
     

                </script>
                <style type="text/css">
         .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
             
                    .pro {
                        float: left;
                        line-height: 30px;
                        margin-left: 0px;
                        margin-bottom: 10px;
                    }

                    .sku_tip {
                        background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);
                        border-radius: 4px;
                        box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);
                        color: #fff;
                        display: none;
                        left: 50%;
                        margin-left: -70px;
                        padding: 5px 10px;
                        position: fixed;
                        text-align: center;
                        top: 50%;
                        z-index: 25;
                    }

                    .pro select {
                        width: 345px;
                        height: 32px;
                    }

                    .box {
                        margin-left: 5px;
                        font-size: 12px;
                        margin-top: -3px;
                        padding-left: 5px;
                        padding: 3px;
                    }
                </style>
                </head>
                <body style="background: none;">
                    <input type ="hidden" value="<?php echo ($data["village"]); ?>" id="developerRole">
                    <div class="place">
                       <span>位置： </span>
                        <ul class="placeul">
                            <li><a href="<?php echo U('Index/start','','');?>">首页</a></li>
                            <li><a href="/index.php?s=/Home/Owner">业主列表</a></li>
                            <li>添加业主</li>
                        </ul>
                    </div>
                    <form action="" method="post" name="vform" >
                        <div class="formbody">
                            <div class="formtitle">
                                <span><?php echo ($data["title"]); ?></span>
                            </div>
                            <ul class="forminfo">
                                <?php if($data["village"] == 0): ?><li><label>所属小区</label> <span class='pro'> 
                                        <select
                                            name='property_id' class="form-control" id="property_id">
                                            <option class="cheng" id="ceshi" value="<?php echo ($find["id"]); ?>"><?php echo ($find["name"]); ?></option>
                                            <?php if(is_array($property)): $i = 0; $__LIST__ = $property;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class="pro_in"  value="<?php echo ($vo["id"]); ?>" ><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                    </span> <i></i></li><?php endif; ?>
                                                    <div style="display:none" id="skuNotice" class="sku_tip">
                                                        <span class="validateTips"></span>
                                                    </div>
                                <li><label>业主姓名</label><input name="name" id="name" type="text" class="dfinput" value="<?php echo ($info["name"]); ?>" /><i id="name_info">请输入真是姓名</i></li>
                                <li><label>业主电话</label><input name="mobile" id="mobile" type="text" class="dfinput" value="<?php echo ($info["mobile"]); ?>" /><i id="mobile_info">请输入真实电话</i></li>
                                <li><label>业主地址</label><input name="address" id="address" type="text" class="dfinput" value="<?php echo ($info["address"]); ?>" /><i id="address_info">请输入真实的地址</i></li> 
                                <input type ='hidden' value = "<?php echo ($info["property_id"]); ?>" id = "property">
                                    <input type="hidden" name = "id" value="<?php echo ($info["id"]); ?>">
                                        <li><label>&nbsp;</label><input name="" type="submit"
                                                                        class="btn btn-primary" value="确认<?php echo ($data["btn"]); ?>"
                                                                        onclick="javascript:;" /></li>
                                        </ul>
                                        </div>
                                        </form>
                                        </body>
                                        <!-- 给物业添加对应的属性 -->
                                        <script type="text/javascript">
                                            $(function(){
                                                var property = $('.pro_in');
                                                for(i=0;i<property.length;i++){            
                                                    if (property.eq(i).val() == $('#property').val()) {
                                                        property.eq(i).attr('selected','selected');
                                                    };           
                                                }
                                            })
                                        </script>
                                        </html>