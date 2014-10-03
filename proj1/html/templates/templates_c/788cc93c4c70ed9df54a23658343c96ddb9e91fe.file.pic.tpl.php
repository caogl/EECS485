<?php /* Smarty version Smarty-3.1.14, created on 2014-09-20 20:21:17
         compiled from "/var/www/html/group54/admin/pa1/php/html/templates/templates/pic.tpl" */ ?>
<?php /*%%SmartyHeaderCode:135671153254179f8cd5c054-72310749%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '788cc93c4c70ed9df54a23658343c96ddb9e91fe' => 
    array (
      0 => '/var/www/html/group54/admin/pa1/php/html/templates/templates/pic.tpl',
      1 => 1411243763,
      2 => 'file',
    ),
    '638a975dafd4170cb06b3a00e1bba900c5d3e8d5' => 
    array (
      0 => '/var/www/html/group54/admin/pa1/php/html/templates/templates/base.tpl',
      1 => 1410834295,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '135671153254179f8cd5c054-72310749',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54179f8cdd6452_13043153',
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54179f8cdd6452_13043153')) {function content_54179f8cdd6452_13043153($_smarty_tpl) {?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="en">
<head>

    <link rel="stylesheet" href="/static/css/style.css" />

    <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
</head>
<body>
  <div class="center">
    
<head>
<style>
body
{
background-color:linen;
font-size:30px;
}
h1{
font-size:40px;
font-weight:bold;
color:maroon;
}
a{
text-decoration:none;

}
</style>
</head>
<body>
<h1><?php echo $_smarty_tpl->tpl_vars['picCaption']->value;?>
</h1>
<p class="important">
<img src="/static/pictures/<?php echo $_smarty_tpl->tpl_vars['pName']->value;?>
" style="width:1000px;height:800:228px"></p>
<p>
<?php $_smarty_tpl->tpl_vars['a'] = new Smarty_variable($_smarty_tpl->tpl_vars['index']->value-1, null, 0);?>
<?php $_smarty_tpl->tpl_vars['b'] = new Smarty_variable($_smarty_tpl->tpl_vars['index']->value+1, null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['index']->value>0){?>
<a href = "/ymneig/pa1/pic?id=<?php echo $_smarty_tpl->tpl_vars['pics']->value[$_smarty_tpl->tpl_vars['a']->value];?>
">&lt&ltPrev</a>
&nbsp;&nbsp;&nbsp;
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['index']->value<$_smarty_tpl->tpl_vars['numPics']->value-1){?>
<a href = "/ymneig/pa1/pic?id=<?php echo $_smarty_tpl->tpl_vars['pics']->value[$_smarty_tpl->tpl_vars['b']->value];?>
">Next>></a>
<?php }?>
</p>
<p><a align="left" href="/ymneig/pa1/album/edit?id=<?php echo $_smarty_tpl->tpl_vars['albumid']->value;?>
">Back to Edit Album</a></p>
<p><a align="left" href="/ymneig/pa1/album?id=<?php echo $_smarty_tpl->tpl_vars['albumid']->value;?>
">Back to Album</a>
</p>
</body>

  </div>
  <script type="text/javascript" src="/static/js/main.js"></script>
</body>

</html><?php }} ?>