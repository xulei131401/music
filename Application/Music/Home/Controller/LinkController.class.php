<?php
namespace Home\Controller;

class LinkController extends TotalController {

    //分页显示友情链接列表
    public function index () {

      /*查询所有友情链接信息*/
      $link = M('Link');
      $count = $link->count();// 查询满足要求的总记录数
      $num = 5;   //每页显示几条

      $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
      // dump($page);
      $show   = $page->show();// 分页显示输出
      //分页查询
      $result = $link->order('id asc')->limit($page->firstRow.','.$page->listRows)->select();

      $this->assign('link_show',$result);// 赋值数据集
      $this->assign('count',$count);// 赋值数据集
      $this->assign('page',$show);// 赋值分页输出;

      $this->display();
    }

   //显示友情链接添加页面
   public function add () {

        $this->display();
   }

   //真正添加友情链接数据的方法
   public function addHandle () {

      if (IS_POST) {
         
          $data['linkname'] = I('linkname');
          $data['linkaddress'] = I('linkaddress');

            //先处理友情链接上传头像
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->subName   =    array('date','Ymd');
            $upload->rootPath   =   './Public/';       //网站跟目录是./
            $upload->savePath  =     'Home/Uploads/link_pic/'; //设置管理员头像附件上传目录
            $rootPath =  $upload->rootPath;             //保存根路径 
            $info   =   $upload->upload();
            if(!$info) {        //当没有新头像上传时

              $this->error($upload->getError());  //直接返回错误页面
              
            } else {             // 当有新头像上传并且上传成功时    

                $data['linkpic'] = $rootPath.$info['linkpic']['savepath'].$info['linkpic']['savename'];
                $link = M('Link');
                $result = $link->add($data);       
                if (!$result === false) {
                    $this->success('友情链接添加成功!',U('Home/Link/index'));
                } else {
                    $this->error('友情链接添加失败!');
                }
            }
      } else {
        $this->error ('非法请求!');
      }


   }


   //显示友情链接修改页面
   public function edit () {
        $id = I('id','','intval');
        $link = M('Link');
        $data['id'] = $id;
        $result = $link->where($data)->order('id desc')->find();
        $this->assign('link',$result);
        $this->display();
   }

   //真正修改友情链接数据的方法
    public function editHandle () {
      if (IS_POST) {
          $data['id'] = I('id','','intval');
          $data['linkname'] = I('linkname');
          $data['linkaddress'] = I('linkaddress');
          
            //先获取原图片路径
            $link = M('Link');
            $val = $link->find($data['id']);
            $imgpath = $val['linkpic'];

          //先处理用户上传头像
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->subName   =    array('date','Ymd');
            $upload->rootPath   =   './Public/';       //网站跟目录是./
            $upload->savePath  =     'Home/Uploads/link_pic/'; //设置管理员头像附件上传目录
            $rootPath =  $upload->rootPath;             //保存根路径   
            $info   =   $upload->upload();
            if(!$info) {        //当没有新头像上传时

                  $result = $link->where("id=%d",$data['id'])->save($data);       
                  if (!$result === false) {
                      $this->success('友情链接信息更新成功!',U('Home/Link/index'));
                  } else {
                      $this->error('友情链接信息更新失败!');
                  }
              //$this->error($upload->getError());
              
            } else {             // 当有新头像上传并且上传成功时

                //先检查原头像是否存在
                if (file_exists($imgpath)) {
                  //如果原图存在 先删除原图
                  unlink($imgpath);
                }

               $data['linkpic'] = $rootPath.$info['npic']['savepath'].$info['npic']['savename'];
                $result = $link->where("id=%d",$data['id'])->save($data);       
                if (!$result === false) {
                    $this->success('友情链接信息更新成功!',U('Home/Link/index'));
                } else {
                    $this->error('友情链接信息更新失败!');
                }

            }


      } else {
        $this->error ('非法访问!');
      }
     

   }



   //删除友情链接的方法
    public function delete () {

        if (IS_GET) {
          $id = I('id','','intval');
          $link = M('Link');
          $data['id'] = $id;

           //先获取原图片路径
          $val = $link->find($data['id']);
          $imgpath = $val['linkpic'];
          //先检查原头像是否存在
          if (file_exists($imgpath)) {
            //如果原图存在 先删除原图
            unlink($imgpath);
          }


          $result = $link->where($data)->delete();
          if ($result) {
            $this->success ('删除友情链接成功',U('Home/Link/index'));
          } else {
            $this->error ('删除友情链接失败!');
          }

        } else {
           $this->error ('非法访问!');
        }

        
    }


   
      
}  