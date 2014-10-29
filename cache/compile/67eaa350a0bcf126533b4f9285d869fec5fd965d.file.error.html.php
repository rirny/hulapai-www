<?php /* Smarty version Smarty-3.1.14, created on 2014-06-13 10:58:49
         compiled from "E:\www\hulapai\www\tpl\error.html" */ ?>
<?php /*%%SmartyHeaderCode:177015397c6a2a699a2-59457090%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '67eaa350a0bcf126533b4f9285d869fec5fd965d' => 
    array (
      0 => 'E:\\www\\hulapai\\www\\tpl\\error.html',
      1 => 1402563548,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '177015397c6a2a699a2-59457090',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5397c6a2bb21c4_20696125',
  'variables' => 
  array (
    'webResult' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5397c6a2bb21c4_20696125')) {function content_5397c6a2bb21c4_20696125($_smarty_tpl) {?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title><?php echo Config::get('sitename','system');?>
 Error页面</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <link href="/static/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   <link href="/static/assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
   <link href="/static/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
   <link href="/static/css/style.css" rel="stylesheet" />
   <link href="/static/css/style-responsive.css" rel="stylesheet" />
   <link href="/static/css/style-default.css" rel="stylesheet" id="style_color" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="error-400">
    <div class="error-wrap">
        <h1>Ouch!</h1>
        <h2>Looks like something went wrong</h2>
        <div class="metro green">
           <span> 6 </span>
        </div>
        <div class="metro yellow">
            <span> <?php echo $_smarty_tpl->tpl_vars['webResult']->value['code'];?>
 </span>
        </div>
        <div class="metro purple">
            <span> <?php echo $_smarty_tpl->tpl_vars['webResult']->value['code'];?>
 </span>
        </div>
        <p><?php echo $_smarty_tpl->tpl_vars['webResult']->value['message'];?>
 <a href="index.html"> Return Home </a></p>
    </div>
</body>
<!-- END BODY -->
</html>
<?php }} ?>