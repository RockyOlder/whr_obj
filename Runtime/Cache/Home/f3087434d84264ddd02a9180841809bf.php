<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>积分规则</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <!-- <link href="/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" /> -->
        <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>

<link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
    <script type="text/javascript" src="/App/Home/View/Public/Js/artDialog.js"></script>
<link id="artDialogSkin" href="/App/Home/View/Public/Css/skin/aero/aero.css" rel="stylesheet" type="text/css" />
           
<script type="text/javascript">
 $(function(){
            $('#queren').bind('click',function(){
            var url = $('#url_pass').val();                
            var _this = this;
            art.dialog({id:'menu_4834783', title:'菜单', content:'请输入密码：<input style="width:200px;border:1px solid #D0DEE5" id="M_dfd" type="password" value="" />',menuBtn:this,lock:true}, function(){
                var a = $('#M_dfd').val();

                if (a != '') {
                    $.ajax({
                    'url': url,
                    'data':{'password':a},
                    'dataType': 'json',
                    'type' : 'post',
                    'success':function(data){

                        if (data== 1) {
                            var id =$('input[name=id]').val();
                            var name =$('textarea').val();
                            var url = $('#post_ctrip').val()
                            $.ajax({
                                'url': url,
                                'data':{'id':id,'name':name},
                                'dataType': 'json',
                                'type' : 'post',
                                success:function(data){
                                    if (data == 1) {
                                        alert('修改成功');
                                    }else{
                                        alert('修改失败');
                                    };
                                },
                                error:function(data){
                                    alert('缺少参数');
                                }
                            })
                        }else{
                            alert('密码输入有误！');
                        }
                    },
                    
                    });
                };
                
            }).close(function(){
                _this.innerHTML = '弹出菜单';
            });
            _this.innerHTML = '关闭菜单';
                        
            return false;
            })
            
         })
      
</script>
    </head>
    <style type="text/css">
        .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
        .pro select{width: 345px;height: 32px; }
        #val_list{width: 345px;height: 32px;  margin-left: 85px;}
    </style>

    <body style="background: none;">

        <div class="place">
            <span>位置：</span>
            <ul class="placeul">
                <li><a href="<?php echo U('Index/start');?>">首页</a></li>
                <li>系统管理</li>
                <li>积分规则设置</li>
            </ul>
        </div>
        <input type="">
        <form action="" method="post" name ="vform">
            <input type ="hidden" name="id" value="<?php echo ($word["id"]); ?>">
            <input type ="hidden" name="action" value="<?php echo ($data["action"]); ?>">
            <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                <div class="formbody">
                <div class="formtitle"><span>积分规则</span></div>
                <ul class="forminfo">
                    <li><label>积分规则</label><textarea rows="5"  cols='50' style="border:1px solid #A7B5BC" name ="name" value="<?php echo ($word["name"]); ?>"><?php echo ($word["name"]); ?></textarea><i>前面是消费金额/后面是赠送积分</i></li>
                    <li><label>&nbsp;</label><input name="" type="button" class="btn btn-primary" value="确认修改积分规则"  onclick="javascript:;" id="queren"/></li>
                </ul>
                <div style="display:none" id="skuNotice" class="sku_tip">
                    <span id="skuTitle2"></span>
                </div>
            </div>
        </form>
        <input type="hidden" value="<?php echo U('Joggle/ajax_password');?>" id='url_pass'>
        <input type="hidden" value="<?php echo U('ajax_edit');?>" id='post_ctrip'>
    </body>
</html>