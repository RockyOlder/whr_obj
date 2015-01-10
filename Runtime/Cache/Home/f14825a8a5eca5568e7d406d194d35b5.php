<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/whr/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/whr/App/Home/View/Public/Css/tableList.css" rel="stylesheet" type="text/css" />
        <link type="text/css" href="/whr/App/Home/View/Public/Js/jquery-ui/css/start/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
        <link href="/whr/App/Home/View/Public/Css/calendor.css" rel="stylesheet" type="text/css" />
        <!-- <link href="/whr/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" /> -->
        <!-- <link rel="stylesheet" type="text/css" href="/whr/App/Home/View/Public/js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">  -->

        <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.js"></script>
        <script type="text/javascript" src="/whr/App/Home/View/Public/Js/common.js"></script>
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
                                // allFields.removeClass( "ui-state-error" );#f8f7f6 url("images/ui-bg_fine-grain_10_f8f7f6_60x60.png") 50% 50% repeat
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
                    $( "#dialog-edit" ).dialog({
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
                                $('form[name=myname]').submit();
                            },
                            "重　置":function(){	
                            }	
                        },
                        close: function() {
                        }
                    });
                    $(".form-control").bind("focus",function(){
                        $(this).addClass("focus");
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
     
                    $("#ig_primary").click(function(){
                        $("button[title=close]").attr({ title: "关 闭"})
                        $("#dialog-form").dialog("option","title","规格添加");            
                        $("#dialog-form").dialog("open");
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
                function update_list(subId){
                    $("button[title=close]").attr({ title: "关 闭"})
                    $("#dialog-form").dialog("option","title","编辑");
                    $("form[name=myform]").attr("action",$("#examUpdate").val());
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
                            alert("error:"+msg);
                        },
                        success:function(data){
                            //       //roleDataBak=data;
                            console.log(data)
                            $("#top_cate").text(data.cat_name);
                            $("#add_id").val(data.id);
                            $("#name").val(data.name);
                            $("#action").val(data.action);
                            $("#dialog-form").dialog("open");
                        }
                    });
                }
                var roleDataBak='{}';
                var allFields=$( [] );
                function rule_add(subId){
                    $("button[title=close]").attr({ title: "关 闭"})
                    $("#dialog-edit").dialog("option","title","审核");
                    $("form[name=myname]").attr("action",$("#examUpdate").val());
                    $.ajax({ 
                        url:$("#url_ajaxCalendar").val(),
                        type:"post",
                        dataType:"json",
                        cache:false,
                        data: {
                            "id":subId
                        },
                        timeout:30000,
                        success:function(data){
                            //roleDataBak=data;
                            if(data.type != null){
                                var str=""
                                $.each(data.type,function(key,val){
                                    str += "<input type='text' name='type[]' class='form-control' value="+val+" />";
                                })
                                $("#table_add").html(str);
                               
                            }
                            //    console.log(data)
                            $("#role_id").val(data.id);
                            $("#dialog-edit").dialog("open");
                        }
                    });
                }
                function addDuty(){
                    var add=''
                    add="<input type='text' name='type[]' title='type' class='form-control' />";
                    $("#table_add").append(add)
                }
                function checkInput(){
                    var bValid = true;
                    //         bValid = bValid && checkLength( $("#title"), "商品名字", 2, 16 );
                    bValid = bValid && checkEmpty( $("#type_on"), "\u8bf7选择分类！" );
                    bValid = bValid && checkEmpty( $("#name"), "规格每个词已“|”为结束" );
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
                        $("#add_id").val(roleDataBak.id);
                        $("#top_cate").val(roleDataBak.cat_name);
                        $("#name").val(roleDataBak.name);
                
                    }
                }
            </script>
    </head>
    <style type="text/css">
        .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
        .pro select{width: 345px;height: 32px; }
        #val_list{width: 345px;height: 32px;  margin-left: 85px;}
        #table_list tr td{ padding: 10px;}
        #table_add input{ margin: 10px;}
        .role-list button{ width: 110px;}
        .th_default{padding: 0 3px;}
        .redclss{ color: red;}
        #ig_primary{float: right; margin-top: 3px;}
        .divBtn {position:relative;display:inline-block;padding:3px;cursor:pointer}
        .tablelist td{line-height:35px; text-indent: 10px; border-right: dotted 1px #c7c7c7;}
        .tiplist{ text-align: center; color: red; margin-left: 50px;}
    </style>

    <body style="background: none;">

        <div class="place">
            <span>后台管理：</span>
            <ul class="placeul">
                <li><a href="#">物业管理 </a></li>
                <li><a href="#">维修报障</a></li>
            </ul>
        </div>
        <input type="hidden" value="/whr/index.php?s=/Home/Category/cationType" id="examUpdate" name="examUpdate" />
        <input type="hidden" value="/whr/index.php?s=/Home/Category/url_ajaxhinder" id="url_ajaxCalendar" name="url_ajaxCalendar" />
        <input type="hidden" value="/whr/index.php?s=/Home/Category/ajax_rule" id="url_rule" name="url_rule" />
        <input type="hidden" value="<?php echo ($obj); ?>" id="model" />
        <li><label>&nbsp;</label><input id="ig_primary" type="submit" class="btn btn-primary" value="添加"  onclick="javascript:;" /></li>

        <div style="display:none" id="skuNotice" class="sku_tip">
            <span id="skuTitle2"></span>
        </div>
        <table class="tablelist">
            <thead>
                <tr>
                    <th><input name="" type="checkbox" value="" checked="checked"/></th>
                    <th>编号<i class="sort"><img src="/whr/App/Home/View/Public/Images/px.gif" /></i></th>
                    <th>分类名称</th> 
                    <th>商品规格</th>
                    <th colspan="3">操作</th>
                </tr>
            </thead>
            <tbody id="table_ajax_list">
                <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><input name="num" type="checkbox" value="" /></td>
                        <td><?php echo ($vo["id"]); ?></td>
                        <td><?php echo ($vo["cat_name"]); ?></td>
                        <td><?php echo ($vo["name"]); ?></td>
                        <!--   <td class="th_default">   
                         <div class="divBtn editBtn ui-state-default ui-corner-all" title="编辑" onclick="update_list(<?php echo ($vo["id"]); ?>)"><span class="ui-icon ui-icon-pencil"></span></div>
                        <!--   <a class="btn btn-default" >修改</a>    <!-- btn btn-danger -->
                        <!--     <a href="<?php echo U('del',array(id=>$vo['nid']),'');?>" class="btn btn-danger" onclick="if(confirm('确认删除')){return true}else{return false}"> 删除</a>
                             <a id="done_add" class="btn btn-info"   onclick="rule_add(<?php echo ($vo["id"]); ?>)">属性</a>

                    </td>-->
                        <td width="20px" class="th_default" align="center"  ><div class="divBtn editBtn ui-state-default ui-corner-all" title="编辑" onclick="update_list(<?php echo ($vo["id"]); ?>)"><span class="ui-icon ui-icon-pencil"></span></div></td>
                        <td width="20px" class="th_default" align="center"><div class="divBtn deleteBtn ui-state-default ui-corner-all" title="删除"onclick="if(confirm('确认删除')){return true}else{return false}"><span class="ui-icon ui-icon-minus"></span></div></td>
                        <td width="20px" class="th_default" align="center"><div class="divBtn addBtn ui-state-default ui-corner-all" title="添加属性" onclick="rule_add(<?php echo ($vo["id"]); ?>)"><span class="ui-icon ui-icon-plus"></span></div></td>

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

        <div id="dialog-form" title="" style=" display: none;">
            <div class="tiplist">
                <p class="validateTips"></p>
            </div>
            <form action="#" method="post" name="myform" class="form-input" />
            <input type ="hidden" name="action" id="action" value="<?php echo ($data["action"]); ?>">
                <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                    <fieldset>
                        <table id="table_list" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td align="right" width="90px">
                                    <label for="title">分类：</label>
                                </td>
                                <td>
                                    <select name = 'parent_id' id="type_on" class="form-control">
                                        <option id="top_cate" value=""></option>
                                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class = "top_cate"  value="<?php echo ($vo["cat_id"]); ?>"><?php echo ($vo["cat_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right">
                                    <label for="name">规格：</label>
                                </td>
                                <td>
                                    <textarea rows="10"  cols='50' name="name" id="name" class="form-control"></textarea>
                                </td>
                            </tr>
                            <input type="hidden" name="id" id="add_id"  />
                        </table>
                    </fieldset>
                    </form>
                    </div>
                    <div id="dialog-edit" title="问题提交" style=" display: none;">
                        <div class="tip">
                            <p class="validateTips"></p>
                        </div>
                        <form action="#" method="post" name="myname" class="form-input" />
                        <input type ="hidden" name="action" id="action2" value="edit" >
                            <fieldset>
                                <table id="table_list" width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td align="right" width="20px">

                                        </td>
                                        <td  align="center">
                                            <span style=" margin-left: -20px;"> <label for="title">添加属性</label></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" width="90px">

                                        </td>
                                        <td id="table_add">
                                            <input type="text" name="type[]" id="type"  class="form-control" />
                                        </td>
                                        <td width="20px" align="center"><div class="divBtn addBtn ui-state-default ui-corner-all" title="添加一个属性" onclick="addDuty()">
                                                <span class="ui-icon ui-icon-plus"></span></div>
                                        </td>
                                    </tr>
                                    <input type="hidden" name="id" id="role_id"  />
                                </table>
                            </fieldset>
                            </form>
                    </div>
                    </body>
                    </html>