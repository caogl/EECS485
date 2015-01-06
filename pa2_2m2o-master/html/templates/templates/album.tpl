{* Smarty *}
{extends 'base.tpl'}
{block name='body'}
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
{if $loggedin eq 1}
	<div class="hmenu">
	<ul>
  		<li><a href="/ymneig/pa2/">Home</a></li>
  		<li><a href="/ymneig/pa2/user/edit">Edit Account</a></li>
  		<li><a href="/ymneig/pa2/albums/edit?username={$username}">My Albums</a></li>
  		<li><a  href = "/ymneig/pa2/logout">Log Out</a></li>
	</ul>
	</div>
	<div class = "header">
		<p class = "title">{$albumTitle} by {$owner}</p>
		<p class = "login">Logged in as {$username}</p>
	</div>
{else}
	<div class = "header">
		<p class = "title">{$albumTitle} by {$owner}</p>
	</div>
{/if}

<div class = "header">
{$i = 0}
<table border = "1">
        {while $i<($numPics-$numPicMod)}
        <tr>
                {for $j=0 to 4}
                <td>
		<p class ="small">{$captions[$i]}</p>
		<a href = "/ymneig/pa2/pic?id={$picIDs[$i]}"><img src="/static/pictures/{$pics[$i]}" style="width:120px;height:120px"></a>
                <p class = "small">{$dates[$i]}</p>
		</td>
		{$i = $i+1}
		{/for}
        </tr>
        {/while}
        <tr>
                {for $k=0 to $numPicMod-1}
                <td>
		<p class = "small">{$captions[$i]}</p>
		<a href = "/ymneig/pa2/pic?id={$picIDs[$i]}"><img src="/static/pictures/{$pics[$i]}" style="width:120px;height:120px"></a>
                <p class = "small">{$dates[$i]}</p>
		</td>
		{$i = $i+1}
		{/for}

        </tr>
</table>
</div>
{if $loggedin eq 0}
<div class = "header">
   	<p><a href = "/ymneig/pa2/">Back to home page</a></p>
</div>
{/if}
</body>
{/block}
