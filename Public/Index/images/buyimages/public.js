/***********************************
 *@ Copyright 2015, kugou.com
 *@ Project shop.kugou
 *@ Creator: WRG
 *@ update by: blairwu 2015/07/01-28
 *@ Modify: 2015/04/07|16:26:37
 *@ CreateTime: 2015年2月1日17:14:57
 ***********************************/

/**
 * 全局配置
 */
var Config = {

	// 域
	domain: 'http://www.kugou.com/shop',

	// 文案提示
	notice : {
		tel : '请输入手机号码',
		telFormat : '请输入可用的手机号码',
		consignee : '请输入收货人',

		district : '请选择所在区',
		city : '请选择所在城市',
		province : '请选择所在省份/直辖区',
		address : '请填写详细地址',
		
		problemDesc : '问题描述不能为空',
		afsType : '请选择售后服务类型'
	},

	// 图片尺寸
	img: {
		_100:'_100x100.jpg',
		uc: '_100x100.jpg' // 个人中心图片尺寸
	},

	gloabalId:"",

	// 订单状态
	orderStatus: {
		_1: '待付款',
		_2: '已取消',
		_3: '已付款',
		_4: '配货中',
		_5: '配货中',
		_6: '配货中',
		_7: '已发货',
		_8: '异常终止',
		_9: '交易完成',
		_10: '退款审核中',
		_11: '已退款'
	}
}

/**
 * 初始化console,容错
 */
var console = window.console || {log:function(txt){}};	

/**
 * 产品购买页
 */
var productFun = window.productFun || {
		initEvent: function() {
			var that = this;
			/*输入设置*/
			Kg.$("#productNum").addEvent("keyup", function() {
				var _this = Kg.$(this),
					thisValue = _this.val();
				if(thisValue != ""){
						thisValue = parseInt(thisValue) || 1; //输入不是数字默认为1
						thisValue = thisValue < 0 ? 1 : thisValue; //输入负数默认为1
				}
				// 根据库存显示错误信息
				//debugger
				var proskuid = tempGlobalParam.skuId ;
				publicFun.getProskuStock(proskuid,thisValue,".p_num")

				var maxValue = 100;//默认最大购买量

				if(thisValue>maxValue){
					_this.val(maxValue);
				}else{
					_this.val(thisValue);
				}

			})
			/*切换色块*/
			Kg.$(".p_c_b").addEvent("click", function() {
				var _this = Kg.$(this);
				Kg.$(".p_c_b").removeClass("active");
				_this.addClass("active");
				tempGlobalParam.productColor = _this.attr("data-value");
				that.changeProductModel(tempGlobalParam.productColor);
			})
			/*切换型号*/
			Kg.$(".p_m_s").addEvent("click", function() {
				var _this = Kg.$(this);
				if (!_this.hasClass("disabled")) {
					Kg.$(".p_m_s").removeClass("active");
					_this.addClass("active");
					tempGlobalParam.productType = _this.attr("data-value");
					that.changeProductPrice(tempGlobalParam.productType);
				}
			})
			/*参数/详细信息/包装清单 切换*/
			Kg.$(".p_t_nav li").addEvent("click", function() {
				var _this = Kg.$(this);
				var _thisIndex = _this.index();
				var contTabs = Kg.$(".p_t_cont_part ");
				Kg.$(".p_t_nav li").removeClass("active");
				contTabs.hide();
				_this.addClass("active");
				contTabs.eq(_thisIndex).show();
			})
			/*立即购买*/
			Kg.$("#buyNow")[0].onclick = function() {

				var skuStock;

				for (var i = 0; i < productParam.sku.length; i++) {

					if (tempGlobalParam.skuId == productParam.sku[i].skuId) {
						skuStock = parseInt(productParam.sku[i].skuStock);
					}

				}

				if (!skuStock) {
					alert('该货物分类暂时没有库存，请选择其它类型');
					return;
				}

				that.buyProduct(tempGlobalParam.skuId, true);
				return false;
			}
			/*加入购物车*/
			Kg.$("#addShopCart").addEvent("click", function() {

				var skuStock,
					_this= Kg.$(this);

				for (var i = 0; i < productParam.sku.length; i++) {

					if (tempGlobalParam.skuId == productParam.sku[i].skuId) {
						skuStock = parseInt(productParam.sku[i].skuStock);
					}

				}

				if (!skuStock) {
					alert('该货物分类暂时没有库存，请选择其它类型');
					return;
				}

				if(_this.attr('busy') && parseInt(_this.attr('busy'))){
					return;
				}else{
					_this.attr('busy',1);
				}
				var productNum = Kg.$("#productNum") //产品详情数量输入框

				if(Kg.UA.Ie6 || Kg.UA.Ie7 || Kg.UA.Ie8){
					if(productNum.val()==""){
						productNum.val(1)
					}
					that.buyProduct(tempGlobalParam.skuId, false);
					//成功后重新获取购物车信息
					publicFun.getCartInfo();

					Kg.$("#addShopCart").attr('busy',0);
					if(Kg.UA.Ie6){
						location.reload();
					}
				}else{
					// Kg.$('#p_add_cart_img').show();
					if(productNum.val()==""){
						productNum.val(1)
					}
					that.buyProduct(tempGlobalParam.skuId, false);

					Kg.$("#addShopCart").attr('busy',0);
					
					//成功后重新获取购物车信息
					publicFun.getCartInfo();
					/*$('#p_add_cart_img').paracurve({
						end:[240,-600],
						step:1.5,
						movecb:function(){
						},
						moveendcb:function(){
							//子弹复位
							$(this).css({
								top:'-225px',
								left:'50px'
							}).hide();
						}
					});*/


				}

			});
			/*第一项属性的第一个默认被选中*/
			Kg.$(".p_c_b").eq(0)[0].click();
			/*绑定改变数量事件*/
			Kg.$(".changeNumBar").addEvent("mouseover", function() {
				publicFun.productNumCountInit(this);
			})


		},
		changeProductModel: function(color_param) {
			/* 动态切换商品信息 */
			var productParam_1 = Kg.$("#productModel"),
				modelParam = productParam.model,
				mapArr = productParam['map'][color_param],
				flag = 0,
				modeOptionHtml = "",
				nowPriceDom = null,
				beforePriceDom = null
			modelArray = [];
			tempGlobalParam.proParam_1 = color_param;
			Kg.$(".p_m_s").addClass("disabled");
			Kg.$(".p_m_s").removeClass("active");
			for (var k in mapArr) {
				if (flag == 0) {
					Kg.$("#param_" + k).removeClass("disabled");
					Kg.$("#param_" + k)[0].click();
				} else {
					Kg.$("#param_" + k).removeClass("disabled");
				}
				flag++;
			}
		},
		changeProductPrice: function(model_param) {
			var productParam_2 = Kg.$("#productPrice")[0],
				nowPriceDom = productParam_2.getElementsByTagName('i')[0],
				beforePriceDom = productParam_2.getElementsByTagName('s')[0],
				skuArr = productParam.sku;
			tempGlobalParam.proParam_2 = model_param;
			tempGlobalParam.skuId = productParam['map'][tempGlobalParam.proParam_1][tempGlobalParam.proParam_2];
			for (var i = 0, l = skuArr.length; i < l; i++) {
				if (skuArr[i]['skuId'] == tempGlobalParam.skuId) {
					nowPriceDom.innerHTML = "&#65509;" + skuArr[i]['skuPrice'];
					beforePriceDom.innerHTML = "&#65509;" + skuArr[i]['skuScprice'];
					break;
				}
			}
		},
		buyProduct: function(skuId, type) {
			skuId = skuId || 15; //写死测试
			/*
			 @skuId:商品唯一ID
			 @type:true 为立即购买 false 为加入购物车
			 */
			var productNum = parseInt(Kg.$("#productNum").val()),
				p_info = {
					Skuid: skuId,
					Num: productNum
				};

			publicFun.updateCatInfo(p_info); //更新购物车cookie信息
			if (type) { //如果立即购买跳转至购物车页面
				window.location.href = domain + "shoppingCart/cartinfo";
			}
		}
	}

