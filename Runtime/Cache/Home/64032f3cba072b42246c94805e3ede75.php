<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/default/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/default/App/Home/View/Public/Css/tableList.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/default/App/Home/View/Public/Js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
            <script type="text/javascript" src="/default/App/Home/View/Public/Js/jquery.js"></script>
            <script type="text/javascript" src="/default/App/Home/View/Public/Js/common.js"></script>
            <script type="text/javascript" src="/default/App/Home/View/Public/Js/bootstrap.min.js"></script>
            <script type="text/javascript" src="/default/App/Home/View/Public/Js/artDialog.js"></script>
            <link id="artDialogSkin" href="/default/App/Home/View/Public/Css/skin/aero/aero.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" type="text/css" href="/default/App/Home/View/Public/Css/bootstrap.min.css">
                <script type="text/javascript" type="text/javascript">
                    function deleteSum(id){
                        if(confirm("确认删除"))
                            location.href="/whr/index.php?s=/Home/Admin/del/id/"+id
                    }

                    $(function(){

                        initPager();
                        
                    })
                      
                      function cats_Shop(id) {
                        //    alert($("#url_ajaxCalendar").val())
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
                    form ul{width: 100%;}
                    form ul li{float: left;width: 110px;line-height: 25px;text-align: center;}
                    form ul input{border: 1px solid #ccc;width: 100px;}
                    form ul select{border: 1px solid #ccc;width: 100px;}
                </style>

                <body style="background: none;">
              <input type="hidden" value="/default/index.php?s=/Home/User/del/id/" id="url_ajaxCalendar" name="url_ajaxCalendar" />
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
                                    <th>编号<i class="sort"><img src="/default/App/Home/View/Public/Images/px.gif" /></i></th>
                                    <th>用户名</th>
                                    <th>手机号码</th>
                                    <th>固定电话</th>
                                    <th>邮箱</th>
                                    <th>小区物业</th>
                                    <th>小区名称</th>
                                    <th>用户积分</th>
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
                                        <td><?php echo ($vo["fax_phone"]); ?></td>
                                        <td><?php echo ($vo["email"]); ?></td>
                                        <td><?php echo ($vo["pname"]); ?></td>
                                        <td><?php echo ($vo["vname"]); ?></td>
                                        <td><?php echo ($vo["source"]); ?></td>
                                        <td><?php echo ($vo["user_rank"]); ?></td>

                                        <td>
                                            <a href="<?php echo U('add',array(id=>$vo['user_id']),'');?>" class="tablelink">修改</a>    
                                           <!--  href="<?php echo U('del',array(id=>$vo['user_id']),'');?>" -->
                                            <a class="tablelink" onclick="return cats_Shop(<?php echo ($vo["user_id"]); ?>)"> 删除</a>
                                            <a href="<?php echo U('updatePW',array(id=>$vo['user_id']),'');?>" class="tablelink">修改密码</a>    
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
                                <span><img src="/default/App/Home/View/Public/Images/ticon.png" /></span>
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