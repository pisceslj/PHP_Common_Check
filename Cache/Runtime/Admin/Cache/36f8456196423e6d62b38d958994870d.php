<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="<?php echo ($site["WEB_ROOT"]); ?>Public/Min/?f=../Public/Css/base.css|../Public/Css/layout.css" />
</head>
<body style="padding: 30px 50px; background: none;">
    接受邮件的地址：<input id="email" class="input" type="text" placeholder="请输入你接受sql文件的邮箱" name="email" value="" />
    <script type="text/javascript">
        function getEmail(){
            return document.getElementById("email").value;
        }
    </script>
</body>
</html>