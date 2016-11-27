<?php
namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller {

    //显示后台登录页面
    public function index () {

        $this->display();
    }


    //判断登录
    public function isLogin () {

        $username = I('username');
        $password = I('password','','md5');
        $checkCode = I('checkCode');
        //模型类
        $admin = M('admin');
        $where['username'] = ':username';
        $where['password'] = ':password';
        //绑定变量
        $bind[':username'] =   array($username, \PDO::PARAM_STR);
        $bind[':password'] =   array($password, \PDO::PARAM_STR);
      
        //查询是否有该用户
        $result = $admin->where($where)->bind($bind)->find();
        
        if (R('Home/Common/check_verify', array('code'=>$checkCode))) {

                if ($result) {
                	//保存用户名和用户ID到session中
                    session('username',$result['username']);
                    session('user_id',$result['id']);                  
                    $this->success('登录成功',U('Home/Index/index'));
                } else {
                    $this->error('账号密码输入错误!重新登录!');
                }


        } else {

            $this->error('验证码错误,重新登录!');
        }

    }

    //退出登录方法
    public function logout(){
        //先去清除客户端
        setcookie(session_name(),"",time()-1,"/");
        //清除session数组
        $_SESSION=array();
        //清除session文件
        session_destroy();
        $this->success("退出成功",U('Home/Login/index'));
    }

}