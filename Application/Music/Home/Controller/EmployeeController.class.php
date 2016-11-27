<?php
namespace Home\Controller;

class EmployeeController extends TotalController {
  
    //显示添加页面
    public function add(){
        $this->display();
    }

    //执行添加
    public function addHandle(){
        //实例化
        $employee=M("Employee");
        $regtime=date('Y-m-d H:i:s',time());
        // $_POST['regtime']=$time;
        //封装信息
        $employee->create();
        if($employee->add()){
            $this->success("添加成功",U("Home/Employee/index"));
        }else{
            $this->error("添加失败");
        }
    }

    // 加载修改页面
    public function edit(){
    	if (IS_GET) {
    		$id = I('id','','intval');
			//实例化
			$employee=M("Employee");
			//获取需要修改的数据
			$result=$employee->find($id);
			//分配变量
			$this->assign("employee",$result);
			//加载模板
			$this->display();
    	} else {
    		$this->error('非法请求!');
    	}
	       
    }

    //执行修改
    public function editHandle(){

        if (IS_POST) {
            $data['id'] = I('id','','intval');
            $data['regtime'] = date('Y-m-d H:i:s',time());
            $data['name'] = I('name');
            $data['address'] = I('address');
            $data['cate'] = I('cate');
            $data['num'] = I('num');
            $data['task'] = I('task');
            $data['required'] = I('required');
            
	  	 	$employee=M("Employee");
	         $result = $employee->where("id=%d",$data['id'])->save($data);       
	          if (!$result === false) {
	              $this->success('招聘信息更新成功!',U('Home/Employee/index'));
	          } else {
	              $this->error('招聘信息更新失败!');
	          }
          

		} else {
		$this->error ('非法访问!');
		}
    
    }
     //删除招聘信息
    public function delete(){

		 if (IS_GET) {
		      $id = I('id','','intval');
		      $employee = M('Employee');
		      $data['id'] = $id;
		      $result = $employee->where($data)->delete();
		      if ($result) {
		        $this->success ('删除招聘信息成功',U('Home/Employee/index'));
		      } else {
		        $this->error ('删除招聘信息失败!');
		      }

	    } else {
	       $this->error ('非法访问!');
	    }
       
    }

    //分页查询显示招聘信息
    public function index(){
        //封装查询信息
        $where=array();
        if(!empty(I('name'))){
        	$name = I('name');
            $where['name']=array("like","%{$name}%");	//模糊查询
        }
        //实例化
        $employee=M("Employee");
        //获取总数
        $count=$employee->where($where)->count();// 查询满足要求的总记录数
        $num = 5;   //每页显示几条
        //实例化分页
        $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
        //分页查询
        $result=$employee->where($where)->order('id asc')->limit($page->firstRow,$page->listRows)->select();

     	$show = $page->show();// 分页显示输出
      

		$this->assign('count',$count);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出;
        //分配变量
        $this->assign("employee",$result);
        //加载目标
        $this->display();
    }
}