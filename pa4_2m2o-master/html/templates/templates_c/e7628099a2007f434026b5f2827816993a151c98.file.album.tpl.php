<?php /* Smarty version Smarty-3.1.14, created on 2014-10-17 11:07:48
         compiled from "/var/www/html/group54/admin/pa2/php/html/templates/templates/album.tpl" */ ?>
<?php /*%%SmartyHeaderCode:140132995754273a6c1c5605-23641742%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e7628099a2007f434026b5f2827816993a151c98' => 
    array (
      0 => '/var/www/html/group54/admin/pa2/php/html/templates/templates/album.tpl',
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
  'nocache_hash' => '140132995754273a6c1c5605-23641742',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54273a6c2bcca5_20369496',
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54273a6c2bcca5_20369496')) {function content_54273a6c2bcca5_20369496($_smarty_tpl) {?>

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

p.small{
font-size:12px;
}

td{
padding-left:18px;
padding-right:18px;
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
		<p class = "title"><?php echo $_smarty_tpl->tpl_vars['albumTitle']->value;?>
 by <?php echo $_smarty_tpl->tpl_vars['owner']->value;?>
</p>
		<p class = "login">Logged in as <?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</p>
	</div>
<?php }else{ ?>
	<div class = "header">
		<p class = "title"><?php echo $_smarty_tpl->tpl_vars['albumTitle']->value;?>
 by <?php echo $_smarty_tpl->tpl_vars['owner']->value;?>
</p>
	</div>
<?php }?>

<div class = "header">
<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>
<table border = "1">
        <?php while ($_smarty_tpl->tpl_vars['i']->value<($_smarty_tpl->tpl_vars['numPics']->value-$_smarty_tpl->tpl_vars['numPicMod']->value)){?>
        <tr>
                <?php $_smarty_tpl->tpl_vars['j'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['j']->step = 1;$_smarty_tpl->tpl_vars['j']->total = (int)ceil(($_smarty_tpl->tpl_vars['j']->step > 0 ? 4+1 - (0) : 0-(4)+1)/abs($_smarty_tpl->tpl_vars['j']->step));
if ($_smarty_tpl->tpl_vars['j']->total > 0){
for ($_smarty_tpl->tpl_vars['j']->value = 0, $_smarty_tpl->tpl_vars['j']->iteration = 1;$_smarty_tpl->tpl_vars['j']->iteration <= $_smarty_tpl->tpl_vars['j']->total;$_smarty_tpl->tpl_vars['j']->value += $_smarty_tpl->tpl_vars['j']->step, $_smarty_tpl->tpl_vars['j']->iteration++){
$_smarty_tpl->tpl_vars['j']->first = $_smarty_tpl->tpl_vars['j']->iteration == 1;$_smarty_tpl->tpl_vars['j']->last = $_smarty_tpl->tpl_vars['j']->iteration == $_smarty_tpl->tpl_vars['j']->total;?>
                <td>
		<p class ="small"><?php echo $_smarty_tpl->tpl_vars['captions']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</p>
		<a href = "/ymneig/pa2/pic?id=<?php echo $_smarty_tpl->tpl_vars['picIDs']->value[$_smarty_tpl->tpl_vars['i']->value];?>
"><img src="/static/pictures/<?php echo $_smarty_tpl->tpl_vars['pics']->value[$_smarty_tpl->tpl_vars['i']->value];?>
" style="width:120px;height:120px"></a>
                <p class = "small"><?php echo $_smarty_tpl->tpl_vars['dates']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</p>
		</td>
		<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
		<?php }} ?>
        </tr>
        <?php }?>
        <tr>
                <?php $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['k']->step = 1;$_smarty_tpl->tpl_vars['k']->total = (int)ceil(($_smarty_tpl->tpl_vars['k']->step > 0 ? $_smarty_tpl->tpl_vars['numPicMod']->value-1+1 - (0) : 0-($_smarty_tpl->tpl_vars['numPicMod']->value-1)+1)/abs($_smarty_tpl->tpl_vars['k']->step));
if ($_smarty_tpl->tpl_vars['k']->total > 0){
for ($_smarty_tpl->tpl_vars['k']->value = 0, $_smarty_tpl->tpl_vars['k']->iteration = 1;$_smarty_tpl->tpl_vars['k']->iteration <= $_smarty_tpl->tpl_vars['k']->total;$_smarty_tpl->tpl_vars['k']->value += $_smarty_tpl->tpl_vars['k']->step, $_smarty_tpl->tpl_vars['k']->iteration++){
$_smarty_tpl->tpl_vars['k']->first = $_smarty_tpl->tpl_vars['k']->iteration == 1;$_smarty_tpl->tpl_vars['k']->last = $_smarty_tpl->tpl_vars['k']->iteration == $_smarty_tpl->tpl_vars['k']->total;?>
                <td>
		<p class = "small"><?php echo $_smarty_tpl->tpl_vars['captions']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</p>
		<a href = "/ymneig/pa2/pic?id=<?php echo $_smarty_tpl->tpl_vars['picIDs']->value[$_smarty_tpl->tpl_vars['i']->value];?>
"><img src="/static/pictures/<?php echo $_smarty_tpl->tpl_vars['pics']->value[$_smarty_tpl->tpl_vars['i']->value];?>
" style="width:120px;height:120px"></a>
                <p class = "small"><?php echo $_smarty_tpl->tpl_vars['dates']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</p>
		</td>
		<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
		<?php }} ?>

        </tr>
</table>
</div>
<?php if ($_smarty_tpl->tpl_vars['loggedin']->value==0){?>
<div class = "header">
   	<p><a href = "/ymneig/pa2/">Back to home page</a></p>
</div>
<?php }?>
</body>

  </div>
  <script type="text/javascript" src="/static/js/main.js"></script>
</body>

</html>
<?php }} ?>