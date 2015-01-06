<?php

   //set the default time zone
   date_default_timezone_set('America/Detroit');
   session_save_path("/var/www/html/group54/admin/pa2/php/session");
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



   $klein->respond('GET', '/ymneig/pa2/', function ($request, $response, $service) use ($smarty) {
        session_save_path("/var/www/html/group54/admin/pa2/php/session");
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


 




/*-----------------------------------login--------------------------------*/
$klein->respond('GET', '/ymneig/pa2/login', function ($request, $response, $service) use ($smarty) {


        $con=mysql_connect("127.0.0.1", "group54", "group54") or die('Could not connect: ' .mysql_error());
        mysql_select_db("group54pa2", $con);
	$smarty->assign('loggedin',1);
	mysql_close();
	$smarty->display('login.tpl');
});

/*--------------------------------------login-POST------------------------*/
$klein->respond('POST', '/ymneig/pa2/login', function ($request, $response, $service) use ($smarty)
{
	session_save_path("/var/www/html/group54/admin/pa2/php/session");
	session_start();

	$con=mysql_connect("127.0.0.1", "group54", "group54") or die('Could not connect: ' .mysql_error());
        mysql_select_db("group54pa2", $con);
	
	if($_POST['submit']=='Cancel')
	{
		$response->redirect('/ymneig/pa2/')->send();			
	}
	else
	{
	   $username = $_POST['username'];
	   $password = $_POST['password'];
	   $queryCheck = "select * from User where username =  '".$username."'AND password = '".$password."';";
	   $resultCheck = mysql_query($queryCheck);
	   $numCheck = mysql_num_rows($resultCheck);	

	   //if LOGIN is SUCCESSFUL 	
	   if($numCheck!= 0)
	   {
		$_SESSION['userName']=$username;
		$_SESSION['lastActivity']=time();
		$response->redirect('/ymneig/pa2/')->send();
	   }
           //if username and password don't match
           else
	   {
		$smarty->assign('loggedin',0);
		$smarty->display('login.tpl');
	   }
	}
	mysql_close();
});


/*---------------------------------------log out -------------------------------*/
$klein->respond('GET', '/ymneig/pa2/logout', function ($request, $response, $service) use ($smarty) {
        $smarty->display('logout.tpl');
        session_save_path("/var/www/html/group54/admin/pa2/php/session");
        session_start();
	unset($_SESSION['userName']);
	unset($_SESSION['lastActivity']);
	$response->redirect('/ymneig/pa2/')->send;
});



/*---------------------------------------new-user-GET----------------------------*/

$klein->respond('GET', '/ymneig/pa2/user', function ($request, $response, $service) use ($smarty) {

        $con=mysql_connect("127.0.0.1", "group54", "group54") or die('Could not connect: ' .mysql_error());
        mysql_select_db("group54pa2", $con);
        mysql_close();
	$smarty->assign('checkResult',0);
	$smarty->display('user.tpl');
});

/*--------------------------------------new user POST-------------------------*/
$klein->respond('POST', '/ymneig/pa2/user', function ($request, $response, $service) use ($smarty)
{
        session_save_path("/var/www/html/group54/admin/pa2/php/session");
        session_start();
	if($_POST['login']=='Cancel')
        {
                $response->redirect('/ymneig/pa2/')->send();
        }
	else{

 
	$con=mysql_connect("127.0.0.1", "group54", "group54") or die('Could not connect: ' .mysql_error());
        mysql_select_db("group54pa2", $con);
	$userName = $_POST['username'];
	$firstName = $_POST['firstN'];
	$lastName = $_POST['lastN'];
	$email = $_POST['email'];
	$password = $_POST['pwd1'];
	$passwordConfirm = $_POST['pwd2'];
	$checkResult = 0;
	$loggedin = 0;
	// if two password does not match
	if($password != $passwordConfirm)
	{
		$checkResult = 1;
		$smarty->assign('checkResult',$checkResult);
		$smarty->display('user.tpl');
	}
	else
	{
		$queryDuplicate = "select username from User where username = '".$userName."';";
		$resultDuplicate = mysql_query($queryDuplicate);
		$numDuplicate = mysql_num_rows($resultDuplicate);
		// if the user name already exists
		if($numDuplicate != 0)
		{
		   $checkResult = 2;
		   $smarty->assign('checkResult',$checkResult);
		   $smarty->display('user.tpl');
		}
		else //create a new user
		{
		   $queryNewUser = "insert into User(username,firstname,lastname,password,email) values('".$userName."','".$firstName."','".$lastName."','".$password."','".$email."');";
		   mysql_query($queryNewUser);
		    
		   $_SESSION['userName']=$userName;
                   $_SESSION['lastActivity']=time();
                   $response->redirect('/ymneig/pa2/')->send();
		}
	}
	}
	mysql_close();
});

/*------------------------------user-edit--------------------------------*/

$klein->respond('GET', '/ymneig/pa2/user/edit', function ($request, $response, $service) use ($smarty)
{
        session_save_path("/var/www/html/group54/admin/pa2/php/session");
        session_start();

        $con=mysql_connect("127.0.0.1", "group54", "group54") or die('Could not connect: ' .mysql_error());
        mysql_select_db("group54pa2", $con);
	
	$currentTime=time();
        if(isset($_SESSION['userName']) AND $currentTime-$_SESSION['lastActivity']<=300)
        {
	   $username = $_SESSION['userName'];
	   $queryUserInfo = "select * from User where username ='".$username."'; ";
	   $resultUserInfo = mysql_query($queryUserInfo);
	   $firstname = mysql_result($resultUserInfo,0,"firstname");
	   $lastname = mysql_result($resultUserInfo,0,"lastname");
	   $password = mysql_result($resultUserInfo,0,"password");
	   $email = mysql_result($resultUserInfo,0,"email");
	   $smarty->assign('firstname',$firstname);
	   $smarty->assign('password', $password);
	   $smarty->assign('lastname',$lastname);
	   $smarty->assign('email',$email);
	   $smarty->assign('username',$username);
	   $_SESSION['lastActivity']=time();
	   $smarty->display('useredit.tpl');
	}
	else 
	{ 
           $response->redirect('/ymneig/pa2/')->send();	
	}
	mysql_close();
});

/*-----------------------------user-edit POST----------------------------*/
$klein->respond('POST', '/ymneig/pa2/user/edit', function ($request, $response, $service) use ($smarty)
{
        session_save_path("/var/www/html/group54/admin/pa2/php/session");
        session_start();

        $con=mysql_connect("127.0.0.1", "group54", "group54") or die('Could not connect: ' .mysql_error());
        mysql_select_db("group54pa2", $con);

        $currentTime=time();
        if(isset($_SESSION['userName']) AND $currentTime-$_SESSION['lastActivity']<=300)
	{
	    $firstname = $_POST['firstN'];
	    $lastname = $_POST['lastN'];
	    $email = $_POST['email'];
	    $password= $_POST['pwd1'];
	    $passwordConfirm= $_POST['pwd2'];
	    $_SESSION['lastActivity']=time();    
	    if($password != $passwordConfirm)
            {
		 $username = $_SESSION['userName'];
          	 $queryUserInfo = "select * from User where username ='".$username."'; ";
           	 $resultUserInfo = mysql_query($queryUserInfo);
          	 $firstname = mysql_result($resultUserInfo,0,"firstname");
          	 $lastname = mysql_result($resultUserInfo,0,"lastname");
          	 $password = mysql_result($resultUserInfo,0,"password");
          	 $email = mysql_result($resultUserInfo,0,"email");
          	 $smarty->assign('firstname',$firstname);
          	 $smarty->assign('password', $password);
          	 $smarty->assign('lastname',$lastname);
          	 $smarty->assign('email',$email);
          	 $smarty->assign('username',$username);
                 $checkResult = 1;
                 $smarty->assign('checkResult',$checkResult);
                 $smarty->display('useredit.tpl');
            }
            else //password matches
	    {	
	   	 $queryUpdate = "update User set firstname='".$firstname."', lastname='".$lastname."', password='".$password."', email='".$email."' where username='".$_SESSION['userName']."';"; 
	  	 mysql_query($queryUpdate);
		 $response->redirect('/ymneig/pa2/')->send();				
	    }	
	}
	else
	{
		$response->redirect('/ymneig/pa2/')->send();
	}
	mysql_close();
});




/*---------------------------------user-delete GET--------------------------------*/


$klein->respond('GET', '/ymneig/pa2/user/delete', function ($request, $response, $service) use ($smarty) {
        session_save_path("/var/www/html/group54/admin/pa2/php/session");
        session_start();
        $con=mysql_connect("127.0.0.1", "group54", "group54") or die('Could not connect: ' .mysql_error());
        mysql_select_db("group54pa2", $con);
        
        $userName=$_SESSION['userName'];
	        
        $query11="delete from AlbumAccess where username='".$userName."';";
        $query12="delete from AlbumAccess where albumid in (select albumid from Album where username='".$userName."');";
        $query2="delete from Photo where picid in (select picid from Contain where albumid in (select albumid from Album where username='".$userName."'));";
        $query3="delete from Contain where albumid in (select albumid from Album where username='".$userName."');";
        $query4="delete from Album where username='".$userName."';";
        $query5="delete from User where username='".$userName."';";
        mysql_query($query11);
        mysql_query($query12);
        mysql_query($query2);
        mysql_query($query3);
        mysql_query($query4);
        mysql_query($query5);

        unset($_SESSION['userName']);
        unset($_SESSION['lastActivity']);
	
        $smarty->display('userdelete.tpl');
        $response->redirect('/ymneig/pa2/')->send;

        mysql_close();
});



/*---------------------------GET-ALBUMSEDIT-------------------------------*/

   $klein->respond('GET', '/ymneig/pa2/albums/edit\?[:username]?', function ($request, $response, $service) use ($smarty)
   {
	session_save_path("/var/www/html/group54/admin/pa2/php/session");
        session_start();
	$loggedin = 0;
	$currentTime=time();
	$username = $_SESSION['userName'];
        if(isset($username) AND $currentTime-$_SESSION['lastActivity']<=300)
	{
        	$con=mysql_connect("127.0.0.1", "group54", "group54")
        	or die('Could not connect: ' .mysql_error());
        	mysql_select_db("group54pa2", $con);
        	$query = "SELECT albumid,title,access FROM Album WHERE username='".$username."'";
        	$result = mysql_query($query);
        	$num = mysql_num_rows($result);
        	$albumAccess = array();
        	$albumNames = array();
        	$albumIDs = array();
        	for($i = 0; $i < $num ; $i++)
        	{
           		$albumName = mysql_result($result,$i,"title");
           		$albumID = mysql_result($result, $i,"albumid");
           		$albumAcc = mysql_result($result, $i, "access");
           		$albumNames[] = $albumName;
           		$albumIDs[] = $albumID;
           		$albumAccess[] = $albumAcc;
        	}
        	$smarty->assign('albumNames',$albumNames);
        	$smarty->assign('albumIDs',$albumIDs);
        	$smarty->assign('username', $username);
		$smarty->assign('albumAccess', $albumAccess);
        	$smarty->assign('num',$num);
        	mysql_close();
		$_SESSION['lastActivity']=time();

                $loggedin = 1;
                $smarty->assign('loggedin',$loggedin);
       		$smarty->display('albumsedit.tpl');
	}
        else
        {
                $response->redirect('/ymneig/pa2/logout')->send();
        }
 
  });

/*---------------------------------POST-ALBUMSEDIT----------------------------*/
   $klein->respond('POST', '/ymneig/pa2/albums/edit\?[:username]?', function ($request, $response, $service) use ($smarty)
   {
	session_save_path("/var/www/html/group54/admin/pa2/php/session");
        session_start();
	$username = $_SESSION['userName'];
        $currentTime=time();
        if(isset($username) AND $currentTime-$_SESSION['lastActivity']<=300)
        {

	        $_SESSION['lastActivity']=time();
		
        	$con=mysql_connect("127.0.0.1", "group54", "group54")
        	or die('Could not connect: ' .mysql_error());
        	mysql_select_db("group54pa2", $con);

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
	       			$queryFormat="select format from Photo where picid='".$picID."';";
	       			$resultFormat=mysql_query($queryFormat);
	       			$format=mysql_result($resultFormat,0,"format");
               			$picIDs[] = $picID;
	       			unlink("static/pictures/".$picID.'.'.$format);
           		}
           		//  delete the albumid in contain table and in album table first
           		$query1="delete from Contain where albumid='".$_POST['albumid']."'";
           		mysql_query($query1);
	   		$query2="delete from AlbumAccess where albumid='".$_POST['albumid']."'";
	   		mysql_query($query2);
           		$query3="delete from Album where albumid='".$_POST['albumid']."'";
           		mysql_query($query3);

           		for($i=0; $i<$num; $i++)
           		{
              			$query3="delete from Photo where picid='".$picIDs[$i]."'";
      				mysql_query($query3);
      			}
		}
                else if($_POST['op']=='add'and $titleLength > 0 )
        	{

            		$queryInsert="INSERT INTO Album (title, created, lastupdated,username,access) VALUES ('".$_POST['title']."', NOW(), NOW(),'".$username."','private')";
            		mysql_query($queryInsert);


        	}

     		$response->redirect('/ymneig/pa2/albums/edit?username='.$_GET['username'])->send();
	}
	else // if session has expired
        {
                $response->redirect('/ymneig/pa2/logout')->send();
        }
        mysql_close();

   });





