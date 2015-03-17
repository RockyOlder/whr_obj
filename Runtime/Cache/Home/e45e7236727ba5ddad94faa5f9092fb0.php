<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/App/Home/View/Public/Css/tableList.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
        <link id="artDialogSkin" href="/App/Home/View/Public/Css/skin/aero/aero.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
            <link href="/App/Home/View/Public/Css/calendor.css" rel="stylesheet" type="text/css" />
            <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/common.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
            <script language="javascript" type="text/javascript" src="/App/Home/View/Public/Js/My97DatePicker/WdatePicker.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/artDialog.js"></script>
            <script type="text/javascript">
                $(function(){
                    $( "#dialog-form" ).dialog({
                        width: 500,
                        autoOpen: false,
                        modal:true,
                        position:{
                            my: "center", 
                            at: "center", 
                            of:  window
                        }, 
                        buttons: {
                            "提　交":function(){
                                //     allFields.removeClass( "ui-state-error" );
                                if(checkInput()){
                                    $('form[name=myform]').submit();
                                }
                            },
                            "重　置":function(){
                                resetInput();	
                            }	
                        },
                        close: function() {
                            resetInput();
                        }
                    });
                    $("#ig_primary").click(function(){
                        $("button[title=close]").attr({ title: "关 闭"})
                        $("#dialog-form").dialog("option","title","添加活动");            
                        $("#dialog-form").dialog("open");
                    });
                    $(".dfinput").bind("focus",function(){
                        $(this).addClass("focus");
                        if($(this).hasClass("ui-state-error")){
                            $(this).removeClass( "ui-state-error" );
                            $(".validateTips").removeClass("errorTip").hide();	
                        }
                    }).bind("blur",function(){
                        $(this).removeClass("focus");

                    //    checkInput();
                    });
                    $( document ).tooltip({
                        track: true,
                        width: "100px",
                        position: {
                            my: "left+5 bottom-5", 
                            at: "center top"
                        }
                    });
                    initPager();
                });         
                var roleDataBak='{}';
                var allFields=$( [] );
                function update_list(subId){
                    $("button[title=close]").attr({ title: "关 闭"})
                    $("#dialog-form").dialog("option","title","编辑活动");
                    $("form[name=myform]").attr("action",$("#examUpdate").val());
                    //         alert($("#url_ajaxCalendar").val())
                    $.ajax({ 
                        url:$("#url_ajaxCalendar").val(),
                        type:"post",
                        dataType:"json",
                        cache:false,
                        data: {
                            "id":subId
                        },
                        timeout:30000,
                        error:function(data, msg){
                          //  alert("error:"+msg);
                        },
                        success:function(data){
                      //      console.log(data)
                               roleDataBak=data;
                            $("#add_id").val(data.id);
                            $("#title").val(data.title);

                            $("#d412").val(data.start_time);
                            $("#d413").val(data.end_time);
                            $("#action").val(data.action);
                            $("#dialog-form").dialog("open");
                        }
                    });
                }
                function checkInput(){
                    var bValid = true;
                    bValid = bValid && checkLength( $("#title"), "活动标题", 2, 16 );
                    bValid = bValid && checkEmpty( $("#d412"), "开始时间不能为空！" );
                         $("#d412").removeClass('ui-state-error')
                    bValid = bValid && checkEmpty( $("#d413"), "结束时间不能为空！" );
                         $("#d413").removeClass('ui-state-error')
                    return bValid;
                }
                function resetInput(){
                    if($("#add_id").val()==""){
                        $("#dialog-form input:text,#dialog-form input:hidden,#dialog-form textarea").each(function(){
                            $(this).val("");	
                        });
                        allFields.val("").removeClass("ui-state-error");
                        $(".validateTips").removeClass("errorTip").hide();
                    }else{
                        $("#title").val(roleDataBak.title);
                        $("#add_id").val(roleDataBak.id);
                        $("#d412").val(roleDataBak.d412);
                        $("#d413").val(roleDataBak.d413);
                
                    }
                }
                function cats_Shop(id) {
                    
                    art.dialog({
                        content:'你确定要删除？',
                        title: '确定框',  
                        okValue:'确认',  
                        cancelValue:'取消', 
                        width: 230,  
                        height: 100,  
                        fixed:true,
                        id:'bnt4_test',
                        style:'confirm'}, 
                    function(){
                        var msg = art.dialog({id:'bnt4_test'}).data.content; // 使用内置接口获取消息容器对象
                        if(msg){
                            location.href=$("#url_ajaxDelect").val()+id
                            return false;
                        }        
                    },function(){
                        return true;
                    });
                };
                
            </script>
    </head>
    <style type="text/css">
        .pro select{width: 345px;height: 32px; }
        .tiplist{ text-align: center; color: red; margin-left: 50px;}
        #ig_primary{float: right; margin-top: 3px;}
        #val_list{width: 345px;height: 32px;  margin-left: 85px;}
        .tiplist{ text-align: center; color: red; margin-left: 50px;}
        #table_list tr td{ padding: 7px;}
        .th_default{padding: 0 4px;}
        .divBtn {position:relative;display:inline-block;padding:3px;cursor:pointer}
        .tablelist td{line-height:35px; text-indent: 8px; border-right: dotted 1px #c7c7c7;}
    </style>

    <body style="background: none;">
   <input type="hidden" value="/index.php?s=/Home/Activity/act/id/" id="url_ajaxDelect" name="url_ajaxCalendar" />
        <div class="place">
            <span>位置： </span>
            <ul class="placeul">
                <li><a href="<?php echo U('Index/start','','');?>">首页</a></li>
                <li>活动列表</li>
                
            </ul>
        </div>
        <input type="hidden" value="/index.php?s=/Home/Activity/add" id="examUpdate" name="examUpdate" />
        <input type="hidden" value="/index.php?s=/Home/Activity/url_ajaxCalendar" id="url_ajaxCalendar" name="url_ajaxCalendar" />
        <li><label>&nbsp;</label><input id="ig_primary" type="submit" class="btn btn-primary" value="添加活动"  onclick="javascript:;" /></li>
        <table class="tablelist">
            <thead>
                <tr>

                    <th>活动标题</th>
                    <th>活动商品数量</th>         
                    <th>开始时间</th>
                    <th>结束时间</th>
                    <th colspan="3">操作</th>
                </tr>
            </thead>

            <tbody id="table_ajax_list">
                <?php if(is_array($into)): $i = 0; $__LIST__ = $into;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>

                        <td><?php echo ($vo["title"]); ?></td>
                        <td><?php echo ($vo["count"]); ?></td>
                        <td><?php echo (date("Y-m-d H:i:s",$vo["start_time"])); ?></td>
                        <td><?php echo (date("Y-m-d H:i:s",$vo["end_time"])); ?></td>      
                        <td width="20px" class="th_default" align="center"><a href="<?php echo U('Activity/index',array('id'=>$vo['id']));?>" class="divBtn editBtn ui-state-default ui-corner-all" title="查看详情" ><span class="ui-icon ui-icon-add"></span></a></td>
                        <td width="20px" class="th_default" align="center"  ><div class="divBtn editBtn ui-state-default ui-corner-all" title="编辑" onclick="update_list(<?php echo ($vo["id"]); ?>)"><span class="ui-icon ui-icon-pencil"></span></div></td>
                        <td width="20px" class="th_default" align="center"><div class="divBtn deleteBtn ui-state-default ui-corner-all" title="删除" onclick="cats_Shop(<?php echo ($vo["id"]); ?>)"><span class="ui-icon ui-icon-minus"></span></div></td>

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
        <div id="dialog-form" title="添加调查卷" style=" display:  none;">
            <div class="tiplist">
                <p class="validateTips"></p>
            </div>
            <form action="#" method="post" name="myform" class="form-input" />
            <input type ="hidden" name="id" value="<?php echo ($info["id"]); ?>">
                <input type ="hidden" name="action" id="action" value="<?php echo ($data["action"]); ?>">
                    <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                        <fieldset>
                            <table id="table_list" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="right" width="90px">
                                        <label for="title">活动标题：</label>
                                    </td>
                                    <td>
                                        <input name="title" id="title" type="text" class="dfinput"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <label for="content">开始时间：</label>
                                    </td>
                                    <td>
                                        <input readonly="readonly" name="start_time"  type="text" class="dfinputInfo" id="d412" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right" width="90px">
                                        <label for="author">结束时间：</label>
                                    </td>
                                    <td>
                                        <input readonly="readonly" name="end_time" type="text"  class="dfinputInfo" id="d413" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" />
                                        <!--    <input type="text" name="author" id="author" class="form-control" />  -->
                                    </td>
                                </tr>
                                <input type="hidden" name="id" id="add_id" value=""  />
                            </table>
                        </fieldset>
                        </form>
                        </div>

                        </body>
                        </html>