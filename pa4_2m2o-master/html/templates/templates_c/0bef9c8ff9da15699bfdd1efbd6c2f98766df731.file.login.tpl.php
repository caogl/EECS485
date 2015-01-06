<?php /* Smarty version Smarty-3.1.14, created on 2014-10-17 13:07:10
         compiled from "/var/www/html/group54/admin/pa2/php/html/templates/templates/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15625640795429a1e179b9b8-24141630%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0bef9c8ff9da15699bfdd1efbd6c2f98766df731' => 
    array (
      0 => '/var/www/html/group54/admin/pa2/php/html/templates/templates/login.tpl',
      1 => 1413558447,
      2 => 'file',
    ),
    'a6d457cd5b1ed36512f36e9f6562711e8e00656d' => 
    array (
      0 => '/var/www/html/group54/admin/pa2/php/html/templates/templates/base.tpl',
      1 => 1413558447,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15625640795429a1e179b9b8-24141630',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5429a1e180d9b5_83387240',
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5429a1e180d9b5_83387240')) {function content_5429a1e180d9b5_83387240($_smarty_tpl) {?>

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
</style>

<h1>User Login</h1>
</head>
<body>
<?php if ($_smarty_tpl->tpl_vars['loggedin']->value==0){?>
<p>Invalid username or password! Please try again!</p>
<?php }?>
<form method = "POST" action="/ymneig/pa2/login">
   <table>
   <tr>
      <td>Username:</td>
      <td><input type = "text" name = "username"></td>
   </tr>
   
   <tr>
      <td>Password:</td> 
      <td><input type = "password" name = "password"></td>
   </tr>
   
   <tr>
      <td><input type = "submit" value = "Log In" name = "submit"></td>
      <td align = "right"><input type = "submit" value = "Cancel" name = "submit"></td>
   </tr>
   </table>

</form>

</body>

  </div>
  <script type="text/javascript" src="/static/js/main.js"></script>
</body>

</html>
<?php }} ?>