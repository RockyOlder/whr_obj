<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/App/Home/View/Public/Css/tableList.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
<script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
<script type="text/javascript" src="/App/Home/View/Public/Js/common.js"></script>
<script type="text/javascript" src="/App/Home/View/Public/Js/bootstrap.min.js"></script>
<script type="text/javascript" src="/App/Home/View/Public/Js/artDialog.js"></script>
<link id="artDialogSkin" href="/App/Home/View/Public/Css/skin/aero/aero.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
<script type="text/javascript" type="text/javascript">   
    function cats_Shop(id) {
        art.dialog({
            content:'你确定删除？',
            title: '确定框',  
            okValue:'确认',  
            cancelValue:'取消',            
            id:'bnt4_test',
            style:'confirm'}, 
        function(){
            var msg = art.dialog({id:'bnt4_test'}).data.content; // 使用内置接口获取消息容器对象
            if(msg){
                location.href=$("#"+id).val()
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
         $(function(){
          initPager();
         })
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
            <li><a href="#" id="xasda">管理员管理</a></li>
            <li><a href="#" id="nidaye">管理员申请列表</a></li>
        </ul>
    </div>

    <div class="rightinfo">

        <div class="tools">

        </div>


        <table class="tablelist">
            <thead>
                <tr>
                    <!-- <th><input name="" type="checkbox" value="" checked="checked"/></th> -->
                    <th>编号<i class="sort"><img src="/App/Home/View/Public/Images/px.gif" /></i></th>
                    <th>账号</th>
                    <th>真实姓名</th>
                    <th>邮箱</th>
                    <th>电话</th>
                    <th>申请角色</th>
                    <th>申请时间</th>
                    <th>操作</th>
                </tr>
            </thead>

            <tbody id="table_ajax_list">
                <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <!-- <td><input name="num" type="checkbox" value="" /></td> -->
                        <td><?php echo ($vo["id"]); ?></td>
                        <td><?php echo ($vo["name"]); ?></td>
                        <td><?php echo ($vo["true_name"]); ?></td>
                        <td><?php echo ($vo["email"]); ?></td>
                        <td><?php echo ($vo["mobile"]); ?></td>
                        <td><?php echo ($vo["role"]); ?></td>
                        <td><?php echo (date("Y-m-d H:i",$vo["add_time"])); ?></td>  
                        <td>
                            <a href="<?php echo U('info',array(id=>$vo['id']),'');?>" class="tablelink">申请详情</a> 
                            <a  class="tablelink" class="love_obj" onclick="return cats_Shop(<?php echo ($vo["id"]); ?>)" > 删除</a>
                            <input type="hidden" id="<?php echo ($vo["id"]); ?>" value ="<?php echo U('delApp',array('id'=>$vo['id']),'');?>">
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