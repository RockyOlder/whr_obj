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
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Css/bootstrap.min.css">
            <link href="/App/Home/View/Public/Css/topShow.css" rel="stylesheet" type="text/css" />
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
                    $('.scbtn').bind('click',function(){
                        $('#from_sub').submit();
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
            <style>
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
   <input type="hidden" value="/life.php?s=/Home/Business/GoodsDel/id/" id="url_ajaxCalendar" name="url_ajaxCalendar" />

    <body style="background: none;">

        <div class="place">
            <span>位置： </span>
            <ul class="placeul">
                <li><a href="<?php echo U('Index/start','','');?>">首页</a></li>
                <li>商品列表</li>
            </ul>
        </div>
        <div class="rightinfo">
            <form action="" method="post" name ="vform" id="from_sub">
                <div  id="tab2" class="tabson">
                    <ul class="seachform">
                        <li><label>名称</label><input name="lgname" type="text" class="scinput"value="" /></li>

                        <li><label>分类</label>  
                            <div class="vocation">
                                <select class="select3" name = 'cate_pid' >
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
                            <th>商品名称</th>
                            <th>所属商家</th>
                            <th>价格</th>
                            <th>市场价</th>
                            <th colspan="3">操作</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <!--  / -->
                                <td class="imgtd"><img src="<?php echo ($vo["list_pic"]); ?>" width="50px"/></td>
                                <td><?php echo ($vo["lgname"]); ?></td>
                                <td><?php echo ($vo["name"]); ?></td>
                                <td><?php echo ($vo["price"]); ?></td>
                                <td><?php echo ($vo["m_price"]); ?></td>
                                <!--<td><a href="<?php echo U('goodsadd',array(id=>$vo['lgid']),'');?>">编辑</a>
                                    <a href="<?php echo U('del',array(id=>$vo['lgid']),'');?>" class="tablelink" onclick="if(confirm('确认删除')){return true}else{return false}"> 删除</a>
                                    <?php if($vo["num"] == 0): ?><a href="<?php echo U('recommendedGoods',array(id=>$vo['lgid']),'');?>">推荐</a><?php endif; ?>
                                </td> -->
                                <td width="20px" class="th_default" align="center"><a href="<?php echo U('goodsadd',array(id=>$vo['lgid']),'');?>" class="divBtn editBtn ui-state-default ui-corner-all" title="编辑" ><span class="ui-icon ui-icon-pencil"></span></a></td>
                                <td width="20px" class="th_default" align="center"><div class="divBtn deleteBtn ui-state-default ui-corner-all" title="删除"onclick="return cats_Shop(<?php echo ($vo["lgid"]); ?>)"><span class="ui-icon ui-icon-minus"></span></div></td>
                                <!--<td width="20px" class="th_default" align="center"> <?php if($vo["num"] == 0): ?><a href="<?php echo U('recommendedGoods',array(id=>$vo['lgid']),'');?>" class="divBtn editBtn ui-state-default ui-corner-all" title="推荐" ><span class="ui-icon ui-icon-shop"></span></a></td><?php endif; ?>-->
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