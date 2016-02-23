<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>论文分类管理-论文管理-后台管理首页-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
        <?php $addCss=""; $addJs=""; $currentNav ='论文管理 > 论文分类管理'; ?>
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
                        <div class="current">论文分类管理</div>
                    </div>
                    <form action="" method="post" id="quickForm">
                        <b>添加分类：</b>
                        <input type="hidden" name="act" value="add" /> &nbsp;
                        <select name="data[pid]">
                            <option value="0">顶级分类</option>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["cid"]); ?>"><?php echo ($vo["fullname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>  &nbsp;
                        <input placeholder="你要添加的分类名称" id="newName" class="input" type="text" name="data[name]" value="" /> &nbsp;
                        <button class="btn quickSubmit">确定添加</button>
                    </form>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tab">
                        <thead>
                            <tr align="center">
                                <td width="10%">原分类CID</td>
                                <td width="20%">原分类结构 <b title="单击分类隐藏/显示该分类下在子类">[i]</b></td>
                                <td width="20%" align="left">操作属性</td>
                                <td width="20%">新分类</td>
                                <td width="20%">修改后的名称</td>
                                <td width="10%">操作</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tree): $mod = ($i % 2 );++$i;?><tr pid="<?php echo ($tree["pid"]); ?>" cid="<?php echo ($tree["cid"]); ?>">
                                    <td width="10%" align="center"><?php echo ($tree["cid"]); ?><input type="hidden" name="cid" value="<?php echo ($tree["cid"]); ?>"/></td>
                                    <td width="20%" class="tree" style="cursor: pointer;"><?php echo ($tree["fullname"]); ?></td>
                                    <td width="20%">
                                        <select name="act" class="act">
                                            <option selected="selected" value="edit">修改该分类</option>
                                            <option value="del">删除该分类</option>
                                            <option value="add">在该分类中添加子类</option>
                                        </select>
                                    </td>
                                    <td width="20%">
                                        <select name="pid">
                                            <option value="0">顶级分类</option>
                                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i; if($vo1['cid'] == $tree['cid']): ?><option value="<?php echo ($vo1["cid"]); ?>" selected="selected" readonly><?php echo ($vo1["fullname"]); ?></option>
                                                    <?php else: ?>
                                                    <option value="<?php echo ($vo1["cid"]); ?>"><?php echo ($vo1["fullname"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                    </td>
                                    <td width="20%"><input type="text" value="" name="name" class="input" placeholder="你要修改分类的新名称"/></td>
                                    <td align="center" width="10%"><button class="btn opCat">确定</button></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <form action="" method="post" id="opForm">
            <input id="cid" type="hidden" name="data[cid]" />
            <input id="act" type="hidden" name="act" />
            <input id="pid" type="hidden" name="data[pid]" />
            <input id="name" type="hidden" name="data[name]" />
        </form>
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
                $(".opCat").click(function(){
                    var obj=$(this).parents("tr");
                    $("#cid").val(obj.find("input[name='cid']").val());
                    $("#act").val(obj.find("select[name='act']").val());
                    $("#pid").val(obj.find("select[name='pid']").val());
                    $("#name").val(obj.find("input[name='name']").val());
                    if($("#act").val()=="del"){
                        popup.confirm('你真的打算删除该分类吗?','温馨提示',function(action){
                            if(action == 'ok'){
                                commonAjaxSubmit("","#opForm");
                            }
                        });
                        return false;
                    }
                    commonAjaxSubmit("","#opForm");
                });
                $(".quickSubmit").click(function(){
                    if($("#newName").val()==''){
                        popup.alert("分类名称不能为空滴！");
                        return false;
                    }
                    commonAjaxSubmit("","#quickForm");
                    return false;
                });

                var chn=function(cid,op){
                    if(op=="show"){
                        $("tr[pid='"+cid+"']").each(function(){
                            $(this).removeAttr("status").show();
                            chn($(this).attr("cid"),"show");
                        });
                    }else{
                        $("tr[pid='"+cid+"']").each(function(){
                            $(this).attr("status",1).hide();
                            chn($(this).attr("cid"),"hide");
                        });
                    }
                }
                $(".tree").click(function(){
                    if($(this).attr("status")!=1){
                        chn($(this).parent().attr("cid"),"hide");
                        $(this).attr("status",1);
                    }else{
                        chn($(this).parent().attr("cid"),"show");
                        $(this).removeAttr("status");
                    }
                });
            });
        </script>
    </body>
</html>