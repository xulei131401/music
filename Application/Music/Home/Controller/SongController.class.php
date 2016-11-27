<?php
namespace Home\Controller;

class SongController extends TotalController {

  //分页显示会员列表
    public function index () {

      /*查询所有歌曲信息*/
      $song = M('Song');
      $count = $song->count();// 查询满足要求的总记录数
      $num = 8;   //每页显示几条

      $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
      // dump($page);
      $show   = $page->show();// 分页显示输出
      //分页查询
      $result = $song->order('id asc')->limit($page->firstRow.','.$page->listRows)->select();

      $this->assign('song_show',$result);// 赋值数据集
      $this->assign('count',$count);// 赋值数据集
      $this->assign('page',$show);// 赋值分页输出;

      $this->display();
    }

   //显示歌曲添加页面
   public function add () {

        $this->display();
   }

   //真正添加歌曲数据的方法
   public function addHandle () {

      if (IS_POST) {
         
          $data['name'] = I('name');
          $data['singer'] = I('singer');
          $data['volume'] = I('volume');
          $data['addtime'] = date('Y-m-d H:i:s',time());
          $data['playtimes'] = 0;

            //先处理上传歌曲文件
            $upload = new \Think\Upload();          // 实例化上传类
            $upload->maxSize   =     10485760 ;     // 设置附件上传大小10M
            $upload->exts      =     array("mp3","MP3","wma","WMA","WAV","wav","MOD","mod");// 设置歌曲上传类型
            $upload->subName   =    array('date','Ymd');
            $upload->rootPath   =   './Public/';       //网站跟目录是./
            $upload->savePath  =     'Home/Uploads/music/'; //设置歌曲附件上传目录 
            $rootPath =  $upload->rootPath;             //保存根路径    
            $info   =   $upload->upload();


             //再处理上传歌词文件
            $upload1 = new \Think\Upload();                // 实例化上传类
            $upload1->maxSize   =     10485760 ;          // 设置附件上传大小10M
            $upload1->exts      =     array("lrc");       // 设置歌词上传类型
            $upload1->subName   =    array('date','Ymd');
            $upload1->rootPath   =   './Public/';            //网站跟目录是./
            $upload1->savePath  =     'Home/Uploads/lyric/'; //设置歌曲附件上传目录 
            $rootPath1 =  $upload1->rootPath;             //保存根路径    
            $info1   =   $upload1->upload();

            if(!$info && !$info1) {        //当没有歌曲文件和歌词文件上传时

              $this->error("上传歌曲文件或者歌词文件失败!");  //直接返回错误页面
              
            } else {             // 当有歌曲上传并且上传成功时    

                $data['url'] = $rootPath.$info['url']['savepath'].$info['url']['savename'];
                $data['lyric'] = $rootPath1.$info1['lyric']['savepath'].$info1['lyric']['savename'];
                $song = M('Song');
                $result = $song->add($data);       
                if (!$result === false) {
                    $this->success('歌曲添加成功!',U('Home/Song/index'));
                } else {
                    $this->error('歌曲添加失败!');
                }
            }
      } else {
        $this->error ('非法请求!');
      }


   }


   //显示歌曲修改页面
   public function edit () {
        $id = I('id','','intval');
        $song = M('Song');
        $data['id'] = $id;
        $result = $song->where($data)->order('id desc')->find();
        $this->assign('song',$result);
        $this->display();
   }

   //真正修改歌曲数据的方法
    public function editHandle () {
      if (IS_POST) {
      	/*组装数据*/
 	      $data['id'] = I('id','','intval');
          $data['name'] = I('name');
          $data['singer'] = I('singer');
          $data['volume'] = I('volume');
          $data['addtime'] = date('Y-m-d H:i:s',time());
        
      
          $song = M('Song');
          $result = $song->where("id=%d",$data['id'])->save($data);       
          if (!$result === false) {
              $this->success('歌曲信息更新成功!',U('Home/Song/index'));
          } else {
              $this->error('歌曲信息更新失败!');
          }
           
              
   
      } else {
        $this->error ('非法访问!');
      }
     

   }



   //删除歌曲的方法
    public function delete () {

		if (IS_GET) {
			$id = I('id','','intval');
			$song = M('Song');
			$data['id'] = $id;
			
			$val = $song->find($data['id']);
      $imgpath = $val['url'];   //先获取原歌曲文件路径
			$imgpath1 = $val['lyric'];	  //先获取原歌词文件路径

			//先检查原歌曲文件是否存在
			if (file_exists($imgpath)) {
				//如果原歌曲文件存在 先删除原歌曲文件
				unlink($imgpath);
			}

      //先检查歌词文件是否存在
      if (file_exists($imgpath1)) {
        //如果原歌曲文件存在 先删除原歌曲文件
        unlink($imgpath1);
      }

			$result = $song->where($data)->delete();
			
			if ($result) {
			
			$this->success ('删除歌曲成功',U('Home/Song/index'));
		
				
			} else {
				$this->error ('删除歌曲失败!');
			}

		} else {
			$this->error ('非法访问!');
		}
	}


   

}  