<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/whr/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.js"></script>
        <script type="text/javascript" src="/whr/App/Home/View/Public/Js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/whr/App/Home/View/Public/Js/artDialog.js"></script>
        <link id="artDialogSkin" href="/whr/App/Home/View/Public/Css/skin/aero/aero.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="/whr/App/Home/View/Public/Css/bootstrap.min.css">
            <script type="text/javascript" type="text/javascript">
                function deleteSum(id){
                    if(confirm("确认删除"))
                        location.href="/whr/index.php?s=/Home/Admin/del/id/"+id
                }
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
                            location.href="/whr/index.php?s=/Home/Admin/del/id/"+id
                            return false;
                        }        
                    },function(){
                        return true;
                    });
                };
                function art_del_confirm(){  
          
                    art.dialog({  
                        title: '确定框',  
                        okValue:'确认',  
                        cancelValue:'取消',  
                        width: 230,  
                        height: 100,  
                        fixed: true,  
                        content: '确定要继续操作么？',  
                        
                        ok: function () {  
                            //  window.location.href=url;   
                        
                            return true;  
                        },  
                        cancel: function () {  
                            return true;  
                        },  
                    });  
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
                <li><a href="#" id="xasda">开发商管理</a></li>
                <li><a href="#" id="nidaye">开发商列表</a></li>
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
                        <th>名称</th>
                        <th>邮箱</th>
                        <th>添加时间</th>
                        <th>操作</th>
                    </tr>
                </thead>

                <tbody id="table_ajax_list">
                    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><input name="num" type="checkbox" value="" /></td>
                            <td><?php echo ($vo["id"]); ?></td>
                            <td><?php echo ($vo["name"]); ?></td>
                            <td><?php echo ($vo["email"]); ?></td>
                            <td><?php echo ($vo["addtime"]); ?></td>      
                            <td>
                                <a href="<?php echo U('add',array(id=>$vo['id']),'');?>" class="tablelink">修改</a>    <!--href="<?php echo U('del',array(id=>$vo['id']),'');?>" onclick="if(confirm('确认删除')){return true}else{return false}" -->

                                <a  class="tablelink" class="love_obj" onclick="return cats_Shop(<?php echo ($vo["id"]); ?>)" > 删除</a>
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