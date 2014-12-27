<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/whr/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/whr/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" />
        <link href="/whr/App/Home/View/Public/Css/tableList.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/whr/App/Home/View/Public/js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
            <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.js"></script>
            <script type="text/javascript" src="/whr/App/Home/View/Public/Js/common.js"></script>
            
            <script type="text/javascript" src="/whr/App/Home/View/Public/Js/jquery.idTabs.min.js"></script>
            <script type="text/javascript" src="/whr/App/Home/View/Public/Js/select-ui.min.js"></script>
            <script type="text/javascript" src="/whr/App/Home/View/Public/Js/kindeditor.js"></script>
            <script type="text/javascript" src="/whr/App/Home/View/Public/Js/kindeditor.js"></script>

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
                <li><a href="#">首页</a></li>
                <li><a href="#">图片列表</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <form action="" method="post" name ="vform" id="from_sub">
                <div  id="tab2" class="tabson">
                    <ul class="seachform">
                        <li><label>名称</label><input name="name" type="text" class="scinput"value="" /></li>
                        <li><label>店铺地址</label>   <input name="address" type="text" class="scinput" value="" />  </li>
                        <li><label>分类</label>  
                            <div class="vocation">
                                <select class="select3" name = 'parent_type' >
                                    <option class="pro_into" >请选择</option>
                                    <?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><option name = 'parent_type' class = "top_cate" value="<?php echo ($list["type_id"]); ?>"><?php echo ($list["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </li>
                        <li><label>&nbsp;</label><input name="" type="button" class="scbtn" value="查询" id="like"/></li>
                    </ul>
                </div>
                <table class="imgtable">
                    <thead>
                        <tr>
                            <th width="100px;">缩略图</th>
                            <th>名称</th>
                            <th>店主</th>
                            <th>店铺地址</th>
                            <th>店铺电话</th>
                            <th>店铺状态</th>
                            <th>操作</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <!--  /whr/ -->
                                <td class="imgtd"><img src="<?php echo ($vo["list_pic"]); ?>" width="50px"/></td>
                                <td><a href="#"><?php echo ($vo["name"]); ?></a><p><?php echo (date("Y-m-d H:i:s",$vo["addtime"])); ?></p></td>
                                <td>店主名称:<?php echo ($vo["user_id"]); ?><p>店主等级：<?php echo ($vo["u_rank"]); ?></p></td>
                                <td><?php echo ($vo["provate_name"]); echo ($vo["city_name"]); echo ($vo["area_name"]); echo ($vo["address"]); ?></td>
                                <td><?php echo ($vo["mobile_phone"]); ?></td>
                                <td><?php if($vo["lock"] == 0): ?>正常<?php endif; if($vo["lock"] == 1): ?>锁定<?php endif; ?></td>
                                <td><a href="<?php echo U('add',array(id=>$vo['id']),'');?>">编辑</a>
                                    <a href="<?php echo U('del',array(id=>$vo['id']),'');?>" class="tablelink" onclick="if(confirm('确认删除')){return true}else{return false}"> 删除</a>

                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>  

                    </tbody>

                </table>
                <!--    <div class="pagin">
                        <div class="message">共<i class="blue">1256</i>条记录，当前显示第&nbsp;<i class="blue">2&nbsp;</i>页</div>
                        <ul class="paginList">
                            <li class="paginItem"><a href="javascript:;"><span class="pagepre"></span></a></li>
                            <li class="paginItem"><a href="javascript:;">1</a></li>
                            <li class="paginItem current"><a href="javascript:;">2</a></li>
                            <li class="paginItem"><a href="javascript:;">3</a></li>
                            <li class="paginItem"><a href="javascript:;">4</a></li>
                            <li class="paginItem"><a href="javascript:;">5</a></li>
                            <li class="paginItem more"><a href="javascript:;">...</a></li>
                            <li class="paginItem"><a href="javascript:;">10</a></li>
                            <li class="paginItem"><a href="javascript:;"><span class="pagenxt"></span></a></li>
                        </ul>
                    </div>
                -->
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
            </form>



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

        <script type="text/javascript">
            $('.imgtable tbody tr:odd').addClass('odd');
        </script>

    </body>

</html>