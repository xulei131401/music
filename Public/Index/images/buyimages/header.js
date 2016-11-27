/***********************************
 *@ Copyright 2015, kugou.com
 *@ Project shop.kugou
 *@ Creator: WRG
 *@ update by: blairwu
 *@ Modify: 2015/04/07|16:26:37
 *@ CreateTime: 2015年2月1日17:14:57
 ***********************************/
// document.domain = "kugou.com";
var domain = "http://www.kugou.com/shop/";
var tempGlobalParam = {};
window.onerror=function(){
    return true
}
/**
 * 初始化console,容错
 */
var console = window.console || {log:function(txt){}};  

/*公共方法*/
var publicFun = window.publicFun || {
        productNumCountInit: function(obj, callback) {

            /*@{更改商品数量}@*/
            /*初始化改变数量控件*/
            tempGlobalParam.productNum = 1; /*默认购买数量为1*/
            var _this = obj;
            var self= this;
            var plusBtn = _this.getElementsByTagName('a')[1];
            var minusBtn = _this.getElementsByTagName('a')[0];
            var numInput = _this.getElementsByTagName('input')[0];

            var thisNum = parseInt(numInput.value) > 1 ? parseInt(numInput.value) : 1;
            // 获取在购物列表操作当前对象的 id
            function returnId(){
                /*获取当前操作 产品的id 主要针对购物车
                 * return  skuId
                 * */
                var skuId="";
                skuId = Kg.$(_this).parent().parent().find(".c_p_del").attr("data-value").split("|")[1];
                return  skuId;
            };
            //获取产品详情页id 主要针对详情页
            function getProId(){
                if(tempGlobalParam.skuId){
                    var proskuid = tempGlobalParam.skuId;
                    return proskuid;
                }else{
                    return false
                }

            }
            _this.checkNum = function(num) { //检查数量来控制样式

                var maxValue = 100;//默认最大购买量

                if (num < 2) { //商品数量小于2时默认为1
                    minusBtn.style.cursor = "not-allowed";
                    num = 1;
                    numInput.value = num;
                } else if(num >maxValue) {
                    plusBtn.style.cursor = "not-allowed";
                    num = maxValue;
                    numInput.value = num;
                }else {
                    minusBtn.style.cursor = "pointer";
                    plusBtn.style.cursor = "pointer";
                    numInput.value = num;
                }
            };

            _this.checkNum(thisNum); //初次检查


            plusBtn.onclick = function() { //点击加按钮

                thisNum = parseInt(numInput.value) ? parseInt(numInput.value) : 1;
                thisNum +=1;
                _this.checkNum(thisNum);

                //校验库存显示错误信息
                if(getProId()){
                    self.getProskuStock(getProId(),thisNum,".p_num")
                }else if(returnId()){

                    self.getProskuStock(returnId(),thisNum,"");
                }



                //在购物车操作数量时 同步 cookie 中实际商品数量
                var cartPageFlag= location.href.indexOf("cartinfo");
                if(cartPageFlag != -1){
                    cartFun.confirmOrder(true)
                }

                callback ? callback(this) : null;
                return false;
            };
            minusBtn.onclick = function() { //点击减按钮
                thisNum = parseInt(numInput.value) ? parseInt(numInput.value) : 1;
                thisNum -= 1;
                _this.checkNum(thisNum);
               
                //校验库存显示错误信息
                if(getProId()){
                    self.getProskuStock(getProId(),thisNum,".p_num")
                }else if(returnId()){
                    self.getProskuStock(returnId(),thisNum,"");
                }


                //在购物车操作数量时 同步 cookie 中实际商品数量
                var cartPageFlag= location.href.indexOf("cartinfo");
                if(cartPageFlag != -1){
                    cartFun.confirmOrder(true)
                }

                callback ? callback(this) : null;
                return false;
            }
        },
        getProskuStock:function(proId,value,from){
            /*
             * 根据 产品id拿库存
             * proId :需要拿去的产品库存对应产品id
             * value: 当前 输入框的数量
             * from：错误信息显示位置 dom class
             * */
            Kg.Ajax({
                url: "http://www.kugou.com/shop/product/getnum?skuId="+proId,
                callback:function(res){

                    if (res.status=1) {
                        var num = parseInt(Kg.JSON.parse(res).data) ;
                        var maxValue=100;//最大下单量
                        if(num>maxValue&& value > maxValue){
                            alert("单次最大下单数量为100")
                        }
                        if(value > num){
                            if(from != ""){
                                Kg.$(from).find(".error").remove()
                                Kg.$(from).append('<p class="error">产品库存不足</p>')
                            }else{
                                alert("下单数量大于当前库存数量")
                            }
                        }else{
                            if( Kg.$(from).find(".error").length > 0){
                                Kg.$(from).find(".error").remove()
                            }

                        }
                    }
                }
            });
        },
        updateCatInfo: function(p_info) {
            /*@{向购物车追加商品条目}@*/
            /*数据格式
             p_info = {
             Skuid : skuId,
             Num:productNum
             }
             */
            if (!/object/g.test(typeof(p_info))) { //检查是否传入为对象
                return;
            }
            var cart_info_arr = [],
                cart_info_str = "",
                cart_info_now = Kg.Cookie.read("cart_info"); //读取购物车信息
            try { //尝试把购物车信息以json格式解析，如果格式不符清空并重写
                cart_info_arr = Kg.JSON.parse(cart_info_now); //购物车信息转化为数组
                if (cart_info_arr.length > 0) { //购物车不为空
                    var isset = false; //默认为不存在此条记录
                    for (var i = 0, l = cart_info_arr.length; i < l; i++) {
                        if (cart_info_arr[i]['Skuid'] == p_info['Skuid']) { //如果购物车中已经存在些skuid累加数量
                            //如果购物车已满100，或者 添加的数量加上原有购物车的数量满了100，拒绝添加
                            if(cart_info_arr[i]['Num'] >= 100 ||  cart_info_arr[i]['Num'] + parseInt(p_info['Num']) > 100){
                                alert( "单次最大下单数量为100");
                                return;
                            }else{
                                cart_info_arr[i]['Num'] += parseInt(p_info['Num']);
                            }

                            isset = true
                            break;
                        }
                    }
                    if (!isset) { //不存在此商品
                        cart_info_arr.push(p_info);
                    }
                } else { //购物车为空
                    cart_info_arr.push(p_info);
                }
            } catch (e) { //如果购物车信息不规范清空购物车重新写入
                cart_info_arr.push(p_info);
            }
            cart_info_str = Kg.JSON.stringify(cart_info_arr); //整合后的购物车信息转化为string
            Kg.Cookie.write("cart_info", cart_info_str, 2592000, "/", "kugou.com"); //购物string信息写入cookie
        },
        resetCart: function(cart_info_str) {
            /*@{重置购物车：传入购物信息则重写更新，否则清空购物车}@*/
            if (cart_info_str) {
                Kg.Cookie.write("cart_info", cart_info_str, 2592000, "/", "kugou.com");
            } else {
                Kg.Cookie.write("cart_info", null, -1, "/", "kugou.com");
            }
        },
        getCartInfo: function() {
            /*@{获取购物车信息}@*/
            var _this = this;
            // // 此处赶项目时 Kg 库 ajax jsonp ie6  有比较大的性能问题 改用jquery
             $.ajax({
                    url: domain + "shoppingCart/getCartInfo",
                    type: "get",
                    dataType: "jsonp",  
                    success: function(res) {
                       
                         _this.writeMiniCartList(res); 
                         if (location.href.indexOf("cartinfo") != -1) { //判断是否为购物车页面                            
                                cartFun.writeCartList(res); //购物车页面
                            }  
                    }
                });
            

        },
        writeMiniCartList: function(res) {

            tempGlobalParam.cart_info = res; //购物车信息本地存储
            var _this = this,
                cartInfoList = Kg.$("#cartInfoList"),
                myGoodsSum = Kg.$("#myGoodsSum"),
                goodsNum = Kg.$("#goodsNum"),
                totalSum = Kg.$("#totalSum"),
                count_cart = Kg.$(".count_cart"),
                productSum = 0, //商品总数
                total = 0, //总计金额
                dataList = res.data.Goods,
                listHtml = "",
                img_src,
                img_str;
            if (dataList.length < 1) { //购物车信息为空时

                count_cart.hide(); //计算总合部分隐藏
                myGoodsSum.html(0).hide(); //置零并隐藏数量
                cartInfoList.html("<li class='empty_cart'>购物车中还没有商品，赶紧选购吧！</li>");
                return;
            }
            for (var i = 0, l = dataList.length; i < l; i++) {
                img_src = '',
                    img_str = dataList[i]['product_img'].split('|')[0];

                if (img_str.match('.com')) {
                    img_src = img_str+"_100x100.jpg";
                } else {
                    img_src = 'http://imge.kugou.com/v2/shop_product/' + img_str+"_100x100.jpg";
                }
                if(i<6){
                    listHtml += [
                        '<li class="goods">',
                        '<a class="goods_img" href="http://www.kugou.com/shop/product/?id=' + dataList[i]['product_id'] + '" hidefocus="true">',
                        '<img src="' + img_src + '" alt="" width="60" height="60">',
                        '</a>',
                        '<div class="goods_info">',
                        '<em class="goods_cartName goods_mode">' + dataList[i]['name'] + '</em>',
                        '<em class="goods_name goods_cartName">' + dataList[i]['sku_price'] + 'x' + dataList[i]['Num'] + '</em>',
                        '<em class="goods_mode">' + dataList[i]['option_value'] + '</em>',
                        '</div>',
                        //'<span class="goods_s_s">'+ dataList[i]['name'] +'</span>',
                        '<a href="javascript:;" hidefocus="true" class="del_g" data-value="' + dataList[i]['product_id'] + '|' + dataList[i]['sku_id'] + '"></a>',
                        '</li>'
                    ].join("");
                }else{

                }


                productSum += parseInt(dataList[i]['Num']);
                total += dataList[i]['SubTotal'];
            }
            if(dataList.length>6){
                listHtml+="<li class='goods addliubai'><a href='http://www.kugou.com/shop/shoppingCart/cartinfo'>&bull;&bull;&bull;</a></li>";
            }

            cartInfoList.html(listHtml);
            //显示在顶部购物车数量控制
            var temoGoodsSum = productSum;

            if(temoGoodsSum>99){
                temoGoodsSum = "99+"
            }

            myGoodsSum.html(temoGoodsSum).show();
            goodsNum.html(productSum);
            totalSum.html(total.toFixed(2)+"元");
            count_cart.show();
            /*给删除按钮绑定事件*/
            var del_buttom = Kg.$("#cartInfoList").find(".del_g");
            for (var i = 0, l = del_buttom.length; i < l; i++) {
                del_buttom[i].onclick = function() {
                    var skuid = this.getAttribute("data-value").split("|")[1];
                    cartFun.delProduct(skuid); //调用通用删除方法
                    if(Kg.UA.Ie6){
                        location.reload();
                    }
                }
            }
        },
        headEventInit: function() {
            /*@{重置购物车：公共导航事件绑定}@*/
            var _this = this;
            /*获取购物车信息如果本地无存储*/
            if (!tempGlobalParam.cart_info) {
                _this.getCartInfo();
            }
            //是否为第一次登陆

            var nav_handle = Kg.$(".nav_handle");
            /*如果没有登录，加载登录插件js*/
            if (!this.checkLogin()) {
                var loginJs = document.createElement('script');
                loginJs.type = 'text/javascript';
                loginJs.async = true;
                loginJs.src = "http://static.kgimg.com/common/js/min/popuplogin-min.js?" + new Date().getTime();
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(loginJs, s);
                //var login_btn = Kg.$(".not_login")[0].getElementsByTagName("a")[0];
                var login_btn = Kg.$(".loginbtn")[0];
                Kg.addEvent(login_btn, "click", function(){
                    UsLogin(_this.checkLogin);
                });
            } else { //如果登录了去年末登录标记not_login
                Kg.$(".t_ico")[0].onclick = null;
                Kg.$(".regLink").hide();
                nav_handle.removeClass("not_login");
                tempGlobalParam.login_flag = false;
            }
            nav_handle.addEvent("mouseover", function() {
                var _this = Kg.$(this);
                if (!_this.hasClass("not_login")) {
                    _this.addClass("hover");
                }
                /*显示隐藏个人信息与MINI购物车*/
            }).addEvent("mouseout", function() {
                var _this = Kg.$(this);
                if (!_this.hasClass("not_login")) {
                    _this.removeClass("hover");
                }
            })
            /*生成顶部购物车信息*/
            var showWecharQC = Kg.$(".showWecharQC"),
                wecharQC = Kg.$(".vchar_code");
            showWecharQC.addEvent("mouseover", function() {
                wecharQC.show();
            }).addEvent("mouseout", function() {
                wecharQC.hide();
            })
            // 处理头部购物车跳转 self/_blank
            if(location.href.indexOf("shoppingCart") !=-1){
                Kg.$(".g_ico").attr("target","self");
            }
           
            // _this.scrollTop();

        },
        scrollTop:function(){
            /*
             * 返回顶部 fn
             * */
            var winWidth = parseInt(document.documentElement.clientWidth || document.body.clientWidth),
                winHeight = parseInt(document.documentElement.clientHeight || document.body.clientHeight),
                scrollTop = parseInt(document.documentElement.scrollTop || document.body.scrollTop),
                icoOffset_V = scrollTop + winHeight/2 - 36;//图标垂直方向上的位置
            var scrollEle = Kg.$(".scroll");
            if(scrollTop>300){
                scrollEle.show();
            }else{
                scrollEle.hide();
            }

            if(winWidth>990){
                var leftPos = Math.floor((winWidth-990)/2+990)+10;

                document.getElementById("scroll").style.right = leftPos
            }else{

                var leftPos = 0;
                document.getElementById("scroll").style.right = leftPos
            }

            Kg.UA.Ie6 ? scrollEle.css({
                "position":"absolute",
                "top":(icoOffset_V+200)+"px",
                "left":leftPos+"px"
            }):scrollEle.css({
                "top":"60%",
                "left":leftPos+"px"
            });
            scrollEle.addEvent("click",function(){

                if(document.documentElement.scrollTop){
                    scrollEle.hide();
                    document.documentElement.scrollTop = 0;
                }else{
                    scrollEle.hide();
                    document.body.scrollTop = 0;
                }

            })
        },
        initSimRad: function() {
            /*@{模拟radio选框}@*/
            var simRads = Kg.$(".sel_ico"),
                simRadLabels = Kg.$(".label_radio");
            simRads.addEvent("click", function(event) {
                Kg.stopEvent(event);
                var thisName = this.getAttribute("data-name"),
                    _this = Kg.$(this),
                    thisDataFor = this.getAttribute("data-for");
                /*
                 如果选择了发票，默认选择发票类型为 个人
                 如果选择发票TITLE为单位 则显示 填写 单位的输入框，反之隐藏
                 */
                switch (thisDataFor) {
                    case "company":
                        Kg.$("#companyName").show();
                        Kg.$("#receiptTitle").show();
                        break;
                    case "person":
                        Kg.$("#receiptTitle").show();
                        Kg.$("#companyName").hide();
                        break;
                    case "recType":
                        Kg.$("#for_person")[0].click();
                        Kg.$("#receiptTitle").show();
                        break;
                    default:
                        Kg.$("#receiptTitle").hide();
                        Kg.$("#companyName").hide();
                        break;
                }
                for (var i = 0, l = simRads.length; i < l; i++) {
                    if (simRads[i].getAttribute("data-name") == thisName) {
                        simRads[i].className = "sel_ico";
                    }
                }
                _this.addClass("active");
            })
            simRadLabels.addEvent("click", function() {
                Kg.stopEvent(event);
                var thisFor = Kg.$(this).attr("data-for");
                Kg.$("#for_" + thisFor)[0].click();
            })
        },
        pop: function(DomId) {
            /*@{公共弹窗}@*/
            popub = new LightBox(DomId, {
                modal: true,
                modalOpa: 50,
                pos: "center"
            });
            popub.open();
        },
        checkLogin: function() {
            /*@{检查是否登陆}@*/
            var userId = Kg.Cookie.read("KuGoo", "KugooID");

            if (userId) {
                tempGlobalParam.userId = userId;
                var loginBlock = Kg.$(".nav_r"), //登录区块
                    loginBtn = Kg.$(".loginbtn"), //登录按钮
                    perhomeLink = Kg.$(".perhome"), //登录按钮
                    nickNameDom = Kg.$("#userName"), //昵称
                    userImgDom = Kg.$("#userImg"), //头像
                    userScoreDom = Kg.$("#userScore"), //积分
                    myMsgSum = Kg.$("myMsgSum"), //消息
                    userImg = Kg.Cookie.read("KuGoo", "Pic"), //cookie头像地址
                    nickName = unescape(Kg.Cookie.read("KuGoo", "NickName")); //cookie头像地址
                if (!/http/gi.test(userImg)) { //不完整的头像地址
                    var folder = userImg.substr(0, 8);
                    if(folder != ''){
                        userImg = "http://imge.kugou.com/kugouicon/165/" + folder + "/" + userImg;
                    }else {
                        userImg = 'http://imge.kugou.com/kugouicon/20100101/20100101192931478054.jpg';
                    }
                }
                nickNameDom.html("Hi," + nickName);
                userImgDom[0].src = userImg;
                userScoreDom.html(0);

                //Kg.get( //尝试同步本地购物车cookie到DB
                //    domain + "shoppingCart/saveToUser",
                //    "User_id=" + userId + "&t=" + new Date().getTime(),
                //    function(res) {}
                //)
                //尝试同步本地购物车cookie到DB
                Kg.Ajax({
                    docType:"jsonp",
                    url: domain + "shoppingCart/saveToUser&User_id="+ userId + "&t=" + new Date().getTime(),
                    callback:function(res){
                           
                    }
                });
                
                 //vip icon
                Kg.Ajax({
                    method:"get",
                    docType:"jsonp",
                    url: domain + "user/getvip",
                    callback:function(res){
                        tempGlobalParam.vip = res.is_vip;                      
                        if(tempGlobalParam.vip != 0){
                            var vipIcon=Kg.$(".vipIcon"),
                                vip_false=Kg.$(".vip_false"),
                                vip_true=Kg.$(".vip_true")

                            if(vipIcon.length>0){
                                vip_false.hide();
                                vip_true.show();
                            }
                                                      
                        }

                    }
                });

                /*去年末登录标记 并去除点击事件*/
                Kg.$(".t_ico").onclick = null;

                //隐藏注册按钮
                Kg.$(".regLink").hide();
                loginBtn.hide();
                perhomeLink.show();
          
                perhomeLink.attr("href",domain + "user/home");
                loginBlock.removeClass("not_login");
                return true;
            } else {
                return false;
            }
        }
    }

