<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" />
        <link href="/App/Home/View/Public/Css/tableList.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
            <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/common.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/select-ui.min.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
                    <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
            <script language="javascript">
          
                function deleteSum(id){
                    if(confirm("确认删除"))
                        location.href="/whr/index.php?s=/Home/Business/del/id/"+id
                }
            </script>
            <style type="text/css">
                #table_ajax_list tr td{ height: 50px;}
               

            </style>
            <script type="text/javascript">
                $(document).ready(function(e) {
                    $(".select1").uedSelect({
                        width : 345           
                    });
                    $(".select2").uedSelect({
                        width : 167  
                    });
                    $(".select3").uedSelect({
                        width : 120
                    });
                });
                $(function(){
                    $('.scbtn').bind('click',function(){
                        $('#from_sub').submit();
                    });
                    //      initPager();
                });
            </script>
    </head>
    <body style="background: none;">

        <div class="place">
            <span>位置：</span>
            <ul class="placeul">
                <li><a href="<?php echo U('Index/start','','');?>">首页</a></li>
                <li>月末统计</li>
            </ul>
        </div>
        <div class="rightinfo">
            <form action="" method="post" name ="vform" id="from_sub">
                <div  id="tab2" class="tabson">
                    <ul class="seachform">

                        <li><label>选择年份</label>  
                            <div class="vocation">
                                <select class="select3" name = 'year_y' >
                                    <option class="pro_into" ><?php echo ($todayYear); ?></option>
                                    <?php if(is_array($year)): $i = 0; $__LIST__ = $year;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$year): $mod = ($i % 2 );++$i;?><option name = 'year' class = "top_cate" value="<?php echo ($year); ?>"><?php echo ($year); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </li>
                        <li><label>选择月份</label>  
                            <div class="vocation">
                                <select class="select3" name = 'month_y' >
                                    <option class="pro_into" ><?php echo ($todayMonth); ?></option>
                                    <?php if(is_array($month)): $i = 0; $__LIST__ = $month;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$month): $mod = ($i % 2 );++$i;?><option name = 'parent_type' class = "top_cate" value="<?php echo ($month); ?>"><?php echo ($month); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </li>
                        <?php if($role == 1): ?><li><label>选择商家</label>  
                            <div class="vocation">
                                <select class="select3" name = 'cate' >
                                    <option class="pro_into" >请选择</option>
                                    <option name = 'cate' class = "top_cate" value="0" >生活导航商家</option>
                                        <option name = 'cate' class = "top_cate" value="1">VIP商家</option>
                                </select>
                            </div>
                        </li><?php endif; ?>
                        <li><label>&nbsp;</label><input name="" type="button" class="scbtn" value="查询" id="like"/></li>
                    </ul>
                </div>
                <table class="imgtable">
                    <thead>
                        <tr>
                            <th>订单商家</th>                  
                            <th>未完成总额</th>                  
                            <th>完成总额</th>
                            <th>下单总额</th>

                            <!-- <th>操作</th> -->
                        </tr>
                    </thead>
                    <tbody id="table_ajax_list">
                        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td class="contentSmall"><?php echo ($vo["name"]); ?></td>  
                                <td><?php echo ($vo["undone"]); ?></td>
                                <td><?php echo ($vo["complete"]); ?></td>
                                <td><?php echo ($vo["totle"]); ?></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>    
                    </tbody>
                </table>
             <!--   <div id="pager" class="pager">
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
                </div>-->
            </form>
        </div>
        <script type="text/javascript">
            $('.imgtable tbody tr:odd').addClass('odd');
        </script>

    </body>

</html>