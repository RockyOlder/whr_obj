<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/App/Home/View/Public/Css/tableList.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
        <link id="artDialogSkin" href="/App/Home/View/Public/Css/skin/aero/aero.css" rel="stylesheet" type="text/css" />
            <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/common.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/artDialog.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/bootstrap.min.js"></script>
            <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
                <script type="text/javascript" type="text/javascript">

                    $(function(){
                        initPager();
                    })
                    function cats_Shop(id) {
                    
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
                                location.href=$("#url_ajaxCalendar").val()+id
                                return false;
                            }        
                        },function(){
                            return true;
                        });
                    };
                </script>


                </head>
                <style type="text/css">

                    #table_ajax_list a{ width: 70px;}
                    .tablelist td{ overflow:  auto;}
                    #tab2{ float: left;}
                    #like{ float: left;}
                </style>

                <body style="background: none;">
                    <input type="hidden" value="/server.php?s=/Home/ProInfo/Nodel/id/" id="url_ajaxCalendar" name="url_ajaxCalendar" />
                    <div class="place">
                        <span>位置： </span>
                        <ul class="placeul">
                            <li><a href="<?php echo U('Index/start','','');?>">首页</a></li>
                            <li><a href="#">资讯列表</a></li>
                        </ul>
                    </div>
                    <form action="" method="post" name ="vform" id="from_sub">
                        <div  id="tab2" class="tabson">
                            <ul class="seachform">
                                <li><label>标题</label><input name="title" type="text" class="scinput"value="" /></li>
                                <li><label>&nbsp;</label><input name="" type="submit" class="scbtn" value="查询" id="like"/></li>
                            </ul>
                        </div>
                    </form>
                    <div class="rightinfo">


                        <a href="<?php echo U('add');?>" style="float: right; margin-top: 3px;" class="btn btn-primary">添加</a>    



                        <table class="tablelist">
                            <thead>
                                <tr>


                                    <th>资讯标题</th>
                                    <th width="100px;">资讯图片</th>
                                  <!--  <th>资讯内容</th>  -->
                                    <th>发布方</th> 
                                    <th>发布时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>

                            <tbody id="table_ajax_list">
                                <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                        <td><?php echo ($vo["title"]); ?></td>
                                        <td><img src="<?php echo ($vo["pic"]); ?>" width="50px;"></td>
                                    <!--    <td><?php echo (msubstr($vo["content"],0,20,'utf-8',true)); ?></td> -->
                                        <td><?php echo ($vo["author"]); ?></td>
                                        <td><?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></td>      
                                        <td>
                                            <a href="<?php echo U('add',array(nid=>$vo['id']),'');?>" class="btn btn-default" title="资讯详情" style=" width: 84px;">资讯详情</a>     
                                            <a href="<?php echo U('add',array(id=>$vo['id']),'');?>" class="btn btn-default">修改</a>    
                                               <a class="btn btn-danger" onclick="return cats_Shop(<?php echo ($vo["id"]); ?>)"> 删除</a>
                                            <a href="<?php echo U('index',array(id=>$vo['id']),'');?>" class="btn btn-info" title="置顶">置顶</a>     
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
                        <div class="tip">
                            <div class="tiptop"><span>提示信息</span><a></a></div>

                            <div class="tipinfo">
                                <span><img src="/App/Home/View/Public/Images/ticon.png" /></span>
                                <div class="tipright">
                                    <p>是否确认对信息的修改 ？</p>
                                    <cite>如果是请点击确定按钮 ，否则请点取消。</cite>
                                </div>
                            </div>

                            <div class="tipbtn">
                                <input name="" type="button"  class="sure" value="确定" />&nbsp;
                                <input name="" type="button"  class="cancel" value="取消" />
                            </div>

                        </div>




                    </div>

                    <script type="text/javascript">
                        $('.tablelist tbody tr:odd').addClass('odd');
                    </script>

                </body>

                </html>