<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {

        //生成验证码
        public function verify () {
            $config = array(
                // 验证码字体大小
                'fontSize'    =>    15,
                //验证码位数
                'length'      =>    1,
                 // 关闭验证码杂点
                'useNoise'    =>    false,
                //是否使用背景图片 默认为false
                'useImgBg'    => false,
                //验证码宽度 设置为0为自动计算
                'imageW'      => 80,
                //验证码高度 设置为0为自动计算
                'imageH'     => 25,
                'reset'     => false,

            );

            $Verify = new \Think\Verify($config);

            $Verify->entry();
        }

        //验证验证码是否正确
        public  function check_verify($code, $id = ''){
            $verify = new \Think\Verify();  
            return $verify->check($code, $id);
        }

        //分页显示
        public function fenye ($count,$num) {

            $page   = new \Think\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)

            $page -> setConfig('header','共%TOTAL_ROW%条');
            $page -> setConfig('first','首页');
            $page -> setConfig('last','共%TOTAL_PAGE%页');
            $page -> setConfig('prev','上一页');
            $page -> setConfig('next','下一页');

            // $page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
            $page -> setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');

           return $page;
        }
       
}