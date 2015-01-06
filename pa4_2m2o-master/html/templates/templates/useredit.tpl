{* Smarty *}
{extends 'base.tpl'}
{block name='body'}
<head>
<title>User Edit</title>
<meta charset="UTF-8">
<style>

div.header{
width: 850px;
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

body{
        background-color:linen;
        font-family:"Times New Roman";
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

.div2{
width:700px;
float:left;
}
</style>
<script>
	function checkValid()
	{
		var p1=document.getElementById("pwd1").value;
		var p2=document.getElementById("pwd2").value;
		if(p1!=p2)
		{
			alert("Password doesn't match!");
		}
	}
 
</script>
</head>

<body>
<div class="hmenu">
<ul>
  <li><a href="/ymneig/pa4/">Home</a></li>
  <li><a href="/ymneig/pa4/user/edit">Edit Account</a></li>
  <li><a href="/ymneig/pa4/albums/edit?username={$username}">My Albums</a></li>
  <li><a href="/ymneig/pa4/logout">Log Out</a></li>
</ul>
</div>
<div class = "header">
<p class="title">Edit your account</p>
<p class="login">Logged in as {$username}</p>

<div class = "div2">
{if $checkResult eq 1}
<p>Password doesn't match!</p>
{/if}
<form method = "POST" action = "/ymneig/pa4/user/edit">
<table>
<tr><td>Username:</td>
        <td><input type = "text" value = "{$username}" disabled = "true"></td>
        </tr>
   <tr>
        <td>First Name:</td>
        <td><input type = "text" value = "{$firstname}" name = "firstN"></td>
   </tr>
   <tr>
        <td>Last Name:</td>
        <td><input type = "text" value = "{$lastname}" name = "lastN"></td>
   </tr>
   <tr>
        <td>Email:</td>
        <td><input type = "text" value = "{$email}" name = "email"></td>
   </tr>
   <tr>
        <td>Password(*):</td>
        <td><input id = "pwd1" type = "password" value= "{$password}" title = "Password must be between 5 to 15 characters,including at least one digit and at least one letter. Password can only have letters, digits and underscores"{literal} required pattern = "(?=(.*[0-9]+))(?=(.*[A-Za-z]+))[0-9A-Za-z_]{5,15}"{/literal} name = "pwd1"></td>
   </tr>
   <tr>
        <td>Confirm Password(*):</td>
        <td><input id = "pwd2" type = "password" value = "{$password}"  {literal} required pattern = "(?=(.*[0-9]+))(?=(.*[A-Za-z]+))[0-9A-Za-z_]{5,15}" {/literal} title = "Please enter the same password as above" onblur="checkValid()" name = "pwd2"></td>
   </tr>
   <tr>
        <td>
        <input type = "submit" value = "Edit" name = "login">
        </td>
   </tr>   
   <tr>
	<td>
	<br>
	<br>
	<a href="/ymneig/pa4/user/delete">Delete User Account</a>
	<td>
   </tr>
</table>
</form>
</div>
</body>


{/block}
