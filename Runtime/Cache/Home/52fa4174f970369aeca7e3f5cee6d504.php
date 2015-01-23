<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
        <script type="text/javascript" src="/App/Home/View/Public/Js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
            <input type ="hidden" name="action" value="<?php echo ($data["action"]); ?>"></input>
                <script type="text/javascript">
                    function deleteSum(id){
                        if(confirm("确认删除"))
                            location.href="/whr/index.php?s=/Home/Developer/del/pid/"+id
                    }
                    /*       function getLocalTime(nS) {     
                        return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');     
                    }    
      
                    var selectDeveloper = function() {

                        $.getJSON('<?php echo U("selectDeveloper");?>', function(res) {
                            console.log(res);
                            var table=$(".tablelist");
                            if($(".tablelist tr td").text()==''){
                                for(var i=0; i<res.length; i++)  
                                {  
                                    var id=res[i].id
                                  
                                    var select="<tr><td><input name='num' type='checkbox' value='' /></td>\n\
                                                 <td>"+res[i].id+"</td>\n\
                                                 <td>"+res[i].name+"</td>\n\
                                                 <td>"+res[i].owner+"</td>\n\
                                                 <td>"+res[i].phone+"</td>\n\
                                                 <td>"+getLocalTime(res[i].addtime)+"</td>\n\
                                                 <td>"+res[i].admin+"</td><td><a href='<?php echo U('sonlist',array(id=>"+res[i].id+"),'');?>' class='tablelink'>查看分部</a>\n\
                                                                     <a href='/whr/index.php?s=/Home/Developer/add/id/"+id+"' class='tablelink'>修改</a>   \n\
                                                                     <a class='tablelink'onclick='deleteSum("+id+")'> 删除</a> </td> ";
                                    table.append(select)
                                }                           
                            }
                        });
                    };
                    selectDeveloper()
                    $(function(){
                        $('#select_deve').bind('click',function(){
                            selectDeveloper()
                        });
                    });*/
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
                            <li><a href="#">开发商管理</a></li>
                            <li><a href="#">开发商列表</a></li>
                            <li><a href="#">开发商分布</a></li>
                        </ul>
                    </div>
                    <div class="rightinfo">
                        <div class="tools">
                            <form action="" method="post" name="vform" id="vform">
                                <ul>

                                    <li>开发商总部信息:</li>
                                    <li>名称:<?php echo ($data["name"]); ?></li>
                                    <li>手机:<?php echo ($data["phone"]); ?></li>
                                    <li>负责人:<?php echo ($data["owner"]); ?></li>
                                    <!-- <li></li> -->
                                </ul>
                            </form>
                        </div>
                        <table class="tablelist">
                            <thead>
                                <tr>
                                    <th><input name="" type="checkbox" value="" checked="checked"/></th>
                                    <th>编号<i class="sort"><img src="/App/Home/View/Public/Images/px.gif" /></i></th>
                                    <th>名称</th>
                                    <th>负责人</th>
                                    <th>电话</th>
                                    <th>添加时间</th>
                                    <th>添加人</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody >
                                <?php if(is_array($pid)): $i = 0; $__LIST__ = $pid;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="table_ajax_list">
                                        <td><input name='num' type='checkbox' value='' /></td>
                                        <td><?php echo ($vo["id"]); ?></td>
                                        <td><?php echo ($vo["name"]); ?></td>
                                        <td><?php echo ($vo["owner"]); ?></td>
                                        <td><?php echo ($vo["phone"]); ?></td>
                                        <td><?php echo (date("Y-m-d H:i:s",$vo["addtime"])); ?></td>
                                        <td><?php echo ($vo["admin"]); ?></td>

                                        <td>
                                            <a href="<?php echo U('class_Update',array(id=>$vo['id']),'');?>" class="tablelink">修改</a>    
                                            <a class="tablelink" onclick="deleteSum('<?php echo ($vo["id"]); ?>')"> 删除</a>
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