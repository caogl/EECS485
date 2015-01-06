<?php /* Smarty version Smarty-3.1.14, created on 2014-10-17 13:07:03
         compiled from "/var/www/html/group54/admin/pa2/php/html/templates/templates/albumedit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:105550885854273a70a4f287-93723851%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cc8faf78d326f860e478c6b6659573a3ae7d16ea' => 
    array (
      0 => '/var/www/html/group54/admin/pa2/php/html/templates/templates/albumedit.tpl',
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
  'nocache_hash' => '105550885854273a70a4f287-93723851',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54273a70bafc67_40051555',
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54273a70bafc67_40051555')) {function content_54273a70bafc67_40051555($_smarty_tpl) {?>

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
.div2{
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
font-family:"Time New Roman";

}

td{
font-size:15px;
font-weight:bold;
}

td.upload
{
padding-bottom:5px;
padding-top:5px;
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
<div class = "div2">
<p class = "title">Edit <?php echo $_smarty_tpl->tpl_vars['albumTitle']->value;?>
</p>
<p class = "login">Logged in as <?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</p>
</div>
<div class = "div2">
   <form method ="POST" action="/ymneig/pa2/album/edit?id=<?php echo $_smarty_tpl->tpl_vars['albumID']->value;?>
">
	<table>
	   <tr>
	   <td>Album Name:</td>
	   <td><input type = "text" value = "<?php echo $_smarty_tpl->tpl_vars['albumTitle']->value;?>
" name = "albumTitle"></td>
	   </tr>
	   <tr>
           <td>Album Permission:</td>
	<?php if ($_smarty_tpl->tpl_vars['permission']->value=='public'){?>
           <td><input type = "radio" value = "public" name = "access" checked = "true">Public</td>
	   <td><input type = "radio" value = "private" name = "access">Private</td>
	   </tr>
	<?php }else{ ?>
	<td><input type = "radio" value = "public" name = "access">Public</td>
           <td><input type = "radio" value = "private" name = "access" checked = "true">Private</td>
           </tr>
	<?php }?>
	   <tr>
           <td>If Private, allow access to :</td>
		<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['numPrivateAc']->value-1+1 - (0) : 0-($_smarty_tpl->tpl_vars['numPrivateAc']->value-1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
           <td><input type = "checkbox" value = "<?php echo $_smarty_tpl->tpl_vars['privateAc']->value[$_smarty_tpl->tpl_vars['i']->value];?>
" name = "permission[]" checked = "true"><?php echo $_smarty_tpl->tpl_vars['privateAc']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</td>
		<?php }} ?>
           	<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['numUsers']->value-1+1 - (0) : 0-($_smarty_tpl->tpl_vars['numUsers']->value-1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
           <td><input type = "checkbox" value = "<?php echo $_smarty_tpl->tpl_vars['usernames']->value[$_smarty_tpl->tpl_vars['i']->value];?>
" name = "permission[]"><?php echo $_smarty_tpl->tpl_vars['usernames']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</td>
                <?php }} ?>
	   </tr>
	
	<tr>
	   <td><input type = "submit" name = "submit" value = "Make change"></td>
	</tr>
	</table>
   </form>
</div>
<div class = "div2">
<table border = "1">
<br>
<br>
<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>
<?php while ($_smarty_tpl->tpl_vars['i']->value<$_smarty_tpl->tpl_vars['numPics']->value){?>
	<tr>
	<td>
            <form method = "POST" action = "/ymneig/pa2/album/edit?id=<?php echo $_smarty_tpl->tpl_vars['albumID']->value;?>
">
 	    <a href = "/ymneig/pa2/pic?id=<?php echo $_smarty_tpl->tpl_vars['picIDs']->value[$_smarty_tpl->tpl_vars['i']->value];?>
"><img src="/static/pictures/<?php echo $_smarty_tpl->tpl_vars['pics']->value[$_smarty_tpl->tpl_vars['i']->value];?>
" style="width:304px;height:228px"></a>

	    <p align="center"><input type="submit" value ="delete" name="op"/><?php echo $_smarty_tpl->tpl_vars['captions']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</p>
	    <input type="hidden" value ="<?php echo $_smarty_tpl->tpl_vars['pics']->value[$_smarty_tpl->tpl_vars['i']->value];?>
" name="picid" />
	    <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
	    </form></td>
	<?php if ($_smarty_tpl->tpl_vars['i']->value==$_smarty_tpl->tpl_vars['numPics']->value){?>
	<?php continue 1?>
        <?php }?>
	<td>
 		<form method = "POST" action = "/ymneig/pa2/album/edit?id=<?php echo $_smarty_tpl->tpl_vars['albumID']->value;?>
">
 	        <a href = "/ymneig/pa2/pic?id=<?php echo $_smarty_tpl->tpl_vars['picIDs']->value[$_smarty_tpl->tpl_vars['i']->value];?>
"><img src="/static/pictures/<?php echo $_smarty_tpl->tpl_vars['pics']->value[$_smarty_tpl->tpl_vars['i']->value];?>
" style="width:304px;height:228px"></a>
		<p align="center"><input type="submit" value ="delete" name="op"/><?php echo $_smarty_tpl->tpl_vars['captions']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</p>
		<input type="hidden" value ="<?php echo $_smarty_tpl->tpl_vars['pics']->value[$_smarty_tpl->tpl_vars['i']->value];?>
" name="picid" />
		<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
		</form></td>
	<?php if ($_smarty_tpl->tpl_vars['i']->value==$_smarty_tpl->tpl_vars['numPics']->value){?>
	<?php continue 1?>
	<?php }?>
	<td>
	 	<form method = "POST" action = "/ymneig/pa2/album/edit?id=<?php echo $_smarty_tpl->tpl_vars['albumID']->value;?>
">
	        <a href = "/ymneig/pa2/pic?id=<?php echo $_smarty_tpl->tpl_vars['picIDs']->value[$_smarty_tpl->tpl_vars['i']->value];?>
"><img src="/static/pictures/<?php echo $_smarty_tpl->tpl_vars['pics']->value[$_smarty_tpl->tpl_vars['i']->value];?>
" style="width:304px;height:228px"></a>
		<p align="center"><input type="submit" value ="delete" name="op"/><?php echo $_smarty_tpl->tpl_vars['captions']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</p>
		<input type="hidden" value ="<?php echo $_smarty_tpl->tpl_vars['pics']->value[$_smarty_tpl->tpl_vars['i']->value];?>
" name="picid" />
		<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
		</form></td>
	</tr>	
<?php }?>
	<tr>
	<td class = "upload" colspan = "3" align="center">
		<form enctype="multipart/form-data" action="/ymneig/pa2/album/edit?id=<?php echo $_smarty_tpl->tpl_vars['albumID']->value;?>
" method="POST">
		Upload New Photo: <input name="userfile" type="file" />
    		<input type="submit" value="Upload" name="op" />
		</form>	
		</td>
	</tr>
	
</table>
</div>

</body>



  </div>
  <script type="text/javascript" src="/static/js/main.js"></script>
</body>

</html>
<?php }} ?>