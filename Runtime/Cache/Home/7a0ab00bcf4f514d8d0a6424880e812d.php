<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/App/Home/View/Public/Css/tableList.css" rel="stylesheet" type="text/css" />
        <link type="text/css" href="/App/Home/View/Public/Js/jquery-ui/css/start/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
        <link href="/App/Home/View/Public/Css/calendor.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
        <script type="text/javascript" src="/App/Home/View/Public/Js/common.js"></script>
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
            <script type="text/javascript" src="/App/Home/View/Public/Js/artDialog.js"></script>
            <link id="artDialogSkin" href="/App/Home/View/Public/Css/skin/aero/aero.css" rel="stylesheet" type="text/css" />
            <script type="text/javascript" src="/App/Home/View/Public/Js/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
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
                        $("#dialog-form").dialog("option","title","添加调查表");            
                        $("#dialog-form").dialog("open");
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
                    $("#dialog-form").dialog("option","title","编辑调查");
                    $("form[name=myform]").attr("action",$("#examUpdate").val());
                    $.ajax({ 
                        url:$("#examUpdate").val(),
                        type:"post",
                        dataType:"json",
                        cache:false,
                        data: {
                            "pid":subId
                        },
                        timeout:30000,
                        error:function(data, msg){
                            alert("error:"+msg);
                        },
                        success:function(data){
                            console.log(data)
                            roleDataBak=data;
                            $("#title").val(data.title);
                            $("#add_id").val(data.id);
                            $("#content").val(data.content);
                            $("#author").val(data.author);
                            $("#action").val(data.action);
                            $("#dialog-form").dialog("open");
                        }
                    });
                }
                function checkInput(){
                    var bValid = true;
                    bValid = bValid && checkLength( $("#title"), "公告标题", 2, 16 );
                    bValid = bValid && checkEmpty( $("#content"), "公告内容不能为空！" );
                    //      bValid = bValid && checkEmpty( $("#author"), "发布人不能为空！" );
                    return bValid;
                }
                
                function resetInput(){
                    if($("#subject_id").val()==""){
                        $("#dialog-form input:text,#dialog-form input:hidden,#dialog-form textarea").each(function(){
                          // console.log($(this).attr({ disabled: "disabled"}))
                      
                            $(this).val("");	
                        });
                        $("#author").val($("#author_log").val())
                        allFields.val("").removeClass("ui-state-error");
                        $(".validateTips").removeClass("errorTip").hide();
                    }else{
                        $("#add_id").val(roleDataBak.id);
                        $("#title").val(roleDataBak.title);
                        $("#content").val(roleDataBak.content);
                        $("#author").val(roleDataBak.author);
                
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
                            location.href=$("#url_delete").val()+id
                            return false;
                        }        
                    },function(){
                        return true;
                    });
                };
            </script>
    </head>
    <style type="text/css">
        .tiplist{ text-align: center; color: red; margin-left: 50px;}
        .imgBtn {cursor:pointer}
        .pro select{width: 345px;height: 32px; }
        #val_list{width: 345px;height: 32px;  margin-left: 85px;}
        #table_list tr td{ padding: 7px;}

        .th_default{padding: 0 4px;}
        #ig_primary{float: right; margin-top: 3px;}
        .divBtn {position:relative;display:inline-block;padding:3px;cursor:pointer}
        .tablelist td{line-height:35px; text-indent: 8px; border-right: dotted 1px #c7c7c7;}
        #tab2{ float: left;}
    </style>

    <body style="background: none;">

        <div class="place">
    <span>位置： </span>
            <ul class="placeul">
                <li><a href="<?php echo U('Index/start','','');?>">首页</a></li>
                <li>添加/修改社区调查</li>
            </ul>
        </div>
              <input type="hidden" value="/server.php?s=/Home/ProInfo/Sudel/id/" id="url_delete" name="url_ajaxCalendar" />
        <input type="hidden" value="/server.php?s=/Home/ProInfo/examine" id="examUpdate" name="examUpdate" />
        <input type="hidden" value="/server.php?s=/Home/ProInfo/url_ajaxCalendar" id="url_ajaxCalendar" name="url_ajaxCalendar" />
         <input type="hidden"  id="author_log" class="form-control" value="<?php echo ($data["name"]); ?>" />
        <form action="" method="post" name ="vform" id="from_sub">
            <div  id="tab2" class="tabson">
                <ul class="seachform">
                    <li><label>标题</label><input name="title" type="text" class="scinput"value="" /></li>
                    <li><label>&nbsp;</label><input name="" type="submit" class="scbtn" value="查询" id="like"/></li>
                </ul>
            </div>
        </form>
        <li><label>&nbsp;</label><input id="ig_primary" type="submit" class="btn btn-primary" value="添加调查卷"  onclick="javascript:;" /></li>

        <div style="display:none" id="skuNotice" class="sku_tip">
            <span id="skuTitle2"></span>
        </div>
        <table class="tablelist" >
            <thead>
                <tr>

                    <th>编号<i class="sort"><img src="/App/Home/View/Public/Images/px.gif" /></i></th>
                    <th>调查标题</th>
                    <th>调查内容</th>
                    <th>发布人</th> 
                    <th>发布时间</th>
                    <th>过期时间</th>
                    <th>参与人数</th>
                    <th>非常满意</th>
                    <th>满意</th>
                    <th>一般</th>
                    <th>不满意</th>
                    <th>十分不满意</th>
                    <th colspan="3">操作</th>
                </tr>
            </thead>

            <tbody id="table_ajax_list">
                <?php if(is_array($pro)): $i = 0; $__LIST__ = $pro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($vo["id"]); ?></td>
                        <td><?php echo ($vo["title"]); ?></td>
                        <td><?php echo (msubstr($vo["content"],0,20,'utf-8',true)); ?></td>
                        <td><?php echo ($vo["author"]); ?></td>
                        <td><?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></td>      
                        <td><?php echo (date("Y-m-d H:i:s",$vo["pass_time"])); ?></td>   
                        <td><?php echo ($vo["number"]); ?></td>
                        <td><?php echo ($vo["survey_verygood"]); ?></td>
                        <td><?php echo ($vo["survey_good"]); ?></td>
                        <td><?php echo ($vo["survey_general"]); ?></td>
                        <td><?php echo ($vo["survey_nogood"]); ?></td>
                        <td><?php echo ($vo["survey_bad"]); ?></td>
                        <td width="20px" class="th_default" align="center"  ><div class="divBtn editBtn ui-state-default ui-corner-all" title="编辑" onclick="update_list(<?php echo ($vo["id"]); ?>)"><span class="ui-icon ui-icon-pencil"></span></div></td>
                        <td width="20px" class="th_default" align="center"><div class="divBtn deleteBtn ui-state-default ui-corner-all" title="删除" onclick="return cats_Shop(<?php echo ($vo["id"]); ?>)"><span class="ui-icon ui-icon-minus"></span></div></td>

                        <!--   <td width="30px"><img src="/App/Home/View/Public/Images/edit.gif" title="编辑" class="imgBtn" onclick="update_list(<?php echo ($vo["id"]); ?>)" /></td>
                         <td width="30px"><img src="/App/Home/View/Public/Images/delete.gif" title="删除" class="imgBtn" onclick="if(confirm('确认删除')){return true}else{return false}" /></td>
                           <a class="btn btn-default" title="编辑" onclick="update_list(<?php echo ($vo["id"]); ?>)">修改</a>    
                             <a href="<?php echo U('del',array(id=>$vo['nid']),'');?>" class="btn btn-danger" onclick="if(confirm('确认删除')){return true}else{return false}"> 删除</a> -->
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
        <div id="dialog-form" title="添加调查卷"  style=" display:  none;">
            <div class="tiplist">
                <p class="validateTips"></p>
            </div>
            <form action="#" method="post" name="myform" class="form-input" />
            <input type ="hidden" name="action" id="action" value="<?php echo ($data["action"]); ?>">
                <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                    <input type="hidden"  id="subject_id"  />
                    <fieldset>
                        <table id="table_list" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td align="right" width="90px">
                                    <label for="title">调查标题：</label>
                                </td>
                                <td>
                                    <input type="text" name="title" id="title"  class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td align="right">
                                    <label for="content">调查内容：</label>
                                </td>
                                <td>
                                    <textarea rows="5"  cols='50' name="content" id="content" class="form-control"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" width="90px">
                                    <label for="author">发布人：</label>
                                </td>
                                <td>
                                    <input type="text" name="author" id="author" class="form-control"  disabled="disabled" value="<?php echo ($data["name"]); ?>" />
                                </td>
                            </tr>
                            <input type="hidden" name="id" id="add_id" value=""  />
                        </table>
                    </fieldset>
                    </form>
                    </div>
                    </body>
                    </html>