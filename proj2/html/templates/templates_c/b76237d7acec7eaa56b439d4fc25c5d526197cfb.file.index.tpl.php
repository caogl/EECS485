<?php /* Smarty version Smarty-3.1.14, created on 2014-09-20 21:09:17
         compiled from "/var/www/html/group54/admin/pa1/php/html/templates/templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18712220405417a00d16feb3-62455868%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b76237d7acec7eaa56b439d4fc25c5d526197cfb' => 
    array (
      0 => '/var/www/html/group54/admin/pa1/php/html/templates/templates/index.tpl',
      1 => 1411247242,
      2 => 'file',
    ),
    '638a975dafd4170cb06b3a00e1bba900c5d3e8d5' => 
    array (
      0 => '/var/www/html/group54/admin/pa1/php/html/templates/templates/base.tpl',
      1 => 1410834295,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18712220405417a00d16feb3-62455868',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5417a00d1f8f56_42375604',
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5417a00d1f8f56_42375604')) {function content_5417a00d1f8f56_42375604($_smarty_tpl) {?>

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
<title>Index Page</title>
<meta charset="UTF-8">
<style>
header{
	font-family:"Times New Roman";
	font-size: 40px;
	color: maroon;
	font-weight: bold;
}
p.center{
font-weight:bold;
padding-top: 4px;
padding-bottom:20px;
}
body{
	background-color:linen;
	font-family:"Times New Roman";
}
footer{
color:maroon;
font-size:15px;
}
ul
{
list-style-type:square;
padding:5px;
}
a{
text-decoration:none;
font-size: 30px;
}
li{
padding-bottom: 5px;
}
p1{
font-size: 30px;
color:purple;
font-weight:bold;
}
</style>
</head>
<body>
<header>Build Your Photo Albums</header>
<p class="center">
  This website allows users to create, browse and edit albums.
</p>
<p1>Usernames</p1>
<ul>
<?php  $_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['foo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['usernames']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['foo']->key => $_smarty_tpl->tpl_vars['foo']->value){
$_smarty_tpl->tpl_vars['foo']->_loop = true;
?>
<li><a href ="/ymneig/pa1/albums?username=<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
</a></li>
<?php } ?>
</ul>
</body>
<footer>
Posted by Ying He, Astin Teferi, Guanglei Cao
</footer>

  </div>
  <script type="text/javascript" src="/static/js/main.js"></script>
</body>

</html><?php }} ?>