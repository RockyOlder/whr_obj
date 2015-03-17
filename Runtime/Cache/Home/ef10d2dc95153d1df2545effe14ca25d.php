<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />

            <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/common.js"></script>

            <script type="text/javascript">

            </script>
    </head>
    <style type="text/css">
        .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
        #divTotlePrice{ height: 50px; background: url(/App/Home/View/Public/Images/righttop.gif) repeat-x; border: 0px; margin-top: 15px; }
        #centnRight{color:  red;  font-size: 18px; float: right; margin-top: 10px; margin-right: 50px;}
        #centnRight span{ color:  red;  font-size: 18px; }
        #addSubmit{ float: right; margin-top: 3px; text-align: center; font-size: 16px; line-height:}
        #tab2{ margin-left: 32%}
        #detailDialog {
           
            margin-left:15%;
            margin-top: 13px;
            height:auto;
            width:70%;
            display:none;
            -webkit-box-shadow: 0 0 10px #121a2a;
            box-shadow: 0 0 20px #121a2a;
            padding:20px;
            background-color:#FFF;
            cursor:move;
            z-index: 9999;
        }
        #detailDialog #close {
            position:absolute;
            right:10px;
            top:8px;
            width:15px;
            height:15px;
            line-height:11px;
            border:1px solid rosybrown;

            cursor:pointer
        }
        #detailDialog table,#detailDialog tr,#detailDialog td{
            border-color:#d9d6c4;
            background-color:#FFF;
            cursor:default
        }
        #detailDialog table {
            width:100%;
        }
        #detailDialog tr,#detailDialog td {
            height:40px;
        }
        #detailDialog td span {
            margin-left:10px;
            margin-right:10px;
            cursor:text
        }
        #detailDialog td{
            text-align:left;
        }
        #detailDialog .label{
            font-weight:600;
            color:#654b24;
            text-align:center;
        }
        #detailDialog .closeHover {
            background-color:#f391a9;
            color:#FFF
        }
        #detailDialog .closeMouseDown {
            background-color:#aa2116;
            color:#f6f5ec
        }
        .userOrder{ text-align: center; padding: 5px; color: red;}
        .userOrder h2{ font-size: 16px;}

    </style>

    <body style="background: none;">

        <div class="place">
            <span>位置：</span>
            <ul class="placeul">
                <li><a href="#">订单操作</a></li>
                <li><a href="#">订单详情</a></li>
            </ul>
        </div>
        <div class="userOrder"><h2>顾客订单信息</h2><hr style="height:1px;border:none;border-top:1px dashed #0066CC; margin-top: 10px;" ></div>
        <div id="detailDialog" style=" display: block;">
            <table cellpadding="0" cellspacing="0" border="1">
                <tr>
                    <td width="80px" class="label">订单编号</td>
                    <td width="120px"><span id="goods_name"><?php echo ($info["number"]); ?></span></td>
                    <td class="label">订单金额</td>
                    <td><span id="show_sex"><?php echo ($info["totle"]); ?></span></td>
                    <td rowspan="3" style="text-align:center" width="120px"><img src="<?php echo ($info["face"]); ?>" width="100px" height="110px"/></td>
                </tr>
                <tr>
                    <td width="80px" class="label">下单时间</td>
                    <td width="150px"><span id="price"><?php echo (date("Y-m-d H:i:s",$info["time"])); ?></span></td>
                    <td class="label">订单状态</td>
                    <td><span id="show_mobile"><?php echo ($info["statue"]); ?></span></td>
                </tr>
                <tr>
                    <td class="label"> 收货人</td>
                    <td><span id="if_show"><?php echo ($info["name"]); ?></span></td>
                    <td class="label">顾客电话</td>
                    <td><span id="number"><?php echo ($info["phone"]); ?></span></td>
                </tr>
                <tr>
                    <td class="label">收货地址</td>
                    <td><span id="cat_id"><?php echo ($info["area"]); ?></span></td>
                    <td class="label">具体地址</td>
                    <td><span id="store_id"><?php echo ($info["userAddress"]); ?></span></td>
                </tr>
	
            </table>
        </div>
        <div class="userOrder" style=" margin-top: 15px;"><h2>订单商品信息</h3><hr style="height:1px;border:none;border-top:1px dashed #0066CC; margin-top: 10px;" ></div>      
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


                                <div id="divTotlePrice" class="current ui-state-focus">
                                        <!--  <?php if($info["statue"] =='待发货' || $info["statue"] =='配货中' || $info["statue"] =='发货'): ?><a href="<?php echo U('index',array(id=>$info['oid']),'');?>"class="scbtn" id="addSubmit" >发货</a><?php endif; ?> -->

                                    <div id="centnRight">合计:<span id="priceTotal" class="priceSpan"><?php echo ($total); ?></span>元含(运费：<span id="priceFreight" class="priceSpan"><?php echo ($info["freight"]); ?></span>元)</div>

                                </div>
                                </form>

                                <script type="text/javascript">
                                    $('.imgtable tbody tr:odd').addClass('odd');
                                </script>

                                </body>

                                </html>