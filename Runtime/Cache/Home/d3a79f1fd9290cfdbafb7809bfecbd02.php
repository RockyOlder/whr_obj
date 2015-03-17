<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>数据备份列表</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" />
        <link href="/App/Home/View/Public/Css/tableList.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
        <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
        <script type="text/javascript" src="/App/Home/View/Public/Js/common.js"></script>
        
        <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.idTabs.min.js"></script>
        <script type="text/javascript" src="/App/Home/View/Public/Js/select-ui.min.js"></script>
        <script type="text/javascript" src="/App/Home/View/Public/Js/kindeditor.js"></script>
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">          
    </head>
    <script type="text/javascript" >
    $(function(){
     //全选的实现
     $(".check-all").click(function(){
         $(".ids").prop("checked", this.checked);
     });
     $(".ids").click(function(){
         var option = $(".ids");
         option.each(function(i){
             if(!this.checked){
                 $(".check-all").prop("checked", false);
                 return false;
             }else{
                 $(".check-all").prop("checked", true);
             }
         });
     });
  
 });
</script>
    <body style="background: none;line-height:20px;">

        <div class="place">
            <span>位置：</span>
            <ul class="placeul">
                <li><a href="<?php echo U('Index/start');?>">首页</a></li>
                <li><a href="#">系统管理</a></li>
                <li><a href="#">数据备份列表</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            
                <div  id="tab2" class="tabson">               
                    <a id="optimize" class="scbtn" href="<?php echo U('Backup/index');?>" onclick="if(confirm('确认要备份数据库？')){return true}else{return false}">立即备份</a>         
                </div>
                <form id="export-form" method="post" action="<?php echo U('export');?>">
                <table class="imgtable">
                    <thead>
                        <tr>
                            
                            <th>表名</th>
                            <th>数据大小</th>
                            <th>备份创建时间</th>
                            <th >操作</th>
                        </tr>
                    </thead>

                    <tbody >
                         <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($i % 2 );++$i;?><tr>
                            
                            <td><?php echo ($table["name"]); ?></td>
                            <td><?php echo ($table["size"]); ?></td>
                            <td><?php echo ($table["time"]); ?></td>
                            <td class="action">
                                <a class="ajax-get no-refresh" href="<?php echo U('Backup/recover?file='.$table['name']);?>"onclick="if(confirm('确认要还原备份数据？')){return true}else{return false}">还原备份</a>
                                <a class="ajax-get no-refresh" href="<?php echo U('Backup/deletebak?file='.$table['name']);?>"onclick="if(confirm('确认要删除备份数据？')){return true}else{return false}">删除备份</a>
                                
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
                            <span class="">共1/1页</span>
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
            </form>



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

        <script type="text/javascript">
            $('.imgtable tbody tr:odd').addClass('odd');
        </script>
    <script type="text/javascript">
    (function($){
        var $form = $("#export-form"), $export = $("#export"), tables
            $optimize = $("#optimize"), $repair = $("#repair");

        $optimize.add($repair).click(function(){
            $.post(this.href, $form.serialize(), function(data){
                if(data.status){
                    alert(data.info,'alert-success');
                } else {
                    alert(data.info,'alert-error');
                }
                setTimeout(function(){
                    $('#top-alert').find('button').click();
                    $(that).removeClass('disabled').prop('disabled',false);
                },1500);
            }, "json");
            return false;
        });

        $export.click(function(){
            $export.parent().children().addClass("disabled");
            $export.html("正在发送备份请求...");
            $.post(
                $form.attr("action"),
                $form.serialize(),
                function(data){
                    if(data.status){
                        tables = data.tables;
                        $export.html(data.info + "开始备份，请不要关闭本页面！");
                        backup(data.tab);
                        window.onbeforeunload = function(){ return "正在备份数据库，请不要关闭！" }
                    } else {
                        alert(data.info,'alert-error');
                        $export.parent().children().removeClass("disabled");
                        $export.html("立即备份");
                        setTimeout(function(){
                            $('#top-alert').find('button').click();
                            $(that).removeClass('disabled').prop('disabled',false);
                        },1500);
                    }
                },
                "json"
            );
            return false;
        });

        function backup(tab, status){
            status && showmsg(tab.id, "开始备份...(0%)");
            $.get($form.attr("action"), tab, function(data){
                if(data.status){
                    showmsg(tab.id, data.info);

                    if(!$.isPlainObject(data.tab)){
                        $export.parent().children().removeClass("disabled");
                        $export.html("备份完成，点击重新备份");
                        window.onbeforeunload = function(){ return null }
                        return;
                    }
                    backup(data.tab, tab.id != data.tab.id);
                } else {
                    alert(data.info,'alert-error');
                    $export.parent().children().removeClass("disabled");
                    $export.html("立即备份");
                    setTimeout(function(){
                        $('#top-alert').find('button').click();
                        $(that).removeClass('disabled').prop('disabled',false);
                    },1500);
                }
            }, "json");

        }

        function showmsg(id, msg){
            $form.find("input[value=" + tables[id] + "]").closest("tr").find(".info").html(msg);
        }
    })(jQuery);
    </script>

    </body>

</html>