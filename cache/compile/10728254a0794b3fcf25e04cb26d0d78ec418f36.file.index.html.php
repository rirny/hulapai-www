<?php /* Smarty version Smarty-3.1.14, created on 2014-06-13 16:56:46
         compiled from "E:\www\hulapai\www\tpl\www\index.html" */ ?>
<?php /*%%SmartyHeaderCode:260625397e81153ad96-60284923%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '10728254a0794b3fcf25e04cb26d0d78ec418f36' => 
    array (
      0 => 'E:\\www\\hulapai\\www\\tpl\\www\\index.html',
      1 => 1402649804,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '260625397e81153ad96-60284923',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5397e81154dd34_03760717',
  'variables' => 
  array (
    'static' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5397e81154dd34_03760717')) {function content_5397e81154dd34_03760717($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('www/header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('action'=>''), 0);?>

    <div class="content">
    	<div class="bdownload">
        <div class="download">
        	<div class="d_dleft">
       	    <img src="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
/web/image/iphone5.gif" />
            </div>
       	  <div class="dright">
            	<ul class="dintr">
                	<li>呼啦派</li>
                	<li>全新的学习方式</li>
                </ul>
                <ul class="dinfo">
                	<li>多种教务管理系统</li>
                	<li>课时、学费自动统计</li>
                	<li>朋友分享、咨询传播</li>
                </ul>
                <p class="ddspk">下载现在就去<span>免费</span>下载吧</p>
                <p class="downbtn">
                	<input name="downapp" class="downapp" type="submit" value="App&nbsp;&nbsp;Store" onclick="window.location.href='/download?src=ios'" />
                   	<input name="downdroid" class="downdroid" type="submit" value="安卓市场" onclick="window.location.href='/download?src=android'" />
               	</p>
            </div>
        </div>
        </div>
        
        <div class="bactioninfo">
        <div class="actioninfo">
        </div>
        </div>
        
        <div class="bfunone">
        <div class="funone">
        </div>
        </div>
        
        <div class="bfuntwo">
        <div class="funtwo">
        	<ul class="myclass">
            	<li>我的</li>
            	<li>课程表</li>
            </ul>
            <p class="myclainfo">
                课程表提供四种查看方式：<Br/>
				月视图可查看当月课程安排；<Br/>
				周视图查看本周课程；<Br/>
				日视图查看当天课程；<Br/>
				列表视图列表查看所有课程。
            </p>
        </div>
        </div>
        
        <div class="bfunthree">
        <div class="funthree">
        	<ul class="class">
            	<li>教师 - 学生点评</li>
            </ul>
            <p class="clainfo">
				老师可对学生表现进行点评；<Br/>
				老师对学生课堂表现进行点评；<Br/>
				老师可查看学生对自己的评价；<Br/>
				老师对课程考勤功能
            </p>
        </div>
        </div>
    </div>
 <?php echo $_smarty_tpl->getSubTemplate ('www/footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>