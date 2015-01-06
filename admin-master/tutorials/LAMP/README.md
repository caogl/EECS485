# LAMP (Linux, Apache, MySQL, PHP)
It is very painful and error prone if you want to configure these stuff through terminal. Here I will give a tutorial about using XAMPP, which provides a GUI. The system I used is Ubuntu 12.04 LTS. And I cloned my PA1 repo to do this demo. 

### Installation:
Please follow this: http://ubuntuportal.com/2013/12/how-to-install-xampp-1-8-3-for-linux-in-ubuntu-desktop.html.
**Be careful there is something wrong in Step 2. The downloaded file will be named 'download' instead of 'xampp-linux-x64-1.8.3-2-installer.run'.**

### Step-by-step
##### 1. Start your XAMPP
You should see something like this after installation: 

<img src="https://github.com/EECS485-Fall2014/admin/blob/master/tutorials/LAMP/0.png" width="50%" height="50%">

##### 2. Change Document Root
Click on "Apache Web Server", click on "Configure", and open up the "Open Conf File", here is a screenshot:

<img src="https://github.com/EECS485-Fall2014/admin/blob/master/tutorials/LAMP/1.png" width="50%" height="50%">

Then search for `DocumentRoot` in the file, find the one with a path which by default should be "/opt/lampp/htdocs" like this

<img src="https://github.com/EECS485-Fall2014/admin/blob/master/tutorials/LAMP/2.png" width="50%" height="50%">

Change that path to where your index.php is, in my case it is `/home/ubuntu/pa1_q350d6uhaor/php/html`, and here is a screenshot of my `pwd` and `ls` result to give you a clearer idea:

<img src="https://github.com/EECS485-Fall2014/admin/blob/master/tutorials/LAMP/3.png" width="75%" height="75%">

And here is a screenshot of mine after I changed the DocumentRoot:
<img src="https://github.com/EECS485-Fall2014/admin/blob/master/tutorials/LAMP/4.png" width="75%" height="75%">

##### 3. Set up MySQL
We will need to set up database which is referenced in your PHP code. For example, I have code 

	$user="group11"; 
	$password="friedcode"; 
	$database="group11";
	$con = mysql_connect("127.0.0.1", $user, $password) or die('Could not connect: ' . mysql_error()); 


We need to set up the user and database here. Go to `http://localhost/phpmyadmin/` in your browser.

Under "Users" Tab, add a new user, fill in username which correspond to the one you used in your code, choose localhost, fill in password (again should match what is in your PHP code), ignore "generate password", check all checkboxs in "Database for user" and "Global privileges" and scroll down to the bottom of the page to click ok. Here is a screenshot for reference:

<img src="https://github.com/EECS485-Fall2014/admin/blob/master/tutorials/LAMP/5.png" width="50%" height="50%">

##### 5. Run it! 
So far you should have everything set up to run the code, use your browser to go to "localhost/secret/pa#".

I got this error. 

	Fatal error: Uncaught exception 'Klein\Exceptions\UnhandledException' with message 'exception 'SmartyException' with message 'unable to write file /home/ubuntu/pa1_q350d6uhaor/php/html/templates/templates_c/wrt54415269201610.61525780' in /home/ubuntu/pa1_q350d6uhaor/php/html/Smarty-3.1.14/libs/sysplugins/smarty_internal_write_file.php:44 Stack trace: #0 /home/ubuntu/pa1_q350d6uhaor/php/html/Smarty-3.1.14/libs/sysplugins/smarty_internal_template.php(201): Smarty_Internal_Write_File::writeFile('/home/ubuntu/pa...', '<?php /* Smarty...', Object(Smarty)) #1 /home/ubuntu/pa1_q350d6uhaor/php/html/Smarty-3.1.14/libs/sysplugins/smarty_internal_templatebase.php(155): Smarty_Internal_Template->compileTemplateSource() #2 /home/ubuntu/pa1_q350d6uhaor/php/html/Smarty-3.1.14/libs/sysplugins/smarty_internal_templatebase.php(374): Smarty_Internal_TemplateBase->fetch('index.tpl', NULL, NULL, NULL, true) #3 /home/ubuntu/pa1_q350d6uhaor/php/html/index.php(44): Smarty_Internal_TemplateBase->display('index.tpl') #4 [internal function]: {closu in /home/ubuntu/pa1_q350d6uhaor/php/html/vendor/klein/klein/Klein/Klein.php on line 687

If you do not meet this, that is perfect. If you meet this, I solved it by changing the permissions of the pa1 folder with `sudo chmod 777 -R pa1_q350d6uhaor`. Then I went back to the browser and got this:

<img src="https://github.com/EECS485-Fall2014/admin/blob/master/tutorials/LAMP/6.png" width="50%" height="50%">

##### 6. Load data into MySQL

Up to now, Apache is hosting your site perfectly. But you will need to load datatables into MySQL. You can use `http://localhost/phpmyadmin/` to do that. I will leave this for you to figure out yourselves. (You can always search for tutorials or other information online about this)

### Trouble-shooting
Click "Open Access/Error Log" under "Configure" of Apache to view logs. Please read it carefully before asking.

Make sure you have the file `.htaccess` in the folder as `index.php`, if not, you can find them on the remote server. Just copy the content over.

### Miscellaneous
##### 1. How to open the application again after you quit it?
Just for the first time you will need to do `sudo chmod +x /opt/lampp/manager-linux.run` through your terminal, afterwards you can start it by `sudo /opt/lampp/manager-linux.run`.