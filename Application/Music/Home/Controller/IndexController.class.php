<?php
namespace Home\Controller;

class IndexController extends TotalController {

	//显示后台首页
    public function index () {
   		$this->display();
    }
    
    //显示后台网站信息页面
    public function home () {
    	$this->display();
    }

}