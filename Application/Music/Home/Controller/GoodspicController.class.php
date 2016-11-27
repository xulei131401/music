<?php
namespace Home\Controller;
use Think\Controller;

class GoodspicController extends Controller {
    
    //加载添加页面
    public function add(){
        $this->display();
    }

    // 执行添加
    public function insert(){

        $fff=$_FILES;
        $_FILES=null;
       
        //实例化
        $upload=new\Think\Upload();
        //初始化
        $upload->sizeMax=3141557;//文件大小
        $upload->exts=array("jpeg","png","jpg","gif");//文件类型
        $upload->rootPath   =   './Public/';       //网站跟目录是./
        $rootPath =  $upload->rootPath;             //保存根路径
        $upload->savePath  =     'Home/Uploads/Goods/'; //设置管理员头像附件上传目录
        $upload->saveName = array("uniqid","asaddfafx".rand(1235343,5235353531));
        
        // 循环一次次上传  
        foreach($fff as $k=>$v){
            $_FILES=array();
            $_FILES[$k]=$v;
           
            //执行上传
            $info=$upload->upload();

            if(!$info){
                $this->error($upload->getError());
            }else{
                // 将上传的地址赋值给$_POST[$k];
                $_POST[$k]=$rootPath.$info[$k]['savepath'].$info[$k]['savename'];
                // 清除本次上传在$_FILES中留下的值
                $_FILES=null;
            }
        }
 
        //实例化
        $mod=M("Goodspic");
        //封装信息
        $mod->create();
        if($mod->add()){
            $this->success("添加成功",U("Goodspic/index"));
        }else{
            $this->error("添加失败");
        }
    }

    // 加载修改页面
    public function edit(){
        //实例化
        $mod=M("Goodspic");
        //获取需要修改的数据
        $ob=$mod->find($_GET['id']);
        //分配变量
        $this->assign("ob",$ob);
        //加载模板
        $this->display("edit");
    }

    //执行修改
    public function update(){
        // 将全局数组赋值给变量存储
        $fff=$_FILES;
        $_FILES=null; 

        //实例化
        $upload=new\Think\Upload();
        //初始化
        $upload->sizeMax=3141557;//文件大小
        $upload->exts=array("jpeg","png","jpg","gif");//文件类型
        $upload->rootPath   =   './Public/';       //网站跟目录是./
        $rootPath =  $upload->rootPath;             //保存根路径
        $upload->savePath  =     'Home/Uploads/Goods/'; //设置管理员头像附件上传目录
        $upload->saveName = array("uniqid","asaddfafx".rand(1235343,5235353531));
        
        // 循环一次次上传修改 
        foreach($fff as $k=>$v){         
            // 判断有没有图片修改
           
            if(!empty($v['name'])){
                $_FILES=array();
                $_FILES[$k]=$v;
                //执行上传
                $info=$upload->upload();

                if(!$info){
                    $this->error($upload->getError());
                }else{
                    // 删除原前的图片
                    unlink($_POST['old'.$k]);
                    // 将上传的地址赋值给$_POST[$k];
                    $_POST[$k]=$rootPath.$info[$k]['savepath'].$info[$k]['savename'];
                    // 清除本次上传在$_FILES中留下的值
                    $_FILES=null;
                }
            }
        }
 
        //实例化
        $mod=M("Goodspic");
        //封装信息
        $mod->create();
        if($mod->save()){
            $this->success("修改成功",U("Goodspic/index"));
        }else{
            $this->error("修改失败");
        }
    }

    //查询分页信息
    public function index(){
        //封装查询信息
        $where=array();
        if(!empty($_POST['gid'])){
            $where['gid']=$_POST['gid'];
        }
        //实例化
        $mod=M("Goodspic");
        //获取总数
        $num=$mod->where($where)->count();
        //实例化分页
        $page=new\Think\Page($num,5);
        //设置分页
        $page->setConfig("prev","上一页");
        $page->setConfig("next","下一页");
        $list=$mod->where($where)->limit($page->firstRow,$page->listRows)->order("id asc")->select();
        //分配变量
        $this->assign("list",$list);
        //分配页面变量
        $this->assign("pageinfo",$page->show());
        //加载目标
        $this->display();
    }

    // 执行删除
    function del(){
        $mod=M("Goodspic");
        $ob=$mod->find($_GET['id']);
        // dump($ob);
        // 删除图片
        unlink($ob['imgindex']);
        unlink($ob['imglb1']);
        unlink($ob['imglb2']);
        unlink($ob['imglb3']);
        unlink($ob['imglb4']);
        unlink($ob['imglb5']);
        unlink($ob['imgad']);
        if($mod->delete($_GET['id'])){
           
            $this->success("删除成功",U("Goodspic/index"));
        }else{
            $this->error("删除失败");
        }
    }
}