<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />

        <link href="/App/Home/View/Public/Css/tableList.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
                <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
                <script type="text/javascript" src="/App/Home/View/Public/Js/common.js"></script>
                <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.idTabs.min.js"></script>
                <script type="text/javascript" src="/App/Home/View/Public/Js/select-ui.min.js"></script>
                <script type="text/javascript" src="/App/Home/View/Public/Js/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
                <script language="javascript">
 
                    function deleteSum(id){
                        if(confirm("确认删除"))
                            location.href="/whr/index.php?s=/Home/Business/del/id/"+id
                    }
                </script>

                <script type="text/javascript">
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
                        if($("#express_id").val()==''){ $("#express_id").text("请选择");}
                        $('.scbtn').bind('click',function(){
                            $('#from_sub').submit();
                        });
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
                        $(".dfinput").bind("focus",function(){
                            //   alert(1)
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
                        //      initPager();
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
                            bValid = bValid && checkEmpty( $("#express_checkInput"), "\u8bf7选择快递！" );
                            $("#express_checkInput").removeClass('ui-state-error')
                            bValid = bValid && checkEmpty( $("#express_number"), "\u8fd0单号不能为空！" );
                            if(bValid==false){ setout(); }
                            return bValid;
                        }
                    });

                </script>
                </head>
                <style type="text/css">
                    .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
                    #divTotlePrice{ height: 50px; background: url(/App/Home/View/Public/Images/righttop.gif) repeat-x; border: 0px; }
                    #centnRight{color:  red;  font-size: 18px; float: right; margin-top: 10px; margin-right: 50px;}
                    #centnRight span{ color:  red;  font-size: 18px; }
                    #addSubmit{ float: right; margin-top: 3px;}
                    #tab2{ margin-left: 32%}
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
                        <span>位置：</span>
                        <ul class="placeul">
                            <li><a href="#">订单操作</a></li>
                            <li><a href="#">发货</a></li>
                        </ul>
                    </div>
                    <div class="rightinfo">
                        <input type="hidden" id="freight" name="freight" value="<?php echo ($find["freight"]); ?>"></input>

                        <form action="<?php echo U('order');?>" method="post" name ="vform" id="from_sub">
                            <input type ="hidden" name="oid" value="<?php echo ($find["oid"]); ?>">
                            <input type ="hidden" name="username" value="<?php echo ($username["user_name"]); ?>">
                            <input type ="hidden" name="username" value="<?php echo ($username["number"]); ?>">
                                <input type ="hidden" name="action" value="<?php echo ($find["action"]); ?>">
                                    <input type="hidden" name="totle" value="<?php echo ($total); ?>"></input>
                                    <table class="imgtable">
                                        <thead>
                                            <tr>
                                                <th width="100px;">图片</th>
                                                <th>订单编号</th>
                                                <th>商品名字</th>
                                                <th>购买数量</th>
                                                <th>总价格</th>
                                                <th>发布时间</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                                    <!--  / -->
                                                    <td class="imgtd"><img src="<?php echo ($vo["list_pic"]); ?>" width="50px"/></td>
                                                    <td><?php echo ($vo["order_number"]); ?></td>
                                                    <td><?php echo ($vo["good_name"]); ?></td>
                                                    <td><?php echo ($vo["info_number"]); ?></td>
                                                    <td class="info_totle"><?php echo ($vo["info_totle"]); ?></td>
                                                    <td><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></td>
                                                </tr>
                                                <!--   <input type="hidden" id="freight" name="freight" value="<?php echo ($vo["freight"]); ?>"></input> --><?php endforeach; endif; else: echo "" ;endif; ?>  

                                        </tbody>

                                    </table>
                                    <div style="display:none" id="skuNotice" class="sku_tip">
                                        <span class="validateTips"></span>
                                    </div>
                                    <div  id="tab2" class="tabson">
                                        <ul class="seachform">
                                            <li><label>选择快递</label>  
                                                <div class="vocation">
                                                    <select class="form-control" name = 'express' id="express_checkInput" >
                                                        <option class="pro_into" id="express_id" value="<?php echo ($expressFind["id"]); ?>" ><?php echo ($expressFind["name"]); ?></option>
                                                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$express): $mod = ($i % 2 );++$i;?><option name = 'express' class = "top_cate" value="<?php echo ($express["id"]); ?>"><?php echo ($express["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select>
                                                </div>
                                            </li>
                                            <li><label>运单号</label><input name="express_number" type="text" id="express_number" class="dfinput"value="" /></li>
                                        </ul>
                                    </div>

                                    <div id="divTotlePrice" class="current ui-state-focus">
                                         <?php if($_SESSION['admin']['type']== 1): ?><input name="" type="button" class="scbtn" id="addSubmit"  value="发货" id="like"/><?php endif; ?>
                                        <div id="centnRight">合计:<span id="priceTotal" class="priceSpan"><?php echo ($total); ?></span>元含(运费：<span id="priceFreight" class="priceSpan"><?php echo ($find["freight"]); ?></span>元)</div>

                                    </div>
                                    </form>

                                    <script type="text/javascript">
                                        $('.imgtable tbody tr:odd').addClass('odd');
                                    </script>

                                    </body>

                                    </html>