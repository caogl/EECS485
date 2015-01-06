{* Smarty *}
{extends 'base.tpl'}
{block name='body'}
<head>
<style>
body
{
   background-color:linen;
   font-family:"Times New Roman";
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

a{
   text-decoration:none;

}
</style>
</head>


<body>
{if $loggedin eq 1}
        <div class="hmenu">
        <ul>
                <li><a href="/ymneig/pa4/">Home</a></li>
                <li><a href="/ymneig/pa4/user/edit">Edit Account</a></li>
                <li><a href="/ymneig/pa4/albums/edit?username={$username}">My Albums</a></li>
                <li><a  href = "/ymneig/pa4/logout">Log Out</a></li>
        </ul>
        </div>
        <div class = "header">
                <p class = "title">{$picCaption}</p>
                <p class = "login">Logged in as {$username}</p>
        </div>
{else}
        <div class = "header">
                <p class = "title">{$picCaption}</p>
        </div>
{/if}



<p>
<img src="/static/pictures/{$pName}" style="width:700:300px;height:600:128px"
</p> 

<p>
	{$a = $index-1}
	{$b = $index+1}
	{if $index > 0}
		<a href = "/ymneig/pa4/pic?id={$pics[$a]}">&lt&ltPrev</a>
		&nbsp;&nbsp;&nbsp;
	{/if}
	{if $index<$numPics-1}
		<a href = "/ymneig/pa4/pic?id={$pics[$b]}">Next>></a>
	{/if}
</p>
{if $permission eq 1} 
	<p><a align="left" href="/ymneig/pa4/album/edit?id={$albumid}">Back to Edit Album</a></p>
{/if}
<p><a align="left" href="/ymneig/pa4/album?id={$albumid}">Back to Album</a></p>
</body>
{/block}