/*订单确认页*/
var orderConfirm = window.orderConfirm || {
		initEvent: function() {

			this.getProductList(); //拉取购物车列表
			/*送货时间选择*/
			Kg.$(".o_e_t_s").addEvent("click", function() {
				var _this = Kg.$(this);
				Kg.$(".o_e_t_s").removeClass("active");
				_this.addClass("active");
			})
			/*订单信息表单事件绑定*/
			var orderForm = Kg.$("#orderExpressInfoForm"),
				thisForm = orderForm[0];
			/*绑定focus事件*/

			Kg.$("#companyName").addEvent("focus", function() {
				var thisValue = this.value;
				if (thisValue == "填写发票抬头") {
					this.value = "";
				}
			}).addEvent("blur", function() {
				var thisValue = this.value;
				if (thisValue == "") {
					this.value = "填写发票抬头";
				}
			})

			/*选择发票信息*/
			var receipt_type = 0, //发票类型 默认为普通发票
				receipt_title_type = 1, //发票title类型
				receipt_title = "", //发票title
				KgcompanyName = Kg.$("#companyName")

			KgcompanyName.hide();

			Kg.$("#receipt_1").addEvent("click", function() {
				receipt_type = 2;
				receipt_title_type = 1;
				KgcompanyName.hide();
				
			});

			Kg.$("#recTye_2").addEvent("click", function() {
				receipt_type = 2;
				receipt_title_type = 2; 
				KgcompanyName.show();
				
			});

			Kg.$("#needReceipt").addEvent("click", function() {
				var _this = this;
				
				if(_this.checked ){
					
					Kg.$(".hideEle").show();
					receipt_type =Kg.$("#recType").val(); //发票类型 默认为普通发票

				}else{
					receipt_type = 0;
					Kg.$(".hideEle").hide();

				}
				
				
			});

			//解决ie6 收货地址 鼠标放上去显示 其他操作按钮
			if(Kg.UA.Ie6||Kg.UA.Ie7){
				var address_li = Kg.$(".address_wrap .address_li");
				address_li.addEvent("mouseover", function() {
					
					Kg.$(this).find("a").css("visibility","visible")

				}).addEvent("mouseout", function() {

					Kg.$(this).find("a").css("visibility","hidden")
				})

			}
			
			// window.onscroll = function() {
			// 	var thisTop = document.documentElement.scrollTop || document.body.scrollTop;
			// 	if (thisTop > 0) {
			// 		var add_str = "",
			// 			phone_name_str = "",
			// 			add_str_dom = Kg.$("#addStr"),
			// 			phone_str_dom = Kg.$("#phoneNameStr");
			// 		add_str = (tempGlobalParam.provinceName || "") + (tempGlobalParam.cityName || "") + (tempGlobalParam.townName || "") + thisForm.address.value;
			// 		phone_name_str = thisForm.receiver.value + thisForm.telphone.value;
			// 		add_str_dom.html(add_str);
			// 		phone_str_dom.html(phone_name_str);

			// 	}
			// }

			Kg.$("#submitOrder")[0].onclick = function() {

				if(!Kg.$('.is_default')[0]){
					alert("请新增收货地址信息");
					return;
				}

				if (!publicFun.checkLogin()) {
					UsLogin(publicFun.checkLogin);
					return;
				}
				var that = Kg.$('.is_default .address_head'),
					sel_options = Kg.$("#orderExpressInfoForm .active"),
					receiver = that.attr('consignee'), //收货人
					telphone = that.attr('tel'), //电话
					address = that.attr('address'), //地址
					area_name_1 = that.attr('province_name') || "", //省名称
					area_name_2 = that.attr('city_name') || "", //市名称
					area_name_3 = that.attr('district_name') || "", //区名称
					area_code_1 = that.attr('province'), //省码
					area_code_2 = that.attr('city'), //市码
					area_code_3 = that.attr('district'), //区码
					express_time = sel_options[0].getAttribute("data-value");//配送时间

					//此处用来解决 之前获取是否为发表title 类型不准确而写 
					var receiptinput =document.getElementById("receiptTitle").getElementsByTagName("input");
					for(var i= 0,len=receiptinput.length;i<len;i++){
						if(receiptinput[i].checked == true){
							receipt_title_type =  receiptinput[i].value;
						}

					}
					if (Kg.$('#recType')[0].checked && Kg.$('#needReceipt')[0].checked && receipt_title_type == "2") { //如果为公司
						receipt_title = Kg.$("#companyName").val(); //发票title为填写的title
						if (receipt_title == "" || receipt_title == "填写发票抬头") {
							alert("请填写所要开具的发票抬头!");
							return;
						}
					} else { //如果为个人
						receipt_title = receiver.trim() || thisForm.companyName.value.trim(); //发票title为收货人或者填写的title
					}


				var json = {
					delivery_time: express_time, //配送方式id
					Invoice_info: receipt_type + "|" + receipt_title_type + "|" + receipt_title //发票信息
				};
				Kg.postJSON(
					domain + "order/insert",
					json,
					function(res) {
						if (res.status) {
							publicFun.resetCart();
							window.location.href = domain + "order/getOrderSuccedDetail?order_no=" + res.order_no;
						} else {
							if (res.msg) {
								//alert("错误代码：" + res.err_code + "\r\n错误信息：" + res.msg);
								alert( res.msg);
								return;
							}
						}
					}
				)
				return false;
			}

			// add by guoshengze
			// 初始化省
			getProvince(apply_address.data.province);
			// 更多地址

			Kg.$('#moreAddress').addEvent('click',function(){
				Kg.$('.address_li').show();
				Kg.$(this).hide();
			});
			// 设置为默认地址
			Kg.$('.set_default,.address_head').addEvent('click',function(){
				var that = Kg.$(this),
					id = that.attr('address_id');

				Kg.postJSON(
					'http://www.kugou.com/shop/user/setDefaultAddress',
					'addressId=' + id,
					function(res){
						if(res.status == 1){

							Kg.$('.set_default').html('设为默认地址');
							// that.html('这是默认地址');
							Kg.$('.is_default').removeClass('is_default');
							that.parent().addClass('is_default');
							that.find('.set_default').html('默认地址');
						}else{
							alert("设置失败");
						}
					}
				);
			});
			// 删除地址
			Kg.$('.del_address').addEvent('click',function(){

				if(!confirm("确定要删除此地址吗？")){
					return;
				}

				var that = Kg.$(this),
					id = that.attr('address_id');
				Kg.postJSON(
					'http://www.kugou.com/shop/user/delCommonAddress',
					'addressId=' + id,
					function(res){
						if(res.status == 1){
							alert("删除成功");
							that.parent().remove();
						}else{
							alert("删除失败");
						}
					}
				);
			});
			// 增加地址
			Kg.$('#addAddress').addEvent('click',function(){
				Kg.$('#saveBtn').attr('type',1);
				Kg.$('#editPop h3').html('添加收货地址');
				Kg.$('#consignee').val('');
				Kg.$('#tel').val('');
				Kg.$('#address').val('');
				Kg.$('#editPop').show();
			});
			// 关闭弹层
			Kg.$('#closeBtn,#cancelBtn').addEvent('click',function(){
				Kg.$('#editPop').hide();
			});
			// 编辑地址
			Kg.$('.address_edit').addEvent('click',function(){
				Kg.$('#saveBtn').attr('type',2);
				Kg.$('#editPop h3').html('编辑收货地址');
				var that = Kg.$(this);
				globalParam.editData = {
					addressId : that.attr('address_id'),
					consignee: that.attr('consignee'),
					tel: that.attr('tel'),
					province: that.attr('province'),
					city: that.attr('city'),
					district: that.attr('district'),
					address: that.attr('address')
				};

				Kg.$('#consignee').val(globalParam.editData.consignee);
				Kg.$('#tel').val(globalParam.editData.tel);
				Kg.$('#address').val(globalParam.editData.address);
				Kg.$('#addressArea').attr('data-v',globalParam.editData.province);
				Kg.$('#addressCity').attr('data-v',globalParam.editData.city);
				Kg.$('#addressTown').attr('data-v',globalParam.editData.district);

				getCity(apply_address.getCityData(globalParam.editData.province));
				getTown(apply_address.getTownData(globalParam.editData.district));

				resetPlace(Kg.$('#addressArea'));
				resetPlace(Kg.$('#addressCity')); 
				resetPlace(Kg.$('#addressTown'));

				Kg.$('#editPop').show();
			});
			// 保存提交
			Kg.$('#saveBtn').addEvent('click',function(){
				var params = {},reqUrl;

				params.consignee = Kg.$('#consignee').val().trim();
				params.tel = Kg.$('#tel').val().trim();
				params.province = parseInt(Kg.$('#addressArea').val());
				params.city = Kg.$('#addressCity').val();
				params.district = Kg.$('#addressTown').val();
				params.address = Kg.$('#address').val().trim();

				var re = /^1\d{10}$/;//电话正则
				var reName = /^[A-Za-z0-9\u4e00-\u9fa5_]+$/;//姓名正则

				if(!params.consignee){
					alert(Config.notice.consignee);
					return;
				}else if(!reName.test(params.consignee)){

					alert("收货人姓名格式不对");
					return;
				}else if( params.consignee.length>=20){
					alert("收货人姓名长度过长");
					return;
				}

				if(!params.tel){


					alert(Config.notice.tel);
					return;
				}else if(!re.test(params.tel)){
					alert(Config.notice.telFormat);
					return;
				}

				if(!params.province){
					alert(Config.notice.province);
					return;
				}

				// 港澳台为空
				if(params.city !== '' && !parseInt(params.city)){
					alert(Config.notice.city);
					return;
				}

				// 港澳台为空
				if(params.district !== '' && !parseInt(params.district)){
					alert(Config.notice.district);
					return;
				}

				if(!params.address){
					alert(Config.notice.address);
					return;
				}

				if(Kg.$('#saveBtn').attr('type') == 1){
					reqUrl = 'http://www.kugou.com/shop/user/addCommonAddress';
				}else{
					reqUrl = 'http://www.kugou.com/shop/user/editCommonAddress';
					params.addressId = globalParam.editData.addressId;
				}
				var tempString="";
				for( i in params){
					tempString+= (i+"="+params[i]+"&")
				}
				params = tempString.substring(0,tempString.length-1).toString()
				Kg.postJSON(
					reqUrl,
					params,
					function(res){

						if(res.status == 1){
							alert("保存成功");
							Kg.$('#editPop').hide();
							location.reload();
						}else{
							alert("保存失败：" + res.info);
						}
					}
				);

			});
		},
		getProductList: function() {
			var orderInfoTable = Kg.$("#orderInfoTable");
			orderInfoTable.html("<p class='notice'>订单商品信息加载中...</p>")

			Kg.postJSON(
				domain + "shoppingCart/getCartInfo", {
					t: new Date().getTime()
				},
				function(res) {

					if (res.status) {
						var cartData = res.data.Goods,
							cart_table = "",
							product_num = 0, //商品总数
							payfor_sum = 0, //支付总额
							minus_sum = 0, //优惠总额
							order_freight = 0,
							img_src,
							img_str; //订单运费
						if (cartData.length > 0) { //购物车不为空
							cart_table += [ //生成表头
								'<table border="0" cellspacing="0" cellpadding="0">',
								'<thead>',
								'<tr>',
								'<th class="p_name" width="600">商品名称</th>',
								'<th width="167">单品价格</th>',
								'<th width="179">购买数量</th>',
								'<th width="111">小计</th>',
								'</tr>',
								'</thead>',
								'<tbody>'
							].join("");
							for (var i = 0, l = cartData.length; i < l; i++) { //生成行数据
								img_src = '';
								img_str = cartData[i]['product_img'].split('|')[0];

								if (img_str.match('.com')) {
									img_src = img_str;
								} else {
									img_src = 'http://imge.kugou.com/v2/shop_product/' + img_str;
								}

								cart_table += [
									'<tr class="' + (i == 0 ? 't_f' : null) + '">',
									'<td class="p_name">',
									'<img src="' + img_src + '" alt="" width="78" height="78">',
									'<p>' + cartData[i]['name']+"&nbsp;&nbsp;&nbsp;&nbsp;"+cartData[i]['option_value'] + '</p>',
									'</td>',
									'<td>' + cartData[i]['Price'] + '元</td>',
									'<td>' + cartData[i]['Num'] + '</td>',
									'<td class="p_subsum">' + cartData[i]['SubTotal'].toFixed(2) + '元</td>',
									'</tr>'
								].join("");
								product_num += parseInt(cartData[i]['Num']); //累加商品数量
								payfor_sum += cartData[i]['SubTotal']; //累加小计
								payfor_summ=payfor_sum;//合计金额
								
							}
							cart_table += "</tbody></table>";
						} else {
							orderInfoTable.html("<p class='notice'>订单中没有商品...</p>");
							return;
						}
						orderInfoTable.html(cart_table);
						
						//根据总花费，设置是否要运费
						if(res.data.postage == 1){
							order_freight = 0;
								
		                 }else {
		                 	 Kg.Ajax({
			                    method:"get",
			                    docType:"jsonp",
			                    url: domain + "user/getvip",
			                    callback:function(res){
			                        if(res.is_vip != 0 && res.is_vip!= undefined){

			                             order_freight = 0;
			                            
			                        }else{

			                          if(payfor_sum < 100){
											//运费等于5
											order_freight = 5;
											//总应付加运费5
											payfor_sum = payfor_sum+5;
										}else{
											order_freight = 0;
										}
			                        }
			                        Kg.$("#orderProductFreight").html(order_freight.toFixed(2) + "元");
			                        Kg.$("#orderProductPaySumNow").html((payfor_sum - minus_sum).toFixed(2) + "元");
			                    }
			                });
		                 }
		               
						Kg.$("#orderProductNum").html(product_num + "件");
						Kg.$("#orderProductPaySum").html(payfor_summ.toFixed(2) + "元");
						Kg.$("#orderProductMinus").html(minus_sum.toFixed(2) + "元");
						Kg.$("#orderProductFreight").html(order_freight.toFixed(2) + "元");
						Kg.$("#orderProductPaySumNow").html((payfor_sum - minus_sum).toFixed(2) + "元");
					}
				})
		}
	}
