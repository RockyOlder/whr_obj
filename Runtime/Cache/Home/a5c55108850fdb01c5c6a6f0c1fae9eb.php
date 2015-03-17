<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/App/Home/View/Public/Css/tableList.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
            <link href="/App/Home/View/Public/Css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <link id="artDialogSkin" href="/App/Home/View/Public/Css/skin/aero/aero.css" rel="stylesheet" type="text/css" />
            <link href="/App/Home/View/Public/Css/topShow.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
                <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
                <script type="text/javascript" src="/App/Home/View/Public/Js/common.js"></script>
                <script type="text/javascript" src="/App/Home/View/Public/Js/artDialog.js"></script>
                <script type="text/javascript" src="/App/Home/View/Public/Js/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
                <link href="/App/Home/View/Public/Css/topShow.css" rel="stylesheet" type="text/css" />
                <script type="text/javascript">
              
                    /*
                                         .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {border: 1px solid #cbc7bd; background: #f8f7f6 url("images/ui-bg_fine-grain_10_f8f7f6_60x60.png") 50% 50% repeat;font-weight: bold;color: #654b24;}
                     *function getLocalTime(nS) {     
                        return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');     
                                    
                    }    
                    function deleteSum(id){
                        if(confirm("确认删除"))
                            location.href="/whr/index.php?s=/Home/Developer/del/id/"+id
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
                                                 <td>"+res[i].admin+"</td><td><a href='/whr/index.php?s=/Home/Developer/delvePid/id/"+id+"' class='tablelink'>查看分部</a>\n\
                                                                     <a href='/whr/index.php?s=/Home/Developer/add/id/"+id+"' class='tablelink'>修改</a>   \n\
                                                                     <a class='tablelink'onclick='deleteSum("+id+")'> 删除</a> </td> ";
                                    table.append(select)
                                }                           
                            }
                        });
                    };
                     */
                    //        selectDeveloper()
                    $(function(){
                        $('#select_deve img').bind('click',function(){
                            $("#vform").submit();
                            //     selectDeveloper()
                        });
                        $( document ).tooltip({
                            track: true,
                            width: "100px",
                            position: {
                                my: "left+5 bottom-5", 
                                at: "center top"
                            }
                        });
                            
                            
                        initPager();
                    });
                    // $(document).ready(function(){
                    //   $(".click").click(function(){
                    //   $(".tip").fadeIn(200);
                    //   });
  
                    //   $(".tiptop a").click(function(){
                    //   $(".tip").fadeOut(200);
                    // });

                    //   $(".sure").click(function(){
                    //   $(".tip").fadeOut(100);
                    // });

                    //   $(".cancel").click(function(){
                    //   $(".tip").fadeOut(100);
                    // });
 
                    // });
                    // $(function(){
                    //     // alert(1);
                    //     loadList();
                    //     function loadList(pid){
                    //         // alert(1);
                    //         var pageSize = "20";
                    //         var cPage = ( pid==''|| pid==undefined ) ? 1 :pid;
                    //         var url="/wrt/index.php?s=/Home/Developer/index&cPage="+cPage+"&pageSize="+pageSize; 
                    //         // alert(url);
                    //         var vForm = $("#sform").serializeArray();
                    //         // partLoading('table-list');
                    //         httpRequest = $.post(encodeURI(url),vForm,function(data){
                    //             // closePartLoading('table-list');             
                    //             if( data == null ) return ;
                    //             $("#table_ajax_list").html(data.html);              
                    //             self.pageShow(data.cPage,data.count);
                    //         },'json');
                    //     }
                    // })
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
                    <input type ="hidden" name="action" value="<?php echo ($data["action"]); ?>">
                        <input type="hidden" value="/index.php?s=/Home/Developer/del/id/" id="url_ajaxCalendar" name="url_ajaxCalendar" />
                        <div class="place">
                            <span>位置：</span>
                            <ul class="placeul">
                               
                                <li><a href="<?php echo U('Index/start','','');?>">首页</a></li>
                                <li>开发商列表</li>
                            </ul>
                        </div>

                        <div class="rightinfo">

                            <div class="tools">

                                <!-- <ul class="toolbar">
                                <li class="click"><span><img src="/App/Home/View/Public/Images/t01.png" /></span>添加</li>
                                
                                <li><span><img src="/App/Home/View/Public/Images/t03.png" /></span>删除</li>
                                <li><span><img src="/App/Home/View/Public/Images/t04.png" /></span>统计</li>
                                </ul>
                                
                                
                                <ul class="toolbar1">
                                <li><span><img src="/App/Home/View/Public/Images/t05.png" /></span>设置</li>
                                </ul> -->
                                <form action="" method="post" name="vform" id="vform">
                                    <ul>
                                        <!-- <li>开发商类别:</li>
                                        <li>
                                            <select name="type">
                                                <option value="0">全部</option>
                                                <option value="1">总部</option>
                                            </select>
                                        </li> -->
                                        <li>开发商名称:</li>
                                        <li><input type="text" value="" class="form-control" name ="name" /></li>
                                        <li><span id="select_deve"><img src="/App/Home/View/Public/Images/ico06.png" width="25"/></span></li>
                                        <!-- <li></li> -->
                                    </ul>
                                </form>

                            </div>


                            <table class="tablelist">
                                <thead>
                                    <tr>
                                       
                                        <th>名称<i class="sort"><img src="/App/Home/View/Public/Images/px.gif" /></i></th>
                                        <th>集团老总</th>
                                        <th>开发商电话</th>
                                        <th>开发商账户</th>
                                        <th>添加时间</th>
                                        <th>添加人</th>
                                        <th colspan="3" align="center">操作</th>
                                    </tr>
                                </thead>

                                <tbody >
                                    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="table_ajax_list">

                   
                                            <td><?php echo ($vo["name"]); ?></td>
                                            <td><?php echo ($vo["owner"]); ?></td>
                                            <td><?php echo ($vo["phone"]); ?></td>
                                            <td><?php echo ($vo["adminUser"]); ?></td>
                                            <td><?php echo (date("Y-m-d H:i:s",$vo["addtime"])); ?></td>
                                            <td><?php echo ($vo["admin"]); ?></td>

                                            <!--   <td>
                                                   <a href="<?php echo U('delvePid',array(id=>$vo['id']),'');?>" class="tablelink">查看分部</a> 
                                                   <a href="<?php echo U('add',array(id=>$vo['id']),'');?>" class="tablelink">修改</a>    
                                                   <a  onclick="cats_Shop(<?php echo ($vo["id"]); ?>)" class="tablelink"> 删除</a>
                                               </td> -->
                                          <!-- <td width="20px" class="th_default" align="center"><a  href="<?php echo U('delvePid',array(id=>$vo['id']),'');?>" class="divBtn deleteBtn ui-state-default ui-corner-all" title="查看分部"><span class="ui-icon ui-icon-add"></span></a></td>-->
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