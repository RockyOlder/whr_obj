<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/whr/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />

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
                    
                    $( "#dialog-edit" ).dialog({
                        width: 500,
                        autoOpen: false,
                        modal:true,
                        position:{
                            my: "center", 
                            at: "center", 
                            of: window
                        },
                        close: function() {
                        }
                    });
                    $("#ig_primary").click(function(){
                        $("#dialog-form").dialog("option","title","投诉建议");            
                        $("#dialog-form").dialog("open");
                    });
                    
                    $(".role-list button").each(function () {
                        if($(this).text()==0){
                            //   $(this).removeClass("btn btn-warning");
                            $(this).addClass("btn btn-success")  
                            $(this).text("新订单");
                        } else if($(this).text()==1){
                            $(this).addClass("btn btn-warning")
                            $(this).text("未支付"); 
                        }
                         
                    })
                    
                    
                    
                });         
                //     var roleDataBak='{}';
                //     var allFields=$( [] );
         
                /*function update_list(subId){
                    $("#dialog-form").dialog("option","title","修改投诉建议");
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
                            //roleDataBak=data;
                            $("#add_id").val(data.rid);
                            $("#title").val(data.title);
                            $("#content").val(data.content);
                            $("#action").val(data.action);
                            $("#dialog-form").dialog("open");
                        }
                    });
                }
                 */
                function rule_add(subId){
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
                      
                            $("#role_id").val(data.rid);
                            $("#title2").text(data.title);
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
        #table_list tr td{ padding: 7px;}
        .th_default a{ width: 70px;}
        .th_default{ width: 300px;}
        #ig_primary{float: right; margin-top: 3px;}
    </style>

    <body style="background: none;">

        <div class="place">
            <span>后台管理：</span>
            <ul class="placeul">
                <li><a href="#">物业管理 </a></li>
                <li><a href="#">投诉建议</a></li>
            </ul>
        </div>
        <input type="hidden" value="/whr/index.php?s=/Home/Order/repair" id="examUpdate" name="examUpdate" />
        <input type="hidden" value="/whr/index.php?s=/Home/Order/url_ajaxrepair" id="url_ajaxCalendar" name="url_ajaxCalendar" />
        <input type="hidden" value="<?php echo ($obj); ?>" id="model" />
        <!--     <li><label>&nbsp;</label><input id="ig_primary" type="submit" class="btn btn-primary" value="投诉建议"  onclick="javascript:;" /></li>  -->

        <div style="display:none" id="skuNotice" class="sku_tip">
            <span id="skuTitle2"></span>
        </div>
        <table class="tablelist">
            <thead>
                <tr>

                    <th><input name="" type="checkbox" value="" checked="checked"/></th>
                    <th>订单编号<i class="sort"><img src="/whr/App/Home/View/Public/Images/px.gif" /></i></th>
                    <th>所属商家</th>
                    <th>所属商店</th>
                    <th>购买者</th>
                    <th>总价格</th>
                    <th>发布时间</th>
                    <th>订单状态</th>
                    <th>交易操作</th>
                    <th>其它操作</th>

                </tr>
            </thead>
            <tbody id="table_ajax_list">
                <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><input name="num" type="checkbox" value="" /></td>
                        <td><?php echo ($vo["number"]); ?></td>
                        <td><?php echo ($vo["bid"]); ?></td>
                        <td><?php echo ($vo["shop_id"]); ?></td>
                        <td><?php echo ($vo["ordername"]); ?></td>
                        <td><?php echo ($vo["totle"]); ?></td>
                        <td><?php echo ($vo["time"]); ?></td>
                        <td class="role-list"><button class="btn btn-default" type="button"><?php echo ($vo["statue"]); ?></button></td> 
                        <td><?php echo ($vo["is_end"]); ?></td>
                        <td class="th_default">    
                            <!--  <a class="btn btn-default" onclick="update_list(<?php echo ($vo["rid"]); ?>)">修改</a>     -->
                            <a href="<?php echo U('del',array(id=>$vo['nid']),'');?>" class="btn btn-danger" onclick="if(confirm('确认删除')){return true}else{return false}"> 修改</a>
                            <a id="done_add" class="btn btn-info"   onclick="rule_add(<?php echo ($vo["rid"]); ?>)">详情</a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>    
            </tbody>
        </table>

        <!--       <div id="dialog-form" title="装修申请" style=" display: none;">
                   <div class="tip">
                       <p class="validateTips"></p>
                   </div>
                   <form action="#" method="post" name="myform" class="form-input" />
                   <input type ="hidden" name="action" id="action" value="<?php echo ($data["action"]); ?>">
                       <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                           <fieldset>
                               <table id="table_list" width="100%" cellpadding="0" cellspacing="0" border="0">
                                   <tr>
                                       <td align="right" width="90px">
                                           <label for="title">投诉标题：</label>
                                       </td>
                                       <td>
                                           <input type="text" name="title" id="title"  class="form-control" />
                                       </td>
                                   </tr>
                                   <tr>
                                       <td align="right">
                                           <label for="content">内容：</label>
                                       </td>
                                       <td>
                                           <textarea rows="10"  cols='50' name="content" id="content" class="inputInfo ui-widget-content ui-corner-all"></textarea>
                                       </td>
                                   </tr>
                                   <input type="hidden" name="rid" id="add_id"  />
                               </table>
                           </fieldset>
                           </form>
                           </div>
        -->
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
                                <label for="title">维修标题：</label>
                            </td>
                            <td>
                                <span id="title2"  /></span>
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
                                <label for="address">故障地址：</label>
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

                        <!-- <tr>
                             <td align="right" width="90px">
                                 <label for="title">提交审核：</label>
                             </td>
                             <td>
                                 <select name = 'done' id="type_on" class="form-control">
                                     <option class = "top_cate">请选择</option>
                                     <option class = "top_cate"  value="0">未通过审核</option>
                                     <option class = "top_cate" value="1" >已审核</option>
                                 </select>
                             </td>
                         </tr>  -->
                        <input type="hidden" name="rid" id="role_id"  />
                    </table>
                </fieldset>
                </form>
        </div>
    </body>
</html>