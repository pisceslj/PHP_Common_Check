<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加、编辑论文-后台管理-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
        <?php $addCss=""; $addJs=""; $currentNav ='论文管理 > 添加编辑论文'; ?>
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
                        <div class="current">添加编辑论文</div>
                    </div>
                    <form action="__URL__/upload" method="post" enctype="multipart/form-data">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">
                            <tr>
                                <th width="100">文章标题：</th>
                                <td><input id="title" type="text" class="input" size="60" name="info[title]" value="<?php echo ($info["title"]); ?>"/> <a href="javascript:void(0)" id="checkPapersTitle">检测是否重复</a></td>
                            </tr>

                            <tr>
                                <th width="100">文章发布状态：</th>
                                <td><label><input type="radio" name="info[status]" value="0" <?php if($info["status"] == 0): ?>checked="checked"<?php endif; ?> /> 文章审核状态</label> &nbsp; <label><input type="radio" name="info[status]" value="1" <?php if($info["status"] == 1): ?>checked="checked"<?php endif; ?> /> 文章已发布状态</label> </td>
                            </tr>
                            <tr>
                                <th>文章所属分类：</th>
                                <td>
                                    <select name="info[cid]">
                                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo[cid] == $info[cid]): ?><option value="<?php echo ($vo["cid"]); ?>" selected="selected"><?php echo ($vo["fullname"]); ?></option>
                                                <?php else: ?>
                                                <option value="<?php echo ($vo["cid"]); ?>"><?php echo ($vo["fullname"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                    </select></td>
                            </tr>
                            <tr>
                                <th>文章关键词：</th>
                                <td><input type="text" class="input" size="60" name="info[keywords]" value="<?php echo ($info["keywords"]); ?>"/> 多关键词间用半角逗号（,）分开，可用于做文章关联阅读条件</td>
                            </tr>
                            <tr>
                                <th>文章描述：</th>
                                <td><textarea class="input" style="height: 60px; width: 600px;" name="info[description]"><?php echo ($info["description"]); ?></textarea> 用于SEO的description</td>
                            </tr>
                            <tr>
                                <th>文章摘要：</th>
                                <td><textarea class="input" style="height: 60px; width: 600px;" name="info[summary]"><?php echo ($info["summary"]); ?></textarea> 如果不填写则系统自动截取文章前200个字符</td>
                            </tr>
                            <tr>
                                <th>上传文件：</th>
                                <td><input  type="file" style="height:30px;width:150px"><br/><!--input type="file" style="height:30px;width:65px" ></input--></input></td>
                            </tr>
                        </table>
                        <input type="hidden" name="info[id]" value="<?php echo ($info["id"]); ?>" />
                    </form>
                    <div class="commonBtnArea" >
                        <button class="btn submit">提交</button>
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
                $("#checkPapersTitle").click(function(){ //用Ajax获取Json数据
                    $.getJSON("__URL__/checkPapersTitle", { title:$("#title").val(),id:"<?php echo ($info["id"]); ?>"}, function(json){
                        $("#checkPapersTitle").css("color",json.status==1?"#0f0":"#f00").html(json.info);
                    });
                });
                $(".submit").click(function(){
                    //alert("提交成功！");
                    //content.sync();
                    commonAjaxSubmit();
                    return false;
                });
                /*$(".upload").click(function(){
                    //alert("hello");
                });*/
            });
        </script>
    </body>
</html>