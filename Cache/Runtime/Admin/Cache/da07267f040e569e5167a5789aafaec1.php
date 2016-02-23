<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>数据还原-数据管理-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
        <?php $addCss=""; $addJs=""; $currentNav ='数据管理 > 数据还原'; ?>
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
                        <span class="fr">系统数据库备份目录下共有<?php echo ($files); ?>个SQL备份文件，共计<?php echo ($total); ?></span>
                        <div class="current">备份SQL文件列表</div>
                    </div>
                    <form>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab">
                            <thead>
                                <tr>
                                    <td width="90"><label><input name="" class="chooseAll" type="checkbox"/> 全选</label> <label><input name="" class="unsetAll" type="checkbox"/> 反选</label></td>
                                    <td>SQL文件名</td>
                                    <td>备份时间</td>
                                    <td>类型</td>
                                    <td>文件大小</td>
                                    <td>文件备注</td>
                                    <td>导入</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sql): $mod = ($i % 2 );++$i;?><tr align="center">
                                        <td><input pre="<?php echo ($sql["pre"]); ?>" type="checkbox" name="sqlFiles[]" value="<?php echo ($sql["name"]); ?>"/></td>
                                        <td align="left"><a href="<?php echo U('SysData/downFile',array('file'=>$sql['name'],'type'=>'sql'));?>" target="_blank"><?php echo ($sql["name"]); ?></a></td>
                                        <td><?php echo ($sql["time"]); ?></td>
                                        <td><?php echo ($sql["type"]); ?></td>
                                        <td><?php echo ($sql["size"]); ?></td>
                                        <td class="description" title="<?php echo ($sql["description"]); ?>">查看备注信息</td>
                                        <td><button class="btn restore" sqlPre="<?php echo ($sql["pre"]); ?>">导入</button></td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                            <tfoot align="center">
                                <tr>
                                    <td width="90"><label><input name="" class="chooseAll" type="checkbox"/> 全选</label> <label><input name="" class="unsetAll" type="checkbox"/> 反选</label></td>
                                    <td>SQL文件名</td>
                                    <td>备份时间</td>
                                    <td>类型</td>
                                    <td>总计：<?php echo ($total); ?></td>
                                    <td>文件备注</td>
                                    <td>导入</td>
                                </tr>
                            </tfoot>
                        </table>
                        <input type="hidden" name="to" id="to" value="" />
                    </form>
                    <div class="commonBtnArea" >
                        <span class="fr" id="opStatus" style="width:450px; display: none; margin: -8px; line-height: 16px;"></span>
                        <button class="btn delSqlFiles">删除所选</button>
                        <button class="btn sendSql">发送SQL到邮箱</button>
                        <button class="btn zip">压缩SQL为ZIP</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <link rel="stylesheet" type="text/css" href="<?php echo ($site["WEB_ROOT"]); ?>Public/Min/?f=__PUBLIC__/Js/poshytip/tip-yellow/tip-yellow.css|__PUBLIC__/Js/poshytip/tip-yellowsimple/tip-yellowsimple.css" />
        <script type="text/javascript" src="<?php echo ($site["WEB_ROOT"]); ?>Public/Min/?f=__PUBLIC__/Js/jquery-1.7.2.min.js|__PUBLIC__/Js/jquery.lazyload.js|__PUBLIC__/Js/functions.js|../Public/Js/base.js|__PUBLIC__/Js/jquery.form.js|__PUBLIC__/Js/asyncbox/asyncbox.js|__PUBLIC__/Js/poshytip/jquery.poshytip.min.js"></script>
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
                //刷新操作
                var repeat=function(url,type){
                    $.post(url, function(json){
//                        var json = eval("(" + json + ")");
                        if(json.status==1){
                            if(json.url){
                                $("#opStatus").html(json.info);
                                repeat(json.url,type);
                            }else{
                                popup.success(json.info,'oh yeah',function(action){
                                    if(action == 'ok'){
                                        $("#opStatus").hide('solw');
                                        $("."+type).html(type=="sendSql"?"发送SQL到邮箱":"导入");
                                    }
                                });
                                $(".btn").removeAttr("disabledSubmit");
                            }
                        }else{
                            popup.error(json.info);
                        }
                    });
                }
                $(".sendSql").click(function(){
                    if($(this).attr("disabledSubmit")){
                        popup.alert("已提交，系统在处理中...");
                        return false;
                    }
                    if($("tbody input[type='checkbox']:checked").size()==0){
                        popup.alert("请先选择你要发送到邮件中的数据库表吧");
                        return false;
                    }
                    popup.open({id:"ifrSendSql", url : "__URL__/sendSql", width : 400, height : 100, buttons : [{ value : '确定发送邮件',result : 'submit'},{ value : '取消',result : 'cancel'}],callback : function(btnRes,cntWin,reVal){
                            if(btnRes == "submit"){
                                var email=cntWin.getEmail();
                                var Reg =/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
                                if (Reg.test(email)) {
                                    $("#to").val(email);
                                    $(".btn").attr("disabledSubmit",true);
                                    $("form").ajaxSubmit({url:"__URL__/sendSql",type:"POST",success:function(json, st) {
//                                            var json = eval("(" + json + ")");
                                            if(json.status==1){
                                                if(json.url){
                                                    $("#opStatus").show().html(json.info);
                                                    repeat(json.url,"sendSql");
                                                }else{
                                                    popup.success(json.info);
                                                }
                                                popup.close("asyncbox_alert");
                                            }else{
                                                popup.error(json.info);
                                            }
                                        }
                                    });
                                    popup.close("ifrSendSql");
                                }else{
                                    popup.error("你输入的电子邮件地址格式错误");
                                }
                                return false;
                            }
                        }
                    });
                    return false;
                });
                //显示SQL文件说明信息
                $('.description').poshytip({className: 'tip-yellowsimple', showTimeout: 0.5,alignX: 'center',offsetY: 0,allowTipHover: true});
                clickCheckbox();//全新反选
                //同一备份版本任意一个卷选中则选中该卷所有文件
                $("tbody input[type='checkbox']").click(function(){$("tbody input[type='checkbox'][pre='"+$(this).attr("pre")+"']").prop("checked",$(this).prop('checked'));});
                //提交数据恢复操作
                $(".restore").click(function(){
                    if($(this).attr("disabledSubmit")){
                        popup.alert("已提交，系统在处理中...");
                        return false;
                    }
                    var sqlPre=$(this).attr("sqlPre");
                    $(".restore[sqlPre='"+sqlPre+"']").attr("disabledSubmit",true).html("导入中...");
                    $(".btn").attr("disabledSubmit",true);
                    $.getJSON("__URL__/restoreData", {sqlPre:sqlPre}, function(json){
                        if(json.status==1){
                            if(json.url){
                                $("#opStatus").show().html(json.info);
                                repeat(json.url,"restore");
                            }else{
                                popup.success(json.info);
                            }
                            popup.close("asyncbox_alert");
                        }else{
                            popup.error(json.info);
                        }
                    });
                    popup.alert("系统处理中，如果导入文件较大可能需要较长时间，请稍候....");
                    return false;
                });
                //删除备份文件
                $(".delSqlFiles").click(function(){
                    if($(this).attr("disabledSubmit")){
                        popup.alert("已提交，系统在处理中...");
                        return false;
                    }
                    if($("tbody input[type='checkbox']:checked").size()==0){
                        popup.alert("请先选择你要删除的数据库表吧");
                        return false;
                    }
                    popup.confirm('你确定要删除备份文件吗？','温馨提示',function(action){
                        if(action == 'ok'){
                            $(".btn").attr("disabledSubmit",true);
                            $(this).html("提交处理中...");
                            commonAjaxSubmit("__URL__/delSqlFiles");
                        }
                    });
                    return false;
                });

                //删除备份文件
                $(".zip").click(function(){
                    if($(this).attr("disabledSubmit")){
                        popup.alert("已提交，系统在处理中...");
                        return false;
                    }
                    if($("tbody input[type='checkbox']:checked").size()==0){
                        popup.alert("请先选择你要压缩的数据库表吧");
                        return false;
                    }
                    commonAjaxSubmit("__URL__/zipSql");
                    $(".btn").attr("disabledSubmit",true);
                    $(this).html("压缩中...");
                    return false;
                });
            });
        </script>
    </body>
</html>