<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>缓存管理-后台管理首页-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
        <?php $addCss=""; $addJs=""; $currentNav ='网站管理 > 缓存管理'; ?>
        <base href="<?php echo ($site["WEB_ROOT"]); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo ($site["WEB_ROOT"]); ?>Public/Min/?f=../Public/Css/base.css|../Public/Css/layout.css|__PUBLIC__/Js/asyncbox/skins/default.css<?php echo ($addCss); ?>" />
<script type="text/javascript" src="<?php echo ($site["WEB_ROOT"]); ?>Public/Min/?f=__PUBLIC__/Js/jquery-1.9.0.min.js|__PUBLIC__/Js/jquery.lazyload.js|__PUBLIC__/Js/functions.js|../Public/Js/base.js|__PUBLIC__/Js/jquery.form.js|__PUBLIC__/Js/asyncbox/asyncbox.js<?php echo ($addJs); ?>"></script>
    </head>
    <body>
        <div class="wrap">
            <div id="Top">
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
            <div class="mainBody">
                <div id="Left">
    <div id="control" class=""></div>
    <div class="subMenuList">
        <div class="itemTitle"><?php if(MODULE_NAME == 'Index'): ?>常用操作<?php else: ?>子菜单<?php endif; ?> </div>
        <ul>
            <?php if(is_array($sub_menu)): foreach($sub_menu as $key=>$sv): ?><li><a href="<?php echo ($sv["url"]); ?>"><?php echo ($sv["title"]); ?></a></li><?php endforeach; endif; ?>
        </ul>
    </div>
</div>
                <div id="Right">
                    <div class="Item hr">
                        <div class="current">缓存管理</div>
                    </div><form>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab">
                        <thead>
                            <tr>
                                <td style="text-align: left;" colspan="4"><label><input name="" class="chooseAll" type="checkbox"/> 全选</label>&nbsp;&nbsp;&nbsp;&nbsp; <label><input name="" class="unsetAll" type="checkbox"/> 反选</label></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($caches)): $k = 0; $__LIST__ = $caches;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cache): $mod = ($k % 2 );++$k; if($k%2==1) echo "<tr>"; ?>
                                <td width="30" align="center"><input type="checkbox" name="cache[]" value="<?php echo ($key); ?>" /></td>
                                <td><?php echo ($cache["name"]); ?><br/> (<?php echo ($cache["path"]); ?>)</td>
                                <?php if($k%2==0) echo "</tr>"; endforeach; endif; else: echo "" ;endif; ?>
                            <?php if(count($caches)%2==1) echo '<td>&nbsp;</td><td>&nbsp;</td></tr>'; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4"><label><input name="" class="chooseAll" type="checkbox"/> 全选</label>&nbsp;&nbsp;&nbsp;&nbsp; <label><input name="" class="unsetAll" type="checkbox"/> 反选</label></td>
                            </tr>
                        </tfoot>
                    </table>
                    </form>
                    <div class="commonBtnArea" >
                        <button class="btn submit">清除已选缓存</button>
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
                clickCheckbox();
                $(".submit").click(function(){
                    if($("tbody input[type='checkbox']:checked").size()==0){
                        popup.alert("请先选择要删除的缓存吧");
                        return false;
                    }
                    commonAjaxSubmit();
                });
            });
        </script>
    </body>
</html>