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
<script type="text/javascript" src="/App/Home/View/Public/Js/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
<link href="/App/Home/View/Public/Css/topShow.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
<script type="text/javascript" type="text/javascript">

   
         $(function(){
           $( document ).tooltip({
            track: true,
            width: "100px",
            position: {
                my: "left+5 bottom-5", 
                at: "center top"
            }
        });
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
         
    $(function(){
        $('#select_deve img').bind('click',function(){
            $("#vform").submit();
            //     selectDeveloper()
        });
    })   
</script>


</head>
<style type="text/css">
    form ul{width: 100%;}
    form ul li{float: left;width: 110px;line-height: 25px;text-align: center;}
    form ul input{border: 1px solid #ccc;width: 100px;}
    form ul select{border: 1px solid #ccc;width: 100px;}
    .th_default{padding: 0 3px;}
    .redclss{ color: red;}
    #ig_primary{float: right; margin-top: 3px;}
    .divBtn {position:relative;display:inline-block;padding:3px;cursor:pointer}
    .tablelist td{line-height:35px; text-indent: 10px; border-right: dotted 1px #c7c7c7;}
</style>

<body style="background: none;">
  <input type="hidden" value="<?php echo U(del);?>" id="url_ajaxCalendar" name="url_ajaxCalendar" />
        <div class="place">
           <span>位置： </span>
            <ul class="placeul">
                <li><a href="<?php echo U('Index/start');?>">首页</a></li>
                <li>系统管理</li>
                <li>快递公司列表</li>
            </ul>
        </div>

        <div class="rightinfo">

            <div class="tools">
                <form action="" method="post" name="vform" id="vform">
                        <ul>
                            
                            <li>快递公司名称:</li>
                            <li><input type="text" value="" class="form-control" name ="name" /></li>
                            

                            <li><span id="select_deve" style="cursor:pointer"><img src="/App/Home/View/Public/Images/ico06.png" width="25"/></span></li>
                            <a href="<?php echo U('add');?>"><li class="click"><span><img src="/App/Home/View/Public/Images/t01.png" /></span>添加快递公司</li></a>
                        </ul>
                    </form>
            </div>


            <table class="tablelist">
                <thead>
                    <tr>
                       
                        <th>编号</th>
                        <th>名称</th>
                        <th>拼音编号</th>
                        <th>电话</th>
                        <th>每公斤价格</th>
                
                        <th colspan="3">操作</th>
                    </tr>
                </thead>

                <tbody id="table_ajax_list">
                    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($vo["id"]); ?></td>

                            <td><?php echo ($vo["name"]); ?></td>
                            <td width="180px"><?php echo ($vo["code"]); ?></td>
                            <td><?php echo ($vo["phone"]); ?></td>
                            <td><?php echo ($vo["price"]); ?></td>
            
                       <td width="20px" class="th_default" align="center">
                            <a href="<?php echo U('info',array('id'=>$vo['id']));?>">
                                <div class="divBtn editBtn ui-state-default ui-corner-all"  title="查看详细">
                            <span class="ui-icon ui-icon-add"></span>
                            </div></a>
                                            </td>
                            <td width="20px" class="th_default" align="center"><a href="<?php echo U('add',array(id=>$vo['id']),'');?>" class="divBtn editBtn ui-state-default ui-corner-all" title="编辑" ><span class="ui-icon ui-icon-pencil"></span></a></td> 
                            <td width="20px" class="th_default" align="center"><div class="divBtn deleteBtn ui-state-default ui-corner-all" title="删除"onclick="return cats_Shop(<?php echo ($vo["id"]); ?>)"><span class="ui-icon ui-icon-minus"></span></div></td>
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


            




        </div>

        <script type="text/javascript">
            $('.tablelist tbody tr:odd').addClass('odd');
        </script>

    </body>

</html>