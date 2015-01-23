<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/default/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <!-- <link href="/default/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" /> -->
        <script type="text/javascript" src="/default/App/Home/View/Public/Js/jquery.js"></script>
        <script type="text/javascript" src="/default/App/Home/View/Public/Js/common.js"></script>
        <link rel="stylesheet" type="text/css" href="/default/App/Home/View/Public/Js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
            <!-- <script type="text/javascript" src="/default/App/Home/View/Public/Js/jquery.idTabs.min.js"></script> -->
            <!-- <script type="text/javascript" src="/default/App/Home/View/Public/Js/select-ui.min.js"></script> -->
            <!-- <script type="text/javascript" src="/default/App/Home/View/Public/Js/kindeditor.js"></script> -->
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
                        bValid = bValid && checkLength( $("#name"), "用户名", 2, 16 );
                        bValid = bValid && checkEmpty( $("#owner"), "负责人不能为空！" );
                      //  bValid = bValid && checkEmpty( $("#addressAdd"), "请选择省市！" );
                       // bValid = bValid && checkEmpty( $("#city_list"), "请选择市区！" );
                        //bValid = bValid && checkEmpty( $("#val_list"), "请选择区县！" );
                        //bValid = bValid && (checkRegexp( $("#mobile_phone"), /(^1[0-9]{10}$)|(^00[1-9]{1}[0-9]{3,15}$)/ , "手机格式不正确！" ));
                        bValid = bValid && (checkRegexp( $("#phone"), /\d{3}-\d{8}|\d{4}-\d{7}/ , "电话格式不正确！" ));
                        //bValid = bValid && (checkRegexp( $("#email"), /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "邮箱格式不正确！" ));
                        //          bValid = bValid && checkLength( $("#name"), "地 址", 2, 30 );
                        //bValid = bValid && checkRegexp( $("#username"), /^[a-z]([0-9a-z_])+$/i, "用户名只能是数字和字母组成" );
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
    </head>
    <body style="background: none;">

        <div class="place">
            <span>后台管理：</span>
            <ul class="placeul">
                <li><a href="#">开发商管理</a></li>
                <li><a href="#">添加开发商</a></li>
            </ul>
        </div>
        <form action="" method="post" name ="vform">
            <input type ="hidden" name="id" value="<?php echo ($data["id"]); ?>">
                <input type ="hidden" name="id" value="<?php echo ($info["id"]); ?>">
                    <input type ="hidden" name="action" value="<?php echo ($data["action"]); ?>">
                        <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                            <div class="formbody">

                                <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>

                                <ul class="forminfo">
                                    <li><label>开发商名字</label><input name="name" id="name" type="text" class="dfinput" value="<?php echo ($info["name"]); ?>" /><i id="name_info">名称不能超过30个字符</i></li>
                                    <li><label>负 责 人</label><input name="owner" id="owner" type="text" class="dfinput"  value="<?php echo ($info["owner"]); ?>"/><i></i></li>
                                    <li><label>开发商电话</label><input name="phone" id="phone" type="text" class="dfinput"  value="<?php echo ($info["phone"]); ?>"/><i>电话号码</i></li>
                                    <li><label>开发商竞价</label><input name="sort" type="text" class="dfinput" value="<?php echo ($info["sort"]); ?>"/><i>竞价排序</i></li>
                                    <li><label>是否总部</label><cite><input name="father" type="radio" value="1" <?php if($info["parent"] == 0): ?>checked="checked"<?php endif; ?>/>是&nbsp;&nbsp;&nbsp;&nbsp;<input name="father" type="radio" value="0" <?php if($info["parent"] != 0): ?>checked="checked"<?php endif; ?>/>否</cite></li>
                                                    <li style="background:#F0F7FA;">温馨提示：如果添加总部下面的部分不用输入,直接点击添加</li>
                                                    <li><label>所属开发商</label><i>选择总部</i></li>
                                                    <li><label>开发商省份</label><input name="provence" type="text" class="dfinput" /><i>选择省份</i></li>
                                                    <li><label>开发商城市</label><input name="city" type="text" class="dfinput" /><i>选择城市</i></li>
                                                    <li><label>所属总部id</label><input name="pid" id="pid" type="text" class="dfinput" value="<?php echo ($info["pid"]); ?>"/><i>选择总部</i></li>
                                                    <li><label>备注</label><input name="notice" id="notice" type="text" class="dfinput" /><i></i></li>

                                                    <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="确认<?php echo ($data["btn"]); ?>"  onclick="javascript:;" /></li>
                                                    </ul>

                                                    </div>
                                                    </form>

                                                    </body>

                                                    </html>