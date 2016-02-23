<?php

class IndexAction extends CommonAction {

    public function index() {
        
        $this->display();
    }

    public function myInfo() {
        if (IS_POST) {
            $this->checkToken();
            echo json_encode(D("Index")->my_info($_POST));
        } else {
            $this->display();
        }
    }

    public function cache() {
        $caches = array(
            "HomeCache" => array("name" => "网站前台缓存文件", "path" => WEB_CACHE_PATH . "Home/Cache/"),
            "AdminCache" => array("name" => "网站后台缓存文件", "path" => WEB_CACHE_PATH . "Runtime/Admin/Cache/"),
            "HomeData" => array("name" => "网站前台数据库字段缓存文件", "path" => WEB_CACHE_PATH . "Runtime/Home/Data/"),
            "AdminData" => array("name" => "网站后台数据库字段缓存文件", "path" => WEB_CACHE_PATH . "Runtime/Admin/Data/"),
            "HomeLog" => array("name" => "网站前台日志缓存文件", "path" => WEB_CACHE_PATH . "Runtime/Home/Logs/"),
            "AdminLog" => array("name" => "网站后台日志缓存文件", "path" => WEB_CACHE_PATH . "Runtime/Admin/Logs/"),
            "HomeTemp" => array("name" => "网站前台临时缓存文件", "path" => WEB_CACHE_PATH . "Runtime/Home/Temp"),
            "AdminTemp" => array("name" => "网站后台临时缓存文件", "path" => WEB_CACHE_PATH . "Runtime/Admin/Temp"),
            "Homeruntime" => array("name" => "网站前台runtime.php缓存文件", "path" => WEB_CACHE_PATH . "Runtime/Home/~runtime.php"),
            "Adminruntime" => array("name" => "网站后台runtime.php缓存文件", "path" => WEB_CACHE_PATH . "Runtime/Admin/~runtime.php"),
            "MinFiles" => array("name" => "JS\CSS压缩缓存文件", "path" => WEB_CACHE_PATH . "MinFiles/")
        );
        if (IS_POST) {
            foreach ($_POST['cache'] as $path) {
                if (isset($caches[$path]))
                    delDirAndFile($caches[$path]['path']);
            }
            echo json_encode(array("status"=>1,"info"=>"缓存文件已清除"));
        } else {
            $this->assign("caches", $caches);
            $this->display();
        }
    }

}