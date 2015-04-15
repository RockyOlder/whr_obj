<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo ($info["title"]); ?></title>
    <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
    <style type="text/css">
        #info ul{height: auto;width: 100%;margin: 15px 35px;overflow: hidden;}
        #info ul li{height: 30px;width: 40%;float: left;text-indent: 2em;overflow: hidden;}
        #info2 ul{height: auto;width: 100%;margin: 15px 35px;overflow: hidden;}
        #info2 ul li{height: 80px;width: 40%;float: left;text-indent: 2em;}
    </style>
</head>
<body style="background: #FFFFFF;">
    <div class="place">

        <ul class="placeul">
            <li>位置：</li>
            <li><a href="<?php echo U('Index/start');?>">首页</a></li>
            <li>商家管理</li>
            <li><a href="<?php echo U('SellerApp/vip');?>">VIP商家申请列表</a></li>
            <li><?php echo ($info["title"]); ?></li>
        </ul>
    </div>
    <div class="box">
        <div>
            <div class="title">
                <div style="text-align: center;font-size: 18px;height: 35px;">管理员信息</div>
                <div style="border:1px solid #D4E7F0;width:94%;margin:0 auto;"></div>
                <div id="info">
                    <ul>
                        <li>登录名：<?php echo ($info["name"]); ?></li>
                        <li>绑定电话：<?php echo ($info["mobile"]); ?></li>
                        <li>绑定邮箱：<?php echo ($info["email"]); ?></li>
                        <li>真实姓名：<?php echo ($info["true_name"]); ?></li>
                    </ul>
                </div>
                
            </div>
            <div class="title">
                <div style="text-align: center;font-size: 18px;height: 35px;">店铺相关基本信息</div>
                <div style="border:1px solid #D4E7F0;width:94%;margin:0 auto;"></div>
                <div id="info2">
                    <ul  data-role="listview">
                        <li>店铺名称：<?php echo ($shop["name"]); echo ($shop["store_name"]); ?></li>
                        <li>店铺地址：<?php echo ($shop["address"]); ?></li>
                        
                        <li><span>营业执照：</span><img src="<?php echo ($shop["permit"]); ?>" alt="店铺营业执照" width="50" /></li>
                        <li><span>税务登记证：</span><img src="<?php echo ($shop["tax"]); ?>" alt="税务登记证" width="50" /></li>
                        <li><span>组织机构证：</span><img src="<?php echo ($shop["organize"]); ?>" alt="组织机构证" width="50" /></li>
                        <li><span>企业营业执照：</span><img src="<?php echo ($shop["company"]); ?>" alt="企业营业执照" width="50" /></li>
                        <li><span>基本开户许可证：</span><img src="<?php echo ($shop["basic"]); ?>" alt="基本开户许可证" width="50" /></li>
                        <li><span>负责人身份证：</span><img src="<?php echo ($shop["owner"]); ?>" alt="负责人身份证" width="50" /></li>
                        <li><span>代理人身份证：</span><img src="<?php echo ($shop["agent"]); ?>" alt="代理人身份证" width="50" /></li>
                        <li><span>慧锐通授权书：</span><img src="<?php echo ($shop["authz"]); ?>" alt="慧锐通授权书" width="50" /></li>
                    </ul>
                </div>
                
            </div>
            <div class="btn_pass" style="text-align: center;margin: 20px 0px;">
                <input type="hidden" name="ajax_pass" value="<?php echo U('toPass');?>">
                <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
                <input type="button" name="" id="pass" value="通过" data-mini="true" style="background: #008000;border-radius: 5px !important;color: #FFFFFF;padding: 7px 30px;font-size: 16px;letter-spacing: 10px;font-weight: 700;"/>
            </div>
            <div id="end_copy" style="text-align: center;font-size: 16px;">
                <?php echo (C("web_copy")); ?>
            </div>
        </div>
    </div>  
</body>
	
	<script type="text/javascript">
        $('#pass').click(function(){
            var id = $('input[name=id]').val();
            var url = $('input[name=ajax_pass]').val();
            $.ajax({
            	type:"post",
            	url:url,
            	data:{'id':id,'life':0},
            	success:function(data){
            		if(data){
            			alert('操作成功');
            			location.href="<?php echo U('vip');?>";            			
            		}else{
            			alert('操作失败');
            		}
            	},
            	error:function(){
            		alert('操作失败');
            	}
            	
            });
        })
    </script>
</html>