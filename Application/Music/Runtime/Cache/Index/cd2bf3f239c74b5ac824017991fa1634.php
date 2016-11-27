<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="imageBg">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta http-equiv="pragma" CONTENT="no-cache"> 
        <meta http-equiv="Cache-Control" CONTENT="no-cache, must-revalidate"> 
        <meta name="author" content="xulei">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>个人音乐网站播放器</title>
        <link rel="stylesheet" href="<?php echo C('T_URL');?>/css/music.css" />
        <script type="text/javascript" src="<?php echo C('T_URL');?>/js/jquery-2.2.2.min.js"></script>
        <style type="text/css">
        /*设置当前歌曲列表样式*/
            .current-song, .current-song a {
                    color: #A6E22D;
                }
        </style>
        <script type="text/javascript">
            var astr = <?php echo ($dataJson); ?>;
            var root = "/music/";
            $(function () {
                //点击换标题
                $('a').click(function () {
                    var $songname = $(this).attr('data-value');
                    $('#show').text($songname);
                });
                       
                //点击换肤
                 $('.bg').click(function () {
                    var color = $(this).attr('color');
                    $('html').css('background',color);
                });
            })
        </script>
    </head>
    <body>
    <div>
    <!--左上角的标题(有URL)-->
        <header>
              <div id="show"><a href="<?php echo U('Index/Index');?>">我的个人音乐网站</a></div>
        </header>

        <div class="wrapper">
            <!--播放器控制-->
            <div id="player">
                <audio controls id="audio" src="/music/<?php echo ($song['url']); ?>" id="bgAudio">您的浏览器不支持该播放器!:(</audio>
            </div>
            <!--控制结束-->
            <!--左侧歌曲列表-->
            <div id="playlist">
            <!--会显示在歌曲列表的上方-->
                <ol>
                    <?php if(is_array($a)): $k = 0; $__LIST__ = $a;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li><a name="<?php echo ($k-1); ?>" id="gequ<?php echo ($k-1); ?>" href="javascript:void(0)" data-name="<?php echo ($vo['real_lrc_name']); ?>" data-song="<?php echo ($vo['real_song_name']); ?>" data-url="<?php echo ($vo['ly_ric_url']); ?>" data-surl="<?php echo ($vo['real_song_url']); ?>" data-value="<?php echo ($vo['song_name']); ?>--<?php echo ($vo['artist']); ?>"><?php echo ($vo['song_name']); ?>--<?php echo ($vo['artist']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ol>
                <!--歌曲列表下方的换肤-->
                <div class="info">
                    <div class="bg"  title="灰色" color="#887B77" style="background-color:#887B77;"></div>
                    <div class="bg"  title="粉色" color="#EE1196" style="background-color:#EE1196;"></div>
                    <div class="bg"  title="青蓝色" color="#667B99" style="background-color:#667B99;"></div>
                    <div class="bg"  title="偏粉色" color="#996671" style="background-color:#996671;"></div>
                    <div class="bg"  title="暗绿色" color="#76B34D" style="background-color:#76B34D;"></div>
                    <div class="bg"  title="黑色" color="black" style="background-color:black;"></div>
                    <a href="<?php echo U('Index/Index');?>">返回首页</a>
                </div>
                <!--换肤结束-->
            </div>
            <!--中间歌词显示部分-->
            <div id="lyricWrapper">
                <div id="lyricContainer">
                </div>
            </div>
        </div>

    </div>
        <script src="<?php echo C('T_URL');?>/js/selected.js"></script>
    </body>
</html>