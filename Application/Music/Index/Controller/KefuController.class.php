<?php
namespace Index\Controller;
use Think\Controller;
header("content-type:text/html;charset=utf-8");
class KefuController extends Controller {
    public function index(){
    	$this->display("index");
    }
    public function check(){
        $mod=M("User");
        //获取提交的数据
        $username=$_POST['username'];
        $password=md5($_POST['password']);
        $row=$mod->where("(username='{$username}' or email='{$username}') and password='{$password}'")->limit(1)->select();
        // var_dump($row);die;
        if($row){
            //将数据写入session数组
            $_SESSION['user']=$row[0];
            if ($_SESSION['url']){
                $this->success("登录成功",U($_SESSION['url']));
            }else{
             $this->success("登录成功",U("Kefu/index"));
         }
        }else{
            $this->error("登录失败",U("Kefu/index"));
        }
    }
     //退出登录
    public function logout(){
        //先去清除客户端
        setcookie(session_name(),"",time()-3600000,"/");
        //清除session数组
        $_SESSION=array();
        //清除session文件
        session_destroy();
        $this->success("退出成功",U("Kefu/index"));
    }
    //执行反馈内容的添加
    public function insert(){
        if($_SESSION['user']==""){
            $this->error("请先登录",U("Kefu/index"));
        }
    	if($_FILES['pic']['error'] == 0){
            //上传文件
            $upload = new \Think\Upload();// 实例化上传类    
            $upload->maxSize   =     3145728 ;// 设置附件上传大小    
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型   
            $upload->rootPath = './Public/'; 
            $upload->savePath  = 'Uploads/'; // 设置附件上传目录    
            // 上传文件     
            $info   =   $upload->upload();

            if(!$info) {        
                echo $upload->getError();    
            }else{
                $_POST['pic'] = $upload->rootPath.$info['pic']['savepath'].$info['pic']['savename'];
            }
        }
    	//实例化
    	$mod=M("kefu");
    	//获取要存入的信息
    	$username=$_POST['username'];
    	// $username=$_SESSION['user']['username'];
    	// var_dump($username);die;
    	$email=$_POST['email'];
    	// var_dump($email);die;
    	$VIP=$_POST['VIP'];
    	$text=$_POST['text'];
    	$QQ=$_POST['QQ'];
    	$time=time();
    	$_POST['time']=$time;
    	$mod->create();
    	if($mod->add()){
    		$this->success("提交成功",U("Kefu/index"));
    	}else{
    		$this->error("提交失败");
    	}
    }
}