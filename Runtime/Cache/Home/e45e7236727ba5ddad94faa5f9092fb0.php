<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/whr/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
                <link href="/whr/App/Home/View/Public/Css/tableList.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/whr/App/Home/View/Public/js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
            <link rel="stylesheet" type="text/css" href="/whr/App/Home/View/Public/Css/bootstrap.min.css">
                <!-- <link href="/whr/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" /> -->
                <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.js"></script>
                <script type="text/javascript" src="/whr/App/Home/View/Public/Js/common.js"></script>
                <script language="javascript" type="text/javascript" src="/whr/App/Home/View/Public/Js/My97DatePicker/WdatePicker.js"></script>

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
                            bValid = bValid && checkLength( $("#name"), "活动标题", 4, 16 );
                            bValid = bValid && checkEmpty( $("#d412"), "开始时间不能为空" );
                            bValid = bValid && checkEmpty( $("#d413"), "结束时间不能为空！" );
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
                        $(".dfinputInfo").bind("blur",function(){
                            if($(this).val()==''){ 
                                $(this).next().css("color","red"); 
                            }else{
                                $(this).next().css("color","#7f7f7f");
                                $(this).removeClass( "ui-state-error" );
                            }
                            checkInput();
                        })
                             initPager();
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
                            <li><a href="#">添加管理员</a></li>
                        </ul>
                    </div>
                    <form action="" method="post" name ="vform">
                        <input type ="hidden" name="id" value="<?php echo ($info["id"]); ?>">
                            <input type ="hidden" name="action" value="<?php echo ($data["action"]); ?>">
                                <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                                    <div class="formbody">
                                        <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>
                                        <ul class="forminfo">
                                            <li><label>活动标题</label><input name="title" id="name" type="text" class="dfinput" value="<?php echo ($info["title"]); ?>" /><i id="name_info">名称不能超过30个字符</i></li>
                                            <li><label>开始时间</label><input readonly="readonly" name="start_time"  type="text" value="<?php echo ($info["start_time"]); ?>" class="dfinputInfo" id="d412" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" /><i>开始时间不能为空</i></li>
                                            <li><label>结束时间</label><input readonly="readonly" name="end_time" type="text" value="<?php echo ($info["end_time"]); ?>" class="dfinputInfo" id="d413" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" /><i>结束时间不能为空</i></li>
                                            <li><label>&nbsp;</label><input name="" type="submit" class="btn btn-primary" value="确认<?php echo ($data["btn"]); ?>"  onclick="javascript:;" /></li>
                                        </ul>
                                        <div style="display:none" id="skuNotice" class="sku_tip">
                                            <span class="validateTips"></span>
                                        </div>
                                    </div>
                                    </form>

                                    <table class="tablelist">
                                        <thead>
                                            <tr>
                                                <th><input name="" type="checkbox" value="" checked="checked"/></th>
                                                <th>活动标题</th>
                                                <th>开始时间</th>
                                                <th>结束时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>

                                        <tbody id="table_ajax_list">
                                            <?php if(is_array($into)): $i = 0; $__LIST__ = $into;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                                    <td><input name="num" type="checkbox" value="" /></td>
                                                    <td><?php echo ($vo["title"]); ?></td>
                                                    <td><?php echo (date("Y-m-d H:i:s",$vo["start_time"])); ?></td>
                                                    <td><?php echo (date("Y-m-d H:i:s",$vo["end_time"])); ?></td>      
                                                    <td>
                                                        <a href="<?php echo U('add',array(id=>$vo['id']),'');?>" class="tablelink">修改</a>    

                                                        <a href="<?php echo U('del',array(id=>$vo['id']),'');?>" class="tablelink" onclick="if(confirm('确认删除')){return true}else{return false}"> 删除</a>
                                                    </td>
                                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>    
                                        </tbody>
                                    </table>
                                    <div id="pager" class="pager">
                                        <div class="fanye">
                                            <div class="fanye1">
                                                <?php echo ($page); ?>
                                            </div>
                                            <div class="fanye2">
                                                <span class="">共<?php echo ($currentPage); ?>/<?php echo ($totalPage); ?>页</span>
                                                转到<input type="text" value="<?php echo ($currentPage); ?>" id="gopage_input" class="ui-widget-header" />页&nbsp;
                                                <input type="button" value="确定" id="gopage_btn_confirm" />
                                            </div>
                                        </div>
                                    </div>
                                    </body>
                                    </html>