/*------------------------------------------PIC----------------------------------------------*/



$klein->respond('GET', '/ymneig/pa2/pic\?[:id]?', function ($request, $response, $service) use ($smarty)
 {  
        
	session_save_path("/var/www/html/group54/admin/pa2/php/session");
        session_start();
        $username = $_SESSION['userName'];
        $currentTime=time();
        $loggedin=0;
 
        if((isset($username) AND $currentTime-$_SESSION['lastActivity']<=300) OR !isset($username))
        { 
		if(!isset($username))
		{
			$loggedin = 0;
		}
		else
		{
	        	$loggedin = 1;
		}
        	$_SESSION['lastActivity']=time();
		$con=mysql_connect("127.0.0.1", "group54", "group54")
        	or die('Could not connect: ' .mysql_error());
        	mysql_select_db("group54pa2", $con);
        	$queryFormat= "select format from Photo where picid='".$_GET['id']."';";
        	$result=mysql_query($queryFormat);
        	$format=mysql_result($result, 0, "format");
        	$pName=$_GET['id'] . "." . $format;

        	// for going back to the album
        	$queryAlbumid= "select albumid,caption from Contain where picid='".$_GET['id']."';";
        	$result=mysql_query($queryAlbumid);
        	$albumid=mysql_result($result, 0, "albumid");
        	$picCaption=mysql_result($result, 0, "caption");
        	$queryPicAlbum = "select picid from Contain where albumid = '".$albumid."' order by sequencenum;";
        	$resultPicAlbum = mysql_query($queryPicAlbum);
        	$numPics = mysql_num_rows($resultPicAlbum);

        	$pics = array();
        	for($i = 0;$i<$numPics;$i++)
        	{
                	$pic = mysql_result($resultPicAlbum,$i,"picid");
                	$pics[] = $pic;
        	}

        	$permission =0;
        	$queryPermission = "select username from Album where albumid = '".$albumid."';";
        	$resultPerm = mysql_query($queryPermission);
        	$owner= mysql_result($resultPerm, 0, "username");
        	if($owner == $username)
        	{
                	$permission =1;
        	}


        	$index = array_search($_GET['id'],$pics);
        	$smarty->assign('permission', $permission);
        	$smarty->assign('loggedin', $loggedin);
        	$smarty->assign('username', $username);
       		$smarty->assign('picCaption', $picCaption);
        	$smarty->assign('pName', $pName);
        	$smarty->assign('albumid', $albumid);
        	$smarty->assign('pics',$pics);
        	$smarty->assign('index',$index);
        	$smarty->assign('numPics',$numPics);
        	mysql_close();
        	$smarty->display('pic.tpl');

	}
        else
        {
                $response->redirect('/ymneig/pa2/logout')->send();

        }

});





