<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo ($data["title"]); ?></title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <!-- <link href="/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" /> -->
        <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
        <!-- <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.idTabs.min.js"></script> -->
        <!-- <script type="text/javascript" src="/App/Home/View/Public/Js/select-ui.min.js"></script> -->
        <!-- <script type="text/javascript" src="/App/Home/View/Public/Js/kindeditor.js"></script> -->
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
        <script src="/App/Home/View/Public/Js/jquery-1.8.3.min.js"></script>
        <script src="/App/Home/View/Public/Js/easy_validator.pack.js"></script>
        <link href="/App/Home/View/Public/Css/validate.css" rel="stylesheet" type="text/css">
      
    </head>
    <style type="text/css">
        .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
        .pro select{width: 345px;height: 32px; }
    </style>
    <script type="text/javascript">
    function check(){
        
        var url=$('#ajax_edit').val();
        var id=$('#id').val();
        var name=$('#name').val();
        var true_name=$('#true_name').val();
        var mobile=$('#mobile').val();
        var email=$('#email').val();
        var role_id=$('#role_id').val();
        if(role_id == 0){
            alert('你还没有选择角色');

        }else if(name == ''){
            alert('请输入管理员的登录名称');
        }else if(true_name == 0){
            alert('请输入管理员的登录名字');
        }else if(mobile == 0){
            alert('请输入管理员的登录电话');
        }else if(role_id == 0){
            alert('请输入管理员的登录邮箱');
        }else{
            
            $('#frmUserInfo').submit();
        };



    }
    </script>

<body style="background: none;">

    <div class="place">
        <span>后台管理：</span>
        <ul class="placeul">
            <li>管理员管理</li>
            <li><?php echo ($data["title"]); ?></li>
        </ul>
    </div>
    <form action="" method="post" name ="vform" id='frmUserInfo'>
        <input type ="hidden" name="id" id="id" value="<?php echo ($info["id"]); ?>">
            <div class="formbody">

                <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>

                <ul class="forminfo">
                    <li><label>用户名</label><input name="name" id="name" type="text" class="dfinput" value="<?php echo ($info["name"]); ?>" /><i id="name_info">名称不能超过30个字符</i></li>
                    
                    <li><label>真实姓名</label><input name="true_name" id="flishtno" reg="\S+" type="text" class="dfinput" tip="请输入管理员姓名"  value="<?php echo ($info["true_name"]); ?>"/><i></i></li>
                    <li><label>手机</label><input name="mobile" reg="1\d{10}" tip="请输入手机号码" type="text" class="dfinput"  value="<?php echo ($info["mobile"]); ?>"/><i></i></li>
                    <li><label>邮箱</label><input name="email" type="text" class="dfinput"  value="<?php echo ($info["email"]); ?>"/><i></i></li>
                     <li><label>角色</label>
                        <span class = 'pro'>
                            <select name = 'role_id' id="rule" reg="[^0]" tip="管理员角色一定要选择" class="form-control" >
                                <option class="pro_into"  value="0">请选择角色</option>
                                <?php if(is_array($rule)): $i = 0; $__LIST__ = $rule;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class = "top_cate" value="<?php echo ($vo["id"]); ?>"  selected="selected"><?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select></span>
                    </li>                   
                                     
                    <input type="hidden" id ="chenge_type" value="<?php echo ($info["type"]); ?>">
                    <input type="hidden" id ="chenge_shop" value="<?php echo ($info["shop_id"]); ?>">
                    <li><label>&nbsp;</label><input name="" type="button" class="btn btn-info" value="确认"  onclick="check()" /></li>
                </ul>
                
            </div>
        </form>
        <input type="hidden" value="<?php echo U(ajax_edit);?>" id="ajax_edit">
    </body>

</html>