/**
 * 公共JS文件 $Id$
 */
if (typeof $ == 'undefined')
    alert('未加载JQUERY');

/**
 * HTTP请求
 * 
 * @param url
 * @param data
 * @param type
 * @param async
 * @returns
 */
function http_request(url, data, type, async, dataType) {
    // 默认能数
    async = (async ? async : false);
    data = (data ? data : '');
    type = (type ? type : 'POST');
    dataType = (dataType ? dataType : 'JSON');

    var result;
    $.ajax({
	'url' : url,
	'type' : type,
	'data' : data,
	'async' : async,
	'dataType' : dataType,
	'success' : function(res) {
	    result = res;
	}
    });
    return result;
}

/**
 * HTTP_GET
 * 
 * @param url
 * @param data
 * @param async
 * @returns
 */
function http_get(url, data, async) {
    return http_request(url, data, 'GET', async, 'JSON');
}

/**
 * HTTP_POST
 * 
 * @param url
 * @param data
 * @param async
 * @returns
 */
function http_post(url, data, async) {
    return http_request(url, data, 'POST', async, 'JSON');
}

/**
 * 简单柱状图
 * 
 * @param id
 *                元素ID
 * @param data
 *                一维数组的json格式 [key1=>val2,key2=>val2...]
 * @param title
 *                图表标题
 * @param field_name
 *                数值显示的名字(如统计各个渠道总充值的为:充值金额)
 * @returns
 */
function show_simple_bar_chart(id, data, title, field_name) {
    var y_data = {};
    var x_data = [];

    y_data.name = field_name;
    y_data.data = [];

    if (data != null && data.length != 0) {
	for ( var i in data) {
	    x_data.push(i);
	    y_data.data.push(parseFloat(data[i]));
	}
    }

    $(id).highcharts({
	credits : false,
	chart : {
	    type : 'column'
	},
	title : {
	    text : title
	},
	subtitle : {
	    text : ''
	},
	xAxis : {
	    categories : x_data,
	    crosshair : true
	},
	yAxis : {
	    min : 0,
	    title : {
		text : field_name
	    }
	},
	tooltip : {
	    headerFormat : '<span style="font-size:10px">{point.key}</span><table>',
	    pointFormat : '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' + '<td style="padding:0"><b>{point.y}</b></td></tr>',
	    footerFormat : '</table>',
	    shared : true,
	    useHTML : true
	},
	plotOptions : {
	    column : {
		pointPadding : 0.2,
		borderWidth : 0
	    }
	},

	series : [ y_data ]
    });

    return true;
}

/**
 * 组合柱状图
 * 
 * @param id
 *                元素ID
 * @param data
 *                [x=>[x1,x2,x3],y=>[[name=>一类数据,data=>[y1,y2,y3]],[name=>二类数据,data=>[y1,y2,y3]]。。。]]
 * @param title
 *                图表标题
 * @param field_name
 *                数值显示的名字(如统计各个渠道总充值的为:充值金额)
 * @returns
 */
function show_multi_bar_chart(id, data, title, field_name) {
    if (data.length == 0 || data == null) {
	data.x = [];
	data.y = [];
    }

    $(id).highcharts({
	credits : false,
	chart : {
	    type : 'column'
	},
	title : {
	    text : title
	},
	subtitle : {
	    text : ''
	},
	xAxis : {
	    categories : data.x,
	    crosshair : true
	},
	yAxis : {
	    min : 0,
	    title : {
		text : field_name
	    }
	},
	tooltip : {
	    headerFormat : '<span style="font-size:10px">{point.key}</span><table>',
	    pointFormat : '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' + '<td style="padding:0"><b>{point.y:.2f}</b></td></tr>',
	    footerFormat : '</table>',
	    shared : true,
	    useHTML : true
	},
	plotOptions : {
	    column : {
		pointPadding : 0.2,
		borderWidth : 0
	    }
	},

	series : data.y
    });

    return true;
}

/**
 * 简单曲线
 * 
 * @param id
 *                元素ID
 * @param data
 *                二维数组的json格式
 *                [x=>[x1,x2...],y=>[[name=>type1,data=>[y1,y2...]],[name=>type2,data=>[y1,y2...]]]]
 * @param title
 *                图表标题
 * @param field_name
 *                数值显示的名字(如统计各个渠道总充值的为:充值金额)
 * @returns
 */
