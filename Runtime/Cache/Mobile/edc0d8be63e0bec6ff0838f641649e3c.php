<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
 <title>社区调查</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">

 <link rel="stylesheet" href="/Mobile/View/Public/jquery.mobile-1.4.5.min.css" /> 
 <script src="/Mobile/View/Public/jquery-1.8.0.min.js"></script> 
 <script src="/Mobile/View/Public/jquery.mobile-1.4.5.min.js"></script> 
 <style type="text/css">
#alert{position: absolute;top: 150px;left:5%;width: 80%;display:none;border:1px solid #333;background: #BDE6E2;border-radius: 10px;padding: 20px;}
#alert2{position: absolute;top: 150px;left:5%;width: 80%;display:none;border:1px solid #333;background: #BDE6E2;border-radius: 10px;padding: 20px;}
 </style>
</head>
<body> 
	<div data-role="page"> 
		<div data-role="content" id ="bodyone">
			<p  data-role="title"><?php echo ($data["title"]); ?></p>
			<p  data-role="title"><?php echo ($data["content"]); ?></p>            
<form method="post" action ="" data-ajax="false">

    <fieldset data-role="controlgroup">
    <legend>请投上你珍贵的一票:</legend>
    <input type="radio" name="answer" id="radio-choice-1" value="1" checked="checked" />
    <label for="radio-choice-1">非常满意</label>

    <input type="radio" name="answer" id="radio-choice-2" value="2" />
    <label for="radio-choice-2">满意</label>

    <input type="radio" name="answer" id="radio-choice-3" value="3" />
    <label for="radio-choice-3">一般</label>

    <input type="radio" name="answer" id="radio-choice-4" value="4" />
    <label for="radio-choice-4">差</label>
    <input type="radio" name="answer" id="radio-choice-5" value="5" />
    <label for="radio-choice-5">很差</label>
    </fieldset>
    <input type="hidden"value = "<?php echo ($_GET['id']); ?>" name = "id">
    <input type="hidden"value = "<?php echo ($_GET['uid']); ?>" name = "uid">

    <input type="button" id="update" value="提交">
     
    <div data-role="footer"><h4><?php echo (C("web_copy")); ?></h4></div>
</form>
		</div>
         <div id="alert" data-role="content" >
        <p>感谢你的参与,祝您生活愉快</p> 
        <p style="text-align:right">慧享园</p>
        <input type="button" id="update_ok" value="确定" data-them="a" onclick="window_close()"><!--  -->
        </div>
        <div id="alert2" data-role="content" >
        <p>感谢你的关注,你已经参加过改该调查，不能重复投票，谢谢！</p> 
        <p style="text-align:right">慧享园</p>
        <input type="button" id="update_ok" value="确定" data-them="a" onclick="window_close()"><!--  -->
        </div>
	</div>
    <input type="hidden" name="twotime" value="<?php echo ($end); ?>">
</body> 
<script type="text/javascript">
    $(function(){
        $('#update').click(function(){
            var date = $('form').serialize();
            $.ajax({
                type: "POST",
                url: "mobile.php?s=Index/index",
                data: date,
                dataType: "json",
                success: function(data){
                if(data){
                    $('#bodyone').hide(100);
                    $('#alert').show(200);
                }
                
                }, 
                error:function(){
                    alert('提交失败');
                }
            })
        })
        var  times = $('input[name=twotime]').val();
        if (times == 1) {
            $('#bodyone').hide();
            $('#alert2').show(100);
        };
    })
</script>
<script language="javascript">
    
        
        function window_close(){
        var u = navigator.userAgent;

        if(u.indexOf('Android') > -1 || u.indexOf('Linux') > -1)//安卓手机
        // window.location.href = "mobile/index.html";
            window.dc.js_finish()
        
        if(u.indexOf('iPhone') > -1)//苹果手机
        // window.location.href = "mobile/index.html";
            document.location='objc://popToBack'
         /*else if (u.indexOf('Windows Phone') > -1) */
        }
        
    
</script>
</html>