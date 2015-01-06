<?php /* Smarty version Smarty-3.1.14, created on 2014-11-06 21:18:43
         compiled from "/var/www/html/group54/admin/pa4/php/html/templates/templates/search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:214145537354557c640d8337-46949341%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '44333219310f02ee21e79da4d8f5b71c6764f199' => 
    array (
      0 => '/var/www/html/group54/admin/pa4/php/html/templates/templates/search.tpl',
      1 => 1415326721,
      2 => 'file',
    ),
    '6f0f770966886ebc12896f136e3634ec29c8e626' => 
    array (
      0 => '/var/www/html/group54/admin/pa4/php/html/templates/templates/base.tpl',
      1 => 1414883665,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '214145537354557c640d8337-46949341',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54557c64153b09_83276769',
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54557c64153b09_83276769')) {function content_54557c64153b09_83276769($_smarty_tpl) {?>

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
background-color: linen;
}
h1{

color:maroon;
font-weight:bold;
}

p1{
font-weight:bold;
color:maroon;
}
</style>
<div>
   <h1>Search Images</h1>
</div>
<div>
   <form method = "POST" action = "/ymneig/pa4/search">
   <input type = "text" name = "query">
   <input type = "submit" name = "submit" value = "Search">
   </form>
</div>


<?php if ($_smarty_tpl->tpl_vars['check']->value==1){?>
<div>
<br>
<br>
<p1>Total matched: <?php echo $_smarty_tpl->tpl_vars['num']->value;?>
</p1>
</div>
<div>
    <ul>
   <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>
    <?php while ($_smarty_tpl->tpl_vars['i']->value<$_smarty_tpl->tpl_vars['num']->value){?>
       <form method = "POST" action = "/ymneig/pa4/search" id = "myform">
	<li>
	<p> <?php echo $_smarty_tpl->tpl_vars['captions']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</p>
	<input type = "image" src="/static/<?php echo $_smarty_tpl->tpl_vars['urls']->value[$_smarty_tpl->tpl_vars['i']->value];?>
" style="width:120px;height:120px" alt = "Submit"/>
	<input type = "hidden" name = "caption" value = "<?php echo $_smarty_tpl->tpl_vars['captions']->value[$_smarty_tpl->tpl_vars['i']->value];?>
">
	<input type = "hidden" name = "clickImg" value = "true">
	</li>
	</form>
     <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
     <?php }?>	
     </ul>
</div>
<?php }?>




  </div>
  <script type="text/javascript" src="/static/js/main.js"></script>
</body>

</html>
<?php }} ?>