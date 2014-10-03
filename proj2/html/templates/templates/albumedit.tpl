{* Smarty *}
{extends 'base.tpl'}
{block name='body'}
<head>
<style>
.div2{
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


body{
background-color:linen;
font-family:"Time New Roman";

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

<div class="hmenu">
<ul>
  <li><a href="/ymneig/pa2/">Home</a></li>
  <li><a href="/ymneig/pa2/user/edit">Edit Account</a></li>
  <li><a href="/ymneig/pa2/albums/edit?username={$username}">My Albums</a></li>
  <li><a  href = "/ymneig/pa2/logout">Log Out</a></li>
</ul>
</div>
<div class = "div2">
<p class = "title">Edit {$albumTitle}</p>
<p class = "login">Logged in as {$username}</p>
</div>
<div class = "div2">
   <form method ="POST" action="/ymneig/pa2/album/edit?id={$albumID}">
	<table>
	   <tr>
	   <td>Album Name:</td>
	   <td><input type = "text" value = "{$albumTitle}" name = "albumTitle"></td>
	   </tr>
	   <tr>
           <td>Album Permission:</td>
	{if $permission eq public}
           <td><input type = "radio" value = "public" name = "access" checked = "true">Public</td>
	   <td><input type = "radio" value = "private" name = "access">Private</td>
	   </tr>
	{else}
	<td><input type = "radio" value = "public" name = "access">Public</td>
           <td><input type = "radio" value = "private" name = "access" checked = "true">Private</td>
           </tr>
	{/if}
	   <tr>
           <td>If Private, allow access to :</td>
		{for $i = 0 to $numPrivateAc-1}
           <td><input type = "checkbox" value = "{$privateAc[$i]}" name = "permission[]" checked = "true">{$privateAc[$i]}</td>
		{/for}
           	{for $i = 0 to $numUsers-1}
           <td><input type = "checkbox" value = "{$usernames[$i]}" name = "permission[]">{$usernames[$i]}</td>
                {/for}
	   </tr>
	
	<tr>
	   <td><input type = "submit" name = "submit" value = "Make change"></td>
	</tr>
	</table>
   </form>
</div>
<div class = "div2">
<table border = "1">
<br>
<br>
{$i = 0}
{while $i<$numPics}
	<tr>
	<td>
            <form method = "POST" action = "/ymneig/pa2/album/edit?id={$albumID}">
 	    <a href = "/ymneig/pa2/pic?id={$picIDs[$i]}"><img src="/static/pictures/{$pics[$i]}" style="width:304px;height:228px"></a>

	    <p align="center"><input type="submit" value ="delete" name="op"/>{$captions[$i]}</p>
	    <input type="hidden" value ="{$pics[$i]}" name="picid" />
	    {$i = $i+1}
	    </form></td>
	{if $i eq $numPics}
	{continue}
        {/if}
	<td>
 		<form method = "POST" action = "/ymneig/pa2/album/edit?id={$albumID}">
 	        <a href = "/ymneig/pa2/pic?id={$picIDs[$i]}"><img src="/static/pictures/{$pics[$i]}" style="width:304px;height:228px"></a>
		<p align="center"><input type="submit" value ="delete" name="op"/>{$captions[$i]}</p>
		<input type="hidden" value ="{$pics[$i]}" name="picid" />
		{$i =$i+1}
		</form></td>
	{if $i eq $numPics}
	{continue}
	{/if}
	<td>
	 	<form method = "POST" action = "/ymneig/pa2/album/edit?id={$albumID}">
	        <a href = "/ymneig/pa2/pic?id={$picIDs[$i]}"><img src="/static/pictures/{$pics[$i]}" style="width:304px;height:228px"></a>
		<p align="center"><input type="submit" value ="delete" name="op"/>{$captions[$i]}</p>
		<input type="hidden" value ="{$pics[$i]}" name="picid" />
		{$i = $i+1}
		</form></td>
	</tr>	
{/while}
	<tr>
	<td class = "upload" colspan = "3" align="center">
		<form enctype="multipart/form-data" action="/ymneig/pa2/album/edit?id={$albumID}" method="POST">
		Upload New Photo: <input name="userfile" type="file" />
    		<input type="submit" value="Upload" name="op" />
		</form>	
		</td>
	</tr>
	
</table>
</div>

</body>


{/block}

