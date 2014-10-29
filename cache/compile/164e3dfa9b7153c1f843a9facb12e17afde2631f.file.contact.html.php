<?php /* Smarty version Smarty-3.1.14, created on 2014-06-11 14:46:16
         compiled from "E:\www\hulapai\www\tpl\www\contact.html" */ ?>
<?php /*%%SmartyHeaderCode:94975397f269507783-49539728%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '164e3dfa9b7153c1f843a9facb12e17afde2631f' => 
    array (
      0 => 'E:\\www\\hulapai\\www\\tpl\\www\\contact.html',
      1 => 1402467302,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '94975397f269507783-49539728',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5397f26952ce07_97857172',
  'variables' => 
  array (
    'static' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5397f26952ce07_97857172')) {function content_5397f26952ce07_97857172($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('www/header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('action'=>'contact'), 0);?>

<link href="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
/web/style/contact.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
<div class="bcontent">
    <div class="content">
    	<div class="cleft">
            
            <div class="map">
                <!--百度地图容器-->
                <div style="width:650px;height:375px;border:#ccc solid 1px;" id="dituContent"></div>
            </div>
            
  			
            <div class="con">
            	<span>联系我们</span>
                <ul class="conul">
                	<li><b>公司地址</b></li>
                	<li>上海市普陀区宁夏路201号11楼D</li>
                	<li><b>联系电话</b></li>
                	<li>021-52363421</li>
                	<li><b>客服电话</b></li>
                	<li>4008-250-388</li>
                	<li><b>客服邮箱</b></li>
                	<li>service@hulapai.com</li>
                </ul>
            </div>
            
        </div>
        
        <div class="cright">
            <div class="rcomlist">
            	<span>联系我们</span>
            	<ul class="rcomul">
                	<li><a href="javascript:;">公司地址</a></li>
                	<li><a href="javascript:;">联系电话</a></li>
                	<li><a href="javascript:;">客服电话</a></li>
                	<li><a href="javascript:;">客服邮箱</a></li>
                </ul>
            </div>
            
            
            <div class="rcomlist2">
            	<span>诚征英才</span>
            	<ul class="rcomul">
                	<li><a href="javascript:;">首席媒体官</a></li>
                	<li><a href="javascript:;">品牌维护专员</a></li>
                	<li><a href="javascript:;">市场推广专员</a></li>
                	<li><a href="javascript:;">客服经理</a></li>
                </ul>
            </div>
            
        </div>
    <div style="clear:both"></div>
    </div>
</div>
   
<script type="text/javascript">
    //创建和初始化地图函数：
    function initMap(){
        createMap();//创建地图
        setMapEvent();//设置地图事件
        addMapControl();//向地图添加控件
        addMarker();//向地图中添加marker
    }
    
    //创建地图函数：
    function createMap(){
        var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
        var point = new BMap.Point(121.426966,31.240796);//定义一个中心点坐标
        map.centerAndZoom(point,18);//设定地图的中心点和坐标并将地图显示在地图容器中
        window.map = map;//将map变量存储在全局
    }
    
    //地图事件设置函数：
    function setMapEvent(){
        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
        map.enableScrollWheelZoom();//启用地图滚轮放大缩小
        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
        map.enableKeyboard();//启用键盘上下左右键移动地图
    }
    
    //地图控件添加函数：
    function addMapControl(){
        //向地图中添加缩放控件
	var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
	map.addControl(ctrl_nav);
        //向地图中添加缩略图控件
	var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:1});
	map.addControl(ctrl_ove);
        //向地图中添加比例尺控件
	var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
	map.addControl(ctrl_sca);
    }
    
    //标注点数组
    var markerArr = [{title:"上海呼啦派网络科技有限公司",content:"上海市普陀区宁夏路201号11楼D座",point:"121.426858|31.240985",isOpen:1,icon:{w:21,h:21,l:0,t:0,x:6,lb:5}}
		 ];
    //创建marker
    function addMarker(){
        for(var i=0;i<markerArr.length;i++){
            var json = markerArr[i];
            var p0 = json.point.split("|")[0];
            var p1 = json.point.split("|")[1];
            var point = new BMap.Point(p0,p1);
			var iconImg = createIcon(json.icon);
            var marker = new BMap.Marker(point,{icon:iconImg});
			var iw = createInfoWindow(i);
			var label = new BMap.Label(json.title,{"offset":new BMap.Size(json.icon.lb-json.icon.x+10,-20)});
			marker.setLabel(label);
            map.addOverlay(marker);
            label.setStyle({
                        borderColor:"#808080",
                        color:"#333",
                        cursor:"pointer"
            });
			
			(function(){
				var index = i;
				var _iw = createInfoWindow(i);
				var _marker = marker;
				_marker.addEventListener("click",function(){
				    this.openInfoWindow(_iw);
			    });
			    _iw.addEventListener("open",function(){
				    _marker.getLabel().hide();
			    })
			    _iw.addEventListener("close",function(){
				    _marker.getLabel().show();
			    })
				label.addEventListener("click",function(){
				    _marker.openInfoWindow(_iw);
			    })
				if(!!json.isOpen){
					label.hide();
					_marker.openInfoWindow(_iw);
				}
			})()
        }
    }
    //创建InfoWindow
    function createInfoWindow(i){
        var json = markerArr[i];
        var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
        return iw;
    }
    //创建一个Icon
    function createIcon(json){
        var icon = new BMap.Icon("http://app.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w,json.h),{imageOffset: new BMap.Size(-json.l,-json.t),infoWindowOffset:new BMap.Size(json.lb+5,1),offset:new BMap.Size(json.x,json.h)})
        return icon;
    }
    
    initMap();//创建和初始化地图
</script>
<?php echo $_smarty_tpl->getSubTemplate ('www/footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>