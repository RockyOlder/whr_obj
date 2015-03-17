<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/App/Home/View/Public/Css/tableList.css" rel="stylesheet" type="text/css" />
        <!-- <link href="/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" />        <script type="text/javascript" src="/App/Home/View/Public/Js/jquery-1.8.3.min.js"></script>      -->
        <!-- <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/js/jquery-ui/css/pepper-grinder/jquery-ui.min.css"> jquery-1.8.3.min -->
        <link type="text/css" href="/App/Home/View/Public/Js/jquery-ui/css/start/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
        <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
        <script type="text/javascript" src="/App/Home/View/Public/Js/common.js"></script>
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
            <script type="text/javascript" src="/App/Home/View/Public/Js/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
            <script language="javascript">

                function deleteSum(id){
                    if(confirm("确认删除"))
                        location.href="/whr/index.php?s=/Home/Business/del/id/"+id
                }
            </script>

            <script type="text/javascript">
                $(function(){
                    initPager();
                });

            </script>
            <style>
                    .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
                    .pro select{width: 345px;height: 32px; }
                    #val_list{width: 345px;height: 32px;  margin-left: 85px;}
                    #table_list tr td{ padding: 7px;}
                    .th_default a{ width: 70px;}
                    #ig_primary{float: right; margin-top: 3px;}
                    #img_add{ position: absolute; float: left; margin-top: 205px; margin-left: 85px;}
                    .spanText{ margin-top: 10px; float: left;}

            </style>
    </head>


    <body style="background: none;">
        <input type="hidden" value="/server.php?s=/Home/ProInfo/details" id="url_getTeacher" name="url_getTeacher" />
        <div class="place">
             <span>位置： </span>
            <ul class="placeul">
                <li><a href="<?php echo U('Index/start','','');?>">首页</a></li>
                <li>物业信息管理</li>
                <li><a href="<?php echo U('index');?>">资讯列表</a></li>
                <li>屏蔽评论</li>
            </ul>
        </div>
 

            <div class="formtitle"><span><?php echo ($data["title"]); ?></span></div>

            <ul class="forminfo">
                <li><label>标题</label><i class="spanText"><?php echo ($info["title"]); ?></i></li>
                <li><label>内容</label><i class="spanText"><?php echo ($info["content"]); ?></i></li>
                <li><label>发布人</label><i class="spanText"><?php echo ($info["author"]); ?></i></li>
                <li><label>发布时间</label><i class="spanText"><?php echo (date("Y-m-d H:i:s",$info["add_time"])); ?></i></li>
            </ul>
            <div style="display:none" id="skuNotice" class="sku_tip">
                <span class="validateTips"></span>
            </div>
   
                    <table class="tablelist">
                        <thead>
                            <tr>
    
                            <!--    <th>标题</th> -->
                                <th>回复内容</th>
                                <th>发布人</th>
                                <th>发布时间</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody id="table_ajax_list">
                            <?php if(is_array($info["list"])): $i = 0; $__LIST__ = $info["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>

                                 <!--   <td><?php echo ($vo["title"]); ?></td> -->
                                    <td><?php echo (msubstr($vo["content"],0,50,'utf-8',true)); ?></td>
                                    <td><?php echo ($vo["author"]); ?></td>
                                    <td><?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></td>      
                                    <td class="th_default">    
                                    <!--    <a class="btn btn-default" title="编辑" onclick="update_list(<?php echo ($vo["id"]); ?>)">修改</a>   activein  -->
                                   <a href="<?php echo U('activein',array(sheild=>$vo['id']),'');?>" class="btn btn-default" title="屏蔽" onclick="if(confirm('确认删除')){return true}else{return false}">屏蔽</a>     
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
            <script type="text/javascript">
                $('.imgtable tbody tr:odd').addClass('odd');
            </script>

    </body>

</html>