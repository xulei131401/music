<?php
namespace Home\Controller;

/**
 * 歌曲分类控制器
 */
class ClassifyController extends TotalController {

    //取得歌曲分类列表
    public function index(){

		$classify = M('Classify')->select();
		$cate = recursive($classify);
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
			$classify = M('Classify');
			$id = I('id','','intval');
			$cate = $classify->find($id);
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
	        $data['level'] = I('level','','intval')+1;

	        if (M('Classify')->data($data)->add()) {
	            $this->success('添加成功', U('Home/Classify/index'));
	        } else {
	            $this->error('添加失败');
	        }
    	} else {
    		$this->error('非法请求!');
    	}
       
    }

    //修改分类视图
    Public function edit () {
        if (IS_GET) {
			$classify = M('Classify');
			$id = I('id','','intval');
			$cate = $classify->find($id);
			$this->assign('cate',$cate);
			$this->display();
    	} else {
    		$this->error('非法请求!');
    	}
    }

    //修改分类操作
    Public function editCate () {

    	if (IS_POST) {
			$classify = M('Classify');
			$data['id'] = I('id','','intval');
			$data['name'] = I('name');
			$result = $classify->where('id=%d',$data['id'])->save($data);
			if ($result) {
            	$this->success('修改成功', U('Home/Classify/index'));
       		} else {
            	$this->error('修改失败');
        	}

    	} else {
    		$this->error('非法请求!');
    	}

    }

    //删除分类
    Public function del () {
    	if (IS_GET) {

	    	$id = I('id','','intval');
	        $classify = M('Classify');
	        $cateid = $classify->field(array('id', 'pid'))->select();
	        $delid = get_all_child($cateid, $id);
	        $delid[] = $id;

	        $data = array('id' => array('IN', $delid));
	        // dump($data);
	        if (!$classify->where($data)->delete()) {
	            $this->error('删除失败');
	        }

	        $this->success('删除成功', U('Home/Classify/index'));
    	} else {
    		$this->error('非法请求!');
    	}
        
     }

      //获取歌曲的歌曲列表信息
    public function song_list(){

       if (IS_GET) {
        $id = I('id','','intval');
        $classifySong = M('Classify_song');
        $classify = M('Classify');
        $result = $classifySong->where('classify_id=%d', $id)->field('id, classify_id, song_id')->select(); //取出该分类下的歌曲ID
        $good = $classify->where('id=%d', $id)->find(); //取出该分类的信息
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

    //往歌曲分类中添加歌曲
    public function addSong () {
    if (IS_POST) {
        $data['classify_id'] = I('id','','intval');
        $check = I('check','','intval');
        // dump($check);
        $classifySong = M('Classify_song');
        foreach ($check as $key => $value) {
            $data['song_id'] = $value;
            $result = $classifySong->add($data);
        }

        if ($result) {
            $this->success('添加歌曲成功!', U('Home/Classify/song_list',array('id'=>$data['classify_id'])));
        } else {
            $this->error("添加歌曲失败!");
        }
    } else {
        $id = I('id','','intval');
        $classifySong = M('Classify_song');
        $classify = M('Classify');
        $good = $classify->where('id=%d', $id)->find(); //取出该分类的信息
        $result = $classifySong->where('classify_id=%d', $id)->field('id, classify_id, song_id')->select(); //取出该分类下的歌曲ID
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
            $result = $song->order('id asc')->where($where)->limit($page->firstRow.','.$page->listRows)->select();
            
        } else {
            $count = $song->count();// 查询满足要求的总记录数
            $result = $song->order('id asc')->limit($page->firstRow.','.$page->listRows)->select();

        }

          $num = 8;   //每页显示几条
          $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
          $show   = $page->show();// 分页显示输出
          
          $this->assign('songlist',$result);// 赋值数据集
          $this->assign('count',$count);// 赋值数据集
          $this->assign('page',$show);// 赋值分页输出;
          $this->assign('good',$good);// 赋值好歌曲指定ID结果集;
          $this->display();
        }
    }


    //删除歌曲分类中的歌曲
    public function delSong () {

        if (IS_GET) {
            $id = I('id','','intval');          //排行榜分类ID
            $song_id = I('song_id','','intval');     //歌曲ID
            $classifySong = M('Classify_song');
            $result = $classifySong->where("song_id = %d and classify_id = %d", array($song_id,$id))->delete();
            if ($result) {
                $this->success('删除成功!',U('Home/Classify/song_list',array('id'=>$id)));
            } else {
                $this->error('删除失败!');
            }
        } else {
            $this->error('非法请求!');
        }
    }


}