<?php
namespace Index\Controller;
use Think\Controller;

class UserController extends Controller {
    public function index(){
        //实例化
    	$mod=M("user");
    	 //获取需要修改的数据
        $us=$mod->find($_GET['id']);
        //分配变量
        $this->assign("us",$us);
        $this->display("index");
    }
    public function update(){
    	//实例化
    	$mod=M("user");
    	$id=I('post.id');

        //封装信息
        $a=$mod->create();
        // var_dump($a);die;
        if($mod->save()){
            $this->success("修改成功",U("User/index"));
        }else{
            $this->error("修改失败");

        }
    }
    public function xiugai(){
    	//实例化
    	$mod=M("user");
    	$id=I('post.id');
    	if($_FILES['pic']['error'] == 0){
            //检测原来的图片
            $us = $mod->find($id);
            //获取图片路径
            $imgPath = $us['pic'];
            
            //检测图片是否存在
            if(file_exists($imgPath)){
                //如果原图存在 先删除原图
                unlink($imgPath);
            }

            //上传文件
            $upload = new \Think\Upload();// 实例化上传类    
            $upload->maxSize   =     3145728 ;// 设置附件上传大小    
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型   
            $upload->rootPath = './Public/'; 
            $upload->savePath  = 'Uploads/'; // 设置附件上传目录 
              
            // 上传文件     
            $info   =   $upload->upload();

            if(!$info) {// 上传错误提示错误信息        
                echo $upload->getError();    
            }else{// 上传成功        
                
                $_POST['pic'] = $upload->rootPath.$info['pic']['savepath'].$info['pic']['savename'];
            }
        }
        //封装信息
        $_SESSION['user']['pic']=$_POST['pic'];

        $a=$mod->create();
        // var_dump($_SESSION['user']);die;
        // var_dump($a);die;
        if($mod->save()){
            $this->success("修改成功",U("User/index"));
        }else{
            $this->error("修改失败");

        }
    }
     //加载验证码
    public function verify(){
        //实例化
        $Verify=new\Think\Verify();
        //验证码字体的大小
        $Verify->fontSize=18;
        //验证码的字体的个数
        $Verify->length=4;
        //是否用干扰元素
        $Verify->useNoise=true;
        //输入验证码
        $Verify->entry();
    }
    public function update1(){
        //实例化
        $Verify=new\Think\Verify();
        //获取输入的验证码
        $fcode=$_POST['fcode'];
        if(!$Verify->check($fcode,'')){
            $this->error("验证码输入有误",U("Zhu/Index"));
        }
    	//实例化
    	$mod=M("user");
    	$id=I('post.id');
        // var_dump($id);die;
        $password=$_POST['password'];
        $oldpassword=md5($_POST['oldpassword']);
        // var_dump($oldpassword);die;
        $md=$mod->where("id=$id")->find();
        // var_dump($md['password']);die;
        if($oldpassword!=$md['password']){
            $this->error("原密码错误");
        }else{
            $_POST['password']=md5($password);
            $mod->create();
            
        }
        if($mod->save()){
                $this->success("修改成功",U("User/index"));
        }else{
                $this->error("修改失败");
        }
    	
    }

}