/*订单支付页*/
var orderPay = window.orderPay || {
		initEvent: function() {
			/*绑定选择银行*/
			Kg.$(".o_p_b_ico").addEvent("click", function() {
				var parent = this.parentNode;
				parent.getElementsByTagName('i')[0].click();
			})
			/*立即支付*/
			Kg.$("#payForThis").addEvent("click", function() {
				var payType = 1,
					bankCode = null,
					sel_options = Kg.$("#bankList .active");
				if (sel_options.length > 0) {
					var thisValue = sel_options[0].parentNode.getAttribute("data-value");
					switch (thisValue) {
						case "1":
							payType = 1;
							bankCode = null;
							break;
						case "2":
							payType = 2;
							bankCode = null;
							break;
						default:
							payType = 3;
							bankCode = thisValue;
							break;
					}
					Kg.postJSON(
						domain + "pay/request", {
							orderNo: tempGlobalParam.order_no,
							payType: payType,
							bankCode: bankCode
						},
						function(res) {
							if (res.status) {
								var hideDom = Kg.$(".hide");
								hideDom.html(res.info);
								document.forms['kupaysubmit'].submit();
							} else {
								alert(res.info);
							}
						}
					)
				}
			})
		}
	}
/*产品预约页*/
var orderFun = window.orderFun || {
		initEvent: function() {
			/* 分享事件绑定 */
			var shareBtn = Kg.$(".share_ico a");
			shareBtn.addEvent("click", function() {
				var shareType = Kg.$(this).attr("data-type");
				actShareTo(shareType);
			})

			/* 立即预约事件绑定 */
			var orderToWifi = Kg.$("#orderToWifi");
			orderToWifi.addEvent("click", function() {
				var userId = Kg.Cookie.read("KuGoo", "KugooID");
				if (userId) { //如果已经登录
					Kg.postJSON(
						domain + "/book/operate", {
							bookId: globalParam.bookId,
							opType: "book",
							params: null
						},
						function(res) {
							if (res.status) { //预约成功
								publicFun.pop("y_y_success");
								return;
							} else {
								var code = res.code;
								switch (code) {
									case 1001: //已经预约过
										publicFun.pop("y_y_before");
										break;
									default:
										alert("错误：" + res.code + "/r/n" + res.info);
										break;
								}
							}
						}
					)
				} else {
					UsLogin();
					return;
				}
			})

			/* 预约弹窗中的微信分享 */
			var pop_wx_btn = Kg.$(".pop_wx_btn");
			pop_wx_btn.addEvent("mouseover", function() {
				var parents = this.parentNode.parentNode.parentNode;
				var pop_wx_share_code = parents.getElementsByTagName('img')[0];
				pop_wx_share_code.style.display = "block";
			}).addEvent("mouseout", function() {
				var parents = this.parentNode.parentNode.parentNode;
				var pop_wx_share_code = parents.getElementsByTagName('img')[0];
				pop_wx_share_code.style.display = "none";
			})
		}
	}
