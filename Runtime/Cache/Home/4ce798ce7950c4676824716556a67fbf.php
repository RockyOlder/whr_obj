<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo ($data["title"]); ?></title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
        <script src="/App/Home/View/Public/Js/jquery-1.8.3.min.js"></script>
        <script src="/App/Home/View/Public/Js/easy_validator.pack.js"></script>
        <link href="/App/Home/View/Public/Css/validate.css" rel="stylesheet" type="text/css">
        
    </head>
    

<body style="background: none;">

    <div class="place">
        <span>位置： </span>
        <ul class="placeul">
            <li><a href="<?php echo U('Index/start');?>">首页</a></li>
            <li>系统管理</li>
            <li><a href="<?php echo U('index');?>">快递公司列表</a></li>
            <li><?php echo ($data["title"]); ?></li>
        </ul>
    </div>
    <form action="" method="post" id ="vform">
            <div class="formbody">

                <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>

                <ul class="forminfo">
                    <li><label>快递公司名称</label><input name="name" id="name" type="text" class="dfinput" value="<?php echo ($info["name"]); ?>" url="<?php echo U('ajax_check_name');?>"/><i id="name_info">名称不能超过30个字符</i></li>
                   
                    <li><label>快递公司电话</label><input name="phone" reg="1\d{10}|0\d{2,3}-\d{7,8}" tip="请输入快递公司电话" type="text" class="dfinput"  value="<?php echo ($info["phone"]); ?>"/><i></i></li>
                    <li><label>每公斤价格</label><input name="price" type="text" class="dfinput"  value="<?php echo ($info["price"]); ?>"  reg="[1-9]\d*" tip="请输入每公斤价格" /><i></i></li>               
                    <?php if($info['id'] != ''): ?><input type="hidden" name="id" value="<?php echo ($info["id"]); ?>"><?php endif; ?>            
                    <input type="hidden" id ="url" value="<?php echo U('ajax_add');?>">
                    <li><label>&nbsp;</label><input name="" type="button" class="btn btn-info" value="确认"  onclick="check()" /></li>
                </ul>
                
            </div>
        </form>

    </body>
<script type="text/javascript">
function check(){
    var data = $('#vform').serialize();
    // alert(data['name']);
    var id = $('input[name=id]').val();
    if ($.trim(id) == '') {
        id =0;
    };
    var name = $('input[name=name]').val();
    var phone = $('input[name=phone]').val();
    var price = $('input[name=price]').val();
    if ($.trim(name) == '') {
        alert('快递公司名称不能为空')
    }else if($.trim(phone) == ''){
        alert('快递公司电话不能为空')
    }else if($.trim(price) == ''){
        alert('每公斤价格不能为空')
    }else{
        $.ajax({
            url:$('#url').val(),
            type:'post',
            data:data,
            dateType:'json',
            success:function(data){
                if (data ==1) {
                    if (id == 0) {
                        alert('快递公司添加成功！');
                    }else{
                        alert('快递公司修改成功！');
                    };                    
                    window.location.href="<?php echo U(index);?>"
                };
            },
            error:function(){
                alert('通讯被阻断');
            }

            });
    }
}
</script>
</html>