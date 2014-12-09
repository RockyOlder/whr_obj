<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/whr/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.js"></script>
        <script type="text/javascript" src="/whr/App/Home/View/Public/Js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/whr/App/Home/View/Public/Css/bootstrap.min.css">
            <script type="text/javascript" type="text/javascript">
                function deleteSum(id){
                    if(confirm("确认删除"))
                        location.href="/whr/index.php?s=/Home/Admin/del/id/"+id
                }

            </script>


    </head>
    <style type="text/css">
        form ul{width: 100%;}
        form ul li{float: left;width: 110px;line-height: 25px;text-align: center;}
        form ul input{border: 1px solid #ccc;width: 100px;}
        form ul select{border: 1px solid #ccc;width: 100px;}
    </style>

    <body style="background: none;">

        <div class="place">
            <span>后台管理：</span>
            <ul class="placeul">
                <li><a href="#">开发商管理</a></li>
                <li><a href="#">开发商列表</a></li>
            </ul>
        </div>

        <div class="rightinfo">

            <div class="tools">

            </div>


            <table class="tablelist">
                <thead>
                    <tr>
                        <th><input name="" type="checkbox" value="" checked="checked"/></th>
                        <th>编号<i class="sort"><img src="/whr/App/Home/View/Public/Images/px.gif" /></i></th>
                        <th>用户名</th>
                        <th>手机号码</th>
                        <th>昵称</th>
                        <th>固定电话</th>
                        <th>邮箱</th>
                        <th>小区名称</th>
                        <th>用户积分</th>
                        <th>用户余额</th>
                        <th>用户等级</th>
                        <th>操作</th>
                    </tr>
                </thead>

                <tbody id="table_ajax_list">
                    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><input name="num" type="checkbox" value="" /></td>
                            <td><?php echo ($vo["user_id"]); ?></td>
                            <td><?php echo ($vo["user_name"]); ?></td>
                            <td><?php echo ($vo["mobile_phone"]); ?></td>
                            <td><?php echo ($vo["nickname"]); ?></td>
                            <td><?php echo ($vo["email"]); ?></td>
                            <td><?php echo ($vo["sex"]); ?></td>
                            <td><?php echo ($vo["address"]); ?></td>
                            <td><?php echo ($vo["source"]); ?></td>
                            <td><?php echo ($vo["houses_id"]); ?></td>
                            <td><?php echo ($vo["property_id"]); ?></td>
                            <td><?php echo ($vo["add_time"]); ?></td>      
                            <td>
                                <a href="<?php echo U('add',array(id=>$vo['user_id']),'');?>" class="tablelink">修改</a>    
                                
                                <a href="<?php echo U('del',array(id=>$vo['user_id']),'');?>" class="tablelink" onclick="if(confirm('确认删除')){return true}else{return false}"> 删除</a>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>    
                </tbody>
            </table>
            <div class="pagin">
                <div class="message">共<i class="blue">1256</i>条记录，当前显示第&nbsp;<i class="blue">2&nbsp;</i>页</div>
                <ul class="paginList">
                    <li class="paginItem"><a href="javascript:;"><span class="pagepre"></span></a></li>
                    <li class="paginItem"><a href="javascript:;">1</a></li>
                    <li class="paginItem current"><a href="javascript:;">2</a></li>
                    <li class="paginItem"><a href="javascript:;">3</a></li>
                    <li class="paginItem"><a href="javascript:;">4</a></li>
                    <li class="paginItem"><a href="javascript:;">5</a></li>
                    <!-- <li class="paginItem more"><a href="javascript:;">...</a></li> -->
                    <li class="paginItem"><a href="javascript:;">10</a></li>
                    <li class="paginItem"><a href="javascript:;"><span class="pagenxt"></span></a></li>
                </ul>
            </div>


            <div class="tip">
                <div class="tiptop"><span>提示信息</span><a></a></div>

                <div class="tipinfo">
                    <span><img src="/whr/App/Home/View/Public/Images/ticon.png" /></span>
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