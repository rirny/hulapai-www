<?php /* Smarty version Smarty-3.1.14, created on 2014-06-13 16:57:10
         compiled from "E:\www\hulapai\www\tpl\www\guide.video.html" */ ?>
<?php /*%%SmartyHeaderCode:2246353981fdfb4f151-16398578%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '260bd262f21aff6589f292378f47798704e7c4bb' => 
    array (
      0 => 'E:\\www\\hulapai\\www\\tpl\\www\\guide.video.html',
      1 => 1402563548,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2246353981fdfb4f151-16398578',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53981fdfb8c134_53977350',
  'variables' => 
  array (
    'static' => 0,
    'source' => 0,
    'key' => 0,
    'item' => 0,
    'result' => 0,
    'sourceObj' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53981fdfb8c134_53977350')) {function content_53981fdfb8c134_53977350($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('www/header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('action'=>'guide'), 0);?>

<link href="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
/web/style/guide.css" rel="stylesheet" type="text/css" />
<div class="bcontent">
    <div class="content">
    	<div class="cleft">
        	<h1 class="help">帮助视频</h1>
            <div id="myplayer">
				<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
/js/jplayer/swfobject.js"></script>
				<div id="CuPlayer"></div>			
			</div>
			<ul class="playList">
				<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['source']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
				<li><?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
、<a href="#" onclick="changeStream(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
);"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a></li>
				<?php } ?>
			</ul>
        </div>
        
        <div class="cright">			
            <div class="guidelist">
            	<h2>新手指南</h2>
            	<ul class="guideul">
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                	<li><a href="#<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</a></li>
					<?php } ?>                	
                </ul>
            </div>
            <div class="guidevideo">
				<h2><a href="/guide_video">帮助视频</a></h2>
			</div>
        </div>
		<div style="clear:both"></div>
    </div>
</div>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
/js/jplayer/swfobject.js"></script>
<script type="text/javascript">
<!--
var staticRoot = '<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
';
var CuPlayerList = <?php echo (($tmp = @$_smarty_tpl->tpl_vars['sourceObj']->value)===null||$tmp==='' ? '{}' : $tmp);?>
;
var num = CuPlayerList.length;
var video_index = 0;
function getNext(pars)
{	
  if(video_index < num-1)
	{
		video_index++;
		so.addVariable("CuPlayerFile", CuPlayerList[video_index]);
		so.write("CuPlayer");	
	}
	else
	{
		video_index = 0;
		so.addVariable("CuPlayerFile", CuPlayerList[video_index].source);
		so.write("CuPlayer");
	}
}

function changeStream(index){

	$(".playList li a").css('color', '#666');
	$(".playList li a").eq(index).css('color','#ff0000');

	so.addVariable("CuPlayerFile", CuPlayerList[index].source);
	so.addVariable("CuPlayerAutoPlay","true");
	so.write("CuPlayer");	
}

$(".playList li a").css('color', '#666');
$(".playList li a").eq(video_index).css('color','#ff0000');


	CuPlayerFile = CuPlayerList[video_index];
	var so = new SWFObject("<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
/js/jplayer/CuPlayerMiniV3_Black_S.swf","CuPlayer","600","400","9","#000000");
	so.addParam("allowfullscreen","true");
	so.addParam("allowscriptaccess","always");
	so.addParam("wmode","opaque");
	so.addParam("quality","high");
	so.addParam("salign","lt");
	so.addVariable("CuPlayerFile",CuPlayerFile.source);
	so.addVariable("CuPlayerImage","<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
/web/image/screen.png");
	//so.addVariable("CuPlayerLogo","<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
/web/image/screen.png");
	so.addVariable("CuPlayerShowImage","true");
	so.addVariable("CuPlayerWidth","600");
	so.addVariable("CuPlayerHeight","400");
	so.addVariable("CuPlayerAutoPlay","false");
	so.addVariable("CuPlayerAutoRepeat","false");
	so.addVariable("CuPlayerShowControl","true");
	so.addVariable("CuPlayerAutoHideControl","false");
	so.addVariable("CuPlayerAutoHideTime","6");
	so.addVariable("CuPlayerVolume","80");
	so.addVariable("CuPlayerGetNext","true");
	so.write("CuPlayer");

function windowH(){
	if($(window).height()< 720){
		$('.cleft').css('height', '590px');
		$('.cright').css('height', '590px');
		$('body').attr('scroll', '');
		$('body').css('overflow','');
	}else{
		var clientHeight = document.documentElement.clientHeight;
		if($.browser.mozilla)
		{
			clientHeight = window.innerHeight;
		}
		var heights = clientHeight - 240;
		$('.cleft').css('height', heights + 'px');
		$('.cright').css('height', heights + 'px');
	}
}
windowH();
</script>
<?php echo $_smarty_tpl->getSubTemplate ('www/footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>