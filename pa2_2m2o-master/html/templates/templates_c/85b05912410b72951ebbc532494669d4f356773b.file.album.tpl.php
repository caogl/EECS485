<?php /* Smarty version Smarty-3.1.14, created on 2014-09-21 03:02:28
         compiled from "/var/www/html/group54/admin/pa1/php/html/templates/templates/album.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1209169695541a29f9b607c9-26184266%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '85b05912410b72951ebbc532494669d4f356773b' => 
    array (
      0 => '/var/www/html/group54/admin/pa1/php/html/templates/templates/album.tpl',
      1 => 1411268212,
      2 => 'file',
    ),
    '638a975dafd4170cb06b3a00e1bba900c5d3e8d5' => 
    array (
      0 => '/var/www/html/group54/admin/pa1/php/html/templates/templates/base.tpl',
      1 => 1410834295,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1209169695541a29f9b607c9-26184266',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_541a29f9bd59a9_78649403',
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_541a29f9bd59a9_78649403')) {function content_541a29f9bd59a9_78649403($_smarty_tpl) {?>

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
background-color: linen;
}
h1{

color:maroon;
font-weight:bold;
}
</style>
<h1><?php echo $_smarty_tpl->tpl_vars['albumTitle']->value;?>
</h1>
</head>
<body>
<p class="important">
</p>
<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>
<table>
        <?php while ($_smarty_tpl->tpl_vars['i']->value<($_smarty_tpl->tpl_vars['numPics']->value-$_smarty_tpl->tpl_vars['numPicMod']->value)){?>
        <tr>
                <?php $_smarty_tpl->tpl_vars['j'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['j']->step = 1;$_smarty_tpl->tpl_vars['j']->total = (int)ceil(($_smarty_tpl->tpl_vars['j']->step > 0 ? 4+1 - (0) : 0-(4)+1)/abs($_smarty_tpl->tpl_vars['j']->step));
if ($_smarty_tpl->tpl_vars['j']->total > 0){
for ($_smarty_tpl->tpl_vars['j']->value = 0, $_smarty_tpl->tpl_vars['j']->iteration = 1;$_smarty_tpl->tpl_vars['j']->iteration <= $_smarty_tpl->tpl_vars['j']->total;$_smarty_tpl->tpl_vars['j']->value += $_smarty_tpl->tpl_vars['j']->step, $_smarty_tpl->tpl_vars['j']->iteration++){
$_smarty_tpl->tpl_vars['j']->first = $_smarty_tpl->tpl_vars['j']->iteration == 1;$_smarty_tpl->tpl_vars['j']->last = $_smarty_tpl->tpl_vars['j']->iteration == $_smarty_tpl->tpl_vars['j']->total;?>
                <td><a href = "/ymneig/pa1/pic?id=<?php echo $_smarty_tpl->tpl_vars['picIDs']->value[$_smarty_tpl->tpl_vars['i']->value];?>
"><img src="/static/pictures/<?php echo $_smarty_tpl->tpl_vars['pics']->value[$_smarty_tpl->tpl_vars['i']->value];?>
" style="width:80px;height:80px"></a></td>
                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
		<?php }} ?>
        </tr>
        <?php }?>
        <tr>
                <?php $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['k']->step = 1;$_smarty_tpl->tpl_vars['k']->total = (int)ceil(($_smarty_tpl->tpl_vars['k']->step > 0 ? $_smarty_tpl->tpl_vars['numPicMod']->value-1+1 - (0) : 0-($_smarty_tpl->tpl_vars['numPicMod']->value-1)+1)/abs($_smarty_tpl->tpl_vars['k']->step));
if ($_smarty_tpl->tpl_vars['k']->total > 0){
for ($_smarty_tpl->tpl_vars['k']->value = 0, $_smarty_tpl->tpl_vars['k']->iteration = 1;$_smarty_tpl->tpl_vars['k']->iteration <= $_smarty_tpl->tpl_vars['k']->total;$_smarty_tpl->tpl_vars['k']->value += $_smarty_tpl->tpl_vars['k']->step, $_smarty_tpl->tpl_vars['k']->iteration++){
$_smarty_tpl->tpl_vars['k']->first = $_smarty_tpl->tpl_vars['k']->iteration == 1;$_smarty_tpl->tpl_vars['k']->last = $_smarty_tpl->tpl_vars['k']->iteration == $_smarty_tpl->tpl_vars['k']->total;?>
                <td><a href = "/ymneig/pa1/pic?id=<?php echo $_smarty_tpl->tpl_vars['picIDs']->value[$_smarty_tpl->tpl_vars['i']->value];?>
"><img src="/static/pictures/<?php echo $_smarty_tpl->tpl_vars['pics']->value[$_smarty_tpl->tpl_vars['i']->value];?>
" style="width:80px;height:80px"></a></td>
                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
		<?php }} ?>

        </tr>
</table>

</body>

  </div>
  <script type="text/javascript" src="/static/js/main.js"></script>
</body>

</html><?php }} ?>