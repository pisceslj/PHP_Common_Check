<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>数据压缩包管理-数据管理-后台管理-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
        <?php $addCss=""; $addJs=""; $currentNav ='数据管理 > 数据压缩包管理'; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo ($site["WEB_ROOT"]); ?>Public/Min/?f=../Public/Css/base.css|../Public/Css/layout.css|__PUBLIC__/Js/asyncbox/skins/default.css<?php echo ($addCss); ?>" />
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
                        <span class="fr">共有<?php echo ($files); ?>个压缩包文件，共计<?php echo ($total); ?></span>
                        <div class="current">数据库压缩包文件列表</div>
                    </div>
                    <form>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab">
                            <thead>
                                <tr>
                                    <td width="90"><label><input name="" class="chooseAll" type="checkbox"/> 全选</label> <label><input name="" class="unsetAll" type="checkbox"/> 反选</label></td>
                                    <td>压缩包名称</td>
                                    <td>打包时间</td>
                                    <td>文件大小</td>
                                    <td>解压</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zip): $mod = ($i % 2 );++$i;?><tr align="center">
                                        <td><input type="checkbox" name="zipFiles[]" value="<?php echo ($zip["file"]); ?>"/></td>
                                        <td align="left"><a href="<?php echo U('SysData/downFile',array('file'=>$zip['file'],'type'=>'zip'));?>" target="_blank"><?php echo ($zip["file"]); ?></a></td>
                                        <td><?php echo ($zip["time"]); ?></td>
                                        <td><?php echo ($zip["size"]); ?></td>
                                        <td><button class="btn unzip" file="<?php echo ($zip["file"]); ?>">解压</button></td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                            <tfoot align="center">
                                <tr>
                                    <td width="90"><label><input name="" class="chooseAll" type="checkbox"/> 全选</label> <label><input name="" class="unsetAll" type="checkbox"/> 反选</label></td>
                                    <td>压缩包名称</td>
                                    <td>备份时间</td>
                                    <td>总计：<?php echo ($total); ?></td>
                                    <td>解压</td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                    <div class="commonBtnArea" >
                        <span class="fr" id="opStatus" style="width:450px; display: none; margin: -8px; line-height: 16px;"></span>
                        <button class="btn delZipFiles">删除所选</button>
                        <button class="btn unzipSelect">解压缩所选</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <script type="text/javascript" src="<?php echo ($site["WEB_ROOT"]); ?>Public/Min/?f=__PUBLIC__/Js/jquery-1.7.2.min.js|__PUBLIC__/Js/jquery.lazyload.js|__PUBLIC__/Js/functions.js|../Public/Js/base.js|__PUBLIC__/Js/jquery.form.js|__PUBLIC__/Js/asyncbox/asyncbox.js"></script>
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
                //全新反选
                clickCheckbox();

                var repeat=function(url){
                    $.post(url, function(json){
//                        var json = eval("(" + json + ")");
                        if(json.status==1){
                            if(json.url){
                                $("#opStatus").html(json.info);
                                repeat(json.url);
                            }else{
                                popup.success(json.info,'oh yeah',function(action){
                                    if(action == 'ok'){
                                        $("#opStatus").hide('solw');
                                        $(".unzipSelect").html('解压缩所选');
                                    }
                                });
                                $(".btn").removeAttr("disabledSubmit");
                            }
                        }else{
                            popup.error(json.info);
                        }
                    });
                }

                $(".unzipSelect").click(function(){
                    if($(this).attr("disabledSubmit")){
                        popup.alert("已提交，系统在处理中...");
                        return false;
                    }
                    if($("tbody input[type='checkbox']:checked").size()==0){
                        popup.alert("请先选择你要删除的数据库表吧");
                        return false;
                    }
                    var files=[];
                    $("tbody input[type='checkbox'][name='zipFiles[]']:checked").each(function(i){
                        files[i]=$(this).val();
                    });
                    $.post("__URL__/unzipSqlfile", {'zipFiles':files}, function(json){
//                        var json = eval("(" + json + ")");
                        if(json.status==1){
                            if(json.url){
                                $("#opStatus").show().html(json.info);
                                repeat(json.url);
                            }else{
                                popup.success(json.info);
                            }
                            popup.close("asyncbox_alert");
                        }else{
                            popup.error(json.info);
                        }
                    });

                    return false;
                });


                $(".unzip").click(function(){
                    $.post("__URL__/unzipSqlfile",{'zipFiles[]':$(this).attr("file")},function(json){
//                        var json = eval("(" + json + ")");
                        json.status==1?popup.success(json.info):popup.error(json.info);
                        $(".btn").removeAttr("disabledSubmit");
                        if(json.url&&json.url!=''){
                            setTimeout(function(){
                                top.window.location.href=json.url;
                            },2000);
                        }
                    });
                    return false;
                });
                //删除备份文件
                $(".delZipFiles").click(function(){
                    if($(this).attr("disabledSubmit")){
                        popup.alert("已提交，系统在处理中...");

                    }
                    if($("tbody input[type='checkbox']:checked").size()==0){
                        popup.alert("请先选择你要删除的zip文件吧");
                        return false;
                    }
                    popup.confirm('你确定要删除备份文件吗？','温馨提示',function(action){
                        if(action == 'ok'){
                            $(".btn").attr("disabledSubmit",true);
                            $(this).html("提交处理中...");
                            commonAjaxSubmit("__URL__/delZipFiles");
                        }
                    });
                    return false;
                });
            });
        </script>
    </body>
</html>