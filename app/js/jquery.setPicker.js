/**
 * 
 *  *  setPicker 2018.4.16  v1.3
 * 
 * 
             依赖   mui.js  mui.picker.js  mui.poppicker.js  jquery.js 
  
             样式依赖  mui.picker.css mui.poppicker.css
            
             选择日期 需要mui.dtpicker.js  选择地区需要地区数据  自带三级联动数据是city.data-3.js
   

 * @param  {JSON}        data  展示的数据
 * @param  {Number}      layer  联动级别
 * @param  {Boolean}     isDate  是否是日期
 * @param  {JSON}        dateOptions  一个日期对象，具体参数太多了。。   需查看mui.dtpicker.js
 * @param  {Function}    callBack   回调
 */
	
	var BenPicker = (function($, window) {
	
		$.fn.setPicker = function(options) {
			var defaults = {
				data: [],
				layer: 3,
				isDate: false,
				dateOptions: {},
				callBack: function() {
	
				}
			}
			var settings = $.extend({}, defaults, options);
			var _getParam = function(obj, param) {
				return obj[param] || '';
			};
	
			if(!this.length) {
				console.warn('亲，你搞错了'); 
				return;
			}
			this.on('tap', function() {
	
				var userPicker = null;
	
				if(settings.isDate) {
					var optionsJson = settings.dateOptions;
	
					userPicker = new mui.DtPicker(settings.dateOptions);
	
				} else {
	
					userPicker = new mui.PopPicker({
						layer: settings.layer
					});
					
					if(settings.data.legnth==0){
						return
					}
					userPicker.setData(settings.data);
	
				}
	
				userPicker.show(function(items) {
	
					settings.callBack && settings.callBack(items);
	
					//销毁
					userPicker.dispose();
					userPicker = null;
	
				});
	
			});
		};
	
	})(jQuery, window);