/*-------------------------ALBUM----------------------------------*/






   $klein->respond('GET', '/ymneig/pa2/album\?[:id]?', function ($request, $response, $service) use ($smarty)
   {

	session_save_path("/var/www/html/group54/admin/pa2/php/session");
        session_start();
        $username = $_SESSION['userName'];
        $currentTime=time();
        $loggedin = 0;
	if((isset($username) AND $currentTime-$_SESSION['lastActivity']<=300 ) OR !isset($username) )
	{
		if(!isset($username))
		{
			$loggedin = 0;
		}
		else
		{
			$loggedin = 1;
		}
		$_SESSION['lastActivity']=time();

		$con=mysql_connect("127.0.0.1", "group54", "group54")
        	or die('Could not connect: ' .mysql_error());
       	 	mysql_select_db("group54pa2", $con);
        	$queryPicid= "select C.picid, C.caption, P.format, P.date from Contain C,Photo P where C.albumid='".$_GET['id']."' AND C.picid = P.picid order by C.sequencenum;";

        	$resultPicid = mysql_query($queryPicid);
        	$numPics = mysql_num_rows($resultPicid);
		$queryAlbumTitle = "select title,username from Album where albumid='".$_GET['id']."'";
		$albumtitle = mysql_query($queryAlbumTitle);
        	$pics = array();
        	$picIDs = array();
		$captions = array();
		$dates = array();
		$albumTitle=mysql_result($albumtitle,0,"title");  
		$owner = mysql_result($albumtitle,0,"username");
		for($i = 0;$i<$numPics;$i++)
       		{
                	$pic = mysql_result($resultPicid,$i,"picid");
                	$format = mysql_result($resultPicid,$i,"format");
                	$pics[] = $pic . '.' . $format;
                	$picIDs[] = $pic;
			$captions[] = mysql_result($resultPicid,$i,"caption");
			$dates[] = mysql_result($resultPicid,$i,"date");
		}

		$smarty->assign('owner',$owner);
 		$numPicMod = $numPics % 5;	
		$smarty->assign('dates',$dates);
		$smarty->assign('captions',$captions);
		$smarty->assign('username', $username);
        	$smarty->assign('pics',$pics);
        	$smarty->assign('picIDs',$picIDs);
        	$smarty->assign('numPics',$numPics);
		$smarty->assign('numPicMod',$numPicMod); 
		$smarty->assign('albumID',$_GET['id']);
		$smarty->assign('albumTitle', $albumTitle);
        	$smarty->assign('loggedin',$loggedin);
		mysql_close();
        	$smarty->display('album.tpl');
	}
	else
        {
                $response->redirect('/ymneig/pa2/logout')->send();
          
        }



   
   });




