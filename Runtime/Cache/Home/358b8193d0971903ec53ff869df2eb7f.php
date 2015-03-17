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
        <script type="text/javascript">
            $(function(){
                //简单验证
                var validate = {
                    'username' : false,
                    'rule':false
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
                jiance($('#name'),$('#name_info'))
                $('form').submit(function(){
                    $('#name').trigger('blur');
                    $('#rule').trigger('blur');
                    if($.trim($("#rule").val()) !== '0'){ validate.rule = true; }
                    if($.trim($("#name").val()) !== ''){ validate.username = true; }
                    
                    var isOK = validate.username;
                    var rule=validate.rule;  
                    if(!isOK){
                        return false;
                    }
                    return true;
            
                });
            })
        </script>
    </head>
    <style type="text/css">
        .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
        .pro select{width: 345px;height: 32px; }
    </style>

<body style="background: none;">

    <div class="place">
        <span>后台管理：</span>
        <ul class="placeul">
            <li>管理员管理</li>
            <li><?php echo ($data["title"]); ?></li>
        </ul>
    </div>
    <form action="" method="post" name="validateForm1">
        <input type ="hidden" name="id" value="<?php echo ($info["id"]); ?>">
        <input type ="hidden" name="action" value="<?php echo ($data["action"]); ?>">
        <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
        <div class="formbody">

                <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>

                <ul class="forminfo">
                    <li><label>用户名</label><input name="name" id="name" type="text" class="dfinput" value="<?php echo ($info["name"]); ?>" reg="\w{6,16}" tip="请输入6-16为数字或者字母"/><i id="name_info">名称不能超过16个字符</i></li>                    
                    <li><label>真实姓名</label><input name="true_name" id="flishtno" reg="\S+" type="text" class="dfinput" tip="请输入管理员姓名"  value="<?php echo ($info["true_name"]); ?>"/><i></i></li>
                    <li><label>手机</label><input name="mobile" reg="1\d{10}" tip="请输入手机号码" type="text" class="dfinput"  value="<?php echo ($info["mobile"]); ?>"/><i></i></li>
                    <li><label>邮箱</label><input name="email" type="text" class="dfinput"  value="<?php echo ($info["email"]); ?>" reg = "\w{3,20}@\w{3,20}" tip="请输入正确的邮箱地址"/><i></i></li>
                    <li style="position: relative;"><label>选择物业</label>
                        <span class = 'pro'>
                            <select name = 'property' id="property" reg="[^0]" tip="请选择物业" class="form-control" >
                                <option class="pro_into"  value="0">请选择物业</option>
                                <?php if(is_array($property)): $i = 0; $__LIST__ = $property;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo[id] == $info[property]): ?><option class = "top_cate" value="<?php echo ($vo["id"]); ?>"  selected="selected"><?php echo ($vo["pname"]); ?></option> 
                                   <?php else: ?>
                                    <option class = "top_cate" value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["pname"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </span>
                        <input type="hidden" value="<?php echo ($info["property"]); ?>" id="edit_property">
                        <i style="position: absolute;top: 7px;left: 430px;">物业管理员必须选择物业</i>
                    </li> 
                    <li style="position: relative;display:none;" id="hidden"><label>选择小区</label>
                        <span class = 'pro'>
                            <select name = 'village'  id ="village_list" class="form-control" reg="" tip="请选择小区">
                              <option value="0">请选择</option>
                          </select>
                        </span>
                        <input type="hidden" value="<?php echo ($info["village"]); ?>" id="edit_village">
                            <i style="position: absolute;top: 7px;left: 430px;">小区管理员必须选择小区，物业管理员可以不用选择</i>
                    </li> 
                     <li><label>选择角色</label>
                        <span class = 'pro'>
                            <select name = 'role_id' id="addressAdd" tip="一定要选择管理员所属的角色" reg="[^0]" class="form-control" >
                                <option class="pro_into"  value="0">请选择角色</option>
                                <?php if(is_array($rule)): $i = 0; $__LIST__ = $rule;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo[id] == $info[role_id]): ?><option class = "top_cate" value="<?php echo ($vo["id"]); ?>"  selected="selected"><?php echo ($vo["title"]); ?></option> 
                                   <?php else: ?>
                                    <option class = "top_cate" value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            </select></span>
                    </li>                   
                                     
                    <input type="hidden" id ="chenge_type" value="<?php echo ($info["type"]); ?>">
                    <input type="hidden" id ="chenge_shop" value="<?php echo ($info["shop_id"]); ?>">
                    <li><label>&nbsp;</label><input name="" type="submit" class="btn btn-info" value="确认"  onclick="javascript:;" /></li>
                </ul>
                <div style="display:none" id="skuNotice" class="sku_tip">
                    <span id="skuTitle2"></span>
                </div>
            </div>
        </form>

    </body>

<script type="text/javascript">
	$('#property').bind('change',village('#property'));
    function village(str){
            //  $('#vallage').hide(200);
            $(this).parent().next().css("color","#7f7f7f")
            var id =$(str).val();
            // alert(id);
            $.ajax({
                url : "<?php echo U('village','','');?>",
                type : "post",
                data : "id="+id,
                dataType : "json",
                success : function(data){                   
                    if(data != null){
                                                                                       
                        var str="<option  value='0' >请选择小区</option>"
                        $.each(data,function(key,val){
                            if ($('#edit_village').val() == val['id']) {
                                str += "<option  value="+val['id']+" selected='selected'>"+val['name']+"</option>";
                            }else{
                                str += "<option  value="+val['id']+" >"+val['name']+"</option>";
                            }
                            
                        })
                        //   $('#city_list').append(str)
                        $('#village_list').html(str);
                        $('#hidden').show(200);
                    }else{
                        $('#hidden').hide(200);
                        $('#village_list').html('');
                    }
                }
            });         
        }

</script>

</html>