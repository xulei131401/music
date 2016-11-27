<?php
namespace Home\Controller;
use Think\Controller;
class TotalController extends Controller {
    
        //登录权限设置
        public function _initialize(){
            //若没有登录强制定向到登录页面
            if (empty(session('username')) || empty(session('user_id'))) {
                // $this->redirect('Home/Login/index','',2, '登录失效,页面跳转中...');
                // redirect(U('Home/Login/index'),2,'页面跳转中...');
                echo "<script>alert('登录失效!请重新登录!');window.parent.location.href='".__APP__."/Home/Login/index';</script>";
                // $this->error('登录失效!');
            }

            $uid = session('user_id');
            if ($uid == 1) {	//1为超级管理员admin
            	return true;
            }

            //后台权限判断
            $rule = CONTROLLER_NAME.'/'.ACTION_NAME;	//验证规则:控制器名字/方法名字
			$Auth = new \Think\Auth();
            if (!$Auth->check($rule,$uid)) {	       //若没有通过验证
            	 $this -> error("你没有权限!");
            }

        }

    
}