<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加角色</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <!-- <link href="/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" /> -->
        <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
        <!-- <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.idTabs.min.js"></script> -->
        <!-- <script type="text/javascript" src="/App/Home/View/Public/Js/select-ui.min.js"></script> -->
        <!-- <script type="text/javascript" src="/App/Home/View/Public/Js/kindeditor.js"></script> -->
        <script type="text/javascript">
            $(function(){
                //简单验证
                var validate = {
                    'username' : false,
                    'des' : false
                };
                var cats_Shop=function (item,string) {
                    var prev=item.prev().text();
                    var next_on= item.next()
                    next_on.text(prev+string).css('color','red');
                    $('#skuTitle2').text(prev+string)
                    $('#skuNotice').show();
                    setTimeout( function(){
                        $( '#skuNotice' ).fadeOut();
                    }, ( 1 * 1000 ) ); 
                }
                var jiance=function (item,info) {
                    $(item).blur(function(){
                        if($.trim($(this).val()) == ''){
                            cats_Shop(item,'不能为空')
                        }else{
                            info.text('');
                        }
                    });
                }
                jiance($('#username'),$('#name_info'))
                jiance($('#des'),$('#password_info'))
                $('form').submit(function(){
                    $('#username').trigger('blur');
                    $('#des').trigger('blur');
                    if($.trim($("#username").val()) !== ''){ validate.username = true; }
                    if($.trim($("#des").val()) !== ''){ validate.des = true; }
                    var isOK = validate.username;
                    var psw=validate.des;     
                    if(!isOK || !psw){
                        return false;
                    }
                    return true;
            
                });
            })
        </script>
    </head>
    <style type="text/css">
        .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}

    </style>

    <body style="background: none;">

        <div class="place">
            <span>位置： </span>
            <ul class="placeul">
                <li><a href="<?php echo U('Index/start');?>">首页</a></li>
                <li>系统管理</li>
                <li><a href="<?php echo U('Role/index');?>">角色列表</a></li>
                <li>添加角色</li>
            </ul>
        </div>
        <form action="" method="post" name ="vform">
            <input type ="hidden" name="id" value="<?php echo ($info["id"]); ?>">
            <input type ="hidden" name="pid" value="<?php echo ($_SESSION['admin']['role_id']); ?>">
           
            <div class="formbody">

                <div class="formtitle"><span><?php echo ($data["title"]); ?>角色</span></div>

                <ul class="forminfo">
                    <li><label>角色名</label><input name="title" id="username" type="text" class="dfinput" value="<?php echo ($info["title"]); ?>" /><i id="name_info">角色名不能超过30个字符</i></li>
                    <li><label>权限描述</label><input name="des" id="des" type="text" class="dfinput" value = "<?php echo ($info["description"]); ?>" /><i id="password_info">权限描述不能为空</i></li>
              

                    <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="确认<?php echo ($data["btn"]); ?>"  onclick="javascript:;" /></li>
                </ul>
                <div style="display:none" id="skuNotice" class="sku_tip">
                    <span id="skuTitle2"></span>
                </div>
            </div>
        </form>

    </body>

</html>