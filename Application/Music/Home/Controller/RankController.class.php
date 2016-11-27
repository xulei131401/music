<?php
namespace Home\Controller;

/**
 * 排行榜分类控制器
 */
class RankController extends TotalController {

    //取得排行榜分类列表
    public function index(){

		$rank = M('Rank')->select();
		$cate = recursive($rank);
		// p($cate);
		$this->assign('cate',$cate);
		$this->display();

    }

     //添加顶级分类视图
    Public function addTop () {
        $this->display();
    }

    //添加子分类视图
    Public function addChild () {

    	if (IS_GET) {
			$rank = M('Rank');
			$id = I('id','','intval');
			$cate = $rank->find($id);
			$this->assign('cate',$cate);
			$this->display();
    	} else {
    		$this->error('非法请求!');
    	}

    }

    //添加分类表单处理
    Public function addCate () {
    	if (IS_POST) {

	    	$data['name'] = I('name');
            $data['pid'] = I('pid','','intval');
	        $data['desc'] = I('desc');
            $data['level'] = I('level','','intval')+1;
	        $data['regtime'] = date('Y-m-d H:i:s',time());

            //先处理上传图片
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->subName   =    array('date','Ymd');
            $upload->rootPath   =   './Public/';       //网站跟目录是./
            $upload->savePath  =     'Home/Uploads/rank_pic/'; //设置管理员头像附件上传目录
            $rootPath =  $upload->rootPath;             //保存根路径 
            $info   =   $upload->upload();
            if(!$info) {        //当没有新头像上传时

              $this->error($upload->getError());  //直接返回错误页面
              
            } else {             // 当有新头像上传并且上传成功时

                $data['pic'] = $rootPath.$info['pic']['savepath'].$info['pic']['savename'];
    	        if (M('Rank')->data($data)->add()) {
    	            $this->success('添加成功', U('Home/Rank/index'));
    	        } else {
    	            $this->error('添加失败');
    	        }
            }
    	} else {
    		$this->error('非法请求!');
    	}
       
    }

    //修改分类视图
    Public function edit () {
        if (IS_GET) {
			$rank = M('Rank');
			$id = I('id','','intval');
			$cate = $rank->find($id);
			$this->assign('cate',$cate);
			$this->display();
    	} else {
    		$this->error('非法请求!');
    	}
    }

    //修改分类操作
    Public function editCate () {

    	if (IS_POST) {
            $data['name'] = I('name');
            $data['id'] = I('id','','intval');
            $data['desc'] = I('desc');
            $data['regtime'] = date('Y-m-d H:i:s',time());

            //先获取原图片路径
            $rank = M('Rank');
            $val = $rank->find($data['id']);
            $imgpath = $val['pic'];


            //先处理用户上传头像
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->subName   =    array('date','Ymd');
            $upload->rootPath   =   './Public/';       //网站跟目录是./
            $rootPath =  $upload->rootPath;             //保存根路径
            $upload->savePath  =     'Home/Uploads/rank_pic/'; //设置管理员头像附件上传目录    
            $info   =   $upload->upload();
            if(!$info) {        //当没有新头像上传时

                  $result = $rank->where("id=%d",$data['id'])->save($data);       
                  if (!$result === false) {
                      $this->success('排行榜分类信息更新成功!',U('Home/Rank/index'));
                  } else {
                      $this->error('排行榜分类信息更新失败!');
                  }
              //$this->error($upload->getError());
              
            } else {             // 当有新头像上传并且上传成功时    

                //先检查原头像是否存在
                if (file_exists($imgpath)) {
                //如果原图存在 先删除原图
                    unlink($imgpath);
                }

                $data['pic'] = $rootPath.$info['pic']['savepath'].$info['pic']['savename'];

                $result = $rank->where("id=%d",$data['id'])->save($data);       
                if (!$result === false) {
                    $this->success('排行榜分类信息更新成功!',U('Home/Rank/index'));
                } else {
                    $this->error('排行榜分类信息更新失败!');
                }

            }

    	} else {
    		$this->error('非法请求!');
    	}

    }

    //删除分类
    Public function del () {
    	if (IS_GET) {

	    	$id = I('id','','intval');
	        $rank = M('Rank');
	        $cateid = $rank->field(array('id', 'pid'))->select();  //取得排行榜分类表的全部结果集
	        $delid = get_all_child($cateid, $id);      //递归比较
	        $delid[] = $id;        //将父类ID也加进去
	        $data = array('id' => array('IN', $delid));
           
            //循环删除图片
            foreach ($delid as $key => $value) {
                //先获取原图片路径
                $val = $rank->find($value);
                $imgpath = $val['pic']; 
                //先检查原图片是否存在
                if (file_exists($imgpath)) {
                //如果原图存在 先删除原图
                    unlink($imgpath);
                }
            }

            if (!$rank->where($data)->delete()) {
                $this->error('删除失败');
            }
	        $this->success('删除成功', U('Home/Rank/index'));
    	} else {
    		$this->error('非法请求!');
    	}
        
     }

