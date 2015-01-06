{* Smarty *}
{extends 'base.tpl'}
{block name='body'}
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
<h1>Edit {$albumTitle}</h1>


<table border = "1">

{$i = 0}
{while $i<$numPics}
	<tr>
	<td>
            <form method = "POST" action = "/ymneig/pa1/album/edit?id={$albumID}">
 	    <a href = "/ymneig/pa1/pic?id={$picIDs[$i]}"><img src="/static/pictures/{$pics[$i]}" style="width:304px;height:228px"></a>

	    <p align="center"><input type="submit" value ="delete" name="op"/>{$captions[$i]}</p>
	    <input type="hidden" value ="{$pics[$i]}" name="picid" />
	    {$i = $i+1}
	    </form></td>
	{if $i eq $numPics}
	{continue}
        {/if}
	<td>
 		<form method = "POST" action = "/ymneig/pa1/album/edit?id={$albumID}">
 	        <a href = "/ymneig/pa1/pic?id={$picIDs[$i]}"><img src="/static/pictures/{$pics[$i]}" style="width:304px;height:228px"></a>
		<p align="center"><input type="submit" value ="delete" name="op"/>{$captions[$i]}</p>
		<input type="hidden" value ="{$pics[$i]}" name="picid" />
		{$i =$i+1}
		</form></td>
	{if $i eq $numPics}
	{continue}
	{/if}
	<td>
	 	<form method = "POST" action = "/ymneig/pa1/album/edit?id={$albumID}">
	        <a href = "/ymneig/pa1/pic?id={$picIDs[$i]}"><img src="/static/pictures/{$pics[$i]}" style="width:304px;height:228px"></a>
		<p align="center"><input type="submit" value ="delete" name="op"/>{$captions[$i]}</p>
		<input type="hidden" value ="{$pics[$i]}" name="picid" />
		{$i = $i+1}
		</form></td>
	</tr>	
{/while}
	<tr>
	<td class = "upload" colspan = "3" align="center">
		<form enctype="multipart/form-data" action="/ymneig/pa1/album/edit?id={$albumID}" method="POST">
		Upload New Photo: <input name="userfile" type="file" />
    		<input type="submit" value="Upload" name="op" />
		</form>	
		</td>
	</tr>
</table>


</body>


{/block}

