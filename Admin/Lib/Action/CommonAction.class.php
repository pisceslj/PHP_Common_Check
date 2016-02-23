<?php

class CommonAction extends Action {

    public $loginMarked;
    /**
      +----------------------------------------------------------
     * 初始化
     * 如果 继承本类的类自身也需要初始化那么需要在使用本继承类的类里使用parent::_initialize();
      +----------------------------------------------------------
     */
    public function _initialize() {
        header("Content-Type:text/html; charset=utf-8");
        header('Content-Type:application/json; charset=utf-8');
        $systemConfig = include WEB_ROOT . 'Common/systemConfig.php';//引入系统配置文件
        if (empty($systemConfig['TOKEN']['admin_marked'])) {
            $systemConfig['TOKEN']['admin_marked'] = "SynX Studio-Headquarter QQ群：413688598";//实验中心工作室群号
            $systemConfig['TOKEN']['admin_timeout'] = 3600;
            $systemConfig['TOKEN']['member_marked'] = "http://202.115.16.61:8880/experiment/Login/login.xhtml";//试验中心
            $systemConfig['TOKEN']['member_timeout'] = 3600;
            F("systemConfig", $systemConfig, WEB_ROOT . "Common/");
            if (is_dir(WEB_ROOT . "install/")) {
                delDirAndFile(WEB_ROOT . "install/", TRUE);//安装完成之后删除install文件夹
            }
        }
        $this->loginMarked = md5($systemConfig['TOKEN']['admin_marked']);//MD5加密
        $this->checkLogin();// 用户权限检查
        

        if (C('USER_AUTH_ON') && !in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE')))) 
        {
            import('ORG.Util.RBAC');
            if (!RBAC::AccessDecision()) 
            {               
                if (!$_SESSION [C('USER_AUTH_KEY')]) //检查认证识别号
                {   
                    redirect(C('USER_AUTH_GATEWAY'));//跳转到认证网关
                }
                
                if (C('RBAC_ERROR_PAGE'))            // 没有权限 抛出错误
                {
                    redirect(C('RBAC_ERROR_PAGE'));   // 定义权限错误页面
                } 
                else 
                {
                    if (C('GUEST_AUTH_ON')) 
                    {
                        $this->assign('jumpUrl', C('USER_AUTH_GATEWAY'));
                    }
                    $this->error(L('_VALID_ACCESS_')); // 提示错误信息
                }
            }
        }
        $this->assign("menu", $this->show_menu());//显示一级菜单栏，即header的横着那栏
        $this->assign("sub_menu", $this->show_sub_menu());//显示二级菜单栏，即左侧竖着那栏
        $this->assign("my_info", $_SESSION['my_info']);
        $this->assign("site", $systemConfig);
    }

    public function checkLogin() {
        if (isset($_COOKIE[$this->loginMarked])) {
            $cookie = explode("_", $_COOKIE[$this->loginMarked]);
            $timeout = C("TOKEN");
            if (time() > (end($cookie) + $timeout['admin_timeout'])) {
                setcookie("$this->loginMarked", NULL, -3600, "/");
                unset($_SESSION[$this->loginMarked], $_COOKIE[$this->loginMarked]);
                $this->error("登录超时，请重新登录", U("Public/index"));
            } else {
                if ($cookie[0] == $_SESSION[$this->loginMarked]) {
                    setcookie("$this->loginMarked", $cookie[0] . "_" . time(), 0, "/");
                } else {
                    setcookie("$this->loginMarked", NULL, -3600, "/");
                    unset($_SESSION[$this->loginMarked], $_COOKIE[$this->loginMarked]);
                    $this->error("帐号异常，请重新登录", U("Public/index"));
                }
            }
        } else {
            $this->redirect("Public/index");//重定向到Public/index
        }
        return TRUE;
    }

    /**
      +----------------------------------------------------------
     * 验证token信息
      +----------------------------------------------------------
     */
    protected function checkToken() {
        if (IS_POST) {
            if (!M("Admin")->autoCheckToken($_POST)) {
                die(json_encode(array('status' => 0, 'info' => '令牌验证失败')));
            }
            unset($_POST[C("TOKEN_NAME")]);
        }
    }

    /**
      +----------------------------------------------------------
     * 显示一级菜单
      +----------------------------------------------------------
     */
    private function show_menu() {
        $cache = C('admin_big_menu');//获取设置的admin_big_menu参数
        $count = count($cache);      //计算$cache中的单元数目
        $i = 1;
        $menu = "";
        foreach ($cache as $url => $name) {
            if ($i == 1) {
                $css = $url == MODULE_NAME || !$cache[MODULE_NAME] ? "fisrt_current" : "fisrt";
                $menu.='<li class="' . $css . '"><span><a href="' . U($url . '/index') . '">' . $name . '</a></span></li>';
            } else if ($i == $count) {
                $css = $url == MODULE_NAME ? "end_current" : "end";
                $menu.='<li class="' . $css . '"><span><a href="' . U($url . '/index') . '">' . $name . '</a></span></li>';
            } else {
                $css = $url == MODULE_NAME ? "current" : "";
                $menu.='<li class="' . $css . '"><span><a href="' . U($url . '/index') . '">' . $name . '</a></span></li>';
            }
            $i++;
        }
        return $menu;
    }

    /**
      +----------------------------------------------------------
     * 显示二级菜单
      +----------------------------------------------------------
     */
    private function show_sub_menu() {
        $big = MODULE_NAME == "Index" ? "Common" : MODULE_NAME;
        $cache = C('admin_sub_menu');
        $sub_menu = array();
        if ($cache[$big]) {
            $cache = $cache[$big];
            foreach ($cache as $url => $title) {
                $url = $big == "Common" ? $url : "$big/$url";
                $sub_menu[] = array('url' => U("$url"), 'title' => $title);
            }
            return $sub_menu;
        } else {
            return $sub_menu[] = array('url' => '#', 'title' => "该菜单组不存在");
        }
    }

}