/*
 * 分享专题
 * @param {String} 分享的平台
 */
function actShareTo(plat) {
	var option = {
			/*新开窗口宽度*/
			popupWidth: 615,

			/*新开窗口高度*/
			popupHeight: 505,

			/*分享标题*/
			title: globalParam.shareTitle,

			/*分享链接*/
			url: globalParam.shareUrl,

			/*分享内容*/
			content: globalParam.shareContent,

			/*分享图片地址*/
			imgSrc: globalParam.shareImg,

			/*分享视频swf地址*/
			swf: "",

			/*(腾讯微博,网易微博) 用参数，您的网站地址(可选)*/
			site: "",

			/*(新浪微博,腾讯微博) 用参数，您申请的应用appkey,显示分享来源(可选)*/
			appkey: "",

			/*(139微博，网易微博) 用参数，分享来源*/
			source: "",

			/*(新浪微博) 用参数,关联用户的UID，分享微博会@该用户(可选)*/
			ralateUid: ""
		},
		winSrc = "",
		queryStr = "",
		showPopup = true;


	var _title = encodeURIComponent(globalParam.shareTitle),
		_url = globalParam.shareUrl,
		_content = encodeURIComponent(globalParam.shareContent),
		_imgSrc = encodeURIComponent(globalParam.shareImg);
	_swf = encodeURIComponent(globalParam.shareSwf || "");
	switch (plat) {
		case "qzone":
			winSrc = "http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey";
			queryStr = [
				"url=" + _url,
				"title=" + _title,
				"desc=" + _content,
				"pics=" + _imgSrc
			].join("&");

			break;

		case "rr":
			option.popupHeight = 560;
			winSrc = "http://widget.renren.com/dialog/share";
			queryStr = [
				"link=" + _url,
				"title=" + _title,
				"image_src=" + _imgSrc,
				"description=" + _content
			].join("&");

			break;


		case 'sina':
			option.popupWidth = 615;
			option.popupHeight = 505;
			winSrc = "http://service.t.sina.com.cn/share/share.php";
			queryStr = [
				"url=" + _url,
				"appkey=" + option.appkey,
				"title=" + _content,
				"pic=" + _imgSrc,
				"ralateUid=" + option.ralateUid
			].join("&");

			break;

		case 'qq':
			option.popupWidth = 700;
			option.popupHeight = 680;
			var _appkey = encodeURIComponent(option.appkey); //你从腾讯获得的appkey
			var _pic = _imgSrc; //（例如：var _pic='图片url1|图片url2|图片url3....）
			winSrc = "http://v.t.qq.com/share/share.php";
			queryStr = [
				"title=" + _content,
				"url=" + _url,
				"appkey=" + _appkey,
				"site=" + option.site,
				"pic=" + _pic
			].join("&");
			break;

		case 'qq_client':
			option.popupWidth = 765;
			option.popupHeight = 620;
			winSrc = "http://connect.qq.com/widget/shareqq/index.html";
			queryStr = [
				"title=" + _title,
				"desc=" + _content,
				"url=" + _url,
				"site=" + option.site,
				"pics=" + _pic,
				"flash=" + _swf,
				"summary=" + encodeURIComponent('听音乐，找酷狗')
			].join("&");
			break;
		case 'wx_p':
			/*弹窗出二维码*/
			publicFun.pop("y_y_wx_code");
			showPopup = false;
			break;
		default:
			return;

	};
	if (showPopup) {
		var l = (screen.width - option.popupWidth) / 2,
			t = (screen.height - option.popupHeight) / 2,
			resultUrl = winSrc + "?" + queryStr;
		if (!window.open(resultUrl, "_blank", "width=" + option.popupWidth + ",height=" + option.popupHeight + ",left=" + l + ",top=" + t)) {
			location.href = resultUrl;
		};
	}
}

