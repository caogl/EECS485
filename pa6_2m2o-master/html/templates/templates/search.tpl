{* Smarty *}
{extends 'base.tpl'}
{block name='body'}
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
{if $check eq 1}

   {for $i = 0 to $end-1}
	<div>
	<button id = "button{$i}" type = "button" value="{$i}"  onclick = "showInfo({$i})">Show Details</button>
	<a href = "{$urls[$i]}">{$urls[$i]}</a>
	</div>
	<div id = "{$i}" style="display:none">
	   <ul style="list-style-type:none">
		<p>Image:</p>
		<li><img src = "{$images[$i]}" style = "width:50px;height:50px"></li>
		<br>
		<p>Categories:</p>
		{for $j = 0 to $numOfEach[$i]-1}
		<li>{$categories[$i][$j]}</li>
		{/for}
		<br>
		<p>Summary:</p>
		<li>{$infoboxes[$i]}</li>
	   </ul>	
	</div>
   {/for}
	
{/if}
</body>



{/block}

