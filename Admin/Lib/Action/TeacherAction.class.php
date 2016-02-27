<?php

class TeacherAction extends CommonAction {

    /**
     * 列出系统中所有毕业设计信息
     */
    public function index() {
        $this->display();  
    }

    /*
    *对提交的毕业设计进行分类
    */
    public function category() {
        if (IS_POST) {
            echo json_encode(D("Papers")->category());
        } else {
            $this->assign("list", D("Papers")->category());
            $this->display();
        }
    }

    /*
     *列出代管学生的名单
     */
    public function hosted(){
        //$Stu = D('student')->findall();//实例化pa_student模型
        //$list = $Stu->select();//选中所有数据
        //$this->assign('list',$list);
        //dump($Stu);
        //$this->display();
    }

    /*
     *初审任务
     */
    public function concrete(){
        $this->display();
    }

    /*
     *复审任务
     */
    public function review(){
        $this->display();
    }

    /*
     *
     */
}
?>