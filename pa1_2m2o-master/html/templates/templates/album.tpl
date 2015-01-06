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
</style>
<h1>{$albumTitle}</h1>
</head>
<body>
<p class="important">
</p>
{$i = 0}
<table>
        {while $i<($numPics-$numPicMod)}
        <tr>
                {for $j=0 to 4}
                <td><a href = "/ymneig/pa1/pic?id={$picIDs[$i]}"><img src="/static/pictures/{$pics[$i]}" style="width:80px;height:80px"></a></td>
                {$i = $i+1}
		{/for}
        </tr>
        {/while}
        <tr>
                {for $k=0 to $numPicMod-1}
                <td><a href = "/ymneig/pa1/pic?id={$picIDs[$i]}"><img src="/static/pictures/{$pics[$i]}" style="width:80px;height:80px"></a></td>
                {$i = $i+1}
		{/for}

        </tr>
</table>

</body>
{/block}
