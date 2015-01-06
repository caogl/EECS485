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
<script>
	function checkValid()
	{
	     var e = document.getElementById("pwd1");
	     var d = document.getElementById("pwd2");
	     if(e.value != d.value)
	     {
		alert("Password doesn't match!");	
	     }
	}
</script>
<h1>Create a New Account</h1>
<body>
{if $checkResult eq 1}
<p>Password doesn't match! Please try again!</p>
{else if $checkResult eq 2}
<p>User name already exists! Please try again!</p>
{/if}
<form method = "POST" action = "/ymneig/pa2/user">
<table>
   <tr>
	<td>Username(*):</td>
	
	<td>{literal}<input type = "text" title = "Username must contain at least 3 characters and can include letters, digits and underscores" name = "username" required pattern ="[A-Za-z0-9_]{3,}">{/literal}</td>
	</tr>
   <tr>
        <td>First Name:</td>
        <td><input type = "text" name = "firstN"></td>
   </tr>
   <tr>
        <td>Last Name:</td>
        <td><input type = "text" name = "lastN"></td>
   </tr>
   <tr>
        <td>Email:</td>
        <td><input type = "text" name = "email"></td>
   </tr>
   <tr>
        <td>Password(*):</td>
	
        <td>{literal}<input id = "pwd1" type = "password" title = "Password must be between 5 to 15 characters,including at least one digit and at least one letter. Password can only have letters, digits and underscores" required pattern = "(?=(.*[0-9]+))(?=(.*[A-Za-z]+))[0-9A-Za-z_]{5,15}" name = "pwd1">{/literal}</td>
   </tr>
   <tr>
        <td>Confirm Password(*):</td>
        <td>{literal}<input id = "pwd2" type = "password" required pattern = "(?=(.*[0-9]+))(?=(.*[A-Za-z]+))[0-9A-Za-z_]{5,15}" title = "Please enter the same password as above" onblur="checkValid()" name = "pwd2">{/literal}</td>
   </tr>
   <tr>
   	<td>
	<input type = "submit" value = "Create" name = "login">
	</td>
   </tr>

</table>
</form>
<br>
<br>
<a href = "/ymneig/pa2/">Go Back to Homepage</a>
</body>
{/block}
