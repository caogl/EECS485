<?php /* Smarty version Smarty-3.1.14, created on 2014-10-17 11:07:42
         compiled from "/var/www/html/group54/admin/pa2/php/html/templates/templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10449000955427364c2eb346-51682740%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e986e8411f72a0b7cc1cb6186b78b50e8d956721' => 
    array (
      0 => '/var/www/html/group54/admin/pa2/php/html/templates/templates/index.tpl',
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
  'nocache_hash' => '10449000955427364c2eb346-51682740',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5427364c397d87_94485991',
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5427364c397d87_94485991')) {function content_5427364c397d87_94485991($_smarty_tpl) {?>

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
<title>Index Page</title>
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
p.center{
font-weight:bold;
padding-top: 20px;
padding-bottom:20px;
text-align:left;
}
body{
	background-color:linen;
	font-family:"Times New Roman";
}
footer{
color:maroon;
font-size:15px;
}
.div2{
float:left;
display:block;
width:850px;
}
ul
{
list-style-type:square;
padding:5px;
}
a{
text-decoration:none;
}
li{
padding-bottom: 5px;
}
p1{
font-size: 30px;
color:purple;
font-weight:bold;
}
.tb{
font-size:25px;}
td{
padding-left:10px;
padding-right:10px;
padding-top:10px;
padding-bottom:10px;
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

</style>
</head>


<body>
<?php if ($_smarty_tpl->tpl_vars['loggedin']->value==1){?>
	<div class="hmenu">
	<ul>
  		<li><a href="/ymneig/pa2/">Home</a></li>
  		<li><a href="/ymneig/pa2/user/edit">Edit Account</a></li>
  		<li><a href="/ymneig/pa2/albums/edit?username=<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
">My Albums</a></li>
  		<li><a  href = "/ymneig/pa2/logout">Log Out</a></li>
	</ul>
	</div>
	<div class = "header">
		<p class = "title">Welcome to Album Portfolios!</p>
		<p class = "login">Logged in as <?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</p>
	</div>
<?php }else{ ?>
	<div class = "header">
	<p class = "title">Welcome to Album Portfolios!</p>
	<a align = "right" href = "/ymneig/pa2/login"><p class = "login">Log In</p></a>
	<a href = "/ymneig/pa2/user"><p class = "login">Register</p></a>
	</div>
<?php }?>


<div class = "div2">
	<p class = "center">
 	This website allows users to create, browse and edit albums
	</p>
</div>
<div class="div2">
	<table border = "1" class = "tb">
	<tr><td>Album</td>
		<td>User Name</td>
	</tr>
	<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['numAlbum']->value-1+1 - (0) : 0-($_smarty_tpl->tpl_vars['numAlbum']->value-1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
	<tr>
  		<td> <a href ="/ymneig/pa2/album?id=<?php echo $_smarty_tpl->tpl_vars['albumids']->value[$_smarty_tpl->tpl_vars['i']->value];?>
"><?php echo $_smarty_tpl->tpl_vars['albums']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</a></td>
 		 <td><?php echo $_smarty_tpl->tpl_vars['usernames']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</td>
	</tr>
	<?php }} ?>
	</table>
</div>

</body>

<div class = "div2">
	<br>
	<br>
	<footer>
	Posted by Ying He, Astin Teferi, Guanglei Cao
	</footer>
</div>


  </div>
  <script type="text/javascript" src="/static/js/main.js"></script>
</body>

</html>
<?php }} ?>