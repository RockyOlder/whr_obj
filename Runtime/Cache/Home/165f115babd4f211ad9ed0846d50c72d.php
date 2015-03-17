<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>apk列表</title>
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
                    $('.scbtn').bind('click',function(){
                        $('#from_sub').submit();
                    });
                    initPager();
                });
            </script>
    </head>


    <body style="background: none;">

        <div class="place">
                <span>位置：</span>
            <ul class="placeul">
                <li><a href="<?php echo U('Index/start');?>">首页</a></li>
                <li>电子消费劵管理</li>
                <li>消费卷列表</li>
            </ul>
        </div>
        <div class="rightinfo">
            <form action="" method="post" name ="vform" id="from_sub">
                <div  id="tab2" class="tabson">
                    <ul class="seachform">
                        <li><label>订单号码</label>   <input name="number" type="text" class="scinput" value="" />  </li>
                        <li><label>消费卷号码</label>   <input name="check_number" type="text" class="scinput" value="" />  </li>
                        <li><label>消费状态</label>  
                            <div class="vocation">
                                <select class="select3" name = 'statue' >
                                    <option  value="">请选择</option>
                                    <?php if(is_array($statue)): $k = 0; $__LIST__ = $statue;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($k % 2 );++$k;?><option  value="<?php echo ($k - 1); ?>"><?php echo ($value); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </li>
                        
                        <li><label>&nbsp;</label><input name="" type="submit" class="scbtn" value="查询" id="like"/></li>
                    </ul>
                </div>
                <table class="imgtable" style="font-size:14px;">
                    <thead>
                        <tr>
                            <th>订单号</th>
                            <th>付款状态</th>              
                            <th>消费金额</th>
                            <th>电子消费卷</th>
                            <th>是否消费</th>
                            <th>买家电话</th>
                            <th>生成时间</th>
                           <!--  <th>操作</th> -->
                        </tr>
                    </thead>

                    <tbody>
                        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                               
                                <td><?php echo ($vo["number"]); ?></td>
                                <td>
                                    <?php if($vo["statue"] == 0): ?>未付款<?php else: ?>已经付款<?php endif; ?>
                                </td>
                                <td><?php echo ($vo["totle"]); ?></td>
                                <td><?php echo ($vo["check_number"]); ?></td>
                                <td>
                                    <?php if($vo["check_statue"] == 0): ?>未消费<?php endif; ?>
                                    <?php if($vo["check_statue"] == 1): ?>已经消费<?php endif; ?>
                                    <?php if($vo["check_statue"] == 2): ?>已经退款<?php endif; ?>
                                </td>            
                                <td><?php echo ($vo["phone"]); ?></td>
                                <td><?php echo (date('Y-m-d H:i:s',$vo["time"])); ?></td>
                               <!--  <td><?php if($vo["is_ok"] == 1): ?>最新版<?php else: ?>旧版<?php endif; ?></td> -->
                                <!-- <td><?php echo ($vo["url"]); ?></td> -->
                                <td>
                                    
                                    
                                    <!-- <a href="<?php echo U('upload',array(id=>$vo['id']),'');?>" class="btn btn-primary">编辑</a>
                                    <a href="<?php echo U('del',array(id=>$vo['id']),'');?>"onclick="if(confirm('确认删除')){return true}else{return false}" class="btn btn-danger"> 删除</a> -->
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
        </script>

    </body>

</html>