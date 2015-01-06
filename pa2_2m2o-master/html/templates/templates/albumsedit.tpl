{* Smarty *}
{extends 'base.tpl'}
{block name='body'}
<head>
<style>
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

body{
   background-color:linen;
   font-family:"Times New Roman"
}
td{
   padding: 5px;
   font-weight:bold;
   padding-top:5px;
   text-align:center;
   font-size:30px;
}
a{
   text-decoration:none;
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
<div class = "header">
<p class = "title">Edit Albums</p>
<p class = "login">Logged in as {$username}</p>
</div>
<div class = "header">
     <table border=1>   
         <tr>
             <td>Album</td>	
             <td>Access</td>
	     <td>Edit</td>
             <td>Delete</td>
         </tr>
  {for $i = 0 to $num-1}      
         <tr>
	  <td><a href="/ymneig/pa2/album?id={$albumIDs[$i]}">{$albumNames[$i]}</a></td>
	  <td>{$albumAccess[$i]}</td>
	  <td><a href="/ymneig/pa2/album/edit?id={$albumIDs[$i]}">Edit</a></td>	 
          <td><form method="POST" action= "/ymneig/pa2/albums/edit?username={$username}">
	      <input type="submit"  value="delete" name="op">
	      <input type ="hidden" value ="{$albumIDs[$i]}" name ="albumid">
	      </form>	
	  </td>
         </tr>
   {/for}        
	  <tr>
             <td>	     
             <form method="POST" action= "/ymneig/pa2/albums/edit?username={$username}">
		<input type ="hidden" value = "add" name="op"> 
		<input type ="hidden" value = "{$username}" name ="username">
		<input name="title" type="text" /> 
		<input type="submit" value="add" />
	     </td>
	     </form>
          </tr>       
</table>
</div>
</body>
{/block}
