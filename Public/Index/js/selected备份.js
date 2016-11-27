/*
 * 最爱的音乐播放器
 * 版本:v0.3.0
 * 同时作为一个展示，展示了如何用HTML5音频标签同步歌词
 * 本项目所用的歌曲只用于学习目的
 */

$(function (){          //DOM树绘制完毕调用初始化方法
        new Selected().init();      //初始化
})

var Selected = function() {     //函数
    this.audio = document.getElementById('audio');          //获取audio对象
    audio.volume = 0.5;                                     //初始化控制音量为50%
    this.lyricContainer = document.getElementById('lyricContainer');    //获取显示歌词区域对象
    this.playlist = document.getElementById('playlist');        //获取歌曲列表对象
    this.currentIndex = 0;                                  //当前歌曲的索引
    this.lyric = null;                              
    this.lyricStyle = 0;                    //随机数字为歌词添加不同的class样式
};


Selected.prototype = {
    constructor: Selected,              //强制原型链指向自己
    init: function() {
        //获取全部歌曲并添加到歌曲列表中
        this.initialList(this);

        var that = this,allSongs = this.playlist.children[0].children, currentSong, randomLyric,randomSong;
        var arr = new Array();
        arr = window.location.hash.split(',');
        var lyricName = arr[0];         //截取url的#....部分
        var songName = arr[1];         //截取url的#....部分
        // var lyricName = window.location.hash.substr(1);
        //获取url中歌曲在歌曲列表的索引
        var indexOfHashSong = (function() {
            var index = 0;
            Array.prototype.forEach.call(allSongs, function(v, i, a) {
                if (v.children[0].getAttribute('data-name') == lyricName) {
                    index = i;
                    return false;
                }

            });
            return index;
        })();

        this.currentIndex = indexOfHashSong || Math.floor(Math.random() * allSongs.length); //当前歌曲列表的索引
   
        currentSong = allSongs[this.currentIndex];      //当前被选中歌曲li标签以及内容

        randomLyric = currentSong.children[0].getAttribute('data-name');
        randomSong = currentSong.children[0].getAttribute('data-song');
        randomUrl = currentSong.children[0].getAttribute('data-url');
        randomSurl = currentSong.children[0].getAttribute('data-surl');

        //将歌曲名字添加到URL的HASH中
        window.location.hash =  randomLyric+",#"+randomSong;

        //执行播放切换操作(一点击就播放)
        var li = document.getElementsByTagName('li');
        for (var i = 0; i < li.length; i++) {
            var demo = 'a'+i;
            $('#gequ'+i).click(function (e) {
                that.currentIndex = this.desc;
                that.setClass(that.currentIndex);
                var lyricName1 = $(this).attr('data-name');
                var songName1 = $(this).attr('data-song');
                var dataUrl1 = $(this).attr('data-url');
                var dataSurl1 = $(this).attr('data-surl');
                window.location.hash = lyricName1+",#"+songName1;
                that.play(lyricName1,songName1,dataUrl1,dataSurl1);
            });
        }
        
        // this.playlist.addEventListener('click', function(e) {
        //     if (e.target.nodeName.toLowerCase() !== 'a') {
        //         return false;
        //     };
        //     var allSongs = that.playlist.children[0].children,
        //         selectedIndex = Array.prototype.indexOf.call(allSongs, e.target.parentNode);
        //     that.currentIndex = selectedIndex;
        //     that.setClass(selectedIndex);
        //     var lyricName1 = e.target.getAttribute('data-name');
        //     var songName1 = e.target.getAttribute('data-song');
        //     var dataUrl1 = e.target.getAttribute('data-url');
        //     var dataSurl1 = e.target.getAttribute('data-surl');
        //     window.location.hash = lyricName1+",#"+songName1;
        //     that.play(lyricName1,songName1,dataUrl1,dataSurl1);
        // }, false);

    // console.log(this.playlist.getElementsByTagName['ol'][0]);



        //音频播放结束后事件
        this.audio.onended = function() {
            that.playNext(that);        //播放下一首
        }
        //onerror 事件会在文档或图像加载过程中发生错误时被触发
        this.audio.onerror = function(e) {
            that.lyricContainer.textContent = '加载歌曲失败! :(';
        };

        //启用键盘控制，空格键播放和暂停。
        window.addEventListener('keydown', function(e) {
            if (e.keyCode === 32) {
                if (that.audio.paused) {    //暂停
                    that.audio.play();      
                } else {
                    that.audio.pause();
                }
            }
        }, false);

        //初始化背景设置
        document.getElementById('bg_dark').addEventListener('click', function() {
            document.getElementsByTagName('html')[0].className = 'colorBg';
       });
        document.getElementById('bg_pic').addEventListener('click', function() {
            document.getElementsByTagName('html')[0].className = 'imageBg';
        });

        //初始化随机开始歌曲
        for (var i = allSongs.length - 1; i >= 0; i--) {
            allSongs[i].className = '';
        };
        currentSong.className = 'current-song';
        this.play(randomLyric,randomSong,randomUrl,randomSurl);
    },
    initialList: function(ctx) {
      //请求歌曲,歌词json文件
    var fragment = document.createDocumentFragment(),
        data = astr.data,                                   //解析json数据
        ol = ctx.playlist.getElementsByTagName('ol')[0],
        fragment = document.createDocumentFragment();

    data.forEach(function(v, i, a) {
        var li = document.createElement('li'),
            a = document.createElement('a');
        a.href = 'javascript:void(0)';
        a.id = "gequ"+i;                                        //为每一个li添加ID属性
        a.desc = i;                                        //为每一个li添加序列属性
        a.dataset.name = v.real_lrc_name;                    //歌词真实名字
        a.dataset.url = v.ly_ric_url;                           //歌词真实路径
        a.dataset.surl = v.real_song_url;                      //歌曲真实路径
        a.dataset.song = v.real_song_name;                    //歌曲真实名字
        a.textContent = v.song_name + '-' + v.artist;       //歌曲名-歌手名
        li.appendChild(a);
        fragment.appendChild(li);
    });
        ol.appendChild(fragment);           //添加到ol列表中
    },
    play: function(lyricName,songName,dataUrl,dataSurl) {
        var that = this;
        // this.audio.src = './content/songs/' + lyricName + '.mp3';      //歌曲存放位置
        this.audio.src = root+dataSurl;      //歌曲存放位置
        //重置歌词初始位置
        this.lyricContainer.style.top = '130px';
        //清空歌词
        this.lyric = null;
        this.lyricContainer.textContent = '正在加载中..........';
        this.lyricStyle = Math.floor(Math.random() * 4);
        this.audio.addEventListener('canplay', function() {
            // var lyricUrl = './content/songs/' + lyricName + '.lrc';       //歌词的存放位置
            var lyricUrl = dataUrl;                                    //歌词的存放位置
            that.getLyric(lyricUrl);    
            // this.play();                                                       //自动播放
        });

        //同步歌词时间
        this.audio.addEventListener("timeupdate", function(e) {
            if (!that.lyric) return;
            for (var i = 0, l = that.lyric.length; i < l; i++) {
                if (this.currentTime > that.lyric[i][0] - 0.50 /*preload the lyric by 0.50s*/ ) {
                    //single line display mode
                    // that.lyricContainer.textContent = that.lyric[i][1];
                    //scroll mode
                    var line = document.getElementById('line-' + i),
                    prevLine = document.getElementById('line-' + (i > 0 ? i - 1 : i));
                    prevLine.className = '';
                    //随机化当前行的歌词颜色
                    line.className = 'current-line-' + that.lyricStyle;
                    that.lyricContainer.style.top = 130 - line.offsetTop + 'px';        //歌词往下滚动(基准为130px处)
                };
            };
        });
    },
    playNext: function(that) {          //播放下一首
        var allSongs = this.playlist.children[0].children,
            nextItem;
        //reaches the last song of the playlist?
        if (that.currentIndex === allSongs.length - 1) {
            //play from start
            that.currentIndex = 0;
        } else {
            //play next index
            that.currentIndex += 1;
        };
        nextItem = allSongs[that.currentIndex].children[0];
        that.setClass(that.currentIndex);
        var lyricName = nextItem.getAttribute('data-name');
        var songName = nextItem.getAttribute('data-song');
        var dataUrl = nextItem.getAttribute('data-url');
        var dataSurl = nextItem.getAttribute('data-surl');
        window.location.hash = lyricName+",#"+songName;
        that.play(lyricName,songName,dataUrl,dataSurl);
    },
    setClass: function(index) {             //设置当前播放歌曲class样式
        var allSongs = this.playlist.children[0].children;
        // console.log(allSongs);
        // console.log(index);
        for (var i = allSongs.length - 1; i >= 0; i--) {
            allSongs[i].className = '';
        };
        allSongs[index].className = 'current-song';
    },
    getLyric: function(url) {               //ajax异步请求歌词
        console.log(this);
        var that = this;
        request = new XMLHttpRequest();
        u = u+"?content="+url;
        request.open('GET', u, true);
        // request.setRequestHeader("If-Modified-Since","0");
        // request.setRequestHeader("Cache-Control","no-cache");
        request.responseType = 'text';
        //修正中文乱码.  reference: http://xx.time8.org/php/20101218/ajax-xmlhttprequest.html
        //request['overrideMimeType'] && request.overrideMimeType("text/html;charset=gb2312");
        // request.onload = function() {
            // that.lyric = that.parseLyric(request.response);
            // //显示歌词到页面上
            // that.appendLyric(that.lyric);
        // };
        request.onerror = request.onabort = function(e) {
            that.lyricContainer.textContent = '!加载歌词失败 :(';
        }
        this.lyricContainer.textContent = '加载歌词中...';

        request.send();
    },
    parseLyric: function(text) {        //解析歌词
        //get each line from the text
        var lines = text.split('\n'),   //以回车进行分割
            //this regex mathes the time [00:12.78]
            pattern = /\[\d{2}:\d{2}.\d{2}\]/g,             //全局匹配歌词
            result = [];

        // 获取歌词的偏移量
        var offset = this.getOffset(text);

        //排除空行的歌词
        while (!pattern.test(lines[0])) {
            lines = lines.slice(1);
        };
        //移除最后为空的项
        lines[lines.length - 1].length === 0 && lines.pop();
        //将歌词内容显示到div区域
        lines.forEach(function(v, i, a) {
            var time = v.match(pattern),
                value = v.replace(pattern, '');
            time.forEach(function(v1, i1, a1) {
                //将[分：秒]以秒格式然后存储到结果
                var t = v1.slice(1, -1).split(':');
                result.push([parseInt(t[0], 10) * 60 + parseFloat(t[1]) + parseInt(offset) / 1000, value]);
            });
        });
        //用事件排序结果
        result.sort(function(a, b) {
            return a[0] - b[0];
        });
		// console.log(result);          //打印结果
        return result;                  //返回解析结果
    },
    appendLyric: function(lyric) {
        var that = this,
            lyricContainer = this.lyricContainer,
            fragment = document.createDocumentFragment();
        //先清除
        this.lyricContainer.innerHTML = '';
        lyric.forEach(function(v, i, a) {
            var line = document.createElement('p');
            line.id = 'line-' + i;
            line.textContent = v[1];
            fragment.appendChild(line);
        });
        lyricContainer.appendChild(fragment);
    },
    getOffset: function(text) {
        //返回毫秒偏移量
        var offset = 0;
        try {
            // 模式匹配 [offset:1000]
            var offsetPattern = /\[offset:\-?\+?\d+\]/g,
                //获得第一次匹配结果.
                offset_line = text.match(offsetPattern)[0],
                // Get the second part of the offset.
                offset_str = offset_line.split(':')[1];
            // 转换为Int结果
            offset = parseInt(offset_str);
        } catch (err) {
            //alert("offset error: "+err.message);
            offset = 0;
        }
        return offset;
    }
};
