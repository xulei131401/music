<?php
namespace Index\Controller;
use Think\Controller;
class NoticeController extends Controller{

	function add(){
		$mod=M("Notice");
		$aa=$_GET['sgid'];
		if(empty($aa)){
			$this->error("关注失败",U("Goods/index"));
		}
		// 添加一条商品关注		
		$_POST['sgid']=$aa;
		$_POST["usid"]=$_SESSION['user']['id'];
		$mod->create();
		$mod->add();

		// 商品关注度加一
		$mm=M("Goods");
		$num=$mm->field("notinum")->find($aa);
		$_POST['id']=$aa;
		$_POST['notinum']=$num['notinum']+1;
		$mm->create();
		$mm->save();
		$this->success("关注成功",U("goods/index/?id=".$aa));
	}

	// 我的关注首页分页
	function index(){
		$usid=$_SESSION['user']['id'];
		$mod=M("Notice")->join("goods on notice.sgid=goods.id");
		$tot=$mod->field("notice.usid,notice.id as nid,goods.id,notice.sgid,goods.name,goods.img,goods.nowprice,goods.notinum,goods.descri")->where("notice.usid=".$usid)->count();
	
		// 实例化分页
		$page=new\Think\Page($tot,5);
        //设置分页
        $page->setConfig("prev","上一页");
        $page->setConfig("next","下一页");
        //firstRow 起始行数 listRows 每页总行数->limit($page->firstRow,$page->listRows)
		$list=M("Notice")->join("goods on notice.sgid=goods.id")->field("notice.usid,notice.id as nid,goods.id,notice.sgid,goods.name,goods.img,goods.nowprice,goods.notinum,goods.descri")->where("notice.usid=".$usid)->limit($page->firstRow,$page->listRows)->select();
        // 分配变量
        $this->assign("list",$list);
        // 分配分页变量
        $this->assign("pageinfo",$page->show());
        // 加载模板
        $this->display("index");
	}

	// 取消关注
	function del(){
		$id=$_GET['id'];
		$mod=M("Notice");
		$mod->delete($id);
		$this->redirect("notice/index");
	}
}
?>