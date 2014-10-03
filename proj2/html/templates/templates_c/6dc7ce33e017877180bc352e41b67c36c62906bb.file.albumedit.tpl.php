<?php /* Smarty version Smarty-3.1.14, created on 2014-09-20 20:01:05
         compiled from "/var/www/html/group54/admin/pa1/php/html/templates/templates/albumedit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1781943847541a29fcf3d0b0-63197428%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6dc7ce33e017877180bc352e41b67c36c62906bb' => 
    array (
      0 => '/var/www/html/group54/admin/pa1/php/html/templates/templates/albumedit.tpl',
      1 => 1411242878,
      2 => 'file',
    ),
    '638a975dafd4170cb06b3a00e1bba900c5d3e8d5' => 
    array (
      0 => '/var/www/html/group54/admin/pa1/php/html/templates/templates/base.tpl',
      1 => 1410834295,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1781943847541a29fcf3d0b0-63197428',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_541a29fd0730e8_36285235',
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_541a29fd0730e8_36285235')) {function content_541a29fd0730e8_36285235($_smarty_tpl) {?>

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
body{
background-color:linen;
font-family:"Time New Roman";
font-size: 30px;

}
h1{
font-size:35px;
font-weight:bold;
color:maroon;
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
<h1>Edit <?php echo $_smarty_tpl->tpl_vars['albumTitle']->value;?>
</h1>


<table border = "1">

<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>
<?php while ($_smarty_tpl->tpl_vars['i']->value<$_smarty_tpl->tpl_vars['numPics']->value){?>
	<tr>
	<td>
            <form method = "POST" action = "/ymneig/pa1/album/edit?id=<?php echo $_smarty_tpl->tpl_vars['albumID']->value;?>
">
 	    <a href = "/ymneig/pa1/pic?id=<?php echo $_smarty_tpl->tpl_vars['picIDs']->value[$_smarty_tpl->tpl_vars['i']->value];?>
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
 		<form method = "POST" action = "/ymneig/pa1/album/edit?id=<?php echo $_smarty_tpl->tpl_vars['albumID']->value;?>
">
 	        <a href = "/ymneig/pa1/pic?id=<?php echo $_smarty_tpl->tpl_vars['picIDs']->value[$_smarty_tpl->tpl_vars['i']->value];?>
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
	 	<form method = "POST" action = "/ymneig/pa1/album/edit?id=<?php echo $_smarty_tpl->tpl_vars['albumID']->value;?>
">
	        <a href = "/ymneig/pa1/pic?id=<?php echo $_smarty_tpl->tpl_vars['picIDs']->value[$_smarty_tpl->tpl_vars['i']->value];?>
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
		<form enctype="multipart/form-data" action="/ymneig/pa1/album/edit?id=<?php echo $_smarty_tpl->tpl_vars['albumID']->value;?>
" method="POST">
		Upload New Photo: <input name="userfile" type="file" />
    		<input type="submit" value="Upload" name="op" />
		</form>	
		</td>
	</tr>
</table>


</body>



  </div>
  <script type="text/javascript" src="/static/js/main.js"></script>
</body>

</html><?php }} ?>