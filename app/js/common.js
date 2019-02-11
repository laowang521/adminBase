//api
var BASE_URL = "http://tp5.henanyimu.com/apis/";
var IMG_URL = "http://tp5.henanyimu.com/";
var APPID = 'benben';
var APPSECRET = 'longdada123456';

//工具方法 

var log = console.log.bind(console);

var S = JSON.stringify.bind(JSON);

var retel = /^1[345678]\d{9}$/;

//
function check_login() {
	var userId = localStorage.getItem("userId");
	if(!userId) {
		mui.openWindow({
			url: "/user/login.html",
			id: "/user/login.html",
			waiting: {
				autoShow: false, //自动显示等待框，默认为true
			}
		})
		return false;
	}
	return true;
}

mui.plusReady(function() {
	//全局点击事件
	$(".newact").on("tap", function(e) {

		e.stopPropagation();
		var url = $(this).attr("url");
		if(!url) {
			return;
		}
		var web = plus.webview.getWebviewById(url);
		if(web) {
			plus.webview.show(web, "fade-in", 300);
			return
		}
		mui.openWindow({
			url: url,
			id: url,
			waiting: {
				autoShow: false, //自动显示等待框，默认为true
			}
		})
	})

	//全局点击事件
	$(".newactlogin").on("tap", function(e) {

		if(!check_login()) {
			return;
		}
		e.stopPropagation();
		var url = $(this).attr("url");
		if(!url) {
			return;
		}
		var web = plus.webview.getWebviewById(url)
		if(web) {
			plus.webview.show(web, "fade-in", 300);
			return
		}
		mui.openWindow({
			url: url,
			id: url,
			waiting: {
				autoShow: false, //自动显示等待框，默认为true
			}
		})
	});
	//  document.addEventListener("netchange", wainshow, false);
});

function wainshow() {

	if(plus.networkinfo.getCurrentType() == plus.networkinfo.CONNECTION_NONE) {
		mui.toast("网络异常，请检查网络设置！");
		mui.openWindow({
			url: '/public/noNet.html',
			id: '/public/noNet.html',
			waiting: {
				autoShow: false, //自动显示等待框，默认为true
			}
		})

	} else {

	}

};

//UI增强
(function($, window) {
	//显示加载框
	$.showLoading = function(message, type) {
		if($.os.plus && type !== 'div') {
			$.plusReady(function() {
				plus.nativeUI.showWaiting(message);
			});
		} else {
			var html = '';
			html += '<i class="mui-spinner mui-spinner-white"></i>';
			html += '<p class="text">' + (message || "数据加载中") + '</p>';

			//遮罩层
			var mask = document.getElementsByClassName("mui-show-loading-mask");
			if(mask.length == 0) {
				mask = document.createElement('div');
				mask.classList.add("mui-show-loading-mask");
				document.body.appendChild(mask);
				mask.addEventListener("touchmove", function(e) {
					e.stopPropagation();
					e.preventDefault();
				});
			} else {
				mask[0].classList.remove("mui-show-loading-mask-hidden");
			}
			//加载框
			var toast = document.getElementsByClassName("mui-show-loading");
			if(toast.length == 0) {
				toast = document.createElement('div');
				toast.classList.add("mui-show-loading");
				toast.classList.add('loading-visible');
				document.body.appendChild(toast);
				toast.innerHTML = html;
				toast.addEventListener("touchmove", function(e) {
					e.stopPropagation();
					e.preventDefault();
				});
			} else {
				toast[0].innerHTML = html;
				toast[0].classList.add("loading-visible");
			}
		}
	};

	//隐藏加载框
	$.hideLoading = function(callback) {
		if($.os.plus) {
			$.plusReady(function() {
				plus.nativeUI.closeWaiting();
			});
		}
		var mask = document.getElementsByClassName("mui-show-loading-mask");
		var toast = document.getElementsByClassName("mui-show-loading");
		if(mask.length > 0) {
			mask[0].classList.add("mui-show-loading-mask-hidden");
		}
		if(toast.length > 0) {
			toast[0].classList.remove("loading-visible");
			callback && callback();
		}
	}
})(mui, window);

//模板字符串() =>  
String.prototype.render = function(context) {
	return this.replace(/{{(.*?)}}/g, function(match, key) {
		return context[key.trim()]
	});
};

//获取指定范围的随机数

function get_random(max, min) {

	return Math.floor(Math.random() * (max - min + 1) + min);
}

