{* Smarty *}
{extends 'base.tpl'}
{block name='body'}
<head>
<style>
body{
background-color: linen;
}
h1{

color:maroon;
font-weight:bold;
}

p1{
font-weight:bold;
color:maroon;
}
</style>
<div>
   <h1>Search Images</h1>
</div>
<div>
   <form method = "POST" action = "/ymneig/pa4/search">
   <input type = "text" name = "query">
   <input type = "submit" name = "submit" value = "Search">
   </form>
</div>


{if $check eq 1}
<div>
<br>
<br>
<p1>Total matched: {$num}</p1>
</div>
<div>
    <ul>
   {$i = 0}
    {while $i < $num}
       <form method = "POST" action = "/ymneig/pa4/search" id = "myform">
	<li>
	<p> {$captions[$i]}</p>
	<input type = "image" src="/static/{$urls[$i]}" style="width:120px;height:120px" alt = "Submit"/>
	<input type = "hidden" name = "caption" value = "{$captions[$i]}">
	<input type = "hidden" name = "clickImg" value = "true">
	</li>
	</form>
     {$i = $i+1}
     {/while}	
     </ul>
</div>
{/if}



{/block}