/*	*地区联动通用方法*
 param:{
 带*的为必要参数
 *ID1(string)省级DOM的ID
 *ID2(string)市级DOM的ID
 *ID3(string)区级DOM的ID
 tagName(string):
 最终创建的标签名称 例如 最终插入在select标签里那么tagName应该为option 默认为option
 other_tag | option
 如果不是 option 此为必填：
 disValId1(string) 显示省级结果的DOM
 disValId2(string) 显示市级结果的DOM
 disValId3(string) 显示区级结果的DOM

 def(bool):是否提示选择
 defStr(string):第一个选项的内容 例如 defStr 的值为 “请选择”
 tagParam(object):当tagName不是option时生效可传为标签加param的属性
 {
 key:value,
 key1:value1
 }
 selFist(bool):是否初始化时默认选择第一个
 data(object):{
 province:{},
 city:{},
 town:{}
 }存储三级数据可用getProvinceData|getCityData|getTownData 获取对应的数据
 }
 */
function selectAddress(param) {
	this.ID1 = param.ID1 || '';
	this.ID2 = param.ID2 || '';
	this.ID3 = param.ID3 || '';
	this.tagParam = param.tagParam || "";
	this.tagName = param.tagName || 'option';
	this.def = param.def || false;
	this.defStr = param.defStr || "请选择";
	this.firstOpt = "";
	this.data = {
		province: {},
		city: {},
		town: {}
	};
	var _this = this;
	if (_this.tagName !== "option") {
		/*判断是否为模拟下拉框*/
		this.disValId1 = param.disValId1 || ""; //显示省级结果的DOM
		this.disValId2 = param.disValId2 || ""; //显示市级结果的DOM
		this.disValId3 = param.disValId3 || ""; //显示区级结果的DOM
	}
	this.createElement = function(tagParam) {
		/*
		 *创建标签
		 *tagName[string](必选)标签名称
		 *tagParam[object](可选)key:value对象，例如{value:value1,data-value:value2,....}
		 */
		var obj = document.createElement(_this.tagName);
		var tagParam = tagParam || _this.tagParam;
		if (tagParam && typeof(tagParam) == "object") {
			for (var k in _this.tagParam) {
				obj.setAttribute(k, _this.tagParam[k]);
			}
		}
		return obj;
	};
	this.byId = function(id) {
		return document.getElementById(id);
	};
	this.init = function(key) {
		/*初始化省选择项*/
		var provinceDom = _this.byId(_this.ID1);
		provinceDom.innerHTML = ""; //清空所有子元素
		for (var i = 0, l = allProvince.length; i < l; i++) {
			var option = _this.createElement();
			option.setAttribute("data-value", allProvince[i]);
			option.innerHTML = areaDic[allProvince[i]];
			option.onclick = function() {
				var thisKey = this.getAttribute("data-value");
				_this.writeCity(thisKey); //改变市级选择项
				tempGlobalParam.provinceValue = thisKey; //重置已选择数据
				tempGlobalParam.cityValue = null; //重置已选择 市级 数据
				tempGlobalParam.townValue = null; //重置已选择 区级 数据
				tempGlobalParam.provinceName = this.innerHTML; //重置已选择数据
				tempGlobalParam.cityName = null; //重置已选择 市级 数据
				tempGlobalParam.townName = null; //重置已选择 区级 数据
				this.parentNode.style.display = "none"; //选择完隐藏选项
				_this.byId(_this.ID3).innerHTML = ""; //清空 区级 选项内容
				if (_this.tagName !== "option") {
					_this.byId(_this.disValId1).innerHTML = this.innerHTML; //显示已经选择的 省级名称 
					_this.byId(_this.disValId2).innerHTML = "城市"; //还原 市级 选择项
					_this.byId(_this.disValId3).innerHTML = "区/县"; //还原 区级 选择项
				}
			}
			provinceDom.appendChild(option);
			if (key) { //如果指定了id			
				if (key == allProvince[i]) {
					option.click();
				}
			} else if (_this.selFist) {
				if (i === 0) {
					option.click()
				}
			}
		};
		if (_this.tagName !== "option") {
			_this.byId(_this.disValId1).onclick = function() {
				_this.byId(_this.ID1).style.display = "block";
				_this.byId(_this.ID2).style.display = "none";
				_this.byId(_this.ID3).style.display = "none";
			};
			_this.byId(_this.disValId2).onclick = function() {
				_this.byId(_this.ID1).style.display = "none";
				_this.byId(_this.ID2).style.display = "block";
				_this.byId(_this.ID3).style.display = "none";
			};
			_this.byId(_this.disValId3).onclick = function() {
				_this.byId(_this.ID1).style.display = "none";
				_this.byId(_this.ID2).style.display = "none";
				_this.byId(_this.ID3).style.display = "block";
			};
		}
		document.onclick = function(e) {
			e = e || window.event;
			var thisTag = e.target || e.srcElement,
				tagType = thisTag.nodeType,
				flag = true;
			while (thisTag) {
				if (!thisTag || thisTag == this) {
					break;
				}
				if (thisTag.nodeType == 1 && thisTag.className.match(/o_e_a_s_nav/gi)) {
					flag = false;
					break;
				} else {
					//向上查找
					thisTag = thisTag.parentNode;
				}
			}
			if (flag) {
				_this.byId(_this.ID1).style.display = "none";
				_this.byId(_this.ID2).style.display = "none";
				_this.byId(_this.ID3).style.display = "none";
			}
		};
	};
	this.writeCity = function(key) {

		/*初始化市选择项*/
		_this.getCityData(key); //获取数据
		var cityDom = _this.byId(_this.ID2);
		var cityData = _this.data.city;
		var state = 0;
		cityDom.innerHTML = ""; //清空所有子元素
		for (var k in cityData) {
			if (cityData[k]) {
				var option = _this.createElement();
				option.setAttribute("data-value", k);
				option.innerHTML = cityData[k];
				option.onclick = function() {
					var thisKey = this.getAttribute('data-value');
					_this.writeTown(thisKey);
					tempGlobalParam.cityValue = thisKey;
					tempGlobalParam.townValue = null;
					tempGlobalParam.cityName = this.innerHTML;
					tempGlobalParam.townName = null;
					this.parentNode.style.display = "none";
					if (_this.tagName !== "option") {
						_this.byId(_this.disValId2).innerHTML = this.innerHTML; //显示已经选择的 省级名称 
						_this.byId(_this.disValId3).innerHTML = "区/县"; //还原 市级 选择项
					}
				}
				cityDom.appendChild(option);
				if (key) { //如果指定了id			
					if (key == k) {
						option.click();
					}
				} else if (_this.selFist) { //指定选择第一个
					if (state === 0) {
						option.click()
					}
				}
			}
			state++;
		}
	};
	this.writeTown = function(key) {
		/*初始化区选择项*/
		_this.getTownData(key); //获取数据
		var townDom = _this.byId(_this.ID3);
		var townKey = 1;
		var townData = _this.data.town;
		var state = 0;
		townDom.innerHTML = ""; //清空所有子元素
		for (var k in townData) {
			if (townData[k]) {
				var option = _this.createElement();
				option.setAttribute("data-value", k);
				option.innerHTML = townData[k];
				option.onclick = function() {
					tempGlobalParam.townValue = this.getAttribute("data-value");
					tempGlobalParam.townName = this.innerHTML;
					this.parentNode.style.display = "none";
					if (_this.tagName !== "option") {
						_this.byId(_this.disValId3).innerHTML = this.innerHTML; //显示已经选择的 省级名称 
					}
				}
				townDom.appendChild(option);
				if (key) { //如果指定了id			
					if (key == k) {
						option.click();
					}
				} else if (_this.selFist) { //指定选择第一个
					if (state === 0) {
						option.click()
					}
				}
			}
			state++;
		}
	};
	this.getProvinceData = function() {
		/*获取省数据*/
		_this.data.province = {};
		if (_this.def) {
			_this.data['province'][0] = _this.defStr;
		}
		for (var i = 0, l = allProvince.length; i < l; i++) {
			_this.data['province']["'" + allProvince[i] + "'"] = areaDic[allProvince[i]];
		}
		return _this.data.province;
	}
	this.getCityData = function(key) {
		/*获取城市数据*/
		_this.data['city'] = {};
		key = key || '86110100';
		var provKey = parseInt(key.substr(0, 4)); //生成前4位
		var cityKey = 1;
		if (_this.def) {
			_this.data['city'][0] = _this.defStr;
		}
		for (var i = 0; i < 99; i++) {
			var fullKey = '';
			if (cityKey < 10) {
				fullKey = provKey * 10;
			} else {
				fullKey = provKey;
			}
			fullKey = parseInt(fullKey + cityKey.toFixed(0)); //后面统一加零填充到8位
			fullKey = fullKey + "00";
			if (areaDic[fullKey]) {
				_this.data['city'][fullKey] = areaDic[fullKey];
			}
			cityKey++;
		}
		return _this.data.city;
	}
	this.getTownData = function(key) {
		/*获取区数据*/
		_this.data['town'] = {};
		key = key || '86110101';
		var provKey = parseInt(key.substr(0, 6)); //生成前4位
		var townKey = 1;
		if (_this.def) {
			_this.data['town'][0] = _this.defStr;
		}
		for (var i = 0; i < 99; i++) {
			var fullKey = '';
			if (townKey < 10) {
				fullKey = provKey * 10;
			} else {
				fullKey = provKey;
			}
			fullKey = fullKey + townKey.toFixed(0); //后面统一加零填充到8位
			if (areaDic[fullKey]) {
				_this.data['town'][fullKey] = areaDic[fullKey];
			}
			townKey++;
		}
		return _this.data.town;
	}
}