function show_simple_line_chart(id, data, title, field_name) {
    if (data == null || data.length == 0) {
	var y_data = [];
	var x_data = [];
    } else {
	var y_data = data.y;
	var x_data = data.x;
    }

    $(id).highcharts({
	credits : false,
	title : {
	    text : title
	},
	xAxis : {
	    categories : x_data
	},
	yAxis : {
	    title : {
		text : field_name
	    }
	},
	legend : {
	    layout : 'vertical',
	    align : 'right',
	    verticalAlign : 'middle'
	},
	series : y_data,
	responsive : {
	    rules : [ {
		condition : {
		    maxWidth : 500
		},
		chartOptions : {
		    legend : {
			layout : 'horizontal',
			align : 'center',
			verticalAlign : 'bottom'
		    }
		}
	    } ]
	}
    });

    return true;
}

/**
 * 简单饼图
 * 
 * @param id
 *                元素ID
 * @param data
 *                二维数组的json格式 [[name1,value1],[name2,value2]...]
 * @param title
 *                图表标题
 * @param field_name
 *                数值显示的名字(如统计各个渠道总充值的为:充值金额)
 * @returns
 */
function show_simple_pie_chart(id, data, title, field_name) {

    if (data == null || data.length == 0) {
	data = []
    }

    $(id).highcharts({
	credits : false,
	chart : {
	    plotBackgroundColor : null,
	    plotBorderWidth : null,
	    plotShadow : false
	},
	title : {
	    text : title
	},
	tooltip : {
	    headerFormat : '{series.name}<br>',
	    pointFormat : '{point.name}: <b>{point.percentage:.2f}%</b>'
	},
	plotOptions : {
	    pie : {
		allowPointSelect : true,
		cursor : 'pointer',
		dataLabels : {
		    enabled : true,
		    format : '<b>{point.name}</b>: {point.percentage:.2f} %',
		    style : {
			color : (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
		    }
		}
	    }
	},
	series : [ {
	    type : 'pie',
	    name : field_name,
	    data : data
	} ]
    });

    return true;
}

/**
 * JQ插件
 */
jQuery.fn.extend({
	getJson:function(){
		var o = {};
		var a = $(this).serializeArray();
		$.each(a, function () {
		if (o[this.name] !== undefined) {
			if (!o[this.name].push) {
			o[this.name] = [o[this.name]];
			}
			o[this.name].push(this.value || '');
		} else {
			o[this.name] = this.value || '';
		}
		});
		return o;
	},
	// 选中单、复选框
	check:function(vals){
		var checked=true;
		
		if(typeof vals=='boolean'){
			checked=vals;
		}
		
		$.each(this,function(){
			if(vals!==undefined && vals.indexOf){
				$(this).prop("checked",(','+vals+',').indexOf(','+this.value+',')>-1);
			}else{
				$(this).prop("checked",checked);
			}
		});
	},
	
	// =============== 表单赋值 ====================
	vals:function(data){
		$.each(this[0],function(){
			if(this.type=='select-one'){
				
				if(typeof data=='undefined' || typeof data[this.name]=='undefined'){
					this.options[0].selected=true;
				}else{
					this.value=data[this.name];
				}
				
			}else if(this.type=='checkbox' || this.type=='radio'){
				var name=this.name.replace('[]','');
				if(typeof data=='undefined' || typeof data[name]=='undefined'){
					this.checked=false;
				}else{
					if((','+data[name]+',').indexOf(','+this.value+',')>-1){
						this.checked=true;
					}else{
						this.checked=false;
					}
				}
				
			}else{
				
				if(typeof data=='undefined' || typeof data[this.name]=='undefined'){
					this.value='';
				}else{
					this.value=data[this.name];
				}
			}
		});
	},
	
	/*============ 取得多选元素值 ====================*/
	getValSet:function(){
		var vals='';
		$.each(this,function(){
			if(this.checked){
				vals+=this.value+',';
			}
		});
		if(vals!=''){
			vals=vals.slice(0,-1);
		}
		return vals;
	},
	// 取得多元素属性值
	getAttributeSet:function(attrName){
		var vals='';
		$.each(this,function(){
			if(this.checked){
				vals+=this.getAttribute(attrName)+',';
			}
		});
		if(vals!=''){
			vals=vals.slice(0,-1);
		}
		return vals;
	},
	
});