/*购物车页*/
var cartFun = window.cartFun || {
        initEvent: function() {
            var _this = this;

            $.ajax({
                url: domain + "shoppingCart/getCartInfo",
                type: "get",
                dataType: "jsonp",  
                success: function(res) {
                      _this.writeCartList(res); //购物车页面  
                }
            });


            Kg.$("#goToPay")[0].onclick = function() {
                if(!publicFun.checkLogin()){
                    UsLogin(publicFun.checkLogin());
                }else{
					//检查 cookie 购物 是否还有，避免在其他页面结算完 重复下单报错
					var cart_info_now = Kg.Cookie.read("cart_info");
					
					if(cart_info_now){
						var cart_info_arr = Kg.JSON.parse(cart_info_now);
					}else{
						var cart_info_arr = [];
					}
								
					if(cart_info_arr.length > 0 ){		
					
						_this.confirmOrder(); 
						
					}else{
						var result = confirm("购物车为空");
						if(result == true){
							location.reload();
						}
						
					}
					
                    
                }
				
                return false;
            }
        },
        writeCartList: function(cartListData) {
            /*@{生成购物车列表}@*/
            var _this = this;
            if (cartListData) {
                var cartInfoTable = Kg.$("#cartInfoTable");
                cartInfoTable.html("<p class='load_notice'>购物车信息正在努力加载中..."),
                    cartData = cartListData.data.Goods,
                    cart_table = "";
                if (cartData.length > 0) { //购物车不为空
                    var img_src = '',
                        img_str = '';
                    cart_table += [ //生成表头
                        '<table border="0" cellspacing="0" cellpadding="0">',
                        '<thead>',
                        '<tr>',
                        '<th width="600">商品名称</th>',
                        '<th width="167">单品价格</th>',
                        '<th width="179">购买数量</th>',
                        '<th width="111">小计</th>',
                        '<th width="146">操作</th>',
                        '</tr>',
                        '</thead>',
                        '<tbody>'
                    ].join("");
                    for (var i = 0, l = cartData.length; i < l; i++) { //生成行数据
                        img_src = '',
                            img_str = cartData[i]['product_img'].split('|')[0];

                        if (img_str.match('.com')) {
                            img_src = img_str;
                        } else {
                            img_src = 'http://imge.kugou.com/v2/shop_product/' + img_str;
                        }

                        cart_table += [
                            '<tr class="' + (i ==  cartData.length-1 ? 't_b_b noboder' : '') + '">',
                            '<td class="t_t_l">',
                            '<a href="http://www.kugou.com/shop/product/?id='+ cartData[i]['product_id'] +'" class="c_p_img"><img width=158 height=158 src="' + img_src + '" alt=""></a>',
                            '<a href="http://www.kugou.com/shop/product/?id='+ cartData[i]['product_id'] +'" class="c_p_name" style="width:200px;color:#333;">' + cartData[i]['name'] + '<br/>' + cartData[i]['option_value'] + '</a>',
                            '</td>',
                            '<td class="c_p_price">' + parseFloat(cartData[i]['Price']).toFixed(2) + '元</td>',
                            '<td class="c_p_handle"><div class="changeNumBar"><a class="p_n_btn b_minus" href="javascript:;" hidefocus="">+</a><input class="productNum" type="text" value="' + parseFloat(cartData[i]['Num']) + '" maxlength="4" title="请输入购买量"><a class="p_n_btn b_plus" href="javascript:;" hidefocus="">-</a></div></td>',
                            '<td class="c_p_sum">' + parseFloat(cartData[i]['SubTotal']).toFixed(2) + '元</td>',
                            '<td><a href="javascript:;" hidefocus="true" class="c_p_del" data-value="' + cartData[i]['product_id'] + "|" + cartData[i]['sku_id'] + '" title="删除">删除</a></td>',
                            '</tr>'
                        ].join("");
                    }
                    cart_table += "</tbody></table>";
                } else {
                    //购物车为空
                    cart_table = "<p class='load_notice'>购物车里没有任何商品！</p>";
                    Kg.$('#goToPay,.cart_handle span').hide();
                }
                //生成表格
                cartInfoTable.html(cart_table);
                /*为改变购买量绑定事件*/
                var changeNumBar = Kg.$("#cartInfoTable")[0].getElementsByTagName('div');
                for (var i = 0, l = changeNumBar.length; i < l; i++) {
                    if (/changeNumBar/g.test(changeNumBar[i].className)) {
                        changeNumBar[i].onmouseover = function() {
                            publicFun.productNumCountInit(this, cartFun.sumTotal);
                        }
                    }
                }
                /*给INPUT框添加blur事件*/
                var inputDom = Kg.$("#cartInfoTable")[0].getElementsByTagName('input');
                for (var i = 0, l = inputDom.length; i < l; i++) {
                    if (/productNum/g.test(inputDom[i].className)) {
                        inputDom[i].onkeyup = function() {
                            //debugger
                            var that = this;
                            var me = Kg.$(this),
                                thisValue = me.val();
                            thisValue = parseInt(thisValue) || 1; //输入不是数字默认为1
                            thisValue = thisValue < 0 ? 1 : thisValue; //输入负数默认为1
                            //debugger
                            var addProNumele =that.parentNode.parentNode.parentNode.lastChild.childNodes;//获取有该点击按钮对应的产品 id dom对象
                            if(addProNumele){
                                var skuId;
                                for(var i= 0,len=addProNumele.length;i<len;i++){

                                    if(addProNumele[i].className=="c_p_del"){
                                        skuId = addProNumele[i].getAttribute("data-value").split("|")[1]
                                        publicFun.getProskuStock(skuId,thisValue,"");
                                        break;
                                    }
                                }
                            }
                            if(thisValue>100){
                                me.val(100);
                            }else{
                                me.val(thisValue);
                            }
                            setTimeout(function() {
                                _this.sumTotal(that);
                            }, 500)
                        }
                    }
                }
                /*给删除按钮绑定事件*/
                 if(Kg.UA.Ie6){
                    //由于Kg 库 获取的 dom不准确 在ie6下所以在事件绑在 td上
                    var td = Kg.$("#cartInfoTable td");
                    for(var i= 0,len = td.length;i<len;i++){
                        if(td[i].className == ""){//根据输出的dom结构 就 删除按钮所在td  没有class以次作为依据判断
                            td[i].onclick=function(){
                                var skuid =Kg.$( td[i]).find(".c_p_del").attr("data-value").split("|")[1];
                                _this.delProduct(skuid);
                                location.reload();
                            }
                        }
                    }
                }else{
                   var del_buttom = Kg.$("#cartInfoTable").find(".c_p_del");
                   for (var i = 0, l = del_buttom.length; i < l; i++) {
                       del_buttom[i].onclick = function() {
                           var skuid = this.getAttribute("data-value").split("|")[1];
                           _this.delProduct(skuid);
                       }
                   }
               }
                /*计算总计*/
                _this.sumPaySum();

            }
        },
        sumTotal: function(dom) {
            /*计算小计*/
            var tr = dom.parentNode.parentNode.parentNode, //父元素行级
                subTotalDom = tr.getElementsByTagName('td')[3], //小计TD级
                thisSkuId = tr.getElementsByTagName('td')[4].getElementsByTagName('a')[0].getAttribute("data-value").split("|")[1], //该条数据的SKUID
                goodsPrice = parseFloat(tr.getElementsByTagName('td')[1].innerHTML) || 0, //商品单价
                goodsNum = tr.getElementsByTagName('input')[0].value || 0, //商品数量
                subTotal = (goodsNum * goodsPrice).toFixed(2);
            subTotalDom.innerHTML = subTotal + "元";
            cartFun.sumPaySum(); //计算总计
        },
        sumPaySum: function() {
            /*计算总计*/
            var subTotalDoms = Kg.$(".c_p_sum"), //所有小计DOM
                paySum = 0, //需要支付的总计
                cartPaySumDom = Kg.$("#cartPaySum"),//总计DOM
                cartAlsoNeedPay = Kg.$("#cartAlsoNeedPay");
            for (var i = 0, l = subTotalDoms.length; i < l; i++) { //计算总计
                var thisSubTotal = subTotalDoms[i].innerHTML;
                paySum += (parseFloat(thisSubTotal) || 0);
            }
            cartPaySumDom.html("&#65509;" + paySum.toFixed(2) + "元");

            if(paySum>=100){
                cartAlsoNeedPay.html("0")
                
            }else{

                cartAlsoNeedPay.html(100-paySum);
            } 

            Kg.Ajax({
                method:"get",
                docType:"jsonp",
                url: domain + "user/getvip",
                callback:function(res){
                   
                    if(res.is_vip != 0 &&  res.is_vip!= undefined){

                         cartAlsoNeedPay.html("0");
                        
                    }else{

                       if(paySum>=100){
                            cartAlsoNeedPay.html("0")

                        }else{

                            cartAlsoNeedPay.html(100-paySum);
                        } 
                    }
                }
            });
          
        },
        confirmOrder: function(fromBtnFlg) {
            /*@{确认订单}@*/
            /*@{fromBtn} 同步在购物车点击增加 减少按钮操作后的 cookie中实际的数量@*/

            var new_cart_info = [], //重置购物车信息
                trs = Kg.$("#cartInfoTable tr"); //逐行更新购物车

            for (var i = 1, l = trs.length; i < l; i++) {
                var p_info = {
                    Skuid: trs[i].getElementsByTagName('td')[4].getElementsByTagName('a')[0].getAttribute("data-value").split("|")[1], //该条数据的SKUID
                    Num: trs[i].getElementsByTagName('input')[0].value || 0 //商品数量
                }
                new_cart_info.push(p_info);
            }
            publicFun.resetCart(); //清空购物车
            publicFun.resetCart(Kg.JSON.stringify(new_cart_info)); //重新写入

            if(!fromBtnFlg){
                window.location.href = domain + "order/shopOrder";
            }



        },
        delProduct: function(skuid) {
            /*@{删除一条商品skuid}@*/
            var _this = this;
            if (skuid == undefined) {
                return;
            }
            var cat_cookie = Kg.Cookie.read("cart_info");
            try { //解析cookie字符串为obj对象
                var cart_info_obj = Kg.JSON.parse(cat_cookie);
                for (var i = 0, l = cart_info_obj.length; i < l; i++) {
                    if (cart_info_obj[i]['Skuid'] == skuid) { //找出该skuid记录
                        cart_info_obj.splice(i, 1); //删除该条记录
                        publicFun.resetCart(Kg.JSON.stringify(cart_info_obj)); //删除后的cookie重新写入cookie
                        break;
                    }
                }
            } catch (e) { //解析cookie字符串为obj失败则cookie信息格式不正确清空cookie

                publicFun.resetCart();
            }
            publicFun.getCartInfo(); //重新获取购物车信息
        }
    }

