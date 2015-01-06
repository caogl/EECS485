<?php

   //set the default time zone
   date_default_timezone_set('America/Detroit');
   session_save_path("/var/www/html/group54/admin/pa6/php/session");
   session_start();
   // Include the Smarty Templating Engine
   define('SMARTY_DIR', __DIR__ . '/Smarty-3.1.14/libs/');
   require_once(SMARTY_DIR . 'Smarty.class.php');
   $smarty = new Smarty();

   $smarty->setTemplateDir(__DIR__ . '/templates/templates/');
   $smarty->setCompileDir(__DIR__ . '/templates/templates_c/');
   $smarty->setConfigDir(__DIR__ . '/templates/configs/');
   $smarty->setCacheDir(__DIR__ . '/templates/cache/');

   // Notice how you can set variables here in the PHP that will get carried into the template files
   $smarty->assign('title', "EECS485");


   // Setup the Routing Framework
   require_once __DIR__ . '/vendor/autoload.php';
   $klein = new \Klein\Klein();


   /* Define routes here */






/*--------------------------INDEX------------------------------------*/



   $klein->respond('GET', '/ymneig/pa6/', function ($request, $response, $service) use ($smarty) {
        session_save_path("/var/www/html/group54/admin/pa6/php/session");
	session_start();
	
 
	$con=mysql_connect("127.0.0.1", "group54", "group54") or die('Could not connect: ' .mysql_error());
        mysql_select_db("group54pa2", $con);
	$currentTime=time();
      
	if(isset($_SESSION['userName']) AND $currentTime-$_SESSION['lastActivity']<=300)
	{
	$_SESSION['lastActivity']=time();


		$query="SELECT username,title,albumid FROM Album where access='public' OR (access='private' AND albumid in (SELECT albumid from AlbumAccess where username='".$_SESSION['userName']."' )) OR (username = '".$_SESSION['userName']."') order by username";
                $result=mysql_query($query);
                $num=mysql_num_rows($result);
                $i=0;
                $usernames= array();
                $albums =array();
                $albumids = array();
                while ($i < $num)
                {
                        $user=mysql_result($result, $i, "username");
                        $album = mysql_result($result,$i,"title");
                        $albumid = mysql_result($result,$i,"albumid");
                        $usernames[]= $user;
                        $albums[] = $album;
                        $albumids[] = $albumid;
                        $i++;        
                }
        	$smarty->assign('username',$_SESSION['userName']);
                $smarty->assign('loggedin',1);
                $smarty->assign('albums',$albums);
                $smarty->assign('numAlbum',$num);
                $smarty->assign('usernames', $usernames);
                $smarty->assign('albumids',$albumids);

	}
	else
      	{
		session_destroy();	
        	$query="SELECT username,title,albumid FROM Album where access = 'public' order by username";
        	$result=mysql_query($query);
		$num=mysql_num_rows($result);
		$i=0;
		$usernames= array();
		$albums =array();
        	$albumids = array();
		while ($i < $num)
		{
			$user=mysql_result($result, $i, "username");
			$album = mysql_result($result,$i,"title");
			$albumid = mysql_result($result,$i,"albumid");
			$usernames[]= $user;
			$albums[] = $album;
			$albumids[] = $albumid;
			$i++;
	
		}
	
		$smarty->assign('loggedin',0);
        	$smarty->assign('albums',$albums);
		$smarty->assign('numAlbum',$num);
		$smarty->assign('usernames', $usernames);
        	$smarty->assign('albumids',$albumids);
	}
	mysql_close(); 
 	$smarty->display('index.tpl');
});


 

/*-------------------------------- Get search----------------------------------*/
$klein->respond('GET', '/ymneig/pa6/search', function ($request, $response, $service) use ($smarty) {
	$smarty->assign('check',0);
        
        $smarty->display('search.tpl');
});

/*--------------------------------Post search----------------------------------*/
$klein->respond('POST', '/ymneig/pa6/search', function ($request, $response, $service) use ($smarty) {

	
	$con=mysql_connect("127.0.0.1", "group54", "group54") or die('Could not connect: ' .mysql_error());
        mysql_select_db("group54pa2", $con);
	if($_POST['submit']=='Search')
	{
		require "server.php";
		$query = $_POST['query'];
		$w = $_POST['weight'];
		$myResults = queryIndex(6054,"localhost",$query, $w);
		$urls = array();
		$images = array();
		$categories = array();
		$infoboxes = array();
		$numOfEach = array();	
		//first ten on first page
		$end = min(10, sizeof($myResults));
		for( $i = 0; $i < $end; $i++) 
		{
			$id = $myResults[$i]["id"];
			$queryUrl = "select pageUrl from PageUrl where pageID = '".$id."';";
			$result = mysql_query($queryUrl);
			$url = mysql_result($result, 0, "pageUrl");
			$urls[] = $url;
		}
		
		for($i = 0;  $i < $end; $i++)           
                {
                        $id = $myResults[$i]["id"];
                        $queryImage = "select pageFirst from Image where pageID = '".$id."';";
                        $result = mysql_query($queryImage);
                        $image = mysql_result($result, 0, "pageFirst");
			$images[] = $image;
                }
		
		for($i = 0;  $i < $end; $i++)
                {
                        $id = $myResults[$i]["id"];
                        $queryCat = "select category from Category where pageID = '".$id."';";
                        $result = mysql_query($queryCat);
			$num=mysql_num_rows($result);
			$numOfEach[] = $num;
			$cateOfEach = array();
			for($j = 0;$j<$num;$j++)
			{		
                        	$cateOfEach[] = mysql_result($result,$j , "category");
                        }
			$categories[] = $cateOfEach;
               
		}

		for($i = 0;  $i < $end; $i++)
                {
                        $id = $myResults[$i]["id"];
                        $queryInfo = "select info from InfoBox where pageID = '".$id."';";
                        $result = mysql_query($queryInfo);
                        $num=mysql_num_rows($result);
			if($num==0)
			{
				$infoboxes[] = "Information too long";
			}
			else
			{
				$info = mysql_result($result, 0, "info");
                        	$infoboxes[] = $info;
			}
                }

	}
	

	$smarty->assign('infoboxes', $infoboxes);
	$smarty->assign('categories', $categories);
	$smarty->assign('end', $end);
	$smarty->assign('images', $images);
	$smarty->assign('numOfEach',$numOfEach);
	$smarty->assign('urls', $urls);
	$smarty->assign('check',1);
        $smarty->display('search.tpl');
});





	
   $klein->dispatch();

?>
