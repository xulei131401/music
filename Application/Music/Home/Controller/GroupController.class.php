<?php
namespace Home\Controller;
	
class GroupController extends TotalController{

   //显示管理组列表
	public function index(){

	  /*查询所有权限信息*/
      $group = M('Auth_group');
      $rules = M('Auth_rule');
      $count = $group->count();			// 查询满足要求的总记录数
      // dump($result);
      $num = 4;   //每页显示几条
      $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
      $show   = $page->show();// 分页显示输出
      //分页查询
      $result = $group->field('id, title, status, rules')->order('id asc')->limit($page->firstRow.','.$page->listRows)->select();
      foreach ($result as $key => $value) {
      	$arr = explode(',', $value['rules']);
      	foreach ($arr as $k => $value) {
      		$result2[$key][] = $rules->where('id=%d',$value)->find();
      	}
      }
      // dump($result2);
      $this->assign('group_show',$result);// 赋值数据集
      $this->assign('rules',$result2);// 赋值数据集
      $this->assign('count',$count);// 赋值数据集
      $this->assign('page',$show);// 赋值分页输出;

      $this->display();
	
	}   
	
	//添加管理组
	public function add(){
		
		$rule = M('Auth_rule');
		$group = M('Auth_group');
		if(IS_POST){
			$data['title'] = I('title');
			$data['rules'] = I('rules');
		  	$data['rules'] = implode(',',$data['rules']);
		  	// dump($data);
			if($group ->add($data)){
				$this -> success("添加成功",U('Home/Group/index'));
			}else{
				$this -> error('添加失败');
			}
		} else {
			$result = $rule -> where("status = 1") ->select();
			$this -> assign('rules',$result);
			$this->display();
		}
		
		
	}

	//修改管理组规则
	public function edit(){

		$rule = M('Auth_rule');
		$group = M('Auth_group');
		if(IS_POST){
			$id = I('id','','intval');
			$data['title'] = I('title');
			$data['rules'] = I('rules');
		  	$data['rules'] = implode(',',$data['rules']);
		  	$result = $group->where('id=%d',$id)->save($data);
			if($result){
				$this -> success("修改成功",U('Home/Group/index'));
			}else{
				$this -> error("修改失败");
			}
			
		} else {
			//把默认值带过去
			$id = I('id','','intval');
			$groups = $group -> find($id);
			$rules = $rule -> where("status = 1") ->select(); //查找出全部的规则 并且状态是开启的
			$this -> assign('rules',$rules);    
			$this -> assign('group',$groups);
			$this -> display();
		}

	}
	
	//删除管理组规则
	public function delete(){
		if (IS_GET) {
			$data['id'] = I('id','','intval');
			$group = M('Auth_group');
			if($group->where($data)->delete()){
				$this -> success("删除成功!",U('Home/Group/index'));
				
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
			$group = M('Auth_group');
			$id = I('id','','intval');
			$status = I('status');
			$data['id'] = $id;
			if($status){
				$data['status'] = 0;
				$group -> save($data);
				$this -> success("禁用成功!",U('Home/Group/index'));
			}else{
				$data['status'] = 1;
				$group -> save($data);
				$this -> success("启用成功!",U('Home/Group/index'));
			}
		} else {
			$this->error('非法请求!');
		}
	}



	
}