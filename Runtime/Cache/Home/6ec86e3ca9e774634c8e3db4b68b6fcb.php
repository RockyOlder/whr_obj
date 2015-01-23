<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/default/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/default/App/Home/View/Public/Css/tableList.css" rel="stylesheet" type="text/css" />
        <link type="text/css" href="/default/App/Home/View/Public/Js/jquery-ui/css/start/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
        <script type="text/javascript" src="/default/App/Home/View/Public/Js/jquery.js"></script>
        <script type="text/javascript" src="/default/App/Home/View/Public/Js/common.js"></script>
        <link rel="stylesheet" type="text/css" href="/default/App/Home/View/Public/Css/bootstrap.min.css">
            <script type="text/javascript" src="/default/App/Home/View/Public/Js/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
            <script type="text/javascript">
                var mycars=new Array("新订单","未付款","待发货","配货中","发货","发货中","待收货","已收货","评论后")
                $(function(){
                    $( "#dialog-edit" ).dialog({
                        width: 600,
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
                                if($("#role_id").val()!==''){ $('form[name=myname]').submit(); }   
                            }
                        },
                        close: function() {
                            $("#role_id").val('')
                          
                        }
                    });
                    
            /*        $( "#dialog-edit" ).dialog({
                        width: 600,
                        autoOpen: false,
                        modal:true,
                        position:{
                            my: "center", 
                            at: "center", 
                            of: window
                        },
                        close: function() {
                            resetInput();
                        }
                    });
          */
                    $("#ig_primary").click(function(){
                        $("#dialog-form").dialog("option","title","投诉建议");            
                        $("#dialog-form").dialog("open");
                    });

                    $(".role-list button").each(function () {
                 
                        if($(this).text()=='未付款'){
                            $(this).addClass("btn btn-danger")  
  
                        } else if($(this).text()=="新订单"){
                            $(this).addClass("btn btn-danger")  
                        }else if($(this).text()==2){
               
                        }else if($(this).text()==3){
        
                        }
                         
                    })
                    var endtotle=$("#totle").text()
                    initPager();
                });         
                function update_list(subId){
                    $("#dialog-form").dialog("option","title","修改投诉建议");
                    $("form[name=myform]").attr("action",$("#examUpdate").val());
                    //       alert(subId)
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

                            $("#role_id").val(data.oid);
                            $("#totleAll").val(data.totle);
                            $("#number").text(data.number);
                  
                            $("#bid").text(data.name);
                            $("#time").text(data.time);
                            $("#ordername").text(data.user_name);
                            $("#totle").text(data.totle);
                            $("#sumTotle").text(parseFloat(data.totle)+parseFloat(data.freight));
                            $("#freight").attr({ disabled:false})
                            $("#freight").val(data.freight)
                            $("#express").text(data.express);
                            $("#cate").text(data.cate);
                            $("#express_number").text(data.express_number);
                            if(data.statue==0 || data.statue==1){$("#dialog-edit").dialog("open");  }
                            
                            if(data.statue==0){ $("#statue").text(mycars[0])} else if(data.statue==1){$("#statue").text(mycars[1])}
                            if(data.statue==2){ $("#statue").text(mycars[2])} else if(data.statue==3){$("#statue").text(mycars[3])}
                            if(data.statue==4){ $("#statue").text(mycars[4])} else if(data.statue==5){$("#statue").text(mycars[5])} 
                            if(data.statue==6){ $("#statue").text(mycars[6])} else if(data.statue==7){$("#statue").text(mycars[7])}    
                            if(data.statue==8){ $("#statue").text(mycars[8])}  
                        }
                    });
                }
                 
                function rule_add(subId){
                    $("#dialog-edit").dialog("option","title","订单详情");
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
                            console.log(data)//attr({ checked: "checked"})srcIMG、、disabled="disabled"
                            // $("#role_id").val(data.oid);
                            $("#totleAll").val(data.totle);
                            $("#number").text(data.number);
      
                            $("#bid").text(data.name);
                            $("#time").text(data.time);
                            $("#ordername").text(data.user_name);
                            $("#totle").text(data.totle);
                            $("#sumTotle").text(parseFloat(data.totle)+parseFloat(data.freight));
                            $("#bill_type").text(data.bill_type);
                            $("#freight").attr({ disabled:'disabled'})
                            $("#freight").val(data.freight)
                            $("#express").text(data.express);
                            $("#cate").text(data.cate);
                            $("#express_number").text(data.express_number);
                            
                            if(data.statue==0){ $("#statue").text(mycars[0])} else if(data.statue==1){$("#statue").text(mycars[1])}
                            if(data.statue==2){ $("#statue").text(mycars[2])} else if(data.statue==3){$("#statue").text(mycars[3])}
                            if(data.statue==4){ $("#statue").text(mycars[4])} else if(data.statue==5){$("#statue").text(mycars[5])} 
                            if(data.statue==6){ $("#statue").text(mycars[6])} else if(data.statue==7){$("#statue").text(mycars[7])}    
                            if(data.statue==8){ $("#statue").text(mycars[8])}  
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
        #orderadd{ width: 95px;}
        .role-list{ width: 110px;}
        #ig_primary{float: right; margin-top: 3px;}
        .btn { width: 85px;height: 35px; }
        #freight{ width: 100px;}
    </style>

    <body style="background: none;">

        <div class="place">
            <span>后台管理：</span>
            <ul class="placeul">
                <li><a href="#">订单管理 </a></li>
                <li><a href="#">订单列表</a></li>
            </ul>
        </div>
        <input type="hidden" value="/default/index.php?s=/Home/Vip/order" id="examUpdate" name="examUpdate" />
        <input type="hidden" value="/default/index.php?s=/Home/Vip/urlAjaxOrderFind" id="url_ajaxCalendar" name="url_ajaxCalendar" />
        <input type="hidden" value="<?php echo ($obj); ?>" id="model" />
        <!--     <li><label>&nbsp;</label><input id="ig_primary" type="submit" class="btn btn-primary" value="投诉建议"  onclick="javascript:;" /></li>  -->

        <div style="display:none" id="skuNotice" class="sku_tip">
            <span id="skuTitle2"></span>
        </div>
        <table class="tablelist">
            <thead>
                <tr>
                    <th><input name="" type="checkbox" value="" checked="checked"/></th>
                    <th>订单ID<i class="sort"><img src="/default/App/Home/View/Public/Images/px.gif" /></i></th>
                    <th>订单编号</th>
                    <th>所属商家</th>
                    <th>购买者</th>
                    <th>总价格</th>
                    <th>发布时间</th>
                    <th>订单操作</th>
                    <th>其它操作</th>
                </tr>
            </thead>
            <tbody id="table_ajax_list">
                <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><input name="num" type="checkbox" value="" /></td>
                        <td><?php echo ($vo["oid"]); ?></td>
                        <td><?php echo ($vo["number"]); ?></td>
                        <td><?php echo ($vo["name"]); ?></td>
                        <td><?php echo ($vo["user_name"]); ?></td>
                        <td><?php echo ($vo["totle"]); ?></td>
                        <td><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></td>
                        <td class="role-list"><button class="btn btn-default" type="button" onclick="update_list(<?php echo ($vo["oid"]); ?>)"><?php echo ($vo["statue"]); ?></button></td> 
                        <td class="th_default">    
                            <!--  <a class="btn btn-default" onclick="update_list(<?php echo ($vo["rid"]); ?>)">修改</a>  发货   -->
                            <a href="<?php echo U('del',array(id=>$vo['oid']),'');?>" class="btn btn-default" onclick="if(confirm('确认删除')){return true}else{return false}"> 删除</a>
                            <a id="done_add" class="btn btn-default"   onclick="rule_add(<?php echo ($vo["oid"]); ?>)">详情</a>
                            <?php if( $vo["statue"] =='待发货' || $vo["statue"] =='配货中' || $vo["statue"] =='发货'): ?><a href="<?php echo U('order',array(id=>$vo['oid']),'');?>" id="done_add" class="btn btn-info" >发货</a><?php endif; ?>
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
                                <label for="number">订单编号：</label>
                            </td>
                            <td>
                                <span id="number" ></span>
                            </td>
                            <td rowspan="3" style="text-align:right">
                               
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <label for="bid">所属商家：</label>
                            </td>
                            <td>
                                <span id="bid" ></span>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <label for="statue">订单状态：</label>
                            </td>
                            <td>
                                <span id="statue" ></span>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <label for="time">订单日期：</label>
                            </td>
                            <td>
                                <span id="time" ></span>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" width="90px">
                                <label for="ordername">购买者：</label>
                            </td>
                            <td>
                                <span id="ordername"  /></span>
                            </td>
                        </tr>
                        <tr>    
                            <td align="right" width="90px">
                                <label for="totle">价格：</label>
                            </td>
                            <td>
                                <span id="totle"  /> </span>
                                <input type="hidden" name="totle" id="totleAll"  /> </span>
                            </td>
                        </tr>
                        <tr>    
                            <td align="right" width="90px">
                                <label for="bill_type">总价：</label>
                            </td>
                            <td>
                                <span id="sumTotle"  /> </span>
                            </td>
                        </tr>
                        <tr>    
                            <td align="right" width="90px">
                                <label for="freight ">运费：</label>
                            </td>
                            <td>
                                <input name="freight" id="freight" type="text" class="form-control" />
                            </td>
                        </tr>


                        <!--       <tr>    
<tr>    
             <td align="right" width="90px">
                 <label for="express">配送方式：</label>
             </td>
             <td>
                 <span id="express"  /> </span>
             </td>
         </tr>
             <td align="right" width="90px">
                 <label for="cate">订单分类：</label>
             </td>
             <td>
                 <span id="cate"  /> </span>
             </td>
         </tr>
         <tr>    
             <td align="right" width="90px">
                 <label for="express_number">快递编号：</label>
             </td>
             <td>
                 <span id="express_number"  /> </span>
             </td>
         </tr>
       <tr>
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
                        <input type="hidden" name="oid" id="role_id"  />
                    </table>
                </fieldset>
                </form>
        </div>
    </body>
</html>