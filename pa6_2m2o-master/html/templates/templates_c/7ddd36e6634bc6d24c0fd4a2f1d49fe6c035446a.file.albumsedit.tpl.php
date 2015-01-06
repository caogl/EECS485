<?php /* Smarty version Smarty-3.1.14, created on 2014-10-17 13:06:57
         compiled from "/var/www/html/group54/admin/pa2/php/html/templates/templates/albumsedit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:29932483054273959411263-79045925%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7ddd36e6634bc6d24c0fd4a2f1d49fe6c035446a' => 
    array (
      0 => '/var/www/html/group54/admin/pa2/php/html/templates/templates/albumsedit.tpl',
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
  'nocache_hash' => '29932483054273959411263-79045925',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_542739594d6a81_29202302',
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542739594d6a81_29202302')) {function content_542739594d6a81_29202302($_smarty_tpl) {?>

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

body{
   background-color:linen;
   font-family:"Times New Roman"
}
td{
   padding: 5px;
   font-weight:bold;
   padding-top:5px;
   text-align:center;
   font-size:30px;
}
a{
   text-decoration:none;
}
</style>
</head>



<body>

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
<p class = "title">Edit Albums</p>
<p class = "login">Logged in as <?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</p>
</div>
<div class = "header">
     <table border=1>   
         <tr>
             <td>Album</td>	
             <td>Access</td>
	     <td>Edit</td>
             <td>Delete</td>
         </tr>
  <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['num']->value-1+1 - (0) : 0-($_smarty_tpl->tpl_vars['num']->value-1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>      
         <tr>
	  <td><a href="/ymneig/pa2/album?id=<?php echo $_smarty_tpl->tpl_vars['albumIDs']->value[$_smarty_tpl->tpl_vars['i']->value];?>
"><?php echo $_smarty_tpl->tpl_vars['albumNames']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</a></td>
	  <td><?php echo $_smarty_tpl->tpl_vars['albumAccess']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</td>
	  <td><a href="/ymneig/pa2/album/edit?id=<?php echo $_smarty_tpl->tpl_vars['albumIDs']->value[$_smarty_tpl->tpl_vars['i']->value];?>
">Edit</a></td>	 
          <td><form method="POST" action= "/ymneig/pa2/albums/edit?username=<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
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
             <form method="POST" action= "/ymneig/pa2/albums/edit?username=<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
">
		<input type ="hidden" value = "add" name="op"> 
		<input type ="hidden" value = "<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
" name ="username">
		<input name="title" type="text" /> 
		<input type="submit" value="add" />
	     </td>
	     </form>
          </tr>       
</table>
</div>
</body>

  </div>
  <script type="text/javascript" src="/static/js/main.js"></script>
</body>

</html>
<?php }} ?>