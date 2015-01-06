{* Smarty *}
{extends 'base.tpl'}
{block name='body'}
<head>
<style>
body{
background-color:linen;
font-size:30px;
font-family:"Times New Roman";
}
p{
font-weight:bold;
font-size:40px;
color:maroon;
}
ul{
list-style-type:square;
}
a{
text-decoration:none;
}
</style>
</head>
<body>
<p class="important">
 Welcome {$name}
</p>
<ul>
{foreach from=$albumNames item=foo}
<li><a href ="/ymneig/pa1/albums/edit?username={$name}">{$foo}</a></li>
{/foreach}
</ul>
</body>
{/block}