// 初始化省
function getProvince(p){
	var op;
	document.getElementById('addressArea').innerHTML = '';

	for(var i in p){
		op = document.createElement('option');
		op.value = i.replace(/\'/g,"");
		op.innerHTML = p[i];
		document.getElementById('addressArea').appendChild(op);
	}

	document.getElementById('addressArea').onchange = function(){
		var v = document.getElementById('addressArea').value;
		if(v == '0'){
			return;
		}else{
			getCity(apply_address.getCityData(v));
		}
	};
}

// 初始化市
function getCity(p){

	var op;
	var $addressCity = Kg.$('#addressCity');
	var $addressTown = Kg.$('#addressTown');

	$addressCity[0].innerHTML = '';

	for(var i in p){
		op = document.createElement('option');
		op.value = i.replace(/\'/g,"");
		op.innerHTML = p[i];
		$addressCity[0].appendChild(op);
	}

	if($addressCity.find('option').length > 1){
		$addressCity.find('option').eq(1).attr('selected','selected');
		getTown(apply_address.getTownData($addressCity.find('option').eq(1).attr('value')));
	}else{
		// 若城市为空，则选择为空
		$addressCity[0].innerHTML = '';
		$addressTown[0].innerHTML = '';
	}

	$addressCity[0].onchange = function(){
		var v = $addressCity[0].value;

		if(v == '0'){
			return;
		}else{
			getTown(apply_address.getTownData(v));
		}
	};

}

// 初始化区
function getTown(p){


	var op;
	document.getElementById('addressTown').innerHTML = '';

	if(Kg.$('#addressCity option').length == 0){
		return false;
	}
	for(var i in p){
		op = document.createElement('option');
		op.value = i.replace(/\'/g,"");
		op.innerHTML = p[i];
		document.getElementById('addressTown').appendChild(op);
	}

	// resetPlace(Kg.$('#addressTown'));

}


// 恢复初始地址,传select Kg对象，遍历 option
function resetPlace(){

	if(arguments.length < 1){
		return;
	}

	for(var i = 0, len = arguments.length; i < len; i++){


		var that = Kg.$(arguments[i]),val = that.attr('data-v');

		that.find('option').each(function(i,v){

			if(Kg.$(v).attr('value') == val){

				Kg.$(v).attr('selected','selected');
				return;
			}

		});
	}

}