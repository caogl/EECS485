<?php /* Smarty version Smarty-3.1.14, created on 2014-09-20 20:01:16
         compiled from "/var/www/html/group54/admin/pa1/php/html/templates/templates/albums.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20829585675417ace280b524-20023681%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce0fb12f555d3d32bdc6b33a1ef485390d69e395' => 
    array (
      0 => '/var/www/html/group54/admin/pa1/php/html/templates/templates/albums.tpl',
      1 => 1411241702,
      2 => 'file',
    ),
    '638a975dafd4170cb06b3a00e1bba900c5d3e8d5' => 
    array (
      0 => '/var/www/html/group54/admin/pa1/php/html/templates/templates/base.tpl',
      1 => 1410834295,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20829585675417ace280b524-20023681',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5417ace2880811_06706951',
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5417ace2880811_06706951')) {function content_5417ace2880811_06706951($_smarty_tpl) {?>

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
body{
background-color:linen;
font-size:30px;
font-family:"Times New Roman";
}
p{
font-weight:bold;
font-size:40px;
color:maroon;
}
ul{
list-style-type:square;
}
a{
text-decoration:none;
}
</style>
</head>
<body>
<p class="important">
 Welcome <?php echo $_smarty_tpl->tpl_vars['name']->value;?>

</p>
<ul>
<?php  $_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['foo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['albumNames']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['foo']->key => $_smarty_tpl->tpl_vars['foo']->value){
$_smarty_tpl->tpl_vars['foo']->_loop = true;
?>
<li><a href ="/ymneig/pa1/albums/edit?username=<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
</a></li>
<?php } ?>
</ul>
</body>

  </div>
  <script type="text/javascript" src="/static/js/main.js"></script>
</body>

</html><?php }} ?>