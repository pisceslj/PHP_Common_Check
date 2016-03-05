<?php

class TeacherAction extends CommonAction {

    /**
     * 列出系统中所有毕业设计信息
     */
    public function index() {
        $M = M("Papers");
        $count = $M->count();
        import("ORG.Util.Page");       //载入分页类
        $page = new Page($count, 20);
        $showPage = $page->show();
        $this->assign("page", $showPage);
        $this->assign("list", D("Papers")->listPapers($page->firstRow, $page->listRows));
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
         $M = M("Papers");
        $count = $M->count();
        import("ORG.Util.Page");       //载入分页类
        $page = new Page($count, 20);
        $showPage = $page->show();
        $this->assign("page", $showPage);
        $this->assign("list", D("Papers")->listPapers($page->firstRow, $page->listRows));
        $this->display(); 
    }
}
?>