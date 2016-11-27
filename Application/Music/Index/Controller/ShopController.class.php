<?php
namespace Index\Controller;
use Think\Controller;

class ShopController extends Controller {
	
	 //商品列表分页显示
    public function index(){

        $id1 = 4;          //商品分类小耳机ID
        $id2 = 7;          //商品分类周杰伦专辑ID
        $id3 = 32;          //商品分类小音响ID
        $categoryGoods = M('Category_goods');
        $category = M('Category');
        $result1 = $categoryGoods->where('category_id=%d', $id1)->field('id, category_id, goods_id')->select(); //取出该分类下的商品ID
        $result2 = $categoryGoods->where('category_id=%d', $id2)->field('id, category_id, goods_id')->select(); //取出该分类下的商品ID
        $result3 = $categoryGoods->where('category_id=%d', $id3)->field('id, category_id, goods_id')->select(); //取出该分类下的商品ID
        //实例化歌曲类模型
        $goods = M('Goods');
        if ($result1) {      //为了防止foreach报错
            foreach ($result1 as $key => $value) {
            $arr[] = intval($value['goods_id']);
            }
            $where1['id'] = array('IN', $arr);
        } else {
            $where1['id'] = null;        //当没有商品时默认为null
        }

         if ($result2) {      //为了防止foreach报错
            foreach ($result2 as $key => $value) {
            $arr[] = intval($value['goods_id']);
            }
            $where2['id'] = array('IN', $arr);
        } else {
            $where2['id'] = null;        //当没有商品时默认为null
        }

         if ($result3) {      //为了防止foreach报错
            foreach ($result3 as $key => $value) {
            $arr[] = intval($value['goods_id']);
            }
            $where3['id'] = array('IN', $arr);
        } else {
            $where3['id'] = null;        //当没有商品时默认为null
        }

        $count = count($arr);// 查询满足要求的总记录数
        $num = 8;   //每页显示几条
        $page = R('Home/Common/fenye',array('count'=>$count,'num'=>$num));
        // dump($page);
        $show   = $page->show();// 分页显示输出
        //分页查询
        $result4 = $goods->order('id asc')->where($where1)->limit($page->firstRow.','.$page->listRows)->select(); //耳机
        $result5 = $goods->order('id asc')->where($where2)->limit($page->firstRow.','.$page->listRows)->select(); //唱片
        $result6 = $goods->order('id asc')->where($where3)->limit($page->firstRow.','.$page->listRows)->select(); //音响

        $this->assign('goods_show1',$result4);// 赋值数据集
        $this->assign('goods_show2',$result5);// 赋值数据集
        $this->assign('goods_show3',$result6);// 赋值数据集
        $this->assign('count',$count);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出;
        $this->display();
    }

}