/*---------------------------- GET--ALBUMEDIT-------------------------------*/






   $klein->respond('GET','/ymneig/pa2/album/edit\?[:id]?', function ($request, $response, $service) use ($smarty)
   {
	session_save_path("/var/www/html/group54/admin/pa2/php/session");
        session_start();
        $username = $_SESSION['userName'];
        $currentTime=time();
        if(isset($username) AND $currentTime-$_SESSION['lastActivity']<=300)
        {	
		$_SESSION['lastActivity']=time();
		$con=mysql_connect("127.0.0.1", "group54", "group54")
        	or die('Could not connect: ' .mysql_error());
        	mysql_select_db("group54pa2", $con);
		$queryPicid= "select C.picid, C.caption, P.format from Contain C,Photo P where C.albumid='".$_GET['id']."' AND C.picid = P.picid order by C.sequencenum;"; 
		$resultPicid = mysql_query($queryPicid);
		$numPics = mysql_num_rows($resultPicid);
		$queryAlbumTA = "select title,access from Album where albumid='".$_GET['id']."'";
        	$albumTA = mysql_query($queryAlbumTA);
		$albumTitle=mysql_result($albumTA,0,"title");
		$albumAccess = mysql_result($albumTA,0,"access");
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
		if($albumAccess =='private')
		{
		   	$queryPrivateAc = "select username from AlbumAccess where albumid = '".$_GET['id']."';";
			$resultPrivateAc = mysql_query($queryPrivateAc);
			$numPrivateAc = mysql_num_rows($resultPrivateAc);
			$privateAc = array();
			for( $i = 0;$i<$numPrivateAc;$i++)
			{
			   $privateAc[] = mysql_result($resultPrivateAc,$i,"username");
			}
		
		}
		$queryUsernames ="select username from User where username != '".$username."'AND username not in (select username from AlbumAccess where albumid = '".$_GET['id']."');";
                $resultUsernames = mysql_query($queryUsernames);
                $usernames = array();
                $numUsers = mysql_num_rows($resultUsernames);
                for($i = 0;$i<$numUsers;$i++)
                {
                	$usernames[] =  mysql_result($resultUsernames,$i,"username");
                }

	
		$smarty->assign('numPrivateAc',$numPrivateAc);
		$smarty->assign('privateAc',$privateAc);
		$smarty->assign('permission',$albumAccess);
		$smarty->assign('username', $username);
		$smarty->assign('numUsers',$numUsers);
		$smarty->assign('usernames',$usernames);	
		$smarty->assign('pics',$pics);
		$smarty->assign('picIDs',$picIDs);
		$smarty->assign('numPics',$numPics);
     		$smarty->assign('albumID',$_GET['id']);
		$smarty->assign('captions',$captions);
		$smarty->assign('albumTitle', $albumTitle);
		mysql_close();
		$smarty->display('albumedit.tpl');
  
	}
        else  
	{
		$response->redirect('/ymneig/pa2/logout')->send();	
	}


   });






