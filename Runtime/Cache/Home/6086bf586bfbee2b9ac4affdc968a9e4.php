<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/App/Home/View/Public/Css/style_table.css" rel="stylesheet" type="text/css" />
        <link href="/App/Home/View/Public/Css/tableList_obj.css" rel="stylesheet" type="text/css" />
        <link id="artDialogSkin" href="/App/Home/View/Public/Css/skin/aero/aero.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/App/Home/View/Public/Js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
            <script type="text/javascript" src="/App/Home/View/Public/Js/jquery.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/common.js"></script>
            <script type="text/javascript" src="/App/Home/View/Public/Js/artDialog.js"></script>
            <script type="text/javascript">
                $(function(){
                    $('#button_edit').bind('click',function()
                    {
                        if($("#deleteselete").val()==0)
                        {
                            $("#deleteselete").val(1); $("#detailDialog").hide();$("#button_submit").show(400); $("#detailDialog_edit").fadeIn(1000);$("#button_edit button").text("返回");
                        }else
                        { 
                            $("#deleteselete").val(0); $("#detailDialog").fadeIn(1000);$("#button_submit").hide(400); $("#detailDialog_edit").hide();$("#button_edit button").text("修改"); 
                        }
                    });

                        
                })
                function cats_Shop() {
                    
                    art.dialog({
                        content:'你确定要修改？',
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
                            $("#vform").submit();
                            return false;
                        }        
                    },function(){
                        return true;
                    });
                };
            </script>
    </head>
    <style type="text/css">
        .sku_tip { background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);border-radius: 4px;box-shadow: 0 0 3px 3px rgba(150, 150, 150, 0.7);color: #fff;display: none;left: 50%;margin-left: -70px; padding: 5px 10px;position: fixed; text-align: center; top: 50%;z-index: 25;}
        #divTotlePrice{ height: 50px; background: url(/App/Home/View/Public/Images/righttop.gif) repeat-x; border: 0px; margin-top: 15px; }
        #centnRight{color:  red;  font-size: 18px; float: right; margin-top: 10px; margin-right: 50px;}
        #centnRight span{ color:  red;  font-size: 18px; }
        #addSubmit{ float: right; margin-top: 3px; text-align: center; font-size: 16px; line-height:}
        #tab2{ margin-left: 32%}
        .place{  font-size: 12px;}
        .userOrder{ text-align: center; padding: 5px; color: red;}
        .userOrder h2{ font-size: 16px;}
        .placeul li a{ color:#428bca; }
        #button_edit{margin-top: 33%; margin-left:35%;  }
        #button_edit button { width: 85px; height: 40px; font-size: 16px;}
        #button_submit {margin-top: -40px; margin-left:45%;  display: none; }
        #button_submit button { width: 85px; height: 40px; font-size: 16px;}
    </style>

    <body style="background: none;">

        <div class="place">
            <span>位置：</span>
            <ul class="placeul">
                <li><a href="<?php echo U('Index/start','','');?>">首页</a></li>
                <li>店铺信息</li>
            </ul>
            <input type="hidden" id="selectadd" value="0" />
            <input type="hidden" id="deleteselete" value="0" />
        </div>
        <!--  <div id="detailDialog" style=" display: block;">
              <table cellpadding="0" cellspacing="0" border="1">
                  <tr>
                      <td width="80px" class="label">商家名称</td>
                      <td width="120px"><span id="goods_name"><?php echo ($info["name"]); ?></span></td>
                      <td class="label">移动电话</td>
                      <td><span id="show_sex"><?php echo ($info["mobile_phone"]); ?></span></td>
                      <td rowspan="3" style="text-align:center" width="120px"><img src="http://img1.3lian.com/gif/more/11/201211/72c8280fdd1c9c0d228c37891eb388b5.jpg" width="100px" height="110px"/></td>
                  </tr>
                  <tr>
                      <td width="80px" class="label">固定电话</td>
                      <td width="150px"><span id="price"><?php echo ($info["fax_mobile"]); ?></span></td>
                      <td class="label">所属类型</td>
                      <td><span id="show_mobile">商家</span></td>
                  </tr>
                  <tr>
                      <td class="label">具体地址</td>
                      <td><span id="store_id"><?php echo ($info["address"]); ?></span></td>
                      <td class="label">营业执照</td>
                      <td><span id="number"><?php echo ($info["business_license"]); ?></span></td>
                  </tr>
                  <tr>
                      <td class="label">qq</td>
                      <td><span id="cat_id"><?php echo ($info["qq"]); ?></span></td>
                      <td class="label">描述</td>
                      <td height="50px" width="300px;"><span id="if_show"><?php echo ($info["des"]); ?></span></td>
                  </tr>
  
              </table>
          </div> -->
        <div id="detailDialog" style=" display: block;">

            <table cellpadding="0" cellspacing="0" border="1">
                <tr>
                    <td width="80px" class="label">商家名称</td>
                    <td width="120px"><span id="show_name"><?php echo ($info["name"]); ?></span></td>
                    <td width="80px" class="label">移动电话</td>
                    <td width="120px"><span id="show_teacherNo"><?php echo ($info["mobile_phone"]); ?></span></td>
                    <td rowspan="3" style="text-align:center" width="120px"><img src="<?php echo ($info["company"]); ?>" width="100px" height="110px"/></td>
                  

                </tr>
                <tr>
                    <td class="label">邮政编码</td>
                    <td><span id="show_sex"><?php echo ($info["zone"]); ?></span></td>
                    <td class="label">所属类型</td>
                    <?php if($data == '0'): ?><td><span id="show_mobile">生活导航商家</span></td><?php endif; ?>
                    <?php if($data == '1'): ?><td><span id="show_mobile">VIP商家</span></td><?php endif; ?>
                </tr>
                <tr>
                    <td class="label">qq</td>
                    <td><span id="show_qq"><?php echo ($info["qq"]); ?></span></td>
                 <?php if($data == '1'): ?><td class="label">微信号</td>  <td><span id="show_homePhone"><?php echo ($info["weinxin"]); ?></span></td><?php endif; ?> 
                 <?php if($data == '0'): ?><td class="label">固定电话</td><td><span id="show_homePhone"><?php echo ($info["fax_mobile"]); ?></span></td><?php endif; ?> 
                </tr>
                <tr>
                    <td class="label">具体地址</td>
                    <td colspan="4"><span id="show_idcardNumber"><?php echo ($info["address"]); ?></span></td>
                </tr>
                <tr>
                    <td class="label">描述</td>
                    <td colspan="4"><span id="show_officeAddress"><?php echo ($info["des"]); ?></span></td>
                </tr>
                <!--  <tr>
                      <td class="label">家庭地址</td>
                      <td colspan="4"><span id="show_homeAddress"></span></td>
                  </tr> -->
            </table>
        </div>
        <div id="detailDialog_edit">
            <form action="/vip.php?s=/Home/Config/userEdit" method="post" name="vform" id="vform">
                <table cellpadding="0" cellspacing="0" border="1">
                    <tr>
                        <td width="80px" class="label">商家名称</td>
                        <td width="120px"><input type="text" id="show_name" class="dfinput" disabled="disabled" value="<?php echo ($info["name"]); ?>" ></input></td>
                        <td width="80px" class="label">移动电话</td>
                        <td width="120px"><input type="text"  id="show_teacherNo" class="dfinput" disabled="disabled" value="<?php echo ($info["mobile_phone"]); ?>"></input></td>
                     <!--   <?php if($data == '0'): ?><td rowspan="3" style="text-align:center" width="120px"><img src="<?php echo ($info["list_path"]); ?>" width="100px" height="110px"/></td><?php endif; ?>
                        <?php if($data == '1'): ?><td rowspan="3" style="text-align:center" width="120px"><img src="http://img1.3lian.com/gif/more/11/201211/72c8280fdd1c9c0d228c37891eb388b5.jpg" width="100px" height="110px"/></td><?php endif; ?> -->
                         <td rowspan="3" style="text-align:center" width="120px"><img src="<?php echo ($info["company"]); ?>" width="100px" height="110px"/></td>
                    </tr>
                    <tr>
                        <?php if($data == '0'): ?><td class="label">固定电话</td>
                        <td><input type="text" id="show_homePhone" name="fax_mobile" class="dfinput" value="<?php echo ($info["fax_mobile"]); ?>"></input></td><?php endif; ?> 
                        <?php if($data == '1'): ?><td class="label">邮政编码</td>
                        <td><input type="text" id="show_qq"  name="zone"class="dfinput" value="<?php echo ($info["zone"]); ?>"></input></td><?php endif; ?> 
                        <td class="label">所属类型</td>
                       
                    <?php if($data == '0'): ?><td><input type="text" id="show_mobile" disabled="disabled" class="dfinput" value="生活导航商家" ></input></td><?php endif; ?>
                   <?php if($data == '1'): ?><td><input type="text" id="show_mobile" disabled="disabled" class="dfinput" value="VIP商家" ></input></td><?php endif; ?>
                    </tr>
                    <tr>
                        <?php if($data == '1'): ?><td class="label">qq</td>
                        <td><input type="text" id="show_qq"  name="qq" class="dfinput" value="<?php echo ($info["qq"]); ?>"></input></td><?php endif; ?> 
                        <?php if($data == '0'): ?><td class="label">邮政编码</td>
                        <td><input type="text" id="show_qq"  name="zone"class="dfinput" value="<?php echo ($info["zone"]); ?>"></input></td><?php endif; ?> 
                        <?php if($data == '1'): ?><td class="label">微信号</td>
                        <td><input type="text" id="show_homePhone" name="weinxin"  class="dfinput" value="<?php echo ($info["weinxin"]); ?>"></input></td><?php endif; ?> 
                    </tr>
                    <tr>
                        <td class="label">具体地址</td>
                        <td colspan="4"><input type="text" name="address" class="dfinput" id="show_idcardNumber" value="<?php echo ($info["address"]); ?>"></input></td>
                    </tr>
                    <tr>
                        <td class="label">描述</td>

                        <td colspan="4"><textarea rows="10"  cols='40' style=""  name ="des" id="intro" value="<?php echo ($info["des"]); ?>"  ><?php echo ($info["des"]); ?></textarea></input></td>
                    </tr>
                    <!--  <tr>
                          <td class="label">家庭地址</td>
                          <td colspan="4"><span id="show_homeAddress"></span></td>
                      </tr> -->
                    <input type ="hidden" name="id" value="<?php echo ($info["id"]); ?>">
                    <input type ="hidden" name="bsid" value="<?php echo ($info["bsid"]); ?>">
                            </table>
                            </form>
                            </div>

                            <div id="button_edit" class="th_default" ><button class="divBtn deleteBtn ui-state-default ui-corner-all"  >修改</div></button> 
                            <div id="button_submit" class="th_default" ><button class="divBtn deleteBtn ui-state-default ui-corner-all" onclick="return cats_Shop({})" >提交</div></button> 
                            </body>

                            </html>