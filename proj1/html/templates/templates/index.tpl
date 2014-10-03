{* Smarty *}
{extends 'base.tpl'}
{block name='body'}
<head>
<title>Index Page</title>
<meta charset="UTF-8">
<style>
header{
	font-family:"Times New Roman";
	font-size: 40px;
	color: maroon;
	font-weight: bold;
}
p.center{
font-weight:bold;
padding-top: 4px;
padding-bottom:20px;
}
body{
	background-color:linen;
	font-family:"Times New Roman";
}
footer{
color:maroon;
font-size:15px;
}
ul
{
list-style-type:square;
padding:5px;
}
a{
text-decoration:none;
font-size: 30px;
}
li{
padding-bottom: 5px;
}
p1{
font-size: 30px;
color:purple;
font-weight:bold;
}
</style>
</head>
<body>
<header>Build Your Photo Albums</header>
<p class="center">
  This website allows users to create, browse and edit albums.
</p>
<p1>Usernames</p1>
<ul>
{foreach from=$usernames item=foo}
<li><a href ="/ymneig/pa1/albums?username={$foo}">{$foo}</a></li>
{/foreach}
</ul>
</body>
<footer>
Posted by Ying He, Astin Teferi, Guanglei Cao
</footer>
{/block}
