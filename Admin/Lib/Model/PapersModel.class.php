<?php

class PapersModel extends Model {

    public function listPapers($firstRow = 0, $listRows = 20) {
        $stuArr = M("student")->field("`id`,`stu_id`,`stu_name`,`stu_major`,`stu_mobile`")->select();//选中student表中的stu_id和stu_name
        foreach($stuArr as $k => $v){
            $sids[$v['id']] = $v;
        }
        //dump($sids);//ok
        unset($stuArr);

        $M = M("papers");
        $list = $M->field("`id`,`title`,`status`,`published`,`cid`,`aid`,`teacher`")->order("`published` DESC")->limit("$firstRow , $listRows")->select();
        $statusArr = array("审核状态", "已发布状态");
        //dump($list);//ok

        $aidArr = M("Admin")->field("`aid`,`email`,`nickname`")->select();
        foreach ($aidArr as $k => $v) {
            $aids[$v['aid']] = $v;
        }
        //dump($aidArr);//ok
        //dump($aids);
        unset($aidArr);
        
        $cidArr = M("Category")->field("`cid`,`name`")->select();
        foreach ($cidArr as $k => $v) {
            $cids[$v['cid']] = $v;
        }
        //dump($cidArr);//ok
        //dump($cids);
        unset($cidArr);
        
        foreach ($list as $k => $v) {
            $list[$k]['aidName'] = $aids[$v['aid']]['nickname'] ==' '? $aids[$v['aid']]['email'] : $aids[$v['aid']]['nickname'];
            $list[$k]['status'] = $statusArr[$v['status']];
            $list[$k]['cidName'] = $cids[$v['cid']]['name'];
            $list[$k]['stuId'] =   $sids[$v['id']]['stu_id'];
            $list[$k]['stuName'] = $sids[$v['id']]['stu_name'];
            $list[$k]['stuMajor'] = $sids[$v['id']]['stu_major'];
            $list[$k]['stuMobile'] = $sids[$v['id']]['stu_mobile'];
        }
        //dump($list);
        return $list;
    }

    

    public function addPapers() {
        $M = M("Papers");
        $data = $_POST['info'];
        $data['published'] = time();
        $data['aid'] = $_SESSION['my_info']['aid'];
        if (empty($data['summary'])) {
            $data['summary'] = cutStr($data['content'], 200);//截取文章前200字
        }
        if ($M->add($data)) {
            return array('status' => 1, 'info' => "已经发布", 'url' => U('Papers/index'));
        } else {
            return array('status' => 0, 'info' => "发布失败，请刷新页面尝试操作");
        }
    }

    public function edit() {
        $M = M("Papers");
        $data = $_POST['info'];
        $data['update_time'] = time();
        if ($M->save($data)) {
            return array('status' => 1, 'info' => "已经更新", 'url' => U('Papers/index'));
        } else {
            return array('status' => 0, 'info' => "更新失败，请刷新页面尝试操作");
        }
    }

    public function upload(){
        $M = M("Papers");
        $data = $_POST['info'];
    }

}

?>