    //获取排行榜的歌曲列表信息
    public function song_list(){

       if (IS_GET) {
        $id = I('id','','intval');
        $rankSong = M('Rank_song');
        $rank = M('Rank');
        $result = $rankSong->where('rank_id=%d', $id)->field('id, rank_id, song_id')->select(); //取出该分类下的歌曲ID
        $good = $rank->where('id=%d', $id)->find(); //取出该分类的信息
        //实例化歌曲类模型
        $song = M('Song');
        if ($result) {      //为了防止foreach报错
            foreach ($result as $key => $value) {
            $arr[] = intval($value['song_id']);
            }
            $where['id'] = array('IN', $arr);
        } else {
            $where['id'] = null;        //当没有歌曲时默认为null
        }

        $count = count($arr);// 查询满足要求的总记录数
        $num = 5;   //每页显示几条
        $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
        // dump($page);
        $show   = $page->show();// 分页显示输出
        //分页查询
        $result1 = $song->order('id asc')->where($where)->limit($page->firstRow.','.$page->listRows)->select();

        $this->assign('songlist',$result1);// 赋值数据集
        $this->assign('count',$count);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出;
        $this->assign('good',$good);// 赋值分页输出;
        $this->display();
        
       } else {
        $this->error('非法请求!');
       }

    }

    //往排行榜分类中添加歌曲
    public function addSong () {
    if (IS_POST) {
        $data['rank_id'] = I('id','','intval');
        $check = I('check','','intval');
        // dump($check);
        $rankSong = M('Rank_song');
        foreach ($check as $key => $value) {
            $data['song_id'] = $value;
            $result = $rankSong->add($data);
        }

        if ($result) {
            $this->success('添加歌曲成功!', U('Home/Rank/song_list',array('id'=>$data['rank_id'])));
        } else {
            $this->error("添加歌曲失败!");
        }

    } else {
        $id = I('id','','intval');
        $rankSong = M('Rank_song');
        $rank = M('Rank');
        $good = $rank->where('id=%d', $id)->find(); //取出该分类的信息
        $result = $rankSong->where('rank_id=%d', $id)->field('id, rank_id, song_id')->select(); //取出该分类下的歌曲ID
        foreach ($result as $key => $value) {
            $arr[] = intval($value['song_id']);
        }

        /*查询所有歌曲信息*/
        $song=M("Song");
        $songlist=$song->select();
        $list = array();
        //循环遍历歌曲信息,查看歌曲id是否在Goodsong表的song_id里面
        for($i=0;$i<count($songlist);$i++){
            $songid=$songlist[$i]['id'];
            if(in_array($songid,$arr)){
                    $list[]=$songid;    //若存在,则将歌曲信息放到该数组中
            }
        }

        $where['id'] = array('NOT IN',$list);   //添加歌曲时取相反条件
        // dump($where['id'][1]);
        if ($where['id'][1]) {                  //防止没有结果集SQL语句报错
            $count = $song->where($where)->count();// 查询满足要求的总记录数
            $num = 8;   //每页显示几条
            $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
            $result = $song->order('id asc')->where($where)->limit($page->firstRow.','.$page->listRows)->select();
            
        } else {
            $count = $song->count();// 查询满足要求的总记录数
            $num = 8;   //每页显示几条
            $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
            $result = $song->order('id asc')->limit($page->firstRow.','.$page->listRows)->select();

        }

          $show   = $page->show();// 分页显示输出
          
          $this->assign('songlist',$result);// 赋值数据集
          $this->assign('count',$count);// 赋值数据集
          $this->assign('page',$show);// 赋值分页输出;
          $this->assign('good',$good);// 赋值好歌曲指定ID结果集;
          $this->display();
        }
    }


    //删除排行榜分类中的歌曲
    public function delSong () {

        if (IS_GET) {
            $id = I('id','','intval');          //排行榜分类ID
            $song_id = I('song_id','','intval');     //歌曲ID
            $rankSong = M('Rank_song');
            $result = $rankSong->where("song_id = %d and rank_id = %d", array($song_id,$id))->delete();
            if ($result) {
                $this->success('删除成功!',U('Home/Rank/song_list',array('id'=>$id)));
            } else {
                $this->error('删除失败!');
            }
        } else {
            $this->error('非法请求!');
        }
    }

}