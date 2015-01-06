<?php /* Smarty version Smarty-3.1.14, created on 2014-10-17 11:07:52
         compiled from "/var/www/html/group54/admin/pa2/php/html/templates/templates/pic.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20879478525429b78a9fdf82-74698663%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '60a3d2e7e6c11fbf3deb2f9feb56fff9c343d3e0' => 
    array (
      0 => '/var/www/html/group54/admin/pa2/php/html/templates/templates/pic.tpl',
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
  'nocache_hash' => '20879478525429b78a9fdf82-74698663',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5429b78ab010c8_03803029',
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5429b78ab010c8_03803029')) {function content_5429b78ab010c8_03803029($_smarty_tpl) {?>

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
body
{
   background-color:linen;
   font-family:"Times New Roman";
}

div.header{
        width: 850px;
        float:left;
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

a{
   text-decoration:none;

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
                <p class = "title"><?php echo $_smarty_tpl->tpl_vars['picCaption']->value;?>
</p>
                <p class = "login">Logged in as <?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</p>
        </div>
<?php }else{ ?>
        <div class = "header">
                <p class = "title"><?php echo $_smarty_tpl->tpl_vars['picCaption']->value;?>
</p>
        </div>
<?php }?>



<p>
<img src="/static/pictures/<?php echo $_smarty_tpl->tpl_vars['pName']->value;?>
" style="width:700:300px;height:600:128px"
</p> 

<p>
	<?php $_smarty_tpl->tpl_vars['a'] = new Smarty_variable($_smarty_tpl->tpl_vars['index']->value-1, null, 0);?>
	<?php $_smarty_tpl->tpl_vars['b'] = new Smarty_variable($_smarty_tpl->tpl_vars['index']->value+1, null, 0);?>
	<?php if ($_smarty_tpl->tpl_vars['index']->value>0){?>
		<a href = "/ymneig/pa2/pic?id=<?php echo $_smarty_tpl->tpl_vars['pics']->value[$_smarty_tpl->tpl_vars['a']->value];?>
">&lt&ltPrev</a>
		&nbsp;&nbsp;&nbsp;
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['index']->value<$_smarty_tpl->tpl_vars['numPics']->value-1){?>
		<a href = "/ymneig/pa2/pic?id=<?php echo $_smarty_tpl->tpl_vars['pics']->value[$_smarty_tpl->tpl_vars['b']->value];?>
">Next>></a>
	<?php }?>
</p>
<?php if ($_smarty_tpl->tpl_vars['permission']->value==1){?> 
	<p><a align="left" href="/ymneig/pa2/album/edit?id=<?php echo $_smarty_tpl->tpl_vars['albumid']->value;?>
">Back to Edit Album</a></p>
<?php }?>
<p><a align="left" href="/ymneig/pa2/album?id=<?php echo $_smarty_tpl->tpl_vars['albumid']->value;?>
">Back to Album</a></p>
</body>

  </div>
  <script type="text/javascript" src="/static/js/main.js"></script>
</body>

</html>
<?php }} ?>