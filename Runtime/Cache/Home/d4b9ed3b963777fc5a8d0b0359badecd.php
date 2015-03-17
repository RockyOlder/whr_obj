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
                          font-size: 14px}
        .right_one dl dd{line-height: 30px ;text-indent: 1.5em;
                         font-size: 12px}
        .right_two{border:3px solid #3EAFE0;width: 220px;height: 210px;position: fixed;top: 340px;right: 0px;border-radius: 5px; background: #fff}
        .right_two dl a{text-decoration: underline;display: block;}
        .right_two dl dt {line-height: 40px ;background: #49B3E1;text-indent: 2em;
                          font-size: 14px}
        .right_two dl a dd{line-height: 34px ;text-indent: 0.5em;
                           font-size: 12px}
        </style>
        <script type="text/javascript">
            $(function(){
                if($("#url_ajaxCalendar").val()==0) {  $("#sun").hide();}
                if($("#session_Property").val()=='') {var pro=1;}else{var pro=$("#session_Property").val()}
                if(pro==0) {  $("#new").hide();} 
            });
        </script>
        <body style="background:#f0f9fd;">
        <div class="place">
            <span>位置：</span>
            <ul class="placeul">
                <li><a href="<?php echo U('start');?>">首页</a></li>
            </ul>
        </div>
        <input type="hidden" value="<?php echo ($count["pro"]); ?>" id="url_ajaxCalendar"/>
        <input type="hidden" value="<?php echo ($count["property"]); ?>" id="session_Property"/>
        <div style="line-height:50px;font-size:15px;text-align:center">
            <?php echo ($_SESSION['admin']['true_name']); ?> 您好！欢迎你使用<?php echo ($_SESSION['admin']['top_name']); ?>。
        </div>
        <div id="start">
            <div class="start">
                <?php if($data["village"] != 0): ?><div class="little">
                        <a href="<?php echo U('Owner/index');?>">
                            <img class="background" src="/App/Home/View/Public/Images/start/house.png"width="100px" height="100px">
                                <p class="text"><span>住户列表</span></p>
                        </a>
                    </div><?php endif; ?>  
                <?php if($data["village"] != 0): ?><div class="little">
                        <a href="<?php echo U('Owner/get');?>">
                            <img class="background" src="/App/Home/View/Public/Images/start/house.png"width="100px" height="100px">
                                <p class="text"><span>导入住户信息</span></p>
                        </a>
                    </div><?php endif; ?>  
                <?php if($data["village"] != 0): ?><div class="little">
                        <a href="<?php echo U('Owner/app');?>">
                            <img class="background" src="/App/Home/View/Public/Images/start/house.png"width="100px" height="100px">
                                <p class="text"><span>住户申请列表</span></p>
                        </a>
                    </div><?php endif; ?>  
                <?php if($data["village"] != 0): ?><div class="little">
                        <a href="<?php echo U('Owner/bill');?>">
                            <img class="background" src="/App/Home/View/Public/Images/start/house.png"width="100px" height="100px">
                                <p class="text"><span>导入住户月账单</span></p>
                        </a>
                    </div><?php endif; ?>  
                <?php if($data["developer"] != 0): ?><div class="little">
                        <a href="<?php echo U('property/index');?>">
                            <img class="background" src="/App/Home/View/Public/Images/start/house.png"width="100px" height="100px">
                                <p class="text"><span>物业列表</span></p>
                        </a>
                    </div><?php endif; ?>    
                <?php if($data["developer"] != 0 || $data["property"] != 0): ?><div class="little">
                        <a href="<?php echo U('Village/index');?>">
                            <img class="background" src="/App/Home/View/Public/Images/start/house.png"width="100px" height="100px">
                                <p class="text"><span>小区列表</span></p>
                        </a>
                    </div><?php endif; ?>
                <?php if($data["developer"] != 0): ?><div class="little">
                        <a href="<?php echo U('Admin/index');?>">
                            <img class="background" src="/App/Home/View/Public/Images/start/house.png"width="100px" height="100px">
                                <p class="text"><span>管理员列表</span></p>
                        </a>
                    </div><?php endif; ?>    
                <?php if($data["property"] != 0): ?><div class="little"> 

                        <a href="<?php echo U('ProInfo/index');?>">
                            <img class="background" src="/App/Home/View/Public/Images/start/mms.png"width="100px" height="100px">
                                <p class="text"><span>社区资讯列表</span></p>
                        </a>
                    </div><?php endif; ?>    
                <?php if($data["property"] != 0): ?><div class="little"> 
                        <a href="<?php echo U('ProInfo/active');?>">
                            <img class="background" src="/App/Home/View/Public/Images/start/user.png"width="100px" height="100px">
                                <p class="text"><span>邻里活动</span></p>
                        </a>
                    </div><?php endif; ?>
            </div>
            <div class="start">
                <?php if($data["property"] != 0): ?><div class="little">    

                        <a href="<?php echo U('ProInfo/decorate');?>">
                            <img class="background" src="/App/Home/View/Public/Images/start/app.png"width="100px" height="100px">
                                <p class="text"><span>装修申请</span></p>
                        </a>
                    </div><?php endif; ?>
                <?php if($data["property"] != 0): ?><div class="little"> 
                        <a href="<?php echo U('ProInfo/hinder');?>">
                            <img class="background" src="/App/Home/View/Public/Images/start/life.png"width="100px" height="100px">
                                <p class="text"><span>维修申请</span></p>
                        </a>
                    </div><?php endif; ?>
                <?php if($data["property"] != 0): ?><div class="little"> 
                        <a href="<?php echo U('ProInfo/examine');?>">
                            <img class="background" src="/App/Home/View/Public/Images/start/diao.png"width="100px" height="100px">
                                <p class="text"><span>社区调查</span></p>
                        </a>
                    </div<?php endif; ?>

            </div>

        </div> 
        <div class="right_one">
            <dl>
                <dt>当天统计</dt>
                <dd id="sun">物业总数：<?php echo ($count["sum"]); ?></dd>
                <dd id="new">小区总数：<?php echo ($count["new"]); ?></dd>
                <dd>住户总数：<?php echo ($count["collect"]); ?></dd>
            </dl>
        </div>
        <div class="right_two">
            <dl>
                <dt>代办事宜</dt>
            <?php if($data["village"] != 0): ?><a href="<?php echo U('Owner/app');?>"><dd>住户申请：<?php echo ($count["v_count"]); ?></dd></a><?php endif; ?>
            </dl>
        </div>

    </body>

</html>