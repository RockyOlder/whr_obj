<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>起始首页</title>
<link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
</head>
<style type="text/css">
    #start{height: 620px;width: 93%;padding: 20px;}
    #start .little{height: 200px;width: 100px;float: left;margin: 10px;margin-left: 10%}   
    #start .little  a{float: left;display: inline;}
    #start .little .text span{border-radius: 10px;padding: 2px 8px;color:#000000;}
    #start .little .text{text-align: center;margin-top: 10px;}
    .start{overflow: hidden;margin-left: 100px}
    .right_one{border:3px solid #3EAFE0;width: 220px;height: 220px;position: fixed;top: 100px;right: 0px;border-radius: 5px; background: #fff}
    .right_one dl {}
    .right_one dl dt {line-height: 40px ;background: #49B3E1;text-indent: 2em;
        font-size: 16px}
    .right_one dl dd{line-height: 30px ;text-indent: 1.5em;
        font-size: 15px}
    .right_two{border:3px solid #3EAFE0;width: 220px;height: 210px;position: fixed;top: 340px;right: 0px;border-radius: 5px; background: #fff}
    .right_two dl a{text-decoration: underline;display: block;}
    .right_two dl dt {line-height: 40px ;background: #49B3E1;text-indent: 2em;
        font-size: 16px}
    .right_two dl a dd{line-height: 34px ;text-indent: 0.5em;
        font-size: 15px}

</style>
<body style="background:#f0f9fd;">
	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="<?php echo U('start');?>">首页</a></li>
    </ul>
    </div>
    <div style="line-height:50px;font-size:15px;text-align:center">
        <?php echo ($_SESSION['admin']['true_name']); ?> 你好！欢迎你使用<?php echo ($_SESSION['admin']['top_name']); ?>后台管理系统
    </div>
    <div id="start">

        <div class="start">
        <div class="little"> 
           
            <a href="<?php echo U('Business/goodsadd');?>">
                <img class="background" src="/App/Home/View/Public/Images/start/good.png"width="100px" height="100px">
                <p class="text"><span>添加商品</span></p>
            </a>
        </div>
        <div class="little">    
            
            <a href="<?php echo U('Business/goods');?>">
                <img class="background" src="/App/Home/View/Public/Images/start/village.png"width="100px" height="100px">
                <p class="text"><span>商品列表</span></p>
            </a>
        </div>
        </div>
        <div class="start">
        <div class="little"> 
            <a href="<?php echo U('Business/order');?>">
                <img class="background" src="/App/Home/View/Public/Images/start/order.png"width="100px" height="100px">
                <p class="text"><span>订单管理</span></p>
            </a>
        </div>
        </div>
        <div class="start">
        
      <!--  <div class="little"> 
            <a href="<?php echo U('Admin/index');?>">
                <img class="background" src="/App/Home/View/Public/Images/start/admin.png"width="100px" height="100px">
                <p class="text"><span>管理员列表</span></p>
            </a>
        </div>
        
        <div class="little"> 
            <a href="<?php echo U('Role/index');?>">
                <img class="background" src="/App/Home/View/Public/Images/start/role.png"width="100px" height="100px">
                <p class="text"><span>角色列表</span></p>
            </a>
        </div>-->
    </div>
         
        
        
    </div> 
    <div class="right_one">
        <dl>
            <dt>当天统计</dt>
            <dd>关注本店会员总数：<?php echo ($count["collect"]); ?></dd>
            <dd>新订单总数：<?php echo ($count["new"]); ?></dd>
        </dl>
    </div>
    <div class="right_two">
        <dl>
            <dt>待办事宜</dt>
            <a href="<?php echo U('Business/order',array('statue'=>1));?>"><dd>待消费订单：<?php echo ($count["pay"]); ?></dd></a>
        </dl>
    </div>

</body>

</html>