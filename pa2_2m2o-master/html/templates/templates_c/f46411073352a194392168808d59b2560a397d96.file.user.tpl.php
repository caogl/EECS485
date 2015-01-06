<?php /* Smarty version Smarty-3.1.14, created on 2014-10-01 20:45:57
         compiled from "/var/www/html/group54/admin/pa2/php/html/templates/templates/user.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17548606395429aa229da912-36668821%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f46411073352a194392168808d59b2560a397d96' => 
    array (
      0 => '/var/www/html/group54/admin/pa2/php/html/templates/templates/user.tpl',
      1 => 1412206502,
      2 => 'file',
    ),
    'a6d457cd5b1ed36512f36e9f6562711e8e00656d' => 
    array (
      0 => '/var/www/html/group54/admin/pa2/php/html/templates/templates/base.tpl',
      1 => 1412008757,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17548606395429aa229da912-36668821',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5429aa22a4fda5_57610103',
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5429aa22a4fda5_57610103')) {function content_5429aa22a4fda5_57610103($_smarty_tpl) {?>

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
<script>
	function checkValid()
	{
	     var e = document.getElementById("pwd1");
	     var d = document.getElementById("pwd2");
	     if(e.value != d.value)
	     {
		alert("Password doesn't match!");	
	     }
	}
</script>
<h1>Create a New Account</h1>
<body>
<?php if ($_smarty_tpl->tpl_vars['checkResult']->value==1){?>
<p>Password doesn't match! Please try again!</p>
<?php }elseif($_smarty_tpl->tpl_vars['checkResult']->value==2){?>
<p>User name already exists! Please try again!</p>
<?php }?>
<form method = "POST" action = "/ymneig/pa2/user">
<table>
   <tr>
	<td>Username(*):</td>
	
	<td><input type = "text" title = "Username must contain at least 3 characters and can include letters, digits and underscores" name = "username" required pattern ="[A-Za-z0-9_]{3,}"></td>
	</tr>
   <tr>
        <td>First Name:</td>
        <td><input type = "text" name = "firstN"></td>
   </tr>
   <tr>
        <td>Last Name:</td>
        <td><input type = "text" name = "lastN"></td>
   </tr>
   <tr>
        <td>Email:</td>
        <td><input type = "text" name = "email"></td>
   </tr>
   <tr>
        <td>Password(*):</td>
	
        <td><input id = "pwd1" type = "password" title = "Password must be between 5 to 15 characters,including at least one digit and at least one letter. Password can only have letters, digits and underscores" required pattern = "(?=(.*[0-9]+))(?=(.*[A-Za-z]+))[0-9A-Za-z_]{5,15}" name = "pwd1"></td>
   </tr>
   <tr>
        <td>Confirm Password(*):</td>
        <td><input id = "pwd2" type = "password" required pattern = "(?=(.*[0-9]+))(?=(.*[A-Za-z]+))[0-9A-Za-z_]{5,15}" title = "Please enter the same password as above" onblur="checkValid()" name = "pwd2"></td>
   </tr>
   <tr>
   	<td>
	<input type = "submit" value = "Create" name = "login">
	</td>
   </tr>

</table>
</form>
<br>
<br>
<a href = "/ymneig/pa2/">Go Back to Homepage</a>
</body>

  </div>
  <script type="text/javascript" src="/static/js/main.js"></script>
</body>

</html>
<?php }} ?>