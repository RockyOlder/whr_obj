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
            <script type="text/javascript" src="/App/Home/View/Public/Js/artDialog.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
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
                    $("#detailDialog").draggable({
                        cancel:"table"
                    });
                    $("#close").bind("click",function(e){
                        //  console.log(e.clientY)
                        $(".soData").each(function(){ $(this).remove();});
                        //   $("td[title=data]").each(function(){ $(this).remove();});
                        $("#detailDialog").css({
                            'top':'0px',
                            "left":'0px'
                        })
                        $(this).parent().hide(500);  
                    })
                    initPager();

                    $('#city_list').bind('change',function(){
                        //   alert(1)
                        var id=$(this).val();
                        //    alert(id)                                                                                                                          
                        $.ajax({
                            url : "<?php echo U('CategoryClassification ','','');?>",
                            type : "post",
                            data : "id="+id,
                            dataType : "json",
                            success : function(data){        
                                console.log(data)   
                                if(data==false){
                                    $('#vocation_list').hide(200);
                                }
                                if(data != false){
                                    $("#val_list .city_in").remove();
                                    if($(".city_in").val()!==''){
                              
                                        var str=""
                                        var inex= this//selected=selected
                                                                                                                                                                      
                                        $.each(data,function(key,val){
                                            str += "<option class='city_in' value="+val['cat_id']+">"+val['cat_name']+"</option>";
                                        })
                                        $('#val_list').append(str);
                                        $('#vocation_list').show(200);
                                   //     $(".cat_in").text('请选择')
                                    }
                                }
                            }
                                                                                                                                                             
                        });  
                    })
                    
                    
                    
                });
                function showDetail(teacherId){
                    $(".soData").each(function(){ $(this).remove();});
                    $("#detailDialog").position(
                    {
                        my: "top",
                        at: "top",
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
                            // console.log(data)
                            $("#goods_name").text(data.goods_name?data.goods_name:"");
                            $("#price").text(data.price?data.price:"");
                            $("#show_sex").text(data.inventory?data.inventory:"");
                            $("#if_show").text(data.sex==1?"是":data.sex==0?"否":"保密");
                            $("#show_marque").text(data.marque?data.marque:"");
                            $("#number").text(data.number?data.number:"");
                            $("#cat_id").text(data.cat_name?data.cat_name:"");
                            $("#store_id").text(data.store_name?data.store_name:"");

                            $("#shop_list_img").attr("src",data.list_img);
                            if(data.info!= null){
                                //  alert(typeof(data.type))
                                var str=""
                                $.each(data.info,function(key,val){
                                    str+="<tr class='soData'>";                            
                                    str+="<td class='label' width='130px'>"+key+"</td><td width='530px'><span>"+val+"</span></td>";
                                    str+="</tr>";                                                                                                                       
                                }) 
                                $("#tableAdd").append(str);
                            }
            
                            $("#detailDialog").fadeIn(1000);
                            //    $("#tableAdd").remove(str);
                        }
                    });
                }
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
                .placeul li a{ color:#428bca; }
            </style>
    </head>


    <body style="background: none;">
        <input type="hidden" value="/vip.php?s=/Home/Goods/details" id="url_getTeacher" name="url_getTeacher" />
         <input type="hidden" value="/vip.php?s=/Home/Goods/del/id/" id="url_ajaxCalendar" name="url_ajaxCalendar" />
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
                        <li><label>名称</label><input name="name" type="text" class="scinput"value="" /></li>

                        <li><label>分类</label>  
                            <div class="vocation">
                                <select class="select3"  id="city_list"  style=" width: 110px;" name="parent_id">
                                    <option class="pro_into" >请选择</option>
                                    <?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><option  class = "top_cate" value="<?php echo ($list["cat_id"]); ?>"><?php echo ($list["cat_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </li>
                        <li> 
                            <div class="vocation"  id="vocation_list" style=" display:  none;">
                                <select class="select3" name = 'cat_id' id="val_list"  >
                                    <option  class = "cat_in">请选择</option>
                                </select>
                            </div></li>
                        <li><label>&nbsp;</label><input name="" type="button" class="scbtn" value="查询" id="like"/></li>
                    </ul>
                </div>

                <table class="imgtable">
                    <thead>
                        <tr>
                            <th width="100px;">列表图片</th>
                            <th>商品名字</th>
                            <th>单价</th>
                            <th>销售数量：</th>
                            <th>库存:</th>
                            <th>描述</th>
                            <th  colspan="4">操作</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <!--  / -->
                                <td class="imgtd"><img src="<?php echo ($vo["list_img"]); ?>" width="50px"/></td>
                                <td><?php echo ($vo["goods_name"]); ?></a></td>
                                <td><?php echo ($vo["price"]); ?></a></td>
                                <td><?php echo ($vo["number"]); ?></td>
                                <td><?php echo ($vo["inventory"]); ?></td>
                                <td><?php echo ($vo["description"]); ?></td>
                                <!--   <td><a id="showlist<?php echo ($vo["goods_id"]); ?>" href="javascript:showDetail(<?php echo ($vo["goods_id"]); ?>)" title="详情">详情</a>
                                    <a href="<?php echo U('add',array(id=>$vo['goods_id']),'');?>">编辑</a>
                                 <a class="tablelink" onclick="deleteSum('<?php echo ($vo["goods_id"]); ?>')"> 删除</a> 
                                    <?php if($vo["num"] == 0): ?><a href="<?php echo U('activity',array(id=>$vo['goods_id']),'');?>">促销</a><?php endif; ?>
                                    
                                </td>-->
                                <td width="20px" class="th_default" align="center"><a id="showlist<?php echo ($vo["goods_id"]); ?>"  href="javascript:showDetail(<?php echo ($vo["goods_id"]); ?>)" class="divBtn deleteBtn ui-state-default ui-corner-all" title="详情"><span class="ui-icon ui-icon-add"></span></a></td>
                                <td width="20px" class="th_default" align="center"><a href="<?php echo U('add',array(id=>$vo['goods_id']),'');?>" class="divBtn editBtn ui-state-default ui-corner-all" title="编辑" ><span class="ui-icon ui-icon-pencil"></span></a></td>
                                <td width="20px" class="th_default" align="center"><div class="divBtn deleteBtn ui-state-default ui-corner-all" title="删除" onclick="return cats_Shop(<?php echo ($vo["goods_id"]); ?>)"><span class="ui-icon ui-icon-minus"></span></div></td> 
                              <!--  <td width="20px" class="th_default" align="center"> <?php if($vo["num"] == 0): ?><a href="<?php echo U('activity',array(id=>$vo['goods_id']),'');?>" class="divBtn editBtn ui-state-default ui-corner-all" title="促销" ><span class="ui-icon ui-icon-shop"></span></a></td><?php endif; ?>-->



                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>  

                    </tbody>

                </table>
                <div id="detailDialog">
                    <div id="close" title="关闭" class="divBtn editBtn ui-state-default ui-corner-all"><span class="ui-icon ui-icon-circle-close"></span></div>
                    <table cellpadding="0" cellspacing="0" border="1" id="tableAdd">
                        <tr>
                            <td width="80px" class="label">商品名字</td>
                            <td width="120px" ><span id="goods_name"></span></td>
                            <td width="80px" class="label">价 格</td>
                            <td width="120px"><span id="price"></span></td>
                            <td rowspan="3" style="text-align:center" width="120px"><img id="shop_list_img" src="" width="100px" height="110px"/></td>
                        </tr>
                        <tr>
                            <td class="label">库 存</td>
                            <td><span id="show_sex"></span></td>
                            <td class="label">商品型号</td>
                            <td><span id="show_marque"></span></td>
                        </tr>
                        <tr>
                            <td class="label">是否上架</td>
                            <td><span id="if_show"></span></td>
                            <td class="label">销售数量</td>
                            <td><span id="number"></span></td>
                        </tr>
                        <tr>
                            <td class="label">分类</td>
                            <td><span id="cat_id"></span></td>
                            <td class="label">商家名称</td>
                            <td><span id="store_id"></span></td>
                        </tr>
                        <!--   <tr>
                              <td class="label">促销价</td>
                              <td><span id="markdown"></span></td>
                              <td class="label">添加时间</td>
                              <td colspan="2"><span id="add_time"></span></td>
                          </tr>
                          <tr>
                              <td class="label">商品赠送积分</td>
                              <td><span id="points"></span></td>
                              <td class="label">品牌</td>
                              <td colspan="2"><span id="brand"></span></td>
                          </tr>	
                          <tr>
                               <td class="label">身份证号</td>
                               <td colspan="4"><span id="show_idcardNumber"></span></td>
                           </tr>
                           <tr>
                               <td class="label">办公地址</td>
                               <td colspan="4"><span id="show_officeAddress"></span></td>
                           </tr>
                           <tr>
                               <td class="label">家庭地址</td>
                               <td colspan="4"><span id="show_homeAddress"></span></td>
                           </tr> 
                        -->
                    </table>
                </div>
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