function canvasImg(img, param_wid, param_hei, angle) {

	//利用canvas对图片进行压缩
	var canvas = document.createElement('canvas');
	var ctx = canvas.getContext('2d');
	var w, h;

	//var getPixelRatio = function(context) {
	//var backingStore = context.backingStorePixelRatio ||
	//  context.webkitBackingStorePixelRatio ||
	//  context.mozBackingStorePixelRatio ||
	//  context.msBackingStorePixelRatio ||
	//  context.oBackingStorePixelRatio ||
	//  context.backingStorePixelRatio || 1;
	// return (window.devicePixelRatio || 1) / backingStore;
	//};
	//
	////调用
	//var ratio = getPixelRatio(ctx);

	var param_w = param_wid || 600;
	var param_h = param_hei || 400;

	var param_s = param_w / param_h;

	var r_h = 0,
		r_w = 0;
	var l = 0,
		t = 0;

	var anw = document.createAttribute("width");
	var anh = document.createAttribute("height");
	anw.value = param_w;
	anh.value = param_h;

	canvas.setAttributeNode(anw);
	canvas.setAttributeNode(anh);

	ctx.fillStyle = "#fff";
	ctx.fillRect(0, 0, param_w, param_h);

	if(angle) {

		if(angle == 6) {
			//需要顺时针（向左）90度旋转   ios  三星note5

			ctx.save(); //保存状态
			ctx.translate(param_w / 2, param_h / 2); //设置画布上的(0,0)位置，也就是旋转的中心点
			ctx.rotate(90 * Math.PI / 180); //把画布旋转90度

			h = img.videoWidth || img.width;
			w = img.videoHeight || img.height;

			var s = h / w;

			if(s > 1) {

				ctx.drawImage(img, 0 - param_h, 0 - param_w / 2, param_w * 2, param_h * 2);
			} else {

				ctx.drawImage(img, 0 - param_h / 2, 0 - param_w, param_w * 2, param_h * 2);
			}

			ctx.restore(); //恢复状态  
			return canvas.toDataURL('image/png', 1);

		}

	}

	w = img.videoWidth || img.width;
	h = img.videoHeight || img.height;

	var s = w / h;

	if(s > param_s) {

		//图片比设定画布宽
		r_h = h;
		r_w = h * param_s;
		l = (parseInt(w - r_w)) / 2;
		t = 0;

		ctx.drawImage(img, l, t, r_w, r_h, 0, 0, param_w, param_h);

		return canvas.toDataURL('image/png', 1);

	} else {
		//图片比设定画布高
		r_w = w;
		r_h = w / param_s;
		t = (parseInt(h - r_h)) / 2;
		l = 0;

		ctx.drawImage(img, l, t, r_w, r_h, 0, 0, param_w, param_h);
		return canvas.toDataURL('image/png', 1);
	}

}

function dataURLtoFile(dataurl, filename) { //将base64转换为文件
	var arr = dataurl.split(','),
		mime = arr[0].match(/:(.*?);/)[1],
		bstr = atob(arr[1]),
		n = bstr.length,
		u8arr = new Uint8Array(n);
	while(n--) {
		u8arr[n] = bstr.charCodeAt(n);
	}
	return new File([u8arr], filename, {
		type: mime
	});
}

//原图转回base64   @return base64

function img2file(src, can_w, can_h, callback) {
	var _caipu_img = new Image();

	_caipu_img.src = src;

	_caipu_img.onload = function() {
		var canvas = document.createElement('canvas');
		var ctx = canvas.getContext('2d');
		canvas.width = can_w;
		canvas.height = can_h;
		var w = _caipu_img.width;
		var h = _caipu_img.height;

		ctx.drawImage(_caipu_img, 0, 0, w, h);

		//异步操作 不回调可能会取到undefined

		if(callback && typeof callback == "function") {

			return callback(canvas.toDataURL("image/png", 1));

		}

	};

}

//  登录注册 沉浸式

var ben_immer = (function() {

	var immersed = 0;
	var ms = (/Html5Plus\/.+\s\(.*(Immersed\/(\d+\.?\d*).*)\)/gi).exec(navigator.userAgent);

	var set_immersed = function() {

		if(ms && ms.length >= 3) {
			immersed = parseFloat(ms[2]);
		}

		var login_head = document.getElementById('login_head');
		login_head.style.paddingTop = immersed + 'px';

		mui.plusReady(function() {        
			plus.navigator.setStatusBarStyle("UIStatusBarStyleBlackOpaque");

			 
			plus.navigator.setStatusBarStyle("dark");
		});

	}

	return {
		set_immersed: set_immersed
	}

})();

