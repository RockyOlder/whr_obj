<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>vip商品评论</title>
        <link rel="stylesheet" href="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
        <link href="/Mobile/View/Public/css/tableList.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/Mobile/View/Public/js/jquery-ui/css/pepper-grinder/jquery-ui.min.css">
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="/Mobile/View/Public/js/common.js"></script>
        <script type="text/javascript" src="/Mobile/View/Public/js/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>

        <style>

            html, body { padding: 0; margin: 0; background: #f8f8f8;}
            li{list-style: none;}
            .imgtd{ float: right;  position:  absolute;}
            .timeDate{ float: right;padding: 0 10px; }
            .commentsData{margin-top:20px; }
            .commentsData span,i{ font-size: 14px; color:  silver; }
            .spanPaading{padding: 0 10px; }
            .contentData{color:  silver;font-size: 13px; margin-left: 35px; }
            .star{position:relative;height:24px; margin-top: -20px;margin-left: 53px;width: 95px;}
           
            .contentData{color:  silver;font-size: 13px; margin-left: 35px; }
            .star{position:relative;height:24px; margin-top: -20px;margin-left: 53px;width: 95px;}
            #pageTwo{ }
            .star .huixing{width: 95px;background: url(/Mobile/View/Public/images/star.png) ;height: 20px;}
            .star .yellowstar{width: 95px;background: url(/Mobile/View/Public/images/star.png) 0  19px ;height: 20px;position: absolute;top: 0px;left: 0px ;}
            .imgWidth{ float: left; z-index: 999; position: absolute;  display: none; margin-left: -28px;}
            .imgCenterObject{padding: 0 10px; }
        </style>
        <script>
            $(function(){  
                //  alert(1)
              
                $('.imgCenterObject').click(function(){
              //  var maskScrollTop=  $(document).scrollTop();
      //  alert($(window).height());
   //   alert($(document.body).height());       
      //  alert($(document.body).outerHeight(true));
                    var maskHeight = $(document).height();  
                    var maskWidth = $(document).width();
                    //alert(maskWidth)
                    //添加遮照层
                    $('<div class="mask"></div>').appendTo($('body'));
                    $('div.mask').css({
                        'opacity':0.4,
                        'background':'#000',
                        'position':'absolute',
                        'left':0,
                        'top':0,
                        'height':maskHeight,
                        'width':maskWidth,
                        'z-index':2


                    });
                    $(this).next().show();
                
                    //  console.log(maskHeight)
                        $(this).next().css({
                            'top':$(document).scrollTop()+150,
                            "left":'center'
                        })
               
                    //			//关闭
                    $('.imgWidth').click(function(){
                        $(this).hide();
                        $('.mask').remove();

                    });
                });
                initPager();
                    
            })
            
        </script>
    </head>
    <body>

        <div data-role="page" id = "pageTwo"> 

            <div data-role="navbar">
                <div data-role="content">

                    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="commentsData">

                            <span class="spanPaading"><img src="<?php echo ($vo["face"]); ?>" height="35px;" width="35px"/></span>
                            <i class="timeDate"><?php echo (date("Y-m-d",$vo["time"])); ?></i>
                            <span class="imgtd"><?php echo ($vo["user_name"]); ?></span> 
                            <input type="hidden" value="<?php echo ($vo["star"]); ?>">

                            <div class="star">
                                <div class ="huixing">

                                </div>
                                <div class ="yellowstar" style="width:<?php echo ($vo["star"]); ?>%">

                                </div>

                            </div>
                            <p class="contentData"><?php echo ($vo["content"]); ?></p>
                            <div>
                                <?php if($vo['pic'] != ''): if(is_array($vo["pic"])): $i = 0; $__LIST__ = $vo["pic"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pic): $mod = ($i % 2 );++$i;?><img src="<?php echo ($pic["path"]); ?>" alt="<?php echo ($pic["name"]); ?>" width="20%" class="imgCenterObject">
                                        <img class="imgWidth" src="<?php echo ($pic["path"]); ?>" alt="<?php echo ($pic["name"]); ?>" width="200px" height="200px"><?php endforeach; endif; else: echo "暂时没有数据" ;endif; endif; ?>
                            </div>
                            <hr style="height:1px;border:none;border-top:1px solid silver;" />

                        </div><?php endforeach; endif; else: echo "" ;endif; ?>   

                    <!--<table>
                      <?php if(is_array($info["type"])): $k = 0; $__LIST__ = $info["type"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
                        <td><?php echo ($vo); ?></td>
                      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </table> -->

                </div>

            </div>
            <div id="pager" class="pager">
                <div class="fanye">
                    <div class="fanye1">
                        <?php echo ($page); ?>
                    </div>

                </div>
            </div>

        </div>


    </body>
</html>