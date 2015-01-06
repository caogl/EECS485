{* Smarty *}
{extends 'base.tpl'}
{block name='body'}
<head>
<style>
body
{
background-color:linen;
font-size:30px;
}
h1{
font-size:40px;
font-weight:bold;
color:maroon;
}
a{
text-decoration:none;

}
</style>
</head>
<body>
<h1>{$picCaption}</h1>
<p class="important">
<img src="/static/pictures/{$pName}" style="width:1000px;height:800:228px"></p>
<p>
{$a = $index-1}
{$b = $index+1}
{if $index>0}
<a href = "/ymneig/pa1/pic?id={$pics[$a]}">&lt&ltPrev</a>
&nbsp;&nbsp;&nbsp;
{/if}
{if $index<$numPics-1}
<a href = "/ymneig/pa1/pic?id={$pics[$b]}">Next>></a>
{/if}
</p>
<p><a align="left" href="/ymneig/pa1/album/edit?id={$albumid}">Back to Edit Album</a></p>
<p><a align="left" href="/ymneig/pa1/album?id={$albumid}">Back to Album</a>
</p>
</body>
{/block}
