<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>添加编辑节点-权限管理-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
    <?php $addCss=""; $addJs=""; $currentNav ='权限管理 > 添加编辑节点'; ?>
    <base href="<?php echo ($site["WEB_ROOT"]); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo ($site["WEB_ROOT"]); ?>Public/Min/?f=../Public/Css/base.css|../Public/Css/layout.css|__PUBLIC__/Js/asyncbox/skins/default.css<?php echo ($addCss); ?>" />
<script type="text/javascript" src="<?php echo ($site["WEB_ROOT"]); ?>Public/Min/?f=__PUBLIC__/Js/jquery-1.9.0.min.js|__PUBLIC__/Js/jquery.lazyload.js|__PUBLIC__/Js/functions.js|../Public/Js/base.js|__PUBLIC__/Js/jquery.form.js|__PUBLIC__/Js/asyncbox/asyncbox.js<?php echo ($addJs); ?>"></script>
</head>
<body>
    <div class="wrap"> <div id="Top">
    <div class="logo"><a href="<?php echo ($site["WEB_ROOT"]); ?>"><img src="../Public/Img/logo.png" /></a></div>
    <div class="help"><a href="#">使用帮助</a><span><a href="#">关于</a></span></div>
    <div class="menu">
        <ul> <?php echo ($menu); ?> </ul>
    </div>
</div>
<div id="Tags">
    <div class="userPhoto"><img src="../Public/Img/userPhoto.jpg" /> </div>
    <div class="navArea">
        <div class="userInfo"><div><a href="<?php echo U('Webinfo/index');?>" class="sysSet"><span>&nbsp;</span>系统设置</a> <a href="<?php echo U("Public/loginOut");?>" class="loginOut"><span>&nbsp;</span>退出系统</a></div>欢迎您，<?php echo ($my_info["email"]); ?> | <a href="#">个人信息管理</a></div>
        <div class="nav"><font id="today"><?php echo date("Y-m-d H:i:s"); ?></font>您的位置：<?php echo ($currentNav); ?></div>
    </div>
</div>
<div class="clear"></div>
        <div class="mainBody"> <div id="Left">
    <div id="control" class=""></div>
    <div class="subMenuList">
        <div class="itemTitle"><?php if(MODULE_NAME == 'Index'): ?>常用操作<?php else: ?>子菜单<?php endif; ?> </div>
        <ul>
            <?php if(is_array($sub_menu)): foreach($sub_menu as $key=>$sv): ?><li><a href="<?php echo ($sv["url"]); ?>"><?php echo ($sv["title"]); ?></a></li><?php endforeach; endif; ?>
        </ul>
    </div>
</div>
            <div id="Right">
                <div class="contentArea">
                    <div class="Item hr">
                        <div class="current">添加编辑节点</div>
                    </div>
                    <form action="" method="post">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">
                            <tr>
                                <th width="120">名称：</th>
                                <td><input name="name" type="text" class="input" size="40" value="<?php echo ($info["name"]); ?>" /> 英文，为MODEL_NAME的时候首字母大写</td>
                            </tr>
                            <tr>
                                <th>显示名：</th>
                                <td><input class="input" name="title" type="text" size="40" value="<?php echo ($info["title"]); ?>" /> 中英文均可</td>
                            </tr>
                            <tr>
                                <th>状态：</th>
                                <td><select name="status" style="width: 80px;"><?php if($info["status"] == 1): ?><option value="1" selected>启用</option><option value="0">禁用</option><?php else: ?><option value="1">启用</option><option value="0" selected>禁用</option><?php endif; ?></select> 如果禁用那么只有超级管理员才可以访问，其他用户都无权访问</td>
                            </tr>
                            <tr>
                                <th>类型：</th>
                                <td><select name="level" style="min-width: 80px;"><?php echo ($info["levelOption"]); ?></select> 项目（GROUP_NAME;  模块(MODEL_NAME); 操作（ACTION_NAME）</td>
                            </tr>
                            <tr>
                                <th>父级节点：</th>
                                <td><select name="pid" style="min-width: 80px;"><?php echo ($info["pidOption"]); ?></select></td>
                            </tr>
                            <tr>
                                <th>显示排序：</th>
                                <td><input class="input" name="sort" type="text" size="40" value="<?php echo ($info["sort"]); ?>" /> </td>
                            </tr>
                            <tr>
                                <th>描 述：</th>
                                <td><textarea name="remark" style="width: 400px;"><?php echo ($info["remark"]); ?></textarea></td>
                            </tr>
                        </table>
                        <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>"/>
                    </form>
                    <div class="commonBtnArea" >
                        <button class="btn submit">提交</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
<div id="Bottom">© 2015 All rights reserved By <a href="http://www.ss.uestc.edu.cn/" target="_blank">电子科技大学信软学院</a></div>
<script type="text/javascript">
    $(window).resize(autoSize);
    $(function(){
        autoSize();
        $(".loginOut").click(function(){
            var url=$(this).attr("href");
            popup.confirm('你确定要退出吗？','你确定要退出吗',function(action){
                if(action == 'ok'){ window.location=url; }
            });
            return false;
        });

        var time=self.setInterval(function(){$("#today").html(date("Y-m-d H:i:s"));},1000);


    });

</script>
<script type="text/javascript">
    $(function(){
        $("select[name='level']").change(function(){
            var level=$(this).val();
            $("select[name='pid']>option").attr("disabled","disabled");
            if(level==1){
                $("select[name='pid']>option[value='0']").removeAttr("disabled").attr("selected","selected");
            }else if(level==2){
                $("select[name='pid']>option[level='1']").removeAttr("disabled");
            }else{
                $("select[name='pid']>option[level='2']").removeAttr("disabled");
            }
        });

        $(".submit").click(function(){
            commonAjaxSubmit();
        });
    });
</script>
</body>
</html>