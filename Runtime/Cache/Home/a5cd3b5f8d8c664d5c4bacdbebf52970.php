<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/whr/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <!-- <link href="/whr/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" /> -->
        <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.js"></script>
        <script type="text/javascript" src="/whr/App/Home/View/Public/Js/common.js"></script>
        <script type="text/javascript" src=/whr/App/Home/View/Public/js/jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
        <script type="text/javascript" src ="/whr/App/Home/View/Public/ueditor/editor_config.js"></script>
        <script type="text/javascript" src ="/whr/App/Home/View/Public/ueditor/editor_all_min.js"></script>
        <script type="text/javascript" src='/whr/App/Home/View/Public/Js/jquery.uploadify.min.js'></script>
        <link rel="stylesheet" type="text/css" href="/whr/App/Home/View/Public/js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
            <link rel="stylesheet" type="text/css" href="/whr/App/Home/View/Public/Css/bootstrap.min.css">

                <link rel="stylesheet" href="/whr/App/Home/View/Public/Css/uploadify.css">

                    <script type="text/javascript">
                        $(function(){
                                      
                            function checkInput(){
                                var bValid = true;
                                bValid = bValid && checkLength( $("#name"), "用户名", 2, 16 );
                                //bValid = bValid && checkRegexp( $("#username"), /^[a-z]([0-9a-z_])+$/i, "用户名只能是数字和字母组成" );
                                bValid = bValid && checkLength( $("#password"), "密码", 6, 16 );
                                bValid = bValid && checkEquals( $("#password"),$("#password2"), "2次密码输入不一致！" );
                                //          bValid = bValid && checkLength( $("#name"), "地 址", 2, 30 );
                                //   bValid = bValid && ($("#mobile").val()=="" || checkRegexp( $("#mobile"), /(^1[0-9]{10}$)|(^00[1-9]{1}[0-9]{3,15}$)/ , "手机格式不正确！" ));
                                //   bValid = bValid && ($("#email").val()=="" || checkLength( $("#email"), "邮箱", 6, 80 ));
                                //   bValid = bValid && ($("#email").val()=="" || checkRegexp( $("#email"), /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "邮箱格式不正确！" ));
                                //   bValid = bValid && checkEmpty( $("#role"), "请选择角色！" );
                                //alert(checkEmpty( $("#role"), "请选择角色！" ));
                                return bValid;
                            }
                            function setout(){
                                $('.validateTips').text()
                                $('#skuNotice').show();
                                var dingshi= setTimeout( function(){
                                    $( '#skuNotice' ).fadeOut();
                                }, ( 1 * 1000 ) );  
                                return dingshi;
                            }
                            $('form').submit(function(){
                                if(!checkInput()){
                                    setout();
                                    return false;
                                }
                                return true
                            })
                            $(".dfinput").bind("focus",function(){
                                $(this).addClass("focus");
                                if($(this).hasClass("ui-state-error")){
                                    $(this).removeClass( "ui-state-error" );
                                    $(".validateTips").removeClass("errorTip").hide();	
                                    
                                }
                            }).bind("blur",function(){
                                $(this).removeClass("focus");
                                if($(this).val()==''){  setout();   }
                                checkInput();
                            });
                        })
                    </script>
                    <style type="text/css">
                        .pro{  float: left;line-height: 30px;margin-bottom: 10px; margin-left: 5px;}
                        .pro select{width: 345px;height: 32px; }
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
                                                <div style="display:none" id="skuNotice" class="sku_tip">
                                                    <span class="validateTips"></span>
                                                </div>
                                                <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>
                                                <ul class="forminfo">
                                                    <li><label>用户名</label><input name="user_name" id="name" type="text" class="dfinput" value="<?php echo ($info["user_name"]); ?>" /><i id="name_info">名称不能超过30个字符</i></li>
                                                  <!--  <li class="pwsave"><label>原始密码</label><input  type="password" class="dfinput"  /><i id="password_save">密码不能为空</i></li> -->
                                                    <li class="pwsave"><label>密码</label><input name="password" id="password" type="password" class="dfinput" value="<?php echo ($info["name"]); ?>" /><i id="password_info">密码不能为空</i></li>
                                                    <li class="pwsave"><label>确认密码</label><input name="password2" id="password2" type="password" class="dfinput" value="<?php echo ($info["name"]); ?>" /><i id="passwd_inf2">两次密码要一致</i></li>
                                                    <li><label>&nbsp;</label><input name="" type="submit" class="btn btn-primary" value="确认<?php echo ($data["btn"]); ?>"  onclick="javascript:;" /></li>
                                            </div>
                                            </form>
                                            </body>
                                            </html>