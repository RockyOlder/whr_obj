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
                                        alert(data.msg);
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
                function comeback(id) {
                    
                    art.dialog({
                            content:'你确定要撤销账单发布？',
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
                                'url': $("#url_comeback").val(),
                                'data':{'id':id},
                                'dataType': 'json',
                                'type' : 'post',
                                success:function(data){
                                //console.log(data)
                                    if (data.statue == 1) {
                                        alert(data.msg);
                                        $('#statue'+id).show(100);
                                        $('#nomal'+id).hide();
                                        $('#comebackbtn').hide(100);
                                        // $('#'+id).hide(100);
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
                    <input type="hidden" value="<?php echo U('delbill');?>" id="url_ajaxCalendar" name="url_ajaxCalendar" />
                    <input type="hidden" value="<?php echo U('backup');?>" id="url_comeback" name="url_ajaxCalendar" />
                    <div class="place">
                        <span>位置： </span>
                        <ul class="placeul">
                            <li><a href="<?php echo U('Index/start','','');?>">首页</a></li>
                            <li>物业信息管理</li>
                            <li>账单发布记录</li>
                        </ul>
                    </div>
                    <div class="rightinfo">
                        <form action="" method="post" name ="vform" id="from_sub">
                            <div  id="tab2" class="tabson">
                                <ul class="seachform">
                                    
                                    <li><label>账单时间</label>   <input name="date" type="text" class="scinput" value="" />  </li>
                                    <li><label>账单类型</label> 
                                    <div class="vocation">
                                    <select  name="type"  class="select3" style="width: 100px;box-sizing:content-box">
                                        <option>全部</option>
                                    <?php if(is_array($select)): $k = 0; $__LIST__ = $select;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($k % 2 );++$k;?><option value="<?php echo ($k); ?>"><?php echo ($type); ?></option><?php endforeach; endif; else: echo "" ;endif; ?> 
                                    </select> 
                                    </div>
                                    </li>
                                    <li><label>&nbsp;</label><input name="" type="button" class="scbtn" value="查询" id="like"/></li>
                                    <a href="<?php echo U('bill');?>"><li><label>&nbsp;</label><input name="" type="button" class="scbtn" value="发布账单" id="like"/></li></a>

                                </ul>
                            </div>

                            <table class="imgtable">
                                <thead>
                                    <tr>
                                        <th>编号</th>
                                        <th>账单时间</th>
                                        <th>账单类型</th>
                                        <th>操作人</th>
                                        <th>操作时间</th>
                                        <th>发布状态</th>
                                        <th colspan="3">操作</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="<?php echo ($vo["id"]); ?>">
                                            <!--  / -->
                                            <td class="imgtd"><?php echo ($vo["id"]); ?></td>
                                            <td><?php echo ($vo["date"]); ?></a></td>
                                            <td><?php echo ($vo["type"]); ?></td>
                                            <td><?php echo ($vo["operate"]); ?></td>
                                            <td><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></td>
                                            <td>
                                                <div id = 'statue<?php echo ($vo["id"]); ?>' style="display:none">已经撤销</div>
                                                <div id = 'nomal<?php echo ($vo["id"]); ?>'>
                                                <?php if($vo["statue"] == 0): ?>正常<?php endif; ?>
                                                <?php if($vo["statue"] == 1): ?>已经撤销<?php endif; ?>
                                                </div>
                                            </td>
                                            <td width="20px" class="th_default" align="center">
                                            <a href="<?php echo ($vo["file"]); ?>" target="_bank"><div class="divBtn editBtn ui-state-default ui-corner-all"  title="查看详细">
                                            <span class="ui-icon ui-icon-add"></span>
                                            </div></a>
                                            </td>
                                            <td width="20px" class="th_default" align="center"><?php if($vo["statue"] == 0): ?><div  class="divBtn editBtn ui-state-default ui-corner-all" title="撤销" onclick="return comeback(<?php echo ($vo["id"]); ?>)" id = "comebackbtn<?php echo ($vo["id"]); ?>"><span class="ui-icon ui-icon-pencil"></span></div><?php endif; ?></td>
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

                </body>

                </html>