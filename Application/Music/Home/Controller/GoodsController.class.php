<?php
namespace Home\Controller;

class GoodsController extends TotalController {

    //显示商品添加页面
    public function add () {
        $cate1 = M('Category')->select();
        $cate = recursive($cate1);
        // dump($cate);
        $this->assign('cate',$cate);
        $this->display();
    }

   //商品列表分页显示
    public function index(){

       /*查询所有管理员信息*/
      $goods = M('Goods');
      $count = $goods->count();// 查询满足要求的总记录数
      $num = 6;   //每页显示几条

      $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
      // dump($page);
      $show   = $page->show();// 分页显示输出
      //分页查询
      $result = $goods->order('id asc')->limit($page->firstRow.','.$page->listRows)->select();

      $this->assign('goods_show',$result);// 赋值数据集
      $this->assign('count',$count);// 赋值数据集
      $this->assign('page',$show);// 赋值分页输出;

      $this->display();
    }

    //正真添加商品方法
     public function addHandle(){
        if (IS_POST) {

	        $goods = M('Goods');
	        $data['regtime'] = date('Y-m-d H:i:s',time());
	        $data = $goods->create();		//根据表单创建数据对象
	        // dump($data);
	        //处理用户上传头像
	        $upload = new \Think\Upload();// 实例化上传类
	        $upload->maxSize   =     3145728 ;// 设置附件上传大小
	        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	        $upload->subName   =    array('date','Ymd');
	        $upload->rootPath   =   './Public/';       //网站跟目录是./
	        $upload->savePath  =     'Home/Uploads/Goods/'; // 设置附件上传目录    // 上传文件 
	        $rootPath =  $upload->rootPath;             //保存根路径 
	        $info   =   $upload->upload();
	        if(!$info) {        // 上传错误提示错误信息   
	            $this->error($upload->getError());
	        }else{              // 上传成功     
	            $data['img'] = $rootPath.$info['img']['savepath'].$info['img']['savename'];
	            if ($goods->add($data)) {
	                $this->success('添加商品成功!',U('Home/Goods/index'));
	            } else {
	                $this->error('添加商品失败! ');
	            }
	        }
    
        } else {
          $this->error('非法请求!');
        }
         
        
    }

    //显示商品修改页面
    public function edit () {
        if (!IS_GET) {
             $this->error('页面不存在');
        } else {
            $data['id'] = I('id','','intval');
            $goods = M('Goods')->where($data)->find();
            // dump($goods);
            $cate = M('Category')->select();
            $cate1 = recursive($cate);
            // dump($cate);
            $id = "";
            //判断当前商品是否被选中
            foreach ($cate1 as $key => $value) {
              if ($goods['category_id'] == $value['id']) {
                $id = $value['id'];
              }
            }

            $this->assign('cate',$cate1);		//分类列表结果集
            $this->assign('id',$id);			//被选中的分类id
            $this->assign('goods',$goods);		//要修改的商品信息
            $this->display();
        }
        
    }


    //处理修改商品信息
    public function editHandle () {
          if (!IS_POST) {
            $this->error('页面不存在!');
          } else {
            $goods = M('Goods');
            $data['id'] = I('id','','intval');
	        $data['regtime'] = date('Y-m-d H:i:s',time());
	        $data = $goods->create();		//根据表单创建数据对象
        
            //处理用户上传头像
	    	$upload = new \Think\Upload();// 实例化上传类
	    	$upload->maxSize   =     3145728 ;// 设置附件上传大小
	    	$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    	$upload->subName   =    array('date','Ymd');
	    	$upload->rootPath   =   './Public/';		//网站跟目录是./Public
	    	$upload->savePath  =     'Home/Uploads/Goods/'; // 设置附件上传目录
	    	$rootPath =  $upload->rootPath;             //保存根路径 
	    	$info   =   $upload->upload();
	    	if(!$info) {		//若没有上传头像  
                
                $result = $goods->where("id=%d",$data['id'])->save($data);       
                if (!$result === false) {
                    $this->success('商品信息更新成功!',U('Home/Goods/index'));
                } else {
                    $this->error('商品信息更新失败!');
                }
	    		//$this->error($upload->getError());
	    	}else{				// 上传成功     
		    	$data['img'] = $rootPath.$info['img']['savepath'].$info['img']['savename'];
	            $result = $goods->where("id=%d",$data['id'])->save($data);       
	            if (!$result === false) {
	                $this->success('商品信息更新成功!',U('Home/Goods/index'));
	            } else {
	                $this->error('商品信息更新失败!');
	            }

         	 }
         }
   	}


   	 //删除商品
    public function delete () {
        if (!IS_GET) {
            $this->error('页面不存在!');
        } else {
            $data['id'] = I('id','','intval');
            $goods = M('Goods');

			//先获取原图片路径
			$val = $goods->find($data['id']);
			$imgpath = $val['img'];
			//先检查原头像是否存在
			if (file_exists($imgpath)) {
			//如果原图存在 先删除原图
				unlink($imgpath);
			}

            $result = $goods->where("id=%d",$data['id'])->delete();


           if (!$result === false) {
                $this->success('商品删除成功!',U('Home/Goods/index'));
           } else {
                $this->error('商品删除失败!');
           }
        }

    }



}