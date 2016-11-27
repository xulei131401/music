<?php 
namespace Home\Controller;

class ExcellentController extends TotalController {

    //精选专辑列表显示
    public function index(){

       /*查询所有精选专辑信息*/
      $excellent = M('Excellent');
      $count = $excellent->count();// 查询满足要求的总记录数
      $num = 6;   //每页显示几条

      $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
      // dump($page);
      $show   = $page->show();// 分页显示输出
      //分页查询
      $result = $excellent->order('id asc')->limit($page->firstRow.','.$page->listRows)->select();

      $this->assign('exce_show',$result);// 赋值数据集
      $this->assign('count',$count);// 赋值数据集
      $this->assign('page',$show);// 赋值分页输出;

      $this->display();
       
   
    }

    //显示新增精选页面
    public function excellentadd(){
        $this->display();
    }

    //往数据库添加精选专辑信息
    public function excellentinsert(){
      if (IS_POST) {

			$data['ctime'] = date('Y-m-d H:i:s',time());
			$data['name'] = I('name');
			$data['desc'] = I('desc');
			$data['author'] = I('author');

			//先处理用户上传头像
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     3145728 ;// 设置附件上传大小
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->subName   =    array('date','Ymd');
			$upload->rootPath   =   './Public/';       //网站跟目录是./
			$upload->savePath  =     'Home/Uploads/excellent_pic/'; //设置管理员头像附件上传目录
			$rootPath =  $upload->rootPath;             //保存根路径 
			$info   =   $upload->upload();
            if(!$info) {        //上传失败

              $this->error($upload->getError());  //直接返回错误页面
              
            } else {             // 当有新图片上传并且上传成功时    

                $data['pic'] = $rootPath.$info['pic']['savepath'].$info['pic']['savename'];
                $excellent = M('Excellent');
                $result = $excellent->add($data);       
                if (!$result === false) {
                    $this->success('精选专辑添加成功!',U('Home/Excellent/index'));
                } else {
                    $this->error('精选专辑添加失败!');
                }
            }
      } else {
        $this->error ('非法请求!');
      }
       
       
    }
     public function excellentdel(){
      if (IS_GET) {

        $id = I('id','','intval');
        $excellent = M('Excellent');
        $data['id'] = $id;


        //先获取原图片路径
        $val = $excellent->find($data['id']);
        $imgpath = $val['pic'];
        //先检查原头像是否存在
        if (file_exists($imgpath)) {
        //如果原图存在 先删除原图
          unlink($imgpath);
        }


        $result = $excellent->where($data)->delete();
        if ($result) {
          $this->success ('删除精选专辑成功',U('Home/Excellent/index'));
        } else {
          $this->error ('删除管精选专辑失败!');
        }

      } else {
        $this->error ('非法访问!');
      }

    }

    //修改精选专辑数据库信息
     public function excellentupdate(){

         if (IS_POST) {
            $data['id'] = I('id','','intval');
            $data['ctime'] = date('Y-m-d H:i:s',time());
            $data['name'] = I('name');
            $data['desc'] = I('desc');
            $data['author'] = I('author');
            
            //先获取原图片路径
            $excellent = M('Excellent');
            $val = $excellent->find($data['id']);
            $imgpath = $val['pic'];



          //先处理用户上传头像
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->subName   =    array('date','Ymd');
            $upload->rootPath   =   './Public/';       //网站跟目录是./
            $rootPath =  $upload->rootPath;             //保存根路径
            $upload->savePath  =     'Home/Uploads/excellent_pic/'; //设置管理员头像附件上传目录    
            $info   =   $upload->upload();
            if(!$info) {        //当没有新头像上传时
              
                  $result = $excellent->where("id=%d",$data['id'])->save($data);       
                  if (!$result === false) {
                      $this->success('精选专辑信息更新成功!',U('Home/Excellent/index'));
                  } else {
                      $this->error('精选专辑信息更新失败!');
                  }
              //$this->error($upload->getError());
              
            } else {             // 当有新头像上传并且上传成功时    

              //先检查原头像是否存在
              if (file_exists($imgpath)) {
                //如果原图存在 先删除原图
                unlink($imgpath);
              }

                $data['pic'] = $rootPath.$info['pic']['savepath'].$info['pic']['savename'];
              
                $result = $excellent->where("id=%d",$data['id'])->save($data);       
                if (!$result === false) {
                    $this->success('精选专辑信息更新成功!',U('Home/Excellent/index'));
                } else {
                    $this->error('精选专辑信息更新失败!');
                }
            }

      } else {
        $this->error ('非法访问!');
      }

    }

    //显示修改精选专辑信息页面
    public function excellentedit(){
    	if (is_GET) {
        $id = I('id','','intval');
        //实例化
        $excellent=M("Excellent");
        //获取需要修改的数据
        $result=$excellent->find($id);
        //分配变量
        $this->assign("excellent",$result);
        //加载模板
        $this->display();

    	} else {
    		$this->error('非法请求!');
    	}
      
    }

