<?php
namespace Index\Controller;
use Think\Controller;

class EmployeeController extends Controller {
    public function index(){
        
        $this->display();
    }

    public function index1(){
    	$mod=M("Employee");
    	
    	//获取总数据条数
    	$tot=$mod->count();
    	//实例化分页
    	$page = new\Think\Page($tot,15);
    	//设置分页
    	$page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
    	$page->setConfig("prev","上一页");
    	$page->setConfig("next","下一页");
    	$page->setConfig('last','末页');
        $page->setConfig('first','首页');
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
    	//firstRow 起始行数 listRows 每页总行数
    	$list=$mod->order('id asc')->limit($page->firstRow,$page->listRows)->select();
    	//分配变量
    	$this->assign("list",$list);
    	//分配分页变量
    	$this->assign("pageinfo",$page->show());
        // dump($list);
    	$this->display();
    }
    public function index2(){
    	$mod=M("Employee");
    	
    	//获取总数据条数
    	$tot=$mod->count();
    	//实例化分页
    	$page=new\Think\Page($tot,15);
    	//设置分页
    	$page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
    	$page->setConfig("prev","上一页");
    	$page->setConfig("next","下一页");
    	$page->setConfig('last','末页');
        $page->setConfig('first','首页');
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
    	//firstRow 起始行数 listRows 每页总行数
    	$list=$mod->limit($page->firstRow,$page->listRows)->select();
    	//分配变量
    	$this->assign("list",$list);
    	//分配分页变量
    	$this->assign("pageinfo",$page->show());
    	$this->display();
    }
    public function index3(){
    	$mod=M("Employee");
    	
    	//获取总数据条数
    	$tot=$mod->count();
    	//实例化分页
    	$page=new\Think\Page($tot,15);
    	//设置分页
    	$page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
    	$page->setConfig("prev","上一页");
    	$page->setConfig("next","下一页");
    	$page->setConfig('last','末页');
        $page->setConfig('first','首页');
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
    	//firstRow 起始行数 listRows 每页总行数
    	$list=$mod->limit($page->firstRow,$page->listRows)->select();
    	//分配变量
    	$this->assign("list",$list);
    	//分配分页变量
    	$this->assign("pageinfo",$page->show());
    	$this->display();
    }
    public function index4(){
    	//实例化
    	$mod=M("Employee");
    	$id=$_GET['id'];
    	$list=$mod->where("id=$id")->select();
    	//分配变量
    	$this->assign("list",$list);
    	$this->display();
    }
}