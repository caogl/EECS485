<?php /* Smarty version Smarty-3.1.14, created on 2014-11-30 15:26:31
         compiled from "/var/www/html/group54/admin/pa6/php/html/templates/templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:857204265547b7d77bfc4b4-23410755%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e91bc0a22c8006ce49afa5ce8299ff515bb50bd8' => 
    array (
      0 => '/var/www/html/group54/admin/pa6/php/html/templates/templates/index.tpl',
      1 => 1417379154,
      2 => 'file',
    ),
    'cc3da2d75eeb67afd863f9ad9424ade8f521f84c' => 
    array (
      0 => '/var/www/html/group54/admin/pa6/php/html/templates/templates/base.tpl',
      1 => 1417376067,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '857204265547b7d77bfc4b4-23410755',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_547b7d77d6e268_27095899',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547b7d77d6e268_27095899')) {function content_547b7d77d6e268_27095899($_smarty_tpl) {?>

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

	<div class="hmenu">
	<ul>
  		<li><a href="/ymneig/pa6/">Home</a></li>
  	</ul>

	</div>




<div class = "div2">
	<p class = "center">
 	This website allows users to create, browse and edit albums
	</p>
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