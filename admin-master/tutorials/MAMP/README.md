# MAMP (Mac, Apache, MySQL, PHP)

In this tutorial I will cover step by step how to host EECS 485 PHP projects on Mac locally. I cloned my PA1 repo to do this demo.

### Installation:
http://www.mamp.info/en/downloads/

### Step-by-step
##### 1. Start your MAMP
You should see something like this: 

<img src="https://github.com/EECS485-Fall2014/admin/blob/master/tutorials/MAMP/1.png" width="50%" height="50%">

##### 2. Change Document Root
Click Preferences, go to "Web Server" tab, change the "Document Root" to the folder which contains your "index.php". When I try this, my index.php is at "/Users/yixing/Desktop/pa1_q350d6uhaor/php/html/index.php", so I set "Document Root" as "/Users/yixing/Desktop/pa1_q350d6uhaor/php/html". 

<img src="https://github.com/EECS485-Fall2014/admin/blob/master/tutorials/MAMP/2.png" width="50%" height="50%">

##### 3. Start the servers 
The third button will turn green like this:

<img src="https://github.com/EECS485-Fall2014/admin/blob/master/tutorials/MAMP/3.png" width="50%" height="50%">

#####4. Test whether your server is referencing the correct files
Going to "http://localhost:8000/secret/pa#/" in your browser. In my case it is "http://localhost:8000/rg4mmsj/pa1/", here is the screenshot: 

<img src="https://github.com/EECS485-Fall2014/admin/blob/master/tutorials/MAMP/4.png" width="50%" height="50%">

The MySQL error shown is expected, we will work on this later. It means that your PHP code is running successfully, but not able to connect to MySQL since there are no username/password or database in MySQL which are specified in your PHP code yet.

##### 5. Create MySQL database and user

To create MySQL database and user, you need to log into MySQL as root user. In your terminal use this command:
`/Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot`

Then you should be logged in as the root user. Then you will need to create database and user. The command is

	drop database if exists <db_name>; create database <db_name>; 
	grant all on <db_name>.* to <username>@localhost identified by '<password>';


`<db_name>`, `<username>` and `<password>` above should be replaced by corresponding values that you are using in your PHP. 


Here is an example, following is some code in my PHP:


	$user="group11"; 
	$password="friedcode"; 
	$database="group11";
	$con = mysql_connect("127.0.0.1", $user, $password) or die('Could not connect: ' . mysql_error()); 


Then in MySQL I will do 

	drop database if exists group11; create database group11; 
	grant all on group11.* to group11@localhost identified by 'friedcode';

Here is a screenshot for your reference:

<img src="https://github.com/EECS485-Fall2014/admin/blob/master/tutorials/MAMP/5.png" width="50%" height="50%">

##### 6. Change MySQL port

Then go back to MAMP Preferences and change MySQL port to 3306 which is the port PHP used to connect to MySQL by default.

<img src="https://github.com/EECS485-Fall2014/admin/blob/master/tutorials/MAMP/6.png" width="50%" height="50%">

Now you can go back to your browswer and refresh and it should work. 

##### 6. Load data into MySQL

You will also need to load data into the database you just created. I will leave that work for you. It is similar to how it works on the remote server. You can log into MySQL in terminal with ``/Applications/MAMP/Library/bin/mysql --host=localhost -u<username> -p<password>`. Just make sure MAMP has started whenever you want to do any operation about MySQL over your terminal.


### Trouble-shooting
Please refer to logs under `/Applications/MAMP/logs/` and read carefully before asking. Also when asking please provide details from the logs.

Make sure you have the file `.htaccess` in the folder as `index.php`, if not, you can find them on the remote server. Just copy the content over.