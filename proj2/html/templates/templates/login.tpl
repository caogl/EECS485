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

<h1>User Login</h1>
</head>
<body>
{if $loggedin eq 0}
<p>Invalid username or password! Please try again!</p>
{/if}
<form method = "POST" action="/ymneig/pa2/login">
   <table>
   <tr>
      <td>Username:</td>
      <td><input type = "text" name = "username"></td>
   </tr>
   
   <tr>
      <td>Password:</td> 
      <td><input type = "password" name = "password"></td>
   </tr>
   
   <tr>
      <td><input type = "submit" value = "Log In" name = "submit"></td>
      <td align = "right"><input type = "submit" value = "Cancel" name = "submit"></td>
   </tr>
   </table>

</form>

</body>
{/block}