function  formatDateTime(inputTime)  {      
	var  date  =  new  Date(inputTime);    
	var  y  =  date.getFullYear();      
	var  m  =  date.getMonth()  +  1;      
	m  =  m  <  10  ?  ('0'  +  m)  :  m;      
	var  d  =  date.getDate();      
	d  =  d  <  10  ?  ('0'  +  d)  :  d;      
	var  h  =  date.getHours();    
	h  =  h  <  10  ?  ('0'  +  h)  :  h;    
	var  minute  =  date.getMinutes();    
	var  second  =  date.getSeconds();    
	minute  =  minute  <  10  ?  ('0'  +  minute)  :  minute;      
	second  =  second  <  10  ?  ('0'  +  second)  :  second;     

	var obj = {
		y: y,
		m: m,
		d: d,
		h: h,
		minute: minute,
		second: second
	}
	return  obj;

};

/**函数的去抖动**/
function debounce(func, wait, immediate) {

	var timeout, result;

	var debounced = function() {
		var context = this;
		var args = arguments;

		if(timeout) clearTimeout(timeout);
		if(immediate) {
			// 如果已经执行过，不再执行
			var callNow = !timeout;
			timeout = setTimeout(function() {
				timeout = null;
			}, wait)
			if(callNow) result = func.apply(context, args)
		} else {
			timeout = setTimeout(function() {
				func.apply(context, args)
			}, wait);
		}
		return result;
	};

	debounced.cancel = function() {
		clearTimeout(timeout);
		timeout = null;
	};

	return debounced;
}

/**
 * 用于把用utf16编码的字符转换成实体字符，以供后台存储
 * @param  {string} str 将要转换的字符串，其中含有utf16字符将被自动检出
 * @return {string}     转换后的字符串，utf16字符将被转换成&#xxxx;形式的实体字符
 */
function utf16toEntities(str) {
	var patt = /[\ud800-\udbff][\udc00-\udfff]/g; // 检测utf16字符正则
	str = str.replace(patt, function(char) {
		var H, L, code;
		if(char.length === 2) {
			H = char.charCodeAt(0); // 取出高位
			L = char.charCodeAt(1); // 取出低位
			code = (H - 0xD800) * 0x400 + 0x10000 + L - 0xDC00; // 转换算法
			return "&#" + code + ";";
		} else {
			return char;
		}
	});
	return str;
}

/**
 * 判断远程图片是否在本地缓存,如已缓存,直接调用本地,否则下载
 * @imgid  img对象dom (.class | #id)
 * @loadUrl 图片远程地址
 * @callback 回调函数
 * @type 1(默认),图片,2,背景图
 */
function setImg(imgid, loadUrl, callback, type) {
	mui.plusReady(function() {
		if(loadUrl == null) return;
		var filename = loadUrl.substring(loadUrl.lastIndexOf("/") + 1, loadUrl.length);
		var relativePath = "_downloads/" + filename;
		plus.io.resolveLocalFileSystemURL(relativePath, function(entry) {
			setImgFromLocal(imgid, relativePath, callback, type);
		}, function(e) {
			setImgFromNet(imgid, loadUrl, relativePath, callback, type);
		});

		function setImgFromLocal(imgid, relativePath, callback, type) {
			var sd_path = plus.io.convertLocalFileSystemURL(relativePath);
			var type = type || 1;
			if(type == 1) {
				$(imgid).attr('src', sd_path);
			} else {
				$(imgid).css('background', 'url(' + sd_path + ')  no-repeat center 0');
				$(imgid).css('background-size', '100% 100%');
			}
			callback && callback();

		}

		function setImgFromNet(imgid, loadUrl, relativePath, callback, type) {
			var dtask = plus.downloader.createDownload(loadUrl, {}, function(d, status) {
				if(status == 200) {
					setImgFromLocal(imgid, d.filename, callback, type);
				} else {
					callback();
					if(relativePath != null)
						delFile(relativePath);
				}
			});
			dtask.start();
		}

		function delFile(relativePath) {
			plus.io.resolveLocalFileSystemURL(relativePath, function(entry) {
				entry.remove(function(entry) {}, function(e) {});
			});
		}
	})
};




	//
	var API = window.API = {

		login:function(user_login,passwd){
			 return request.post('user/login',{ 
				user_login:user_login,
				passwd:passwd
			});
			
			
		}
		
		
	}
	
	
	
	
	
	
	
	

