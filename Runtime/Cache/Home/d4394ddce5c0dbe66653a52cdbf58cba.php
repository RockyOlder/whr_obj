<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
            <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/common.js"></script>

            <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
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
                            bValid = bValid && checkLength( $("#name"), "楼盘名字", 2, 16 );
                            bValid = bValid && checkEmpty( $("#info"), "楼盘不能为空！" );
                                 $("#info").removeClass('ui-state-error')
                         //   bValid = bValid && checkEmpty( $("#developer_id"), "开发商不能为空！" );
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
                        <span>后台管理：</span>
                        <ul class="placeul">
                            <li><a href="#">楼盘管理</a></li>
                            <li><a href="#">添加楼盘</a></li>
                        </ul>
                    </div>
                    <form action="" method="post" name ="vform">
                        <input type ="hidden" name="id" value="<?php echo ($info["id"]); ?>">
                            <input type ="hidden" name="action" value="<?php echo ($data["action"]); ?>">
                                <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                                    <div class="formbody">
                                        <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>
                                        <ul class="forminfo">
                                            <li><label>楼盘名字</label><input name="name" id="name" type="text" class="dfinput" value="<?php echo ($info["name"]); ?>" /><i id="name_info">名称不能超过30个字符</i></li>
                                            <li><label>楼盘信息</label><textarea rows="5"  cols='50' style="border:1px solid #A7B5BC" name ="info" id="info" value="<?php echo ($info["info"]); ?>"><?php echo ($info["info"]); ?></textarea><i>描述</i></li>
                                         <!--   <li><label>所属开发商</label>
                                                <select  class="form-control" name = 'developer_id' id="developer_id" style="width: 345px;height: 32px;" >
                                                    <option class="cheng_in" value="<?php echo ($info["did"]); ?>"><?php echo ($info["dname"]); ?></option>
                                                    <?php if(is_array($pro)): $i = 0; $__LIST__ = $pro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><option  value="<?php echo ($list["id"]); ?>"><?php echo ($list["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                </select></li> -->
                                            <li><label>&nbsp;</label><input name="" type="submit" class="btn btn-primary" value="确认<?php echo ($data["btn"]); ?>"  onclick="javascript:;" /></li>
                                        </ul>
                                        <div style="display:none" id="skuNotice" class="sku_tip">
                                            <span class="validateTips"></span>
                                        </div>
                                    </div>
                                    </form>
                                    </body>
                                    </html>