# How you should set up the development
It appears a lot of students are doing the development work directly on the remote server, which tends to be extremely painful when several team members work on the same file. Permission problems are annoying and the overwritten of files among team members are error prone. 

### Rationally how web development like this should work

You should set up a local server and do the development locally, push to github whenever you finish something, and finally after your team have finished everything or whenever you want to release, you may simply copy over the code to the remote server or do a git clone on the remote server to deploy it.

#### Python

It is easy to start gunicorn in your localhost and I see a lot of guys doing so already. 

#### PHP

It is a bit complicated to set up localhost, please follow these tutorials:

* [Mac] (https://github.com/EECS485-Fall2014/admin/blob/master/tutorials/MAMP/README.md)
* [Windows] (https://github.com/EECS485-Fall2014/admin/blob/master/tutorials/WAMP/README.md)
* [Linux] (https://github.com/EECS485-Fall2014/admin/blob/master/tutorials/LAMP/README.md)