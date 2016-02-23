<?php

ob_start();
ini_set('date.timezone', 'Asia/Shanghai');
define('THINK_PATH', './ThinkPHP/');
define('APP_NAME', 'Admin');
define('APP_PATH', './admin/');
define('APP_DEBUG', TRUE);
define('SITE_PATH', getcwd());//网站当前路径
define("RUNTIME_PATH", SITE_PATH . "/Cache/Runtime/Admin/");
define("WEB_ROOT", dirname(__FILE__) . "/");

if (!file_exists(WEB_ROOT.'Common/systemConfig.php')) {
    header("Location: install/");
    exit;
}
require(THINK_PATH . "ThinkPHP.php");

?>