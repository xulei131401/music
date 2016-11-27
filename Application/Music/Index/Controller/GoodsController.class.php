<?php
namespace Index\Controller;
use Think\Controller;

class GoodsController extends Controller {

   // 加载商品详情首页
    function index(){
		if (IS_GET) {
			// 接收传过来的商品id
			$data['id']= I('id','','intval');
			$goods = M('Goods');
			$result = $goods->where($data)->find();
			$this->assign('list',$result);
			$this->display();
		} else {
			$this->error('非法请求!');
		}
  }




  
}