<?php

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

   $klein->respond('GET', '/ymneig/pa1/', function ($request, $response, $service) use ($smarty) {

	$con=mysql_connect("127.0.0.1", "group54", "group54")
	or die('Could not connect: ' .mysql_error());
        mysql_select_db("group54", $con);
        $query="SELECT username FROM User";
        $result=mysql_query($query);
	$num=mysql_num_rows($result);
	$i=0;
	$usernames= array();

        while ($i < $num)
	{
		$user=mysql_result($result, $i, "username");
		$usernames[]= $user;
		$i++;
	}

        $smarty->assign('usernames', $usernames);
        mysql_close(); 
 	$smarty->display('index.tpl');
   

});








   $klein->respond('GET', '/ymneig/pa1/pic\?[:id]?', function ($request, $response, $service) use ($smarty)
{ 
	$con=mysql_connect("127.0.0.1", "group54", "group54")
        or die('Could not connect: ' .mysql_error());
        mysql_select_db("group54", $con);
        $queryFormat= "select format from Photo where picid='".$_GET['id']."'";
	$result=mysql_query($queryFormat);
	$format=mysql_result($result, 0, "format");
	$pName=$_GET['id'] . "." . $format;

	// for going back to the album
	$queryAlbumid= "select albumid,caption from Contain where picid='".$_GET['id']."'";
	$result=mysql_query($queryAlbumid);
	$albumid=mysql_result($result, 0, "albumid");
	$picCaption=mysql_result($result, 0, "caption");
	$queryPicAlbum = "select picid from Contain where albumid = '".$albumid."' order by sequencenum";
	$resultPicAlbum = mysql_query($queryPicAlbum);
	$numPics = mysql_num_rows($resultPicAlbum);

	$pics = array();
	 for($i = 0;$i<$numPics;$i++)
        {
                $pic = mysql_result($resultPicAlbum,$i,"picid");
                $pics[] = $pic;              
	}
	$index = array_search($_GET['id'],$pics);
	$smarty->assign('picCaption', $picCaption);
	$smarty->assign('pName', $pName);
	$smarty->assign('albumid', $albumid);
	$smarty->assign('pics',$pics);
	$smarty->assign('index',$index);
	$smarty->assign('numPics',$numPics);
	mysql_close();
	     
	$smarty->display('pic.tpl');
});









   $klein->respond('GET', '/ymneig/pa1/album\?[:id]?', function ($request, $response, $service) use ($smarty) {

	$con=mysql_connect("127.0.0.1", "group54", "group54")
        or die('Could not connect: ' .mysql_error());
        mysql_select_db("group54", $con);
        $queryPicid= "select C.picid, C.caption, P.format from Contain C,Photo P where C.albumid='".$_GET['id']."' AND C.picid = P.picid order by C.sequencenum;";
        $resultPicid = mysql_query($queryPicid);
        $numPics = mysql_num_rows($resultPicid);
	$queryAlbumTitle = "select title from Album where albumid='".$_GET['id']."'";
	$albumtitle = mysql_query($queryAlbumTitle);
        $pics = array();
        $picIDs = array();
	
	$albumTitle=mysql_result($albumtitle,0,"title");  
	
        for($i = 0;$i<$numPics;$i++)
        {
                $pic = mysql_result($resultPicid,$i,"picid");
                $format = mysql_result($resultPicid,$i,"format");
                $pics[] = $pic . '.' . $format;
                $picIDs[] = $pic;              
       
	}

	
 	$numPicMod = $numPics % 5;	
        $smarty->assign('pics',$pics);
        $smarty->assign('picIDs',$picIDs);
        $smarty->assign('numPics',$numPics);
	$smarty->assign('numPicMod',$numPicMod); 
	$smarty->assign('albumID',$_GET['id']);
	$smarty->assign('albumTitle', $albumTitle);
        mysql_close();
        $smarty->display('album.tpl');


   
   });







   $klein->respond('GET','/ymneig/pa1/album/edit\?[:id]?', function ($request, $response, $service) use ($smarty) {
	
	$con=mysql_connect("127.0.0.1", "group54", "group54")
        or die('Could not connect: ' .mysql_error());
        mysql_select_db("group54", $con);
	$queryPicid= "select C.picid, C.caption, P.format from Contain C,Photo P where C.albumid='".$_GET['id']."' AND C.picid = P.picid order by C.sequencenum;"; 
	$resultPicid = mysql_query($queryPicid);
	$numPics = mysql_num_rows($resultPicid);
	$queryAlbumTitle = "select title from Album where albumid='".$_GET['id']."'";
        $albumtitle = mysql_query($queryAlbumTitle);
	$albumTitle=mysql_result($albumtitle,0,"title");  
	$pics = array();
	$picIDs = array();
	$captions=array();
	for($i = 0;$i<$numPics;$i++)
	{
		$pic = mysql_result($resultPicid,$i,"picid");
		$format = mysql_result($resultPicid,$i,"format");
		$pics[] = $pic . '.' . $format;
		$picIDs[] = $pic;
		$caption=mysql_result($resultPicid,$i,"caption");
		$captions[]=$caption;
	}
	
	$smarty->assign('pics',$pics);
	$smarty->assign('picIDs',$picIDs);
	$smarty->assign('numPics',$numPics);
     	$smarty->assign('albumID',$_GET['id']);
	$smarty->assign('captions',$captions);
	$smarty->assign('albumTitle', $albumTitle);
	mysql_close();
	$smarty->display('albumedit.tpl');
   });







   $klein->respond('POST', '/ymneig/pa1/album/edit\?[:id]?', function ($request, $response, $service) use ($smarty)
{
	$con=mysql_connect("127.0.0.1", "group54", "group54")
        or die('Could not connect: ' .mysql_error());
        mysql_select_db("group54", $con);
	
	
	if($_POST['op']=='delete')
	{
		list($picid,$picformat) = explode(".",$_POST['picid']);
		$queryDeleteContain="delete from Contain where picid='".$picid."' AND albumid='".$_GET['id']."';";
		mysql_query($queryDeleteContain);
		$queryDeletePhoto="delete from Photo where picid='".$picid."';";
		mysql_query($queryDeletePhoto);
		$queryUpdateAlbum="update Album set lastupdated=NOW() where albumid='".$_GET['id']."';";
		mysql_query($queryUpdateAlbum);
 		unlink("static/pictures/".$_POST['picid']);
	}


	if($_POST['op']=='Upload')
	{
		$timestamp=$_FILES["userfile"]["name"] . date("Y-m-d") . date("h:i:sa");
		$hashId=MD5($timestamp);
		list($name,$picformat) = explode(".",$_FILES["userfile"]["name"]);

       		if(move_uploaded_file($_FILES['userfile']['tmp_name'], "static/pictures/" . $hashId . "." . $picformat))
		{
		$url="/pictures/" . $hashId . "." . $picformat; 

		$queryAddPhoto="insert into Photo (picid, url, format, date) values ('".$hashId."','". $url."','".$picformat."', NOW())";
		mysql_query($queryAddPhoto);
		$queryAddAlbum="update Album set lastupdated=NOW() where albumid='".$_GET['id']."'";
		mysql_query($queryAddAlbum);
		$queryFindMaxSeq="select max(sequencenum) as maxSqu from Contain where albumid='".$_GET['id']."'";
		$result=mysql_query($queryFindMaxSeq);
		$seqNum=mysql_result($result, $i, "maxSqu");
		$seqNum=$seqNum+1;
		
		$queryAddContain="insert into Contain(albumid, picid, caption, sequencenum) values('".$_GET['id']."','".$hashId."', '".$name."', '".$seqNum."')";
		mysql_query($queryAddContain);
		}
 	 }

	
        $queryPicid= "select C.picid, C.caption, P.format from Contain C,Photo P where C.albumid='".$_GET['id']."' AND C.picid = P.picid order by C.sequencenum;";
        $resultPicid = mysql_query($queryPicid);
        $numPics = mysql_num_rows($resultPicid);
        $pics = array();
        $picIDs = array();
        $captions=array();
        for($i = 0;$i<$numPics;$i++)
        {
                $pic = mysql_result($resultPicid,$i,"picid");
                $format = mysql_result($resultPicid,$i,"format");
                $pics[] = $pic . '.' . $format;
                $picIDs[] = $pic;
                $caption=mysql_result($resultPicid,$i,"caption");
                $captions[]=$caption;
        }
        $smarty->assign('pics',$pics);
        $smarty->assign('picIDs',$picIDs);
        $smarty->assign('numPics',$numPics);
        $smarty->assign('albumID',$_GET['id']);
        $smarty->assign('captions',$captions);

	 mysql_close();
	 $smarty->display('albumedit.tpl');


});







   $klein->respond('GET', '/ymneig/pa1/albums\?[:username]?', function ($request, $response, $service) use ($smarty) {
     	$smarty->assign('name',$_GET['username']);

	$con=mysql_connect("127.0.0.1", "group54", "group54")
        or die('Could not connect: ' .mysql_error());
        mysql_select_db("group54", $con);
	$query = "SELECT title FROM Album WHERE username='".$_GET['username']."';";
	$result = mysql_query($query);
	$num = mysql_num_rows($result);

	$albumNames = array();
	
	for($i = 0;$i<$num;$i++)
	{
		$albumName = mysql_result($result,$i,"title");
		$albumNames[] = $albumName;
	}
	$smarty->assign('albumNames',$albumNames);
	mysql_close();
	$smarty->display('albums.tpl');
   });




   $klein->respond('GET', '/ymneig/pa1/albums/edit\?[:username]?', function ($request, $response, $service) use ($smarty)
   {
	$smarty->assign('name', $_GET['username']);
	$con=mysql_connect("127.0.0.1", "group54", "group54")
        or die('Could not connect: ' .mysql_error());
        mysql_select_db("group54", $con);
        $query = "SELECT albumid,title FROM Album WHERE username='".$_GET['username']."'";
        $result = mysql_query($query);
        $num = mysql_num_rows($result);

        $albumNames = array();  
  	$albumIDs = array();  
        for($i = 0; $i < $num ; $i++)
        {          
           $albumName = mysql_result($result,$i,"title");
	   $albumID = mysql_result($result, $i,"albumid");    
           $albumNames[] = $albumName;
	   $albumIDs[] = $albumID;
        } 
        $smarty->assign('albumNames',$albumNames);
	$smarty->assign('albumIDs',$albumIDs);
	$smarty->assign('num',$num);	
        mysql_close();
       $smarty->display('albumsedit.tpl');


   });




   $klein->respond('POST', '/ymneig/pa1/albums/edit\?[:username]?', function ($request, $response, $service) use ($smarty)
   {
       
        $smarty->assign('name', $_GET['username']);  
	$con=mysql_connect("127.0.0.1", "group54", "group54")
        or die('Could not connect: ' .mysql_error());
        mysql_select_db("group54", $con);

 	$picIDs=array();
	$titleAl= $_POST['title'];
	$titleLength = strlen($titleAl);
	if($_POST['op']=='delete')
	{


	   $query="select picid from Contain where albumid='".$_POST['albumid']."'";
	   $result=mysql_query($query);
	   $num=mysql_num_rows($result);
 	  
	   for($i = 0; $i < $num ; $i++)
           {
               $picID = mysql_result($result,$i,"picid");
               $picIDs[] = $picID;
           }
	

 
	  //  delete the albumid in contain table and in album table first
	   $query1="delete from Contain where albumid='".$_POST['albumid']."'";           	          
           mysql_query($query1);	
	   $query2="delete from Album where albumid='".$_POST['albumid']."'";           
	   mysql_query($query2);

	   for($i=0; $i<$num; $i++)
	   {

	      $query3="delete from Photo where picid='".$picIDs[$i]."'";
              mysql_query($query3);

	   }



	}
  
        else if($_POST['op']=='add'and $titleLength > 0 )
	{
         
            $queryInsert="INSERT INTO Album (title, created, lastupdated,username) VALUES ('".$_POST['title']."', NOW(), NOW(),'".$_POST['username']."')";
	    mysql_query($queryInsert);	
	    	

	}

	$queryAlbum = "SELECT albumid,title FROM Album WHERE username='".$_GET['username']."'";
        $resultAlbum = mysql_query($queryAlbum);
        $numAlbum = mysql_num_rows($resultAlbum);

        $albumNames = array();
        $albumIDs = array();
        for($i = 0; $i < $numAlbum ; $i++)
        {
           $albumName = mysql_result($resultAlbum,$i,"title");
           $albumID = mysql_result($resultAlbum, $i,"albumid");
           $albumNames[] = $albumName;
           $albumIDs[] = $albumID;
        }
        $smarty->assign('albumNames',$albumNames);
        $smarty->assign('albumIDs',$albumIDs);
        $smarty->assign('num',$numAlbum);


      
        mysql_close();
        $smarty->display('albumsedit.tpl');

	   // Haven't dropped yje photo yet


   });
	
   $klein->dispatch();

?>
