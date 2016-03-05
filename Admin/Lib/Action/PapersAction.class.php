<?php

class PapersAction extends CommonAction {

    public function index() {
//            die(".............");
        $M = M("Papers");
//        die(".............");
        $count = $M->count();
        import("ORG.Util.Page");       //载入分页类
        $page = new Page($count, 20);
        $showPage = $page->show();
        $this->assign("page", $showPage);
        $this->assign("list", D("Papers")->listPapers($page->firstRow, $page->listRows));
        $this->display();
    }

   

    public function add() {
        if (IS_POST) {
            $this->checkToken();
            echo json_encode(D("Papers")->addPapers());
        } else {
            $this->assign("list", D("Teacher")->category());
            $this->display();
        }
    }

    public function checkPapersTitle() {
        $M = M("Papers");
        $where = "title='" . $this->_get('title') . "'";
        if (!empty($_GET['id'])) {
            $where.=" And id !=" . (int) $_GET['id'];
        }
        if ($M->where($where)->count() > 0) {
            echo json_encode(array("status" => 0, "info" => "已经存在，请修改标题"));
        } else {
            echo json_encode(array("status" => 1, "info" => "可以使用"));
        }
    }

/*
 *编辑
 */
    public function edit() {
        $M = M("Papers");
        if (IS_POST) {
            $this->checkToken();
            echo json_encode(D("Papers")->edit());
        } else {
            $info = $M->where("id=" . (int) $_GET['id'])->find();
            if ($info['id'] == '') {
                $this->error("不存在该记录");
            }
            $this->assign("info", $info);
            $this->assign("list", D("Papers")->category());
            $this->display("add");
        }
    }

/*
 *删除文件记录
 */
    public function del() {
        if (M("Papers")->where("id=" . (int) $_GET['id'])->delete()) {
            $this->success("成功删除");
//            echo json_encode(array("status"=>1,"info"=>""));
        } else {
            $this->error("删除失败，可能是不存在该ID的记录");
        }
    }

    public function upload(){
        $file = M('file');
        $list = $file->select();
        $this->assign('list',$list);
        $this->display();
    }   
/**************上传pdf文件**************/
    public function uploads(){
          if(empty($_FILES)){
            $this->error('务必选择上传文件');
          }else{
            $result=$this->up();
            if(isset($result)){
                if($this->c($result)){
                    $this->success('上传成功');
                }else{
                    $this->error('写入数据库失败!');
                }
            }else{
                $this->error('上传文件异常，请与老师联系');
            }
          }
    }
    /*********自定义c函数***********/
    private function c($data){
        $file=M('file');
        $num='0';
        for($i=0;$i<count($data)-1;$i++){
            $data['filename']=$data[$i]['savename'];
            if($file->data($data)->add())
            {
                $num++;
            }
        }
        if($num==count($data)-1)
        {
            return true;
        }else
        {
            return false;
        }
    }
    /***********自定义up函数***************/
    private function up(){
        import('@.ORG.UploadFile');//将UploadFile.class.php拷到Lib文件夹下
        $upload = new UploadFile();
        $upload->maxSize = '3145728';//默认-1，不限制文件大小
        $upload->savePath = './Uploads';
        $upload->saveRule = 'uniqid';//保持文件名不变
        $upload->autoCheck = true;   //是否自动检查附件
        $upload->uploadReplace = true;//如存在同名文件是否覆盖
        $upload->allowExts = array('pdf','doc');

        if($upload->upload()){
            $info=$upload->getUploadFileInfo();
            return $info;
        }else{
            $this->error($upload->getErrorMsg());//获取上传的错误信息
        }
    }
    /**************查看已提交的信息*********************/
    private function recheck(){
        if(!function_exists('read_pdf')) {
              function read_pdf($file) {
                 if(strtolower(substr(strrchr($file,'.'),1)) != 'pdf') {
                     echo '文件格式不对.';
                     return;
                 }
                 if(!file_exists($file)) {
                     echo '文件不存在';
                     return;
                 }
              header('Content-type: application/pdf');
              header('filename='.$file);
              readfile($file);
         }
        }
        read_pdf('.pdf');
    }

}