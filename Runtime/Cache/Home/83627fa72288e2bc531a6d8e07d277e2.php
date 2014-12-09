<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加开发商</title>
<link href="/whr/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
<!-- <link href="/whr/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" /> -->
<script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.js"></script>
<!-- <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.idTabs.min.js"></script> -->
<!-- <script type="text/javascript" src="/whr/App/Home/View/Public/Js/select-ui.min.js"></script> -->
<!-- <script type="text/javascript" src="/whr/App/Home/View/Public/Js/kindeditor.js"></script> -->
<script type="text/javascript">
    $(function(){
         //简单验证
        var validate = {
            'username' : false
        };
        $('#name').blur(function(){
            if($.trim($(this).val()) == ''){
                $('#name_info').text('开发商名字不能为空').css('color','red');
                validate.username = false;
            }else{
                $('#username_info').text('');
                validate.username = true;
            }
        });
       
        $('form').submit(function(){
            $('#name').trigger('blur');
            var isOK = validate.username
            if(!isOK){
                
                return false;
            }

                return true;
            
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
        <li><label>开发商编号</label><input name="number" type="text" class="dfinput" value="<?php echo ($info["id"]); ?>" disabled="disabled"/><i>不用输入，系统自动生成</i></li>
        <li><label>开发商名字</label><input name="name" id="name" type="text" class="dfinput" value="<?php echo ($info["name"]); ?>" /><i id="name_info">名称不能超过30个字符</i></li>
        <li><label>负 责 人</label><input name="owner" type="text" class="dfinput"  value="<?php echo ($info["owner"]); ?>"/><i></i></li>
         <li><label>开发商电话</label><input name="phone" type="text" class="dfinput"  value="<?php echo ($info["phone"]); ?>"/><i>电话号码</i></li>
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