<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加开发商</title>
        <link href="/default/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <!-- <link href="/default/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" /> -->
        <script type="text/javascript" src="/default/App/Home/View/Public/Js/jquery.js"></script>

        <link rel="stylesheet" type="text/css" href="/default/App/Home/View/Public/Css/bootstrap.min.css">
            <!-- <script type="text/javascript" src="/default/App/Home/View/Public/Js/jquery.idTabs.min.js"></script> -->
            <!-- <script type="text/javascript" src="/default/App/Home/View/Public/Js/select-ui.min.js"></script> -->
            <!-- <script type="text/javascript" src="/default/App/Home/View/Public/Js/kindeditor.js"></script> -->
            <script type="text/javascript">
                $(function(){
                  
                });         
            </script>
    </head>
    <style type="text/css">
        .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
        .pro select{width: 345px;height: 32px; }
        #val_list{width: 345px;height: 32px;  margin-left: 85px;}
    </style>

    <body style="background: none;">

        <div class="place">
            <span>后台管理：</span>
            <ul class="placeul">
                <li><a href="#">积分规则管理</a></li>
                <li><a href="#">添加/修改关键词</a></li>
            </ul>
        </div>
        <form action="" method="post" name ="vform">
            <input type ="hidden" name="id" value="<?php echo ($word["id"]); ?>">
                <input type ="hidden" name="action" value="<?php echo ($data["action"]); ?>">
                    <input type ="hidden" name="admin" value=<?php echo ($_SESSION['admin']['name']); ?>>
                        <div class="formbody">
                            <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>
                            <ul class="forminfo">
                                <li><label>积分规则</label><textarea rows="5"  cols='50' style="border:1px solid #A7B5BC" name ="name" value="<?php echo ($word["name"]); ?>"><?php echo ($word["name"]); ?></textarea><i>前面是价格/后面是优惠</i></li>
                                <li><label>&nbsp;</label><input name="" type="submit" class="btn btn-primary" value="确认<?php echo ($data["btn"]); ?>"  onclick="javascript:;" /></li>
                            </ul>
                            <div style="display:none" id="skuNotice" class="sku_tip">
                                <span id="skuTitle2"></span>
                            </div>
                        </div>
                        </form>
                        </body>
                        </html>