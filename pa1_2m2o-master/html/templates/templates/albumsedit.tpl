{* Smarty *}
{extends 'base.tpl'}
{block name='body'}
<head>
<style>
h1{
font-family:"Times New Roman";
font-size:40px;
color: maroon;
}
body{
background-color:linen;
font-family:"Times New Roman"
}
td{
padding: 5px;
font-weight:bold;
text-align:center;
font-size:30px;
}
a{
text-decoration:none;
}
</style>
<h1>EDIT ALBUMS</h1>
</head>
<body>
     <table border=1>   
         <tr>
             <td>Album</td>
             <td>Edit</td>
             <td>Delete</td>
         </tr>
  {for $i = 0 to $num-1}      
         <tr>
	  <td><a href="/ymneig/pa1/album?id={$albumIDs[$i]}">{$albumNames[$i]}</a></td>
	  <td><a href="/ymneig/pa1/album/edit?id={$albumIDs[$i]}">Edit</a></td>	 
          <td><form method="POST" action= "/ymneig/pa1/albums/edit?username={$name}">
	      <input type="submit"  value="delete" name="op">
	      <input type ="hidden" value ="{$albumIDs[$i]}" name ="albumid">
	      </form>	
	  </td>
         </tr>
   {/for}        
	  <tr>
             <td>	     
             <form method="POST" action= "/ymneig/pa1/albums/edit?username={$name}">
		<input type ="hidden" value = "add" name="op"> 
		<input type ="hidden" value = "{$name}" name ="username">
		<input name="title" type="text" /> 
		<input type="submit" value="add" />
	     </td>
	     </form>
          </tr>       
</table>
</body>
{/block}
