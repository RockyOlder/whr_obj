<?php if (!defined('THINK_PATH')) exit();?><html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Index</title>
        <link rel="stylesheet" href="/App/Home/View/Public/Css/uploadify.css">
        <script src='/App/Home/View/Public/Js/jquery.js'></script>
        <script src='/App/Home/View/Public/Js/jquery.uploadify.min.js'></script>
    </head>
    <body>
        <form enctype="multipart/form-data" method="post" action="api.php?s=survey/fetchAdd">
            <!-- <img id="img" src="http://www.thinkphp.cn/Public/new/img/header_logo.png" width="130" height="130" border="0" /> -->
            <div id="imgs"></div>
            <div id="city_list"></div>
             <!--<input id="file_upload" name="file_upload" type="file" multiple="true" value="" />--> 
             <ul>
             	<li>物业id<input type="text" name="propertyId" id="propertyId" value="" /></li>
             	<li>用户id<input type="text" name="userId" id="userId" value="" /></li>
             	<li>用户名 <input type="text" name="userName" id="userName" value="" /></li>
             	<li>标题 <input type="text" name="title" id="title" value="" /></li>
             	<li>内容 <input type="text" name="content" id="content" value="" /></li>
             	<li>价格 <input type="text" name="price" id="price" value="" /></li>
             	<li>时间 <input type="text" name="passTime" id="passTime" value="" /></li>
             	<li>图一<input type = "file" name = "phone1" value=""></li>
             	<li>图二<input type = "file" name = "phone1" value=""></li>
             	<li>图三<input type = "file" name = "phone1" value=""></li>
             	<li>图四<input type = "file" name = "phone1" value=""></li>
             </ul>
             
             
            
            <input type = "file" name = "phone2" value="">
            <input type = "file" name = "phone3" value="">
            <input type = "file" name = "phone4" value="">
            <input type="submit" value="提交">
        </form>
       
    </body>
    <script>

    //     var img = "";
    //    $('#file_upload').uploadify({
    //     'swf'      : '/App/Home/View/Public/Images/uploadify.swf',
    //     'uploader' : '<?php echo U("Test/upload");?>',
    //     'cancelImage':'/App/Home/View/Public/Images/uploadify-cancel.png',
    //     'buttonText' : '缩略图上传',
    //     'onUploadSuccess' : function(file, v, response) {
    //           obj= $.parseJSON(v);
    //           alert(obj.path);
    //         // alert(v);
    //          // img += "<img width='200px' src='"+data.path+"'>";
    //          // img += "<img width='200px' src='"+data.mid+"'>";
    //          // img += "<img width='200px' src='"+data.min+"'>";
    //             // $('#imgs').html(img);
    //         // if(data != null){
    //         //     var str=""
    //         //     $.each(data,function(key,val){
    //         //         // alert(key)
    //         //         str += "<input type = 'text' name = '' value='"+val[0]+"'/>";
    //         //     })
    //         //     $('#city_list').html(str);
    //         // }
    //         $.each(obj,function(a,b){
    //             img += "<img width='200px' src='"+b+"' name ='"+a+"'>";
    //         })
    //          $('#imgs').html(img);
    //     }
    // });
    </script>
</html>