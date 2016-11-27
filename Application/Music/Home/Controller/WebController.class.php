<?php
namespace Home\Controller;

class WebController extends TotalController {

  //显示网站信息列表
    public function index () {

      /*查询网站信息*/
      $web = M('Website');
      $result = $web->order('id asc')->select();
      $this->assign('web',$result);
      $this->display();
    }

  

   //显示网站信息修改页面
   public function edit () {
        $id = I('id','','intval');
        $web = M('Website');
        $data['id'] = $id;
        $result = $web->where($data)->order('id desc')->find();
        $this->assign('web',$result);
        $this->display();
   }

   //真正修改网站信息的方法
    public function editHandle () {
      if (IS_POST) {
            $data['id'] = I('id','','intval');
            $data['webname'] = I('webname');
            $data['title'] = I('title');
            $data['keywords'] = I('keywords');

            //先获取原图片路径
            $web = M('Website');
            $val = $web->find($data['id']);
            $imgpath = $val['logo'];
        

          //先处理用户上传头像
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->subName   =    array('date','Ymd');
            $upload->rootPath   =   './Public/';       //网站跟目录是./
            $upload->savePath  =     'Home/Uploads/website_pic/'; //设置会员头像附件上传目录    
            $rootPath =  $upload->rootPath;             //保存根路径
            $info   =   $upload->upload();
            if(!$info) {     //当没有新头像上传时
 
                  $result = $web->where("id=%d",$data['id'])->save($data);       
                  if (!$result === false) {
                      $this->success('网站信息更新成功!',U('Home/Web/index'));
                  } else {
                      $this->error('网站信息更新失败!');
                  }
              //$this->error($upload->getError());
              
            } else {    // 当有新头像上传并且上传成功时    


              //先检查原头像是否存在
              if (file_exists($imgpath)) {
                //如果原图存在 先删除原图
                unlink($imgpath);
              }

               $data['logo'] = $rootPath.$info['logo']['savepath'].$info['logo']['savename'];

                $result = $web->where("id=%d",$data['id'])->save($data);       
                if (!$result === false) {
                    $this->success('网站信息更新成功!',U('Home/Web/index'));
                } else {
                    $this->error('网站信息更新失败!');
                }

            }


      } else {
        $this->error ('非法访问!');
      }
     

   }

   //显示网站状态信息
   public function state () {

      $web = M('Website');
      $result = $web->find();
      $this->assign('web',$result);
      $this->display();

   }


   //修改网站状态信息
   public function editState () {
      if (IS_POST) {

        $data['id'] = I('id','','intval');
        $data['state'] = I('state','','intval');
        $web = M('Website');
        $result = $web->where("id=%d",$data['id'])->save($data);       
        if (!$result === false) {
          $this->success('网站信息更新成功!',U('Home/Web/state'));
        } else {
          $this->error('网站信息更新失败!');
        }
      } else {
        $this->error('非法请求!');
      }


   }
   

}  