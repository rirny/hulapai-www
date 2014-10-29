<?php /* Smarty version Smarty-3.1.14, created on 2014-06-13 10:58:48
         compiled from "E:\www\hulapai\www\tpl\www\header.html" */ ?>
<?php /*%%SmartyHeaderCode:239885397ecc30971f3-25209909%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e233c9f87f3fd1c5e97f31e3d4ceed1230800403' => 
    array (
      0 => 'E:\\www\\hulapai\\www\\tpl\\www\\header.html',
      1 => 1402563548,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '239885397ecc30971f3-25209909',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5397ecc30a2cb0_91667051',
  'variables' => 
  array (
    'static' => 0,
    'action' => 0,
    'root' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5397ecc30a2cb0_91667051')) {function content_5397ecc30a2cb0_91667051($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>应用介绍 - 呼啦派</title>
<link href="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
/web/style/Default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
/js/jquery-1.8.0.js"></script>
<script type="text/javascript">
	$(function(){
		$(".menu li a").click(function (){
			$(".menu li a").parent().find("div").removeClass("selected");
			$(this).parent().find("div").addClass("selected");
		});
	});
</script>
</head>

<body>
<div class="bheader">
	<div class="header">
        <img class="logo" src="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
/web/image/logo2.gif" />
        <a class="intr">全新的学习方式<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
</a>        
        <div class="hright">
        	<a href="IOSdownload.html">应用介绍</a>
            	<img class="phone" src="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
/web/image/phone2.gif" />
        </div>
        <ul class="menu">
            <li><a class="menudot" href="<?php if (!$_smarty_tpl->tpl_vars['action']->value){?>javascript:;<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['root']->value;?>
<?php }?>">应用介绍</a><div <?php if (!$_smarty_tpl->tpl_vars['action']->value){?>class="selected"<?php }?>></div></li>
            <li><a class="menudot" href="<?php if ($_smarty_tpl->tpl_vars['action']->value=='company'){?>javascript:;<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['root']->value;?>
/company<?php }?>">公司介绍</a><div <?php if ($_smarty_tpl->tpl_vars['action']->value=='company'){?>class="selected"<?php }?>></div></li>
            <li><a class="menudot" href="<?php if ($_smarty_tpl->tpl_vars['action']->value=='contact'){?>javascript:;<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['root']->value;?>
/contact<?php }?>">联系我们</a><div <?php if ($_smarty_tpl->tpl_vars['action']->value=='contact'){?>class="selected"<?php }?>></div></li>
            <li><a href="<?php if ($_smarty_tpl->tpl_vars['action']->value=='guide'){?>javascript:;<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['root']->value;?>
/guide<?php }?>">帮助中心</a><div <?php if ($_smarty_tpl->tpl_vars['action']->value=='guide'){?>class="selected"<?php }?>></div></li>
        </ul>        
    </div>
</div><?php }} ?>