/*-------------------POST--ALBUMEDIT-----------------------------*/





   $klein->respond('POST', '/ymneig/pa2/album/edit\?[:id]?', function ($request, $response, $service) use ($smarty)
{

	session_save_path("/var/www/html/group54/admin/pa2/php/session");
        session_start();
        $username = $_SESSION['userName'];
        $currentTime=time();
        if(isset($username) AND $currentTime-$_SESSION['lastActivity']<=300)
        {
		$_SESSION['lastActivity']=time();
		$con=mysql_connect("127.0.0.1", "group54", "group54")
        	or die('Could not connect: ' .mysql_error());
        	mysql_select_db("group54pa2", $con);	
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
				$queryAddPhoto="insert into Photo (picid, url, format, date) values ('".$hashId."','". $url."','".$picformat."', NOW());";
				mysql_query($queryAddPhoto);
				$queryAddAlbum="update Album set lastupdated=NOW() where albumid='".$_GET['id']."';";
				mysql_query($queryAddAlbum);
				$queryFindMaxSeq="select max(sequencenum) as maxSqu from Contain where albumid='".$_GET['id']."';";
				$result=mysql_query($queryFindMaxSeq);
				$seqNum=mysql_result($result, $i, "maxSqu");
				$seqNum=$seqNum+1;		
				$queryAddContain="insert into Contain(albumid, picid, caption, sequencenum) values('".$_GET['id']."','".$hashId."', '".$name."', '".$seqNum."');";
				mysql_query($queryAddContain);
			}
 	 	}
		if($_POST['submit']=='Make change')
		{
			$editName = $_POST['albumTitle'];
			$queryUpdateName = "update Album set title='".$editName."', lastUpdated=NOW()  where albumid = '".$_GET['id']."';";
			mysql_query($queryUpdateName);
			if($_POST['access'] == 'public')
			{
				$queryAlbumPublic = "update Album set access ='public', lastupdated=NOW()  where albumid = '".$_GET['id']."';";
				mysql_query($queryAlbumPublic);
				$queryAccessPublic = "delete from AlbumAccess where albumid = '".$_GET['id']."';";
				mysql_query($queryAccessPublic);
			}
			else if ($_POST['access'] == 'private')	
			{ 
				$queryAccessPublic = "delete from AlbumAccess where albumid = '".$_GET['id']."';";
                        	mysql_query($queryAccessPublic);
				$queryAlbumPrivate = "update Album set access ='private', lastupdated=NOW()  where albumid = '".$_GET['id']."';";
                		mysql_query($queryAlbumPrivate);	
	    			$checked= $_POST['permission'];
	   			if(empty($checked)){}
	  	 		else
	   			{
	   				$N = count($checked);
					for($i=0; $i < $N; $i++) 
					{
		   				$queryAlbumAccess = "insert into AlbumAccess (albumid, username)  values('".$_GET['id']."','".$checked[$i]."') on duplicate key update albumid= albumid;";
		   				mysql_query($queryAlbumAccess);
					}	
		
	   			}  

      			}
		}
	 	$response->redirect('/ymneig/pa2/album/edit?id='.$_GET['id'])->send();
		mysql_close();
	 	$smarty->display('albumedit.tpl');
	}
	else 
	{
		$response->redirect('/ymneig/pa2/logout')->send();	
	}



});
	
   $klein->dispatch();

?>
