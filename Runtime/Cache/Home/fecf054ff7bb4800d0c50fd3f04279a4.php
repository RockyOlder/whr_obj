<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/App/Home/View/Public/Css/style.css" rel="stylesheet" type="text/css" />
        <link href="/App/Home/View/Public/Css/select.css" rel="stylesheet" type="text/css" />
        <link href="/App/Home/View/Public/Css/tableList.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
              <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
            <link id="artDialogSkin" href="/App/Home/View/Public/Css/skin/aero/aero.css" rel="stylesheet" type="text/css" />
            <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/common.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/select-ui.min.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/artDialog.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
            <link href="/App/Home/View/Public/Css/topShow.css" rel="stylesheet" type="text/css" />
            <script language="javascript">
          
                function deleteSum(id){
                    if(confirm("确认删除"))
                        location.href="/whr/index.php?s=/Home/Business/del/id/"+id
                }
            </script>
            <style type="text/css">
                #table_ajax_list tr td{ height: 50px;}


            </style>
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
                    $('#select_deve img').bind('click',function(){
                        $("#from_sub").submit();
                        //     selectDeveloper()
                    });
                    
                    initPager();
                });
                function cats_Shop(id) {
                    
                    art.dialog({
                        content:'你确定要锁定？',
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
                function vip_Shop(id) {
                    
                    art.dialog({
                        content:'你确定要解锁？',
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
                            location.href=$("#url_ajaxVid").val()+id
                            return false;
                        }        
                    },function(){
                        return true;
                    });
                };
            </script>
            <style type="text/css">
                .th_default{ width: 20px; }
                .redclss{ color: red;}
                #ig_primary{float: right; margin-top: 3px;}
                .divBtn {position:relative;display:inline-block;padding:4px;cursor:pointer}
                .tablelist td{line-height:35px; border-right: dotted 1px #c7c7c7;}        
                .imgtable{width:100%;border:solid 1px #cbcbcb; }
                #close{ margin-top: -5px;}
                .imgtable td{line-height:15px; text-indent:5px; border-right: dotted 1px #c7c7c7;}
                .imgtable td img{margin:10px 20px 10px 0;}
                .imgtable td p{color:#919191;}
                .imgtable td i{font-style:normal; color:#ea2020;}
                .imgtd{text-indent:0;}
                .imgtable tbody tr.odd{background:#f5f8fa;}
                .imgtable tbody tr:hover{background:#e5ebee;}

            </style>
    </head>
    <body style="background: none;">
        <input type="hidden" value="/index.php?s=/Home/Vip/vdel/id/" id="url_ajaxCalendar" />
        <input type="hidden" value="/index.php?s=/Home/Vip/vdel/vid/" id="url_ajaxVid" />
        <div class="place">
            <span>位置：</span>
            <ul class="placeul">
                <li><a href="<?php echo U('Index/start','','');?>">首页</a></li>
                <li>VIP商家列表</li>
            </ul>
        </div>
        <div class="rightinfo">
            <form action="" method="post" name ="vform" id="from_sub">
                <div  id="tab2" class="tabson">
                    <ul class="seachform">
                        <li><label>名称</label><input name="store_name" type="text" class="scinput"value="" /></li>
                        <li><span id="select_deve"><img src="/App/Home/View/Public/Images/ico06.png" width="25"/></span></li>
                    </ul>
                </div>
                <table class="imgtable">
                    <thead>
                        <tr>
                            <th>名称</th>
                            <th>店主</th>
                            <th>店铺地址</th>
                            <th>店铺电话</th>
                            <th style=" width:50px;">操作</th>
                        </tr>
                    </thead>
                    <tbody id="table_ajax_list">
                        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <!--  / -->
                                <td><?php echo ($vo["store_name"]); ?></td>
                                <td><?php echo ($vo["user_name"]); ?></td>
                                <td><?php echo ($vo["provate_name"]); echo ($vo["city_name"]); echo ($vo["area_name"]); echo ($vo["address"]); ?></td>
                                <td><?php echo ($vo["mobile_phone"]); ?></td>

                       <!--         <td width="20px" class="th_default" align="center"><a href="<?php echo U('vadd',array(id=>$vo['store_id']),'');?>" class="divBtn editBtn ui-state-default ui-corner-all" title="编辑" ><span class="ui-icon ui-icon-pencil"></span></a></td> -->
                                <?php if($vo["lock"] == 0): ?><td width="20px" class="th_default" align="center"><div class="divBtn deleteBtn ui-state-default ui-corner-all" title="锁定"onclick="return cats_Shop(<?php echo ($vo["store_id"]); ?>)"><span class="ui-icon ui-icon-locked"></span></div></td><?php endif; ?>
                                <?php if($vo["lock"] == 1): ?><td width="20px" class="th_default" align="center"><div class="divBtn deleteBtn ui-state-default ui-corner-all" title="解锁"onclick="return vip_Shop(<?php echo ($vo["store_id"]); ?>)"><span class="ui-icon ui-icon-unlocked"></span></div></td><?php endif; ?>
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