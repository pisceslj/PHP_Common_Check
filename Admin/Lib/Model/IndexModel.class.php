<?php

class IndexModel extends Model {

    /*public function list_info($firstRow = 0, $listRows = 20){
        $stuArr = M("student")->field("`id`,`stu_id`,`stu_name`")->select();//选中student表中的stu_id和stu_name
        foreach($stuArr as $k => $v){
            $sids[$v['aid']] = $v;
        }
        unset($stuArr);

        $M = M("papers");
        $list = $M->field("`id`,`title`,`status`,`published`,`teacher`,`cid`,`aid`")->order("`published` DESC")->limit("$firstRow , $listRows")->select();
        
        $statusArr = array("审核状态", "已发布状态");

        $aidArr = M("Admin")->field("`aid`,`email`,`nickname`")->select();
        foreach ($aidArr as $k => $v) {
            $aids[$v['aid']] = $v;
        }
        unset($aidArr);
        
        $cidArr = M("Category")->field("`cid`,`name`")->select();
        foreach ($cidArr as $k => $v) {
            $cids[$v['cid']] = $v;
        }
        unset($cidArr);
        
        foreach ($list as $k => $v) {
            $list[$k]['aidName'] = $aids[$v['aid']]['nickname'] ==' '? $aids[$v['aid']]['email'] : $aids[$v['aid']]['nickname'];
            $list[$k]['status'] = $statusArr[$v['status']];
            $list[$k]['cidName'] = $cids[$v['cid']]['name'];
            $list[$k]['stuId'] =   $sids[$v['id']]['stu_id'];
            $list[$k]['stuName'] = $sids[$v['id']]['stu_name'];
        }
        //dump($list);
        return $list;
    }*/
    


    public function my_info($datas) {
        $M = M("Admin");
        if (md5(C("AUTH_CODE") . md5($datas['pwd0'])) != $_SESSION['my_info']['pwd']) {
            return array('status' => 0, 'info' => "旧密码错误");
        }
        if (trim($datas['pwd']) == '') {
            return array('status' => 0, 'info' => "密码不能为空");
        }
        if (trim($datas['pwd']) != trim($datas['pwd1'])) {
            return array('status' => 0, 'info' => "两次密码不一致");
        }
        $data['aid'] = $_SESSION['my_info']['aid'];
        $data['pwd'] = md5(C("AUTH_CODE") . md5($datas['pwd']));
        if ($M->save($data)) {
            setcookie("$this->loginMarked", NULL, -3600, "/");
            unset($_SESSION["$this->loginMarked"], $_COOKIE["$this->loginMarked"]);
            return array('status' => 1, 'info' => "你的密码已经成功修改，请重新登录",'url'=>U('Access/index'));
        } else {
            return array('status' => 0, 'info' => "密码修改失败");
        }
    }

}

?>
