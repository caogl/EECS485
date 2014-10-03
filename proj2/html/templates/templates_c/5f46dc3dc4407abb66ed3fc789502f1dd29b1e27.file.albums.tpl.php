<?php /* Smarty version Smarty-3.1.14, created on 2014-09-29 17:52:35
         compiled from "/var/www/html/group54/admin/pa2/php/html/templates/templates/albums.tpl" */ ?>
<?php /*%%SmartyHeaderCode:172539026754273957b424c3-59786678%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5f46dc3dc4407abb66ed3fc789502f1dd29b1e27' => 
    array (
      0 => '/var/www/html/group54/admin/pa2/php/html/templates/templates/albums.tpl',
      1 => 1411856667,
      2 => 'file',
    ),
    'a6d457cd5b1ed36512f36e9f6562711e8e00656d' => 
    array (
      0 => '/var/www/html/group54/admin/pa2/php/html/templates/templates/base.tpl',
      1 => 1412008757,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '172539026754273957b424c3-59786678',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54273957bd8224_75224353',
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54273957bd8224_75224353')) {function content_54273957bd8224_75224353($_smarty_tpl) {?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="en">
<head>

    <link rel="stylesheet" href="/static/css/style.css" />

    <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
</head>
<body>
  <div class = "center">
    
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
<li><a href ="/ymneig/pa2/albums/edit?username=<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
</a></li>
<?php } ?>
</ul>
</body>

  </div>
  <script type="text/javascript" src="/static/js/main.js"></script>
</body>

</html>
<?php }} ?>