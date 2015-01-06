{* Smarty *}
{extends 'base.tpl'}
{block name='body'}
<head>
<title>Index Page</title>
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
p.center{
font-weight:bold;
padding-top: 20px;
padding-bottom:20px;
text-align:left;
}
body{
	background-color:linen;
	font-family:"Times New Roman";
}
footer{
color:maroon;
font-size:15px;
}
.div2{
float:left;
display:block;
width:850px;
}
ul
{
list-style-type:square;
padding:5px;
}
a{
text-decoration:none;
}
li{
padding-bottom: 5px;
}
p1{
font-size: 30px;
color:purple;
font-weight:bold;
}
.tb{
font-size:25px;}
td{
padding-left:10px;
padding-right:10px;
padding-top:10px;
padding-bottom:10px;
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

</style>
</head>


<body>

	<div class="hmenu">
	<ul>
  		<li><a href="/ymneig/pa6/">Home</a></li>
  	</ul>

	</div>




<div class = "div2">
	<p class = "center">
 	This website allows users to create, browse and edit albums
	</p>
</div>


</body>

<div class = "div2">
	<br>
	<br>
	<footer>
	Posted by Ying He, Astin Teferi, Guanglei Cao
	</footer>
</div>

{/block}
