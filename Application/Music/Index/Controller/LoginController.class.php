<?php
namespace Index\Controller;
use Think\Controller;

class LoginController extends Controller {
    //显示首页
    public function index(){
        $this->display();
    }

    //判断是否登录
    public function isLogin(){
        $username = I('username');
        $password = I('password','','md5');
        //模型类
        $user = M('User');
        $where['username'] = ':username';
        $where['password'] = ':password';
        //绑定变量
        $bind[':username'] =   array($username, \PDO::PARAM_STR);
        $bind[':password'] =   array($password, \PDO::PARAM_STR);
      
        //查询是否有该用户
        $result = $user->where($where)->bind($bind)->find();

                if ($result) {
                    //保存用户名和用户ID到session中
                    session('user',$result);            //保存用户整个信息到session中
                    session('username',$result['username']);
                    session('user_id',$result['id']);                
                    $this->success('登录成功',U('Index/Index/index'));
                } else {
                    $this->error('账号密码输入错误!重新登录!');
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
        $this->success("退出成功",U("Index/index"));
    }
}