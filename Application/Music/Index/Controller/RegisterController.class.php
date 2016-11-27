<?php
namespace Index\Controller;

class RegisterController extends CommonController {
    //注册处理
    public function index(){
    	if (IS_POST) {
	    	$data['username'] = I('username');
	    	$data['password'] = I('password','','md5');
	    	$repassword = I('repassword','','md5');
	    	$data['sex'] = I('sex','','intval');
	    	$data['email'] = I('email');
	    	$data['tel'] = I('tel');
	    	$checkCode = I('checkCode');
	    	
	    	$user = M('User');
	    	$result = $user->add($data);
	    	if ($this->check_verify($checkCode)) {
		    	if ($data['password'] == $repassword){
		    		if ($result) {
		    			$this->success('注册成功!',U('Index/Login/index'));
			    	} else {
			    		$this->error('注册失败!');
			    	}	
		    	} else {
		    		$this->error('两次密码不一致!');
		    	}
	    	} else {
	    		$this->error('验证码错误!');
	    	}

    	} else {
    		 $this->display();
    	}
       
    }



}