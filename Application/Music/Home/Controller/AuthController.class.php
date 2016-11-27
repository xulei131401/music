<?php
namespace Home\Controller;
	
class AuthController extends TotalController{

   
   //显示规则列表信息
	public function index(){

	/*查询所有权限信息*/
      $auth_rule = M('Auth_rule');
      $count = $auth_rule->count();// 查询满足要求的总记录数
      $num = 6;   //每页显示几条

      $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
      // dump($page);
      $show   = $page->show();// 分页显示输出
      //分页查询
      $result = $auth_rule->order('id asc')->limit($page->firstRow.','.$page->listRows)->select();

      $this->assign('auth_show',$result);// 赋值数据集
      $this->assign('count',$count);// 赋值数据集
      $this->assign('page',$show);// 赋值分页输出;

      $this->display();
	}

	//提那家页面及添加规则
	public function add(){
		if (IS_POST) {
			$auth_rule = M("auth_rule");
			$auth = $auth_rule->create();
			if($auth_rule->add()){
				$this ->success("添加成功",U('Home/Auth/index'));	
			}else{
				$this -> error('添加失败');
			}				   
			
		} else {
			$this->display();
		}
	
	}
	
	//修改规则
	public function edit(){
		$rule = M('Auth_rule');
		if(IS_POST){
			$id = I('id','','intval');
			$data['title'] = I('title');
			$data['name'] = I('name');
		  	$result = $rule->where('id=%d',$id)->save($data);
			if($result){
				$this -> success("修改成功",U('Home/Auth/index'));
			}else{
				$this -> error("修改失败");
			}
			
		} else {
			//把默认值带过去
			$id = I('id','','intval');
			$rules = $rule -> where("id=%d", $id) ->find();
			$this -> assign('rules',$rules);
			$this -> display();
		}
	
	}
	
	//删除规则
	public function delete(){
		if (IS_GET) {
			$data['id'] = I('id','','intval');
			$rule = M('Auth_rule');
			if($rule->where($data)->delete()){
				$this -> success("删除成功!",U('Home/Auth/index'));

			}else{
				$this -> error("删除失败");
			}
		} else {
			$this->error('非法请求');
		}
		
	}
	
	//修改状态
	public function status(){
		
	   if (IS_GET) {
			$rule = M('Auth_rule');
			$id = I('id','','intval');
			$status = I('status');
			$data['id'] = $id;
			if($status){
				$data['status'] = 0;
				$rule -> save($data);
				$this -> success("禁用成功!",U('Home/Auth/index'));
			}else{
				$data['status'] = 1;
				$rule -> save($data);
				$this -> success("启用成功!",U('Home/Auth/index'));
			}
		} else {
			$this->error('非法请求!');
		}
	}


	
}