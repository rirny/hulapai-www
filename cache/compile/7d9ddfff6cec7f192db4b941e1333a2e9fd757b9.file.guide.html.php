<?php /* Smarty version Smarty-3.1.14, created on 2014-06-13 16:56:59
         compiled from "E:\www\hulapai\www\tpl\www\guide.html" */ ?>
<?php /*%%SmartyHeaderCode:212045397f3315a0df2-82400804%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d9ddfff6cec7f192db4b941e1333a2e9fd757b9' => 
    array (
      0 => 'E:\\www\\hulapai\\www\\tpl\\www\\guide.html',
      1 => 1402563548,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '212045397f3315a0df2-82400804',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5397f3315b59b9_67686095',
  'variables' => 
  array (
    'static' => 0,
    'result' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5397f3315b59b9_67686095')) {function content_5397f3315b59b9_67686095($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('www/header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('action'=>'guide'), 0);?>

<link href="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
/web/style/guide.css" rel="stylesheet" type="text/css" />
<div class="bcontent">
    <div class="content">
    	<div class="cleft">
        	<h1 class="help">新手指南</h1>
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
			<a name="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"></a>
            <div class="helplist">
            	<h3><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</h3>
                <p><?php echo $_smarty_tpl->tpl_vars['item']->value['content'];?>
</p>
            </div>
            <?php } ?>
        </div>
        
        <div class="cright">
			<!--
        	<div class="inport">
            	<input class="search" type="text" />
                <input class="seabtn" type="submit" value="" />
            </div>
			-->
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
<?php echo $_smarty_tpl->getSubTemplate ('www/footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>