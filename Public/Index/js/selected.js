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
    audio.volume = 0.3;                                     //初始化控制音量为30%
    this.lyricContainer = document.getElementById('lyricContainer');    //获取显示歌词区域对象
    this.playlist = document.getElementById('playlist');        //获取歌曲列表对象
    this.currentIndex = 0;                                  //当前url歌曲在列表中的索引
    this.lyric = null;                              
    this.lyricStyle = 0;                    //随机数字为歌词添加不同的class样式
};


Selected.prototype = {
    constructor: Selected,              //强制原型链指向自己
    init: function() {

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

        this.currentIndex = indexOfHashSong || Math.floor(Math.random() * allSongs.length); 

        currentSong = allSongs[this.currentIndex];      //当前被选中歌曲li标签以及内容
        // console.log(currentSong);
        randomLyric = currentSong.children[0].getAttribute('data-name');
        randomSong = currentSong.children[0].getAttribute('data-song');
        randomUrl = currentSong.children[0].getAttribute('data-url');
        randomSurl = currentSong.children[0].getAttribute('data-surl');

        //将歌曲名字添加到URL的HASH中
        window.location.hash =  randomLyric+",#"+randomSong;

        //执行播放切换操作(一点击就播放)
        // var li = document.getElementsByTagName('li');
        // $('li').click(function (e) {
        //     // console.log(e.target);
        //     // console.log(e.target.name);
        //     that.currentIndex = e.target.name;
        //     that.setClass(that.currentIndex);
        //     var lyricName1 = e.target.getAttribute('data-name');
        //     var songName1 = e.target.getAttribute('data-song');
        //     var dataUrl1 = e.target.getAttribute('data-url');
        //     var dataSurl1 = e.target.getAttribute('data-surl');
        //     window.location.hash = lyricName1+",#"+songName1;
        //     that.play(lyricName1,songName1,dataUrl1,dataSurl1);
        // });
       
        
        this.playlist.addEventListener('click', function(e) {
            if (e.target.nodeName.toLowerCase() !== 'a') {
                return false;
            };
            var allSongs = that.playlist.children[0].children,
                selectedIndex = Array.prototype.indexOf.call(allSongs, e.target.parentNode);
            that.currentIndex = selectedIndex;
            that.setClass(selectedIndex);
            var lyricName1 = e.target.getAttribute('data-name');
            var songName1 = e.target.getAttribute('data-song');
            var dataUrl1 = e.target.getAttribute('data-url');
            var dataSurl1 = e.target.getAttribute('data-surl');
            window.location.hash = lyricName1+",#"+songName1;
            that.play(lyricName1,songName1,dataUrl1,dataSurl1);
        }, false);


        //音频播放结束后事件
        this.audio.onended = function() {
            that.playNext(that);        //自动播放下一首
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


        //初始化随机开始歌曲
        for (var i = allSongs.length - 1; i >= 0; i--) {
            allSongs[i].className = '';
        };
        currentSong.className = 'current-song';
        this.play(randomLyric,randomSong,randomUrl,randomSurl);
    },
    play: function(lyricName,songName,dataUrl,dataSurl) {

        var that = this;
        this.audio.src = root+dataSurl;      //歌曲存放位置
        //重置歌词初始位置
        this.lyricContainer.style.top = '130px';
        //清空歌词
        this.lyric = null;
        this.lyricContainer.textContent = '正在加载中..........';
        this.lyricStyle = Math.floor(Math.random() * 4);                 //向下取整(0-3)
        that.getLyric(dataUrl);
        this.audio.play();                                            //自动播放


        //同步歌词时间
        this.audio.addEventListener("timeupdate", function(e) {         //当前的播放位置发送改变时触发
            if (!that.lyric) return;
            for (var i = 0, l = that.lyric.length; i < l; i++) {            //小于歌词数组的长度
                /*6位小数,提前加载歌词0.5s,currentTime 属性设置或返回音频/视频播放的当前位置(以秒计)*/
                if (this.currentTime > that.lyric[i][0] - 0.50) {               //[0]是时间,提前0.5秒载入下一行
                    //single line display mode
                    // that.lyricContainer.textContent = that.lyric[i][1];
                    //scroll mode
                    var line = document.getElementById('line-' + i),
                    prevLine = document.getElementById('line-' + (i > 0 ? i - 1 : i));
                    prevLine.className = '';
                    //随机化当前行的歌词颜色
                    line.className = 'current-line-' + that.lyricStyle;
                    //歌词往下滚动(基准为130px处)(div逐渐往上移动,知道结束)
                    that.lyricContainer.style.top = 130 - line.offsetTop + 'px';
                };
            };
        });
    },
    playNext: function(that) {          //播放下一首
        var allSongs = this.playlist.children[0].children,
            nextItem;
        //reaches the last song of the playlist?
        if (that.currentIndex === allSongs.length - 1) {
            //从列表开始处播放
            that.currentIndex = 0;
        } else {
            //播放下一首(索引加1)
            that.currentIndex += 1;
        };
        nextItem = allSongs[that.currentIndex].children[0];
        that.setClass(that.currentIndex);       //设置随机样式
        var lyricName = nextItem.getAttribute('data-name');
        var songName = nextItem.getAttribute('data-song');
        var dataUrl = nextItem.getAttribute('data-url');
        var dataSurl = nextItem.getAttribute('data-surl');
        window.location.hash = lyricName+",#"+songName;
        that.play(lyricName,songName,dataUrl,dataSurl);
    },
    setClass: function(index) {             //设置当前播放歌曲class样式
        var allSongs = this.playlist.children[0].children;
        for (var i = allSongs.length - 1; i >= 0; i--) {
            allSongs[i].className = '';
        };
        allSongs[index].className = 'current-song';                     //给<li>添加当前行样式
    },
    getLyric: function(url) {                                           //ajax异步请求歌词
        var that = this;
        request = new XMLHttpRequest();
        request.open('GET', root+url, true);
        request.setRequestHeader("If-Modified-Since","0");                  //清除ajax缓存
        request.setRequestHeader("Cache-Control","no-cache");
        request.responseType = 'text';
        //修正中文乱码.  reference: http://xx.time8.org/php/20101218/ajax-xmlhttprequest.html
        //request['overrideMimeType'] && request.overrideMimeType("text/html;charset=gb2312");
        request.onload = function() {
            that.lyric = that.parseLyric(request.response);         //将歌词添加到that对象的lyric属性上
            //显示歌词到页面上
            that.appendLyric(that.lyric);
        };
        request.onerror = request.onabort = function(e) {
            that.lyricContainer.textContent = '!加载歌词失败 :(';
        }
        this.lyricContainer.textContent = '加载歌词中...';

        request.send();
    },
    parseLyric: function(text) {        //解析歌词
        //从歌词文件中获取每一行歌词
        var lines = text.split('\n'),   //以回车进行分割
            //正则匹配 [00:12.78]
            pattern = /\[\d{2}:\d{2}.\d{2}\]/g,             //全局匹配歌词时间部分
            result = [];
        // 获取歌词的补偿时间值
        var offset = this.getOffset(text);
        //排除空行的歌词
        //[ar:歌手名]、[ti:歌曲名]、[al:专辑名]、[by:编辑者(指lrc歌词的制作人)]、[offset:时间补偿值] （
        //其单位是毫秒，正值表示整体提前，负值相反。这是用于总体调整显示快慢的，但多数的MP3可能不会支持这种标签）。
        while (!pattern.test(lines[0])) {           //除掉[ar:周杰伦]等类似的标签
            lines = lines.slice(1);                 //slice() 方法可从已有的数组中返回选定的元素,依次除掉[ti:跨时代]等
        };

        //移除最后为空的项
        lines[lines.length - 1].length === 0 && lines.pop();        //pop() 方法用于删除并返回数组的最后一个元素(删除末尾的空行)
        //将歌词内容显示到div区域
        lines.forEach(function(v, i, a) {      
            var time = v.match(pattern),                //match() 方法可在字符串内检索指定的值，或找到一个或多个正则表达式的匹配(返回时间部分)
                value = v.replace(pattern, '');         //replace() 方法用于将时间部分替换成为空字符串(实质是返回歌词部分)
            time.forEach(function(v1, i1, a1) {
                //将[分:秒,歌词]以秒格式然后存储到结果
                var t = v1.slice(1, -1).split(':');                             //将时间部分值取出来并以冒号分隔开
                result.push([parseInt(t[0], 10) * 60 + parseFloat(t[1]) + parseInt(offset) / 1000, value]);         //转换为10进制
            });
        });
        //用事件排序结果
        result.sort(function(a, b) {            //排序正常歌唱部分以及歌曲停顿时歌词重复显示部分
        //如果这个函数的返回值小于0 则不交换原数组中元素的位置，否则交换原数组中元素的位置。
            return a[0] - b[0];                 //变为升序排序
        });
    	// console.log(result);                    //打印结果
        return result;                          //返回解析结果
    },
    appendLyric: function(lyric) {              //添加歌词到页面
        var that = this,
            lyricContainer = this.lyricContainer,
            fragment = document.createDocumentFragment();
        //先清除
        this.lyricContainer.innerHTML = '';
        lyric.forEach(function(v, i, a) {                           //创建歌词形式例如:<p id="line-0">词 黄俊郎 曲 周杰伦</p>
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
