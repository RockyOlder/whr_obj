<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>推送列表</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" />
        <link href="/App/Home/View/Public/Css/tableList.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">

            <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.idTabs.min.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/select-ui.min.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/kindeditor.js"></script>
            <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
            <script type="text/javascript" src="/App/Home/View/Public/Js/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
            

            
            <style>
                #close{ font-size: 16px; border: 2px solid;}

            </style>
    </head>


    <body style="background: none;">
        <input type="hidden" value="/index.php?s=/Home/Message/details" id="url_getTeacher" name="url_getTeacher" />
        <div class="place">
            <span>位置：</span>
            <ul class="placeul">
                <li><a href="<?php echo U('Index/start');?>">首页</a></li>
                <li>推送管理</li>
                <li>推送列表</li>
            </ul>
        </div>
        <div class="rightinfo">
            <form action="" method="post" name ="vform" id="from_sub">
                <div  id="tab2" class="tabson">
                    <ul class="seachform">
                       <!--  <li><label>姓名</label><input name="name" type="text" class="scinput"value="" /></li>
                        <li><label>电话</label>   <input name="mobile" type="text" class="scinput" value="" />  </li> -->
                        <li><label>推送地区</label>   <input name="address" type="text" class="scinput" value="" />  </li>
                        <li><label>&nbsp;</label><input name="" type="submit" class="scbtn" value="查询" id="like"/></li>
                        
                    </ul>
                </div>

                <table class="imgtable">
                    <thead>
                        <tr>
                            <th>信息编号</th>
                            <th>信息标题</th>
                            <th>信息内容</th>
                            <th>接受设备</th>
                            <th>接受地区</th>
                            <th>发送人</th>
                            <th>发送时间</th>
                            <th>操作</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id = "<?php echo ($vo["id"]); ?>">
                                <!--  / -->
                                <td><?php echo ($vo["id"]); ?></td>
                                <td><?php echo ($vo["title"]); ?></a></td>
                                <td><?php echo ($vo["content"]); ?></td>
                                <td><?php echo ($vo["machine"]); ?></td>
                                <td><?php echo ($vo["area"]); ?></td>
                                <td><?php echo ($vo["name"]); ?></td>
                                <td><?php echo (date("Y-m-d",$vo["time"])); ?></td>
                                <td>
                                    
                                    <a class="tablelink" onclick="if(confirm('你确定要删除吗？'))ajax_delete(<?php echo ($vo["id"]); ?>)"> 删除</a>
                                    
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>  
                        <input type="hidden" value="<?php echo U('ajax_del');?>" id="delete"/>

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
            function ajax_delete(id){
                var url = $("#delete").val();
                $.ajax({ 
                        url:url,
                        type:"post",
                        dataType:"json",
                        data: {
                            "id":id
                        },
                        success:function(data){
                            //alert(data);
                            if (data['statue'] == 1) {
                                $('#'+id).hide(100);
                                alert(data['msg']);
                            }else{
                                alert(data['msg']);
                            };
                            
                        }
                    });
            }
        </script>

    </body>

</html>