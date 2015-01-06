<?php /* Smarty version Smarty-3.1.14, created on 2014-09-27 21:41:46
         compiled from "/var/www/html/group54/admin/pa1/php/html/templates/templates/albumsedit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2670098405417cc035042b3-88345577%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f08b3c1fc689f228027b2f11e00d303625f62ea4' => 
    array (
      0 => '/var/www/html/group54/admin/pa1/php/html/templates/templates/albumsedit.tpl',
      1 => 1411854036,
      2 => 'file',
    ),
    '638a975dafd4170cb06b3a00e1bba900c5d3e8d5' => 
    array (
      0 => '/var/www/html/group54/admin/pa1/php/html/templates/templates/base.tpl',
      1 => 1410834295,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2670098405417cc035042b3-88345577',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5417cc0357aad4_63740165',
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5417cc0357aad4_63740165')) {function content_5417cc0357aad4_63740165($_smarty_tpl) {?>

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
h1{
font-family:"Times New Roman";
font-size:40px;
color: maroon;
}
body{
background-color:linen;
font-family:"Times New Roman"
}
td{
padding: 5px;
font-weight:bold;
text-align:center;
font-size:30px;
}
a{
text-decoration:none;
}
</style>
<h1>EDIT ALBUMS</h1>
</head>
<body>
     <table border=1>   
         <tr>
             <td>Album</td>	
             <td>Edit</td>
             <td>Delete</td>
         </tr>
  <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['num']->value-1+1 - (0) : 0-($_smarty_tpl->tpl_vars['num']->value-1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>      
         <tr>
	  <td><a href="/ymneig/pa1/album?id=<?php echo $_smarty_tpl->tpl_vars['albumIDs']->value[$_smarty_tpl->tpl_vars['i']->value];?>
"><?php echo $_smarty_tpl->tpl_vars['albumNames']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</a></td>
	  
	  <td><a href="/ymneig/pa1/album/edit?id=<?php echo $_smarty_tpl->tpl_vars['albumIDs']->value[$_smarty_tpl->tpl_vars['i']->value];?>
">Edit</a></td>	 
          <td><form method="POST" action= "/ymneig/pa1/albums/edit?username=<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
">
	      <input type="submit"  value="delete" name="op">
	      <input type ="hidden" value ="<?php echo $_smarty_tpl->tpl_vars['albumIDs']->value[$_smarty_tpl->tpl_vars['i']->value];?>
" name ="albumid">
	      </form>	
	  </td>
         </tr>
   <?php }} ?>        
	  <tr>
             <td>	     
             <form method="POST" action= "/ymneig/pa1/albums/edit?username=<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
">
		<input type ="hidden" value = "add" name="op"> 
		<input type ="hidden" value = "<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" name ="username">
		<input name="title" type="text" /> 
		<input type="submit" value="add" />
	     </td>
	     </form>
          </tr>       
</table>
</body>

  </div>
  <script type="text/javascript" src="/static/js/main.js"></script>
</body>

</html><?php }} ?>