<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" />
        <link href="/App/Home/View/Public/Css/tableList.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
            <link id="artDialogSkin" href="/App/Home/View/Public/Css/skin/aero/aero.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
                <link href="/App/Home/View/Public/Css/topShow.css" rel="stylesheet" type="text/css" />
                <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
                <script type="text/javascript" src="/App/Home/View/Public/Js/common.js"></script>
                <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.idTabs.min.js"></script>
                <script type="text/javascript" src="/App/Home/View/Public/Js/select-ui.min.js"></script>
                <script type="text/javascript" src="/App/Home/View/Public/Js/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
                <script type="text/javascript" src="/App/Home/View/Public/Js/artDialog.js"></script>
                <script language="javascript">

                    function deleteSum(id){
                        if(confirm("确认删除"))
                            location.href="/whr/index.php?s=/Home/Business/del/id/"+id
                    }
                </script>

                <script type="text/javascript">
                    $(document).ready(function(e) {
                        $(".select1").uedSelect({
                            width : 345           
                        });
                        $(".select2").uedSelect({
                            width : 167  
                        });
                        $(".select3").uedSelect({
                            width : 100
                        });
                    });
                    $(function(){
                        $( document ).tooltip({
                            track: true,
                            width: "100px",
                            position: {
                                my: "left+5 bottom-5", 
                                at: "center top"
                            }
                        });
                    
                        $('.scbtn').bind('click',function(){
                            $('#from_sub').submit();
                    
                        });
            initPager();
                    });

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
                                // location.href=$("#url_ajaxCalendar").val()+id
                                // return false;
                                $.ajax({
                                'url': $("#url_ajaxCalendar").val(),
                                'data':{'id':id},
                                'dataType': 'json',
                                'type' : 'post',
                                success:function(data){
                                //console.log(data)
                                    if (data.statue == 1) {
                                        alert('成功删除住户信息');
                                        $('#'+id).hide(100);
                                    }else{
                                        alert(data.msg);
                                    };
                },
                error:function(data){
                    alert('缺少参数');
                }
            })
                            }        
                        },function(){
                            return true;
                        });
                    };
                </script>
                <style>
                    #close{ font-size: 16px; border: 2px solid;}

                    .redclss{ color: red;}
                    #ig_primary{float: right; margin-top: 3px;}
                    .divBtn {position:relative;display:inline-block;padding:3px;cursor:pointer}
                    .tablelist td{line-height:35px; text-indent: 6px; border-right: dotted 1px #c7c7c7;}
                </style>
                </head>


                <body style="background: none;">
                    <input type="hidden" value="/index.php?s=/Home/Owner/details" id="url_getTeacher" name="url_getTeacher" />
                    <input type="hidden" value="<?php echo U('del');?>" id="url_ajaxCalendar" name="url_ajaxCalendar" />
                    <div class="place">
                        <span>位置： </span>
                        <ul class="placeul">
                            <li><a href="<?php echo U('Index/start','','');?>">首页</a></li>
                            <li>VIP住户消费</li>
                            <li>住户消费</li>
                        </ul>
                    </div>
                    <div class="rightinfo">

                            <table class="imgtable">
                                <thead>
                                    <tr>
                                        <th>业主编号</th>
                                        <th>业主名字</th>
                                        <th>电话</th>
                                        <th>VIP消费</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="<?php echo ($vo["id"]); ?>">
                                            <!--  / -->
                                            <td class="imgtd"><?php echo ($vo["id"]); ?></td>
                                            <td><?php echo ($vo["name"]); ?></a></td>
                                            <td><?php echo ($vo["mobile"]); ?></td>
                                            
                                           <?php if($vo["owner_price"] != 0): ?><td><?php echo ($vo["owner_price"]); ?></td><?php endif; ?>

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

                </body>

                </html>