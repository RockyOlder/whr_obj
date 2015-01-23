<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/default/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/default/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" />
        <link href="/default/App/Home/View/Public/Css/tableList.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/default/App/Home/View/Public/js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">

            <script type="text/javascript" src="/default/App/Home/View/Public/Js/jquery.js"></script>
            <script type="text/javascript" src="/default/App/Home/View/Public/Js/jquery.idTabs.min.js"></script>
            <script type="text/javascript" src="/default/App/Home/View/Public/Js/select-ui.min.js"></script>
            <script type="text/javascript" src="/default/App/Home/View/Public/Js/kindeditor.js"></script>
            <script type="text/javascript" src="/default/App/Home/View/Public/Js/kindeditor.js"></script>
            <script type="text/javascript" src="/default/App/Home/View/Public/Js/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
            <script language="javascript">
                KE.show({
                    id : 'content7',
                    cssPath : './index.css'
                });
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
                    $("#detailDialog").draggable({
                        cancel:"table"
                    });
                    $("#close").bind("click",function(e){
                        // $(this).parent().removeAttr("id");   
                        //   $(this).parent().removeClass();  
                  // var xtop= $("#detailDialog").position().top;
                   //alert(xtop)
                 //  console.log(e.clientY)
                        $("#detailDialog").css({
                            //'top':"'"+e.clientY+"'px",
                            'top':'50px',
                            "left":'0px'
                        })
                        $(this).parent().hide(1000);  
                    })
                });
                function showDetail(teacherId){
                    var xtop= $("#showlist"+teacherId).position().top;
                    var xleft=$("#showlist"+teacherId).position().left;
                 //   alert(xtop)
                    $("#detailDialog").position(
                    {
                        my: "top"+xtop+"px",
                       // at: xleft+"px",
                        of: window
                    });
                    $.ajax({ 
                        url:$("#url_getTeacher").val(),
                        type:"post",
                        dataType:"json",
                        cache:false,
                        data: {"id":teacherId},
                        timeout:30000,
                        error:function(data, msg){
                            alert("error:"+msg);
                        },
                        success:function(data){
                          /*  $("#goods_name").text(data.goods_name?data.goods_name:"");
                            $("#price").text(data.price?data.price:"");
                            $("#show_mobile").text(data.mobile?data.mobile:"");
                            $("#if_show").text(data.sex==1?"是":data.sex==0?"否":"保密");
                            $("#show_officePhone").text(data.office_phone?data.office_phone:"");
                            $("#show_homePhone").text(data.home_phone?data.home_phone:"");
                            $("#show_entryTime").text(data.qq?data.qq:"");
                            $("#show_teacherPid").text(data.qq?data.qq:"");
                            $("#show_qq").text(data.qq?data.qq:"");
                            $("#show_email").text(data.email?data.email:"");
                            $("#show_wechatNo").text(data.wechat_no?data.wechat_no:"");
                            $("#show_homePage").text(data.home_page?data.home_page:"");
                            $("#show_idcardNumber").text(data.idcard_number?data.idcard_number:"");
                            $("#show_officeAddress").text(data.office_address?data.office_address:"");
                            $("#show_homeAddress").text(data.home_address?data.home_address:"");
                            //$("#photo_path").attr("src",data.photo_path);*/
                            $("#detailDialog").fadeIn(1000);
                        }
                    });
                }
            </script>
            <style>
                #close{ font-size: 16px; border: 2px solid;}

            </style>
    </head>


    <body style="background: none;">
        <input type="hidden" value="/default/index.php?s=/Home/Owner/details" id="url_getTeacher" name="url_getTeacher" />
        <div class="place">
            <span>位置：</span>
            <ul class="placeul">
                <li>业主管理</li>
                <li>业主列表</li>
            </ul>
        </div>
        <div class="rightinfo">
            <form action="" method="post" name ="vform" id="from_sub">
                <div  id="tab2" class="tabson">
                    <ul class="seachform">
                        <li><label>姓名</label><input name="name" type="text" class="scinput"value="" /></li>
                        <li><label>电话</label>   <input name="mobile" type="text" class="scinput" value="" />  </li>
                        <li><label>地址</label>   <input name="address" type="text" class="scinput" value="" />  </li>
                        <li><label>&nbsp;</label><input name="" type="button" class="scbtn" value="查询" id="like"/></li>
                        <a href="<?php echo U('fee','','');?>"><li><label>&nbsp;</label><input name="" type="button" class="btn btn-info" value="导入业主账单" id="like"/></li></a>
                    </ul>
                </div>

                <table class="imgtable">
                    <thead>
                        <tr>
                            <th>业主编号</th>
                            <th>业主名字</th>
                            <th>电话</th>
                            <th>地址</th>
                            <th>操作</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <!--  /default/ -->
                                <td class="imgtd"><?php echo ($vo["id"]); ?></td>
                                <td><?php echo ($vo["name"]); ?></a></td>
                                <td><?php echo ($vo["mobile"]); ?></td>
                                <td><?php echo ($vo["address"]); ?></td>
                                <td>
                                    <a href="<?php echo U('add',array(id=>$vo['id']),'');?>">编辑</a>
                                    <a class="tablelink" onclick="deleteSum('<?php echo ($vo["goods_id"]); ?>')"> 删除</a>
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
                        <span><img src="/default/App/Home/View/Public/Images/ticon.png" /></span>
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
                <span><img src="/default/App/Home/View/Public/Images/ticon.png" /></span>
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