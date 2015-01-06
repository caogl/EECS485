<?php /* Smarty version Smarty-3.1.14, created on 2014-12-06 16:39:07
         compiled from "/var/www/html/group54/admin/pa6/php/html/templates/templates/search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1150996854547b7d7df0d647-75332109%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9e73a093e84205130efb6fa66f4b2cad5f3c5015' => 
    array (
      0 => '/var/www/html/group54/admin/pa6/php/html/templates/templates/search.tpl',
      1 => 1417901650,
      2 => 'file',
    ),
    'cc3da2d75eeb67afd863f9ad9424ade8f521f84c' => 
    array (
      0 => '/var/www/html/group54/admin/pa6/php/html/templates/templates/base.tpl',
      1 => 1417376067,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1150996854547b7d7df0d647-75332109',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_547b7d7e096e42_15795485',
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547b7d7e096e42_15795485')) {function content_547b7d7e096e42_15795485($_smarty_tpl) {?>

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
background-color: #ECECEA;
}
h1{

color:#D9853B;
font-weight:bold;
}

div{
width:700px;
}
div.titleDiv{
color:#558C89;
text-align:center;
}
div.search{
color:#74AFAD;
margin-bottom: 75px;
}

div.weight{
color:#558C89;
margin-top: 2px;
}



</style>
<script type="text/javascript">
function showValue(newValue){
document.getElementById("range").innerHTML = newValue;
}

function showInfo(id){
var buttonid = "button"+id;
if(document.getElementById(id).style.display == "none"){
	document.getElementById(id).style.display = "block";
	document.getElementById(buttonid).innerHTML = "Hide Details";
}
else{
	document.getElementById(id).style.display = "none";
	document.getElementById(buttonid).innerHTML = "Show Details";
	
}
	
}

</script>

</head>


<body>

<div class = "titleDiv">
   <h1>Search Images</h1>
</div>
<div class= "search">
   <form method = "POST" action = "/ymneig/pa6/search">
   <input type = "text" name = "query">
    <input type="range" name = "weight" min= "0.00" max = "1.00" step= 0.01 value = 0.85 onchange="showValue(this.value)">
    <input type = "submit" name = "submit" value = "Search">
    <span id = "range">0.85</span>
</form>

</div>
<?php if ($_smarty_tpl->tpl_vars['check']->value==1){?>

   <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['end']->value-1+1 - (0) : 0-($_smarty_tpl->tpl_vars['end']->value-1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
	<div>
	<button id = "button<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" type = "button" value="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"  onclick = "showInfo(<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
)">Show Details</button>
	<a href = "<?php echo $_smarty_tpl->tpl_vars['urls']->value[$_smarty_tpl->tpl_vars['i']->value];?>
"><?php echo $_smarty_tpl->tpl_vars['urls']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</a>
	</div>
	<div id = "<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" style="display:none">
	   <ul style="list-style-type:none">
		<p>Image:</p>
		<li><img src = "<?php echo $_smarty_tpl->tpl_vars['images']->value[$_smarty_tpl->tpl_vars['i']->value];?>
" style = "width:50px;height:50px"></li>
		<br>
		<p>Categories:</p>
		<?php $_smarty_tpl->tpl_vars['j'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['j']->step = 1;$_smarty_tpl->tpl_vars['j']->total = (int)ceil(($_smarty_tpl->tpl_vars['j']->step > 0 ? $_smarty_tpl->tpl_vars['numOfEach']->value[$_smarty_tpl->tpl_vars['i']->value]-1+1 - (0) : 0-($_smarty_tpl->tpl_vars['numOfEach']->value[$_smarty_tpl->tpl_vars['i']->value]-1)+1)/abs($_smarty_tpl->tpl_vars['j']->step));
if ($_smarty_tpl->tpl_vars['j']->total > 0){
for ($_smarty_tpl->tpl_vars['j']->value = 0, $_smarty_tpl->tpl_vars['j']->iteration = 1;$_smarty_tpl->tpl_vars['j']->iteration <= $_smarty_tpl->tpl_vars['j']->total;$_smarty_tpl->tpl_vars['j']->value += $_smarty_tpl->tpl_vars['j']->step, $_smarty_tpl->tpl_vars['j']->iteration++){
$_smarty_tpl->tpl_vars['j']->first = $_smarty_tpl->tpl_vars['j']->iteration == 1;$_smarty_tpl->tpl_vars['j']->last = $_smarty_tpl->tpl_vars['j']->iteration == $_smarty_tpl->tpl_vars['j']->total;?>
		<li><?php echo $_smarty_tpl->tpl_vars['categories']->value[$_smarty_tpl->tpl_vars['i']->value][$_smarty_tpl->tpl_vars['j']->value];?>
</li>
		<?php }} ?>
		<br>
		<p>Summary:</p>
		<li><?php echo $_smarty_tpl->tpl_vars['infoboxes']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</li>
	   </ul>	
	</div>
   <?php }} ?>
	
<?php }?>
</body>




  </div>
  <script type="text/javascript" src="/static/js/main.js"></script>
</body>

</html>
<?php }} ?>