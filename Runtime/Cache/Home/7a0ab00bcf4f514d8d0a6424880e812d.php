<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/whr/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/whr/App/Home/View/Public/Css/tableList.css" rel="stylesheet" type="text/css" />
        <!-- <link href="/whr/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" /> -->
        <!-- <link rel="stylesheet" type="text/css" href="/whr/App/Home/View/Public/js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">  -->
        <link type="text/css" href="/whr/App/Home/View/Public/js/jquery-ui/css/start/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
        <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.js"></script>
        <link rel="stylesheet" type="text/css" href="/whr/App/Home/View/Public/Css/bootstrap.min.css">
            <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
            <script type="text/javascript">
                $(function(){
                    $( "#dialog-form" ).dialog({
                        width: 500,
                        
                        autoOpen: false,
                        modal:true,
                        position:{
                            my: "center", 
                            at: "center", 
                            of: window
                        }, 
                        buttons: {
                            "提　交":function(){
                                // allFields.removeClass( "ui-state-error" );
                         
                                $('form[name=myform]').submit();
                                
                            },
                            "重　置":function(){
                                //  resetInput();	
                            }	
                        },
        
                        close: function() {
                            //   $("#subject_id").val("");
                            //     resetInput();
                        }
                    });
                    $("#ig_primary").click(function(){
                        $("#dialog-form").dialog("option","title","添加调查表");            
                        $("#dialog-form").dialog("open");
                    });
                });         
            </script>
    </head>
    <style type="text/css">
        .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
        .pro select{width: 345px;height: 32px; }
        #val_list{width: 345px;height: 32px;  margin-left: 85px;}
        #table_list tr td{ padding: 7px;}
        #ig_primary{float: right; margin-top: 3px;}
    </style>

    <body style="background: none;">

        <div class="place">
            <span>后台管理：</span>
            <ul class="placeul">
                <li><a href="#">关键词管理</a></li>
                <li><a href="#">添加/修改关键词</a></li>
            </ul>
        </div>
        <li><label>&nbsp;</label><input id="ig_primary" type="submit" class="btn btn-primary" value="添加调查卷"  onclick="javascript:;" /></li>

        <div style="display:none" id="skuNotice" class="sku_tip">
            <span id="skuTitle2"></span>

            <div id="dialog-form" title="添加调查卷">
                <div class="tip">
                    <p class="validateTips"></p>
                </div>
                <form action="#" method="post" name="myform" class="form-input" />
                <input type ="hidden" name="id" value="<?php echo ($word["id"]); ?>">
                    <input type ="hidden" name="action" value="<?php echo ($data["action"]); ?>">
                        <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                            <input type="hidden" value="" id="subject_id" name="id" />
                            <fieldset>
                                <input type="hidden" id="hidRoleId" value="" />
                                <table id="table_list" width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td align="right" width="90px">
                                            <label for="title">公告标题：</label>
                                        </td>
                                        <td>
                                            <input type="text" name="title" id="title"  class="form-control" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <label for="content">公告内容：</label>
                                        </td>
                                        <td>
                                            <textarea rows="5"  cols='50' name="content" id="content" class="inputInfo ui-widget-content ui-corner-all"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" width="90px">
                                            <label for="author">发布人：</label>
                                        </td>
                                        <td>
                                            <input type="text" name="author" id="author" class="form-control" />
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                            </form>
                            </div>
                            </body>
                            </html>