    //获取对应专辑中的歌曲列表
    public function song_list(){

	    if (IS_GET) {
        $id = I('id','','intval');	//专辑ID
        //获得专辑列表里面的歌曲ID值用于接下来的比较
        $excellent=M("Excellent");
        $value=$excellent->field("id,name,desc,author,pic,ctime,song_id")->find($id);

        //获得所有歌曲信息
        $song=M("Song");
        $songlist=$song->select();
        $list = array();
        //循环遍历歌曲信息,查看歌曲id是否在excellent表的song_id里面
        for($i=0;$i<count($songlist);$i++){
                $songid=$songlist[$i]['id'];
                if(in_array($songid,explode(",",$value['song_id']))){
                        $list[]=$songid;	//若存在,则将歌曲信息放到该数组中
                }
         }
          $where['id'] = array('IN',$list);
          $count = count($list);  //总条数
          $num = 6;   //每页显示几条

          $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
          // dump($page);
          $show   = $page->show();// 分页显示输出
          //分页查询
          if ($where['id'][1]) {		//防止专辑下没有歌曲而SQL语句报错
          	$result = $song->where($where)->limit($page->firstRow.','.$page->listRows)->select();
          } else {
          	$result = array();
          }
        
          $this->assign('songlist',$result);// 赋值数据集
          $this->assign('id',$id);// 赋值专辑ID
          $this->assign('count',$count);// 赋值数据集
          $this->assign('page',$show);// 赋值分页输出;

          $this->display();

			
	    } else {
	    	$this->error ('非法请求!');
	    }
  

    }

    //加载专辑下歌曲添加页面
    public function add(){
  		if (IS_GET) {
      $id = I('id','','intval');	//专辑ID
      //获得专辑列表里面的歌曲ID值用于接下来的比较
      $excellent=M("Excellent");
      $value=$excellent->field("id,name,desc,author,pic,ctime,song_id")->find($id);
      /*查询所有歌曲信息*/
      $song=M("Song");
      $songlist=$song->select();
      $list = array();
     //循环遍历歌曲信息,查看歌曲id是否在excellent表的song_id里面
      for($i=0;$i<count($songlist);$i++){
            $songid=$songlist[$i]['id'];
            if(in_array($songid,explode(",",$value['song_id']))){
                    $list[]=$songid;	//若存在,则将歌曲信息放到该数组中
            }
      }
  		$where['id'] = array('NOT IN',$list);	//添加歌曲时取相反条件
  		// dump($where['id'][1]);
  		if ($where['id'][1]) {					//防止没有结果集SQL语句报错
  			$count = $song->where($where)->count();// 查询满足要求的总记录数
        $num = 10;   //每页显示几条
        $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
  			$result = $song->order('id asc')->where($where)->limit($page->firstRow.','.$page->listRows)->select();
  			
  		} else {
  			$count = $song->count();// 查询满足要求的总记录数
        $num = 10;   //每页显示几条
        $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
  			$result = $song->order('id asc')->limit($page->firstRow.','.$page->listRows)->select();

  		}

	      $show   = $page->show();// 分页显示输出 
	      $this->assign('songlist',$result);// 赋值数据集
	      $this->assign('count',$count);// 赋值数据集
	      $this->assign('page',$show);// 赋值分页输出;
	      $this->assign('id',$id);// 赋值专辑ID;

	      $this->display();

  		} else {
  			$this->error('非法请求');
  		}
    }

    //执行添加
     public function insert(){   
     
  		if (IS_POST) {
  			
      $data['id'] = I('id','','intval');
      $excellent=M("Excellent");
      $value=$excellent->field("song_id")->find($data['id']);

      //获取复选框中选中的歌曲ID
      $ids = I('check');
      $arr = implode(",", $ids);		//将ID以逗号分隔变成字符串

      $data['song_id'] = $arr.','.$value['song_id'];	//替换原来的字段值
      $result = $excellent->where("id=%d",$data['id'])->save($data);

    		if (!$result === false) {
            $this->success('添加歌曲成功!',U('Home/Excellent/song_list',array('id'=>$data['id'])));
        } else {
            $this->error('添加歌曲失败!');
        }
  		} else {
  			$this->error('非法请求');
  		}
   
     
    }

  

    //删除专辑中的歌曲
    public function del(){

    	if (IS_GET) {
        $id = I('id','','intval');	//专辑ID
        $song_id = I('song_id','','intval');	//歌曲ID

        $excellent=M("Excellent");
        $value=$excellent->field("song_id")->find($id);		//查询专辑中的歌曲ID集合

  			$arr = explode(',',$value['song_id']);	//以逗号分隔数组
  			if (in_array($song_id, $arr)) {		//若专辑中存在该歌曲,则从数组中删除
  				foreach ($arr as $key => $v) {
  					if ($v == $song_id){
  						unset($arr[$key]);
  					}
  					
  				}
  			}

			$data['song_id'] = implode(",", $arr);
			$result = $excellent->where("id=%d",$id)->save($data);

      	if (!$result === false) {
      		$this->success('删除歌曲成功!',U('Home/Excellent/song_list',array('id'=>$id)));
      	} else {
      		$this->error('删除歌曲失败!');
      	}

    	} else {
    		$this->error('非法请求');
    	}

    }





}