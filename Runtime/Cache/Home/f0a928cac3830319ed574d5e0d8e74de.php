<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/App/Home/View/Public/Css/tableList.css" rel="stylesheet" type="text/css" />
        <link type="text/css" href="/App/Home/View/Public/Js/jquery-ui/css/start/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
        <link id="artDialogSkin" href="/App/Home/View/Public/Css/skin/aero/aero.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
        <script type="text/javascript" src="/App/Home/View/Public/Js/common.js"></script>
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
            <script type="text/javascript" src="/App/Home/View/Public/Js/select-ui.min.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/artDialog.js"></script>
            <script type="text/javascript">
           //      $mycars=Array("未付款","待发货","发货","配货中","发货中","待收货","已收货","评论后");
            var mycars=new Array("未付款","待发货","发货","配货中","发货中","待收货","已收货","评论后")
                $(document).ready(function(e) {
                    $(".select1").uedSelect({
                        width : 345           
                    });
                    $(".select2").uedSelect({
                        width : 167  
                    });
                    $(".select3").uedSelect({
                        width : 100
                    });
                });
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
                    var lstatue=$(".list_option").val();

                    if($(".list_option").val()==''){$(".list_option").text('请选择')}
                    if(lstatue==0 && lstatue!=''){ $(".list_option").text(mycars[0])} else if(lstatue==1){$(".list_option").text(mycars[1])}
                    if(lstatue==2){ $(".list_option").text(mycars[2])} else if(lstatue==3){$(".list_option").text(mycars[3])}
                    if(lstatue==4){ $(".list_option").text(mycars[4])} else if(lstatue==5){$(".list_option").text(mycars[5])} 
                    if(lstatue==6){ $(".list_option").text(mycars[6])} else if(lstatue==7){$(".list_option").text(mycars[7])}    

           
           $( "#dialog-form" ).dialog({
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
                                cats_Shop()
                            }
                        },
                        close: function() {
                         //   resetInput();
                        }
                    });
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
                function update_list(subId,cate){
                    $("#dialog-form").dialog("option","title","修改投诉建议");
                    $("form[name=myform]").attr("action",$("#examUpdate").val());
                    if(cate==0){ var order=$("#url_ajaxCalendar").val(); }else{ var order=$("#urlAjaxOrderVipFind").val();  }
                  
                    $.ajax({ 
                        url:order,
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
                            if(data.list_pic==null){ $("#srcImg").addClass("imgClass")}
                            $("#srcImg").attr({ src: data.list_pic});
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

                        }
                    });
                }
                 
                /*    function rule_add(subId,cate){
                    $("#dialog-edit").dialog("option","title","订单详情");
                    $("form[name=myname]").attr("action",$("#examUpdate").val());
                    if(cate==0){ var order=$("#url_ajaxCalendar").val(); }else{ var order=$("#urlAjaxOrderVipFind").val();  }
                    $.ajax({ 
                        url:order,
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
                            if(data.list_pic==null){ $("#srcImg").addClass("imgClass")}else{$("#srcImg").removeClass("imgClass")}
                            $("#srcImg").attr({ src: data.list_pic});
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
                 */
                function rule_delete(subId){
                   
                    $("#dialog-form").dialog("option","title","删除订单");
                    $("form[name=myform]").attr("action",$("#orderDEL").val());//deleteid
                    $("#deleteid").val(subId)
                  //   alert( $("#deleteid").val())
                    $("#dialog-form").dialog("open");
                //    alert(1)
                }
                    function cats_Shop() {
                    
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
                             //   location.href=$("#url_ajaxCalendar").val()+id
                              $('form[name=myform]').submit();
                                return false;
                            }        
                        },function(){
                            return true;
                        });
                    };
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
        .imgClass{ display: none;}
        .uew-select .uew-select-value{height:32px;padding:0 5px; margin-top:0px; margin-bottom:12px;line-height:32px;font-family:Tahoma,'微软雅黑','宋体';*font-family:'微软雅黑','宋体';color:#000;resize:none;border-width:1px;border-style:solid;border-color:#a7b5bc #ced9df #ced9df #a7b5bc;}
        .uew-border-flag,.uew-border-flag,textarea.uew-border-flag,.uew-select .uew-select-value.uew-border-flag{border-width:1px;border-style:solid;border-color:#bababa #e9e9e9 #e9e9e9 #bababa;}
        /***** 下拉框 *****/
        .uew-select{position:relative;}
        .uew-select .uew-select-value{z-index:1;position:relative;padding-right:20px;background:#fff;font-size:12px; text-indent:5px;background:url(../Images/inputbg.gif) repeat-x;_background:none;_border:none;}

        .uew-select .uew-icon{position:absolute;right:5px;top:10px;}
        .uew-select select{z-index:2;position:absolute;top:3px;_top:6px;cursor:pointer; height:28px;}
        /***** 去除聚焦虚线框 *****/
        a:focus,input[type=checkbox]:focus,input[type=radio]:focus,button:focus,select{outline:none;}

        option{overflow:auto;}
        .uew-icon,.ue-state-default .uew-icon{display:inline-block;width:16px;height:16px;background-image:url(../Images/uew_icon.png);}
        .ue-state-hover .uew-icon{background-image:url(../Images/uew_icon_hover.png);}
        .uew-icon-triangle-1-s{background-position:-80px 0;}

        .vocation,.usercity{float:left;}
        .cityleft{float:left; padding-right:10px;_padding-right:15px;}
        .cityright{float:left;}
    </style>

    <body style="background: none;">

        <div class="place">
             <span>位置： </span>
            <ul class="placeul">
                <li><a href="<?php echo U('Index/start','','');?>">首页</a></li>
                <li>订单列表</li>
            </ul>
        </div>
        <input type="hidden" value="/index.php?s=/Home/Order/order" id="examUpdate"  />
        <input type="hidden" value="/index.php?s=/Home/Order/urlAjaxOrderFind" id="url_ajaxCalendar" />
        <input type="hidden" value="/index.php?s=/Home/Order/urlAjaxOrderVipFind" id="urlAjaxOrderVipFind" />
        <input type="hidden" value="/index.php?s=/Home/Order/orderDel" id="orderDEL"  />
        <!--     <li><label>&nbsp;</label><input id="ig_primary" type="submit" class="btn btn-primary" value="投诉建议"  onclick="javascript:;" /></li>  -->
        <form action="" method="post" name ="vform" id="from_sub">
            <div  id="tab2" class="tabson">
                <ul class="seachform">
                    <li><label>订单编号</label><input name="number" type="text" class="scinput"value="" /></li>
                    <li><label>购买者</label>   <input name="user_name" type="text" class="scinput" value="" />  </li>
                    <li><label>订单状态</label>  
                        <div class="vocation">
                            <select class="form-control"name = 'statue' >
                                <option class = "list_option" value="<?php echo ($statue); ?>"></option>
                                <option class = "top_cate" value="0">未付款</option>
                                <option class = "top_cate" value="1">待发货</option>
                                <option class = "top_cate" value="2">发货</option>
                                <option class = "top_cate" value="3">配货中</option>
                                <option class = "top_cate" value="4">发货中</option>
                                <option class = "top_cate" value="5">待收货</option>
                                <option class = "top_cate" value="6">已收货</option>
                                <option class = "top_cate" value="7">评论后</option>
                            </select>
                        </div>
                    </li>
                    <li><label>&nbsp;</label><input name="" type="submit" class="scbtn" value="查询" id="like"/></li>
                </ul>
            </div>

            <div style="display:none" id="skuNotice" class="sku_tip">
                <span id="skuTitle2"></span>
            </div>
            <table class="tablelist">
                <thead>
                    <tr>

                        <th>订单ID<i class="sort"><img src="/App/Home/View/Public/Images/px.gif" /></i></th>
                        <th>订单编号</th>
                        <th>所属商家</th>
                        <th>购买者</th>
                        <th>总价格</th>
                        <th>发布时间</th>
                        <th>订单状态</th>
                        <th>订单操作</th>
                    </tr>
                </thead>
                <tbody id="table_ajax_list">
                    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>

                            <td><?php echo ($vo["oid"]); ?></td>
                            <td><?php echo ($vo["number"]); ?></td>
                            <td><?php echo ($vo["name"]); ?></td>
                            <td><?php echo ($vo["user_name"]); ?></td>
                            <td><?php echo ($vo["totle"]); ?></td>
                            <td><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></td>
                            <td class="role-list"><button class="btn btn-default" type="button" ><?php echo ($vo["statue"]); ?></button></td> 
                            <td class="th_default">    
                                <!--  <a class="btn btn-default" onclick="update_list(<?php echo ($vo["rid"]); ?>)">修改</a>  发货   -->
                                <a id="delete_Order" class="btn btn-default" onclick="rule_delete(<?php echo ($vo["oid"]); ?>)"> 删除</a>
                                <!--   <a id="done_add" class="btn btn-default"   onclick="rule_add(<?php echo ($vo["oid"]); ?>,<?php echo ($vo["cate"]); ?>)">详情</a> onclick="update_list(<?php echo ($vo["oid"]); ?>,<?php echo ($vo["cate"]); ?>)"-->
                                <a href="<?php echo U('index',array(fid=>$vo['oid']),'');?>" class="btn btn-default" >详情</a>
                             <!--   <?php if( $vo["statue"] =='待发货' || $vo["statue"] =='配货中' || $vo["statue"] =='发货'): ?><a href="<?php echo U('index',array(id=>$vo['oid']),'');?>" id="done_add" class="btn btn-info" >发货</a><?php endif; ?>-->
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
        </form>
        <div id="dialog-form" title="订单删除" style=" display: none;">
            <form action="#" method="post" name="myform" class="form-input" />
            <input type ="hidden" name="action" id="action" value="<?php echo ($data["action"]); ?>">
                <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                    <fieldset>
                        <table id="table_list" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td align="right">
                                    <label for="content">删除理由：</label>
                                </td>
                                <td>
                                    <textarea rows="5"  cols='50' name="content" id="content" class="inputInfo ui-widget-content ui-corner-all"></textarea>
                                </td>
                            </tr> 
                            <input type="hidden" name="oid" id="deleteid"  />
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
                                <label for="number">订单编号：</label>
                            </td>
                            <td>
                                <span id="number" ></span>
                            </td>
                            <td rowspan="3" style="text-align:right">
                                <img id="srcImg" src="" width="100px" height="110px"/>
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