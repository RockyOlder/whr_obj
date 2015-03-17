<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>住户申请</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" />
        <link href="/App/Home/View/Public/Css/tableList.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">

            <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.idTabs.min.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/select-ui.min.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/kindeditor.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/kindeditor.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
           

            
            <style>
                #close{ font-size: 16px; border: 2px solid;}

            </style>
    </head>


    <body style="background: none;">
        <input type="hidden" value="/server.php?s=/Home/Owner/details" id="url_getTeacher" name="url_getTeacher" />
        <input type="hidden" value="<?php echo U('ajax_del');?>" id="delete"/>
        <input type="hidden" value="<?php echo U('ajax_pass');?>" id="pass"/>
        <div class="place">
            <span>位置： </span>
            <ul class="placeul">
                
                <li><a href="<?php echo U('Index/start');?>">首页</a></li>
                <li>业主管理</li>
                <li>业主申请列表</li>
            </ul>
        </div>
        <div class="rightinfo">
            <form action="" method="post" name ="vform" id="from_sub">
                <div  id="tab2" class="tabson">
                    <ul class="seachform">
                        <li><label>姓名</label><input name="name" type="text" class="scinput"value="" /></li>
                        <li><label>电话</label>   <input name="mobile" type="text" class="scinput" value="" />  </li>
                        
                        <li><label>&nbsp;</label><input name="" type="submit" class="scbtn" value="查询" id="like"/></li>
                        
                    </ul>
                </div>

                <table class="imgtable">
                    <thead>
                        <tr>
                            <th>用户编号</th>
                            <th>电话</th>
                            <th>业主名字</th>
                            <th>物业名称</th>
                            <th>小区名称</th>
                            <th>地址</th>
                            <th>操作</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id = "<?php echo ($vo["user_id"]); ?>">
                                <!--  / -->
                                <td class="imgtd"><?php echo ($vo["user_id"]); ?></td>
                                <td><?php echo ($vo["user_name"]); ?></a></td>
                                <td><?php echo ($vo["true_name"]); ?></td>
                                <td><?php echo ($vo["property"]); ?></td>
                                <td><?php echo ($vo["village"]); ?></td>
                                <td><?php echo ($vo["address"]); ?></td>
                                <td>
                                    
                                    <a class="tablelink" onclick="ajax_delete(<?php echo ($vo["user_id"]); ?>)"  onclick="if(confirm('确认删除该住户申请')){return true}else{return false}"> 删除</a>
                                    <a class="tablelink" onclick="ajax_pass(<?php echo ($vo["user_id"]); ?>)"  onclick="if(confirm('确认通过该住户申请')){return true}else{return false}"> 通过</a>

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
                if(confirm('你确认要删除用户申请吗？')){
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
            }
             function ajax_pass(id){
                 if(confirm('你确认要通过该用户申请吗？')){
                var url = $("#pass").val();
                $.ajax({ 
                        url:url,
                        type:"post",
                        dataType:"json",
                        data: {
                            "id":id
                        },
                        success:function(data){
                            // alert(data['statue']);
                            if (data['statue'] == 1) {
                                $('#'+id).hide(100);
                                alert(data['msg']);
                            }else{
                                alert(data['msg']);
                            };
                            
                        }
                    });
                }
            }
        </script>

    </body>

</html>