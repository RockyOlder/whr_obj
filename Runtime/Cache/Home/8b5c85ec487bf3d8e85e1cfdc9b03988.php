<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/App/Home/View/Public/Css/tableList.css" rel="stylesheet" type="text/css" />
        <!-- <link href="/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" /> -->
        <!-- <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">  -->
        <link type="text/css" href="/App/Home/View/Public/Js/jquery-ui/css/start/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
        <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
        <script type="text/javascript" src="/App/Home/View/Public/Js/common.js"></script>
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
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
                    $("#ig_primary").click(function(){
                        $("#dialog-form").dialog("option","title","添加维修保障");            
                        $("#dialog-form").dialog("open");
                    });
                    
                    /*  $(".role-list button").each(function () {
                        if($(this).text()==1){
                            //   $(this).removeClass("btn btn-warning");
                            $(this).addClass("btn btn-success")  
                            $(this).text("已通过审核");
                        } else{
                            $(this).text("没通过审核"); 
                        }
                         
                    })
                     */
                    initPager();
                });         
                //     var roleDataBak='{}';
                //     var allFields=$( [] );
                function update_list(subId){
                    $("#dialog-form").dialog("option","title","编辑维修保障");
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
                            roleDataBak=data;
                            $("#add_id").val(data.id);
                            $("#title").val(data.title);
                            $("#owner").val(data.owner);
                            $("#content").val(data.content);
                            $("#address").val(data.address);
                            $("#phone").val(data.phone);
                            $("#action").val(data.action);
                            $("#dialog-form").dialog("open");
                        }
                    });
                }
                function rule_add(subId){
                    $("#dialog-edit").dialog("option","title","审核");
                    $("form[name=myname]").attr("action",$("#examUpdate").val());
                    $.ajax({ 
                        url:$("#examUpdate").val(),
                        type:"post",
                        dataType:"json",
                        cache:false,
                        data: {
                            "pid":subId
                        },
                        timeout:30000,
                        success:function(data){
                            //roleDataBak=data;titleadd
                      
                            $("#role_id").val(data.id);
                            $("#title2").text(data.title);
                            $("#titleADD").val(data.title)
                            $("#content2").text(data.content);
                            $("#address2").text(data.address);
                            $("#phone2").text(data.phone);
                            //   $("#action2").val(data.action);
                            //    alert($("#action2").val());
                            $("#dialog-edit").dialog("open");
                        }
                    });
                }
            </script>
    </head>
    <style type="text/css">
        .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
        .pro select{width: 345px;height: 32px; }
        #val_list{width: 345px;height: 32px;  margin-left: 85px;}
        #table_list tr td{ padding: 5px;}
        .th_default a{ width: 85px;}
        #ig_primary{float: right; margin-top: 3px;}
    </style>

    <body style="background: none;">

        <div class="place">
               <span>位置： </span>
            <ul class="placeul">
                <li><a href="<?php echo U('Index/start','','');?>">首页</a></li>
                <li>维修报障</li>
            </ul>
        </div>
        <input type="hidden" value="/index.php?s=/Home/ProInfo/hinder" id="examUpdate" name="examUpdate" />
        <input type="hidden" value="/index.php?s=/Home/ProInfo/url_ajaxhinder" id="url_ajaxCalendar" name="url_ajaxCalendar" />
   <!--     <li><label>&nbsp;</label><input id="ig_primary" type="submit" class="btn btn-primary" value="添加维修报障"  onclick="javascript:;" /></li> -->
            <form action="" method="post" name ="vform" id="from_sub">
                <div  id="tab2" class="tabson">
                    <ul class="seachform">
                        <li><label>标题</label><input name="title" type="text" class="scinput"value="" /></li>
                        <li><label>&nbsp;</label><input name="" type="submit" class="scbtn" value="查询" id="like"/></li>
                    </ul>
                </div>
            </form>
   
        <div style="display:none" id="skuNotice" class="sku_tip">
            <span id="skuTitle2"></span>
        </div>
        <table class="tablelist">
            <thead>
                <tr>

                    <th>编号<i class="sort"><img src="/App/Home/View/Public/Images/px.gif" /></i></th>
                    <th>业主名字</th> 
                    <th>维修标题</th>
                    <th>维修内容</th>
                    <th>故障地址</th>
                    <th>联系电话</th>
                    <th>发布时间</th>
                    <!--  <th>是否解决</th> -->
                    <th>操作</th>
                </tr>
            </thead>
            <tbody id="table_ajax_list">
                <?php if(is_array($pro)): $i = 0; $__LIST__ = $pro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>

                        <td><?php echo ($vo["id"]); ?></td>
                        <td><?php echo ($vo["owner"]); ?></td>
                        <td><?php echo ($vo["title"]); ?></td>
                        <td><?php echo (msubstr($vo["content"],0,20,'utf-8',true)); ?></td>
                        <td><?php echo ($vo["address"]); ?></td>
                        <td><?php echo ($vo["phone"]); ?></td>
                        <td><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></td>      
                        <!--     <td class="role-list"><button class="btn btn-default" type="button"><?php echo ($vo["done"]); ?></button></td> -->
                        <td class="th_default">    
                            <a href="<?php echo U('hinder',array(id=>$vo['id']),'');?>" class="btn btn-default" title="维修详情">维修详情</a>     
                          <!--  <a href="<?php echo U('del',array(id=>$vo['nid']),'');?>" class="btn btn-danger" onclick="if(confirm('确认删除')){return true}else{return false}"> 删除</a> -->
                            <a id="done_add" class="btn btn-info"   onclick="rule_add(<?php echo ($vo["id"]); ?>)"> 回复</a>
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

        <div id="dialog-form" title="添加调查卷" style=" display: none;">
            <div class="tiplist">
                <p class="validateTips"></p>
            </div>
            <form action="#" method="post" name="myform" class="form-input" />
            <input type ="hidden" name="action" id="action" value="<?php echo ($data["action"]); ?>">
                <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                    <input type="hidden" value="" id="subject_id" name="id" />
                    <fieldset>
                        <input type="hidden" id="hidRoleId" value="" />
                        <table id="table_list" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td align="right" width="110px">
                                    <label for="owner">业主名字：</label>
                                </td>
                                <td>
                                    <input type="text" name="owner" id="owner"  class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td align="right" width="110px">
                                    <label for="title">标题：</label>
                                </td>
                                <td>
                                    <input type="text" name="title" id="titleadd"  class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td align="right">
                                    <label for="content">内容：</label>
                                </td>
                                <td>
                                    <textarea rows="5"  cols='50' name="content" id="content" class="inputInfo ui-widget-content ui-corner-all"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" width="110px">
                                    <label for="address">地址：</label>
                                </td>
                                <td>
                                    <input type="text" name="address" id="address" class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td align="right" width="110px">
                                    <label for="phone">联系电话：</label>
                                </td>
                                <td>
                                    <input type="text" name="phone" id="phone" class="form-control" />
                                </td>
                            </tr>

                            <input type="hidden" name="rid" id="add_id"  />
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
                                        <td align="right" width="90px">
                                            <label for="title">标题：</label>
                                        </td>
                                        <td>
                                            <span id="title2"  /></span>
                                            <input type="hidden" name="title" id="titleADD"  class="form-control" />   
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <label for="content">内容：</label>

                                        </td>
                                        <td>
                                            <span id="content2" ></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" width="90px">
                                            <label for="address">地址：</label>
                                        </td>
                                        <td>
                                            <span id="address2"  /></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" width="90px">
                                            <label for="phone">联系电话：</label>
                                        </td>
                                        <td>
                                            <span id="phone2"  /> </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <label for="content">回复：</label>
                                        </td>
                                        <td>
                                            <textarea rows="5"  cols='50' name="content" id="content" class="inputInfo ui-widget-content ui-corner-all"></textarea>

                                        </td>
                                    </tr>

                                    <!--  <tr>
                                          <td align="right" width="90px">
                                              <label for="title">提交审核：</label>
                                          </td>
                                          <td>
                                              <select name = 'done' id="type_on" class="form-control">
                                                  <option class = "top_cate">请选择</option>
                                                  <option class = "top_cate"  value="0">未处理</option>
                                                  <option class = "top_cate" value="1" >正在处理</option>
                                              </select>
                                          </td>
                                      </tr>
                                      <input type="hidden" name="rid" id="role_id"  /> -->
                                    <input type="hidden" name="yid" id="role_id"  />
                                </table>
                            </fieldset>
                            </form>
                    </div>

                    </body>
                    </html>