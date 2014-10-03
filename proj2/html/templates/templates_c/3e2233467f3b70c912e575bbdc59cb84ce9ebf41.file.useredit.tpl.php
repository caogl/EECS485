<?php /* Smarty version Smarty-3.1.14, created on 2014-10-01 20:54:10
         compiled from "/var/www/html/group54/admin/pa2/php/html/templates/templates/useredit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:872094697542b6bcd3735d0-93976266%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3e2233467f3b70c912e575bbdc59cb84ce9ebf41' => 
    array (
      0 => '/var/www/html/group54/admin/pa2/php/html/templates/templates/useredit.tpl',
      1 => 1412211162,
      2 => 'file',
    ),
    'a6d457cd5b1ed36512f36e9f6562711e8e00656d' => 
    array (
      0 => '/var/www/html/group54/admin/pa2/php/html/templates/templates/base.tpl',
      1 => 1412008757,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '872094697542b6bcd3735d0-93976266',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_542b6bcd40e491_69457050',
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542b6bcd40e491_69457050')) {function content_542b6bcd40e491_69457050($_smarty_tpl) {?>

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
<title>User Edit</title>
<meta charset="UTF-8">
<style>

div.header{
width: 850px;
}

p.title{
        font-family:"Times New Roman";
        font-size: 40px;
        color: maroon;
        font-weight: bold;
        float:left;

}
p.login{
float:right;
padding-top: 40px;
font-size:17px;
padding-left: 10px;
}

body{
        background-color:linen;
        font-family:"Times New Roman";
}

div.hmenu {
   margin: 0;
   padding: .3em 0 .3em 0;
   background: #B8B8B8;
   width: 850px;
   text-align: center;
}

div.hmenu ul {
   list-style: none;
   margin: 0;
   padding: 0;
}

div.hmenu ul li {
   margin: 0;
   padding-left: 30px;
   padding-right:30px;
   display: inline;
}
div.hmenu ul a:hover{
   margin: 0;
   padding: .3em .4em .3em .4em;
   text-decoration: none;
   font-weight: bold;
   font-size: 20px;
   color: #f6f0cc;
   background-color: #227755;
}

.div2{
width:700px;
float:left;
}
</style>
<script>
	function checkValid()
	{
		var p1=document.getElementById("pwd1").value;
		var p2=document.getElementById("pwd2").value;
		if(p1!=p2)
		{
			alert("Password doesn't match!");
		}
	}
 
</script>
</head>

<body>
<div class="hmenu">
<ul>
  <li><a href="/ymneig/pa2/">Home</a></li>
  <li><a href="/ymneig/pa2/user/edit">Edit Account</a></li>
  <li><a href="/ymneig/pa2/albums/edit?username=<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
">My Albums</a></li>
  <li><a href="/ymneig/pa2/logout">Log Out</a></li>
</ul>
</div>
<div class = "header">
<p class="title">Edit your account</p>
<p class="login">Logged in as <?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</p>

<div class = "div2">
<?php if ($_smarty_tpl->tpl_vars['checkResult']->value==1){?>
<p>Password doesn't match!</p>
<?php }?>
<form method = "POST" action = "/ymneig/pa2/user/edit">
<table>
<tr><td>Username:</td>
        <td><input type = "text" value = "<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
" disabled = "true"></td>
        </tr>
   <tr>
        <td>First Name:</td>
        <td><input type = "text" value = "<?php echo $_smarty_tpl->tpl_vars['firstname']->value;?>
" name = "firstN"></td>
   </tr>
   <tr>
        <td>Last Name:</td>
        <td><input type = "text" value = "<?php echo $_smarty_tpl->tpl_vars['lastname']->value;?>
" name = "lastN"></td>
   </tr>
   <tr>
        <td>Email:</td>
        <td><input type = "text" value = "<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
" name = "email"></td>
   </tr>
   <tr>
        <td>Password(*):</td>
        <td><input id = "pwd1" type = "password" value= "<?php echo $_smarty_tpl->tpl_vars['password']->value;?>
" title = "Password must be between 5 to 15 characters,including at least one digit and at least one letter. Password can only have letters, digits and underscores" required pattern = "(?=(.*[0-9]+))(?=(.*[A-Za-z]+))[0-9A-Za-z_]{5,15}" name = "pwd1"></td>
   </tr>
   <tr>
        <td>Confirm Password(*):</td>
        <td><input id = "pwd2" type = "password" value = "<?php echo $_smarty_tpl->tpl_vars['password']->value;?>
"   required pattern = "(?=(.*[0-9]+))(?=(.*[A-Za-z]+))[0-9A-Za-z_]{5,15}"  title = "Please enter the same password as above" onblur="checkValid()" name = "pwd2"></td>
   </tr>
   <tr>
        <td>
        <input type = "submit" value = "Edit" name = "login">
        </td>
   </tr>   
   <tr>
	<td>
	<br>
	<br>
	<a href="/ymneig/pa2/user/delete">Delete User Account</a>
	<td>
   </tr>
</table>
</form>
</div>
</body>



  </div>
  <script type="text/javascript" src="/static/js/main.js"></script>
</body>

</html>
<?php }} ?>