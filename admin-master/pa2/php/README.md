### Two Quick Notes if you are using PHP/smarty

1. Since you are extending functionality from your website in PA1, copy and paste your previous code into the new directory.

  When you do this, you will have to modify several lines of httpd.conf under conf folder. whichever line that contain `pa1` should change into the proper path. 

  For example, assume your pa2 folder is located at `GroupXX/admin/pa2_pak0sbtdg1i`
The orginal line 372 in httpd.conf: `ErrorLog "/var/www/html/GroupXX/admin/pa1/php/httpd-error.log" `
should change into `ErrorLog "/var/www/html/GroupXX/admin/pa2_pak0sbtdg1i/php/httpd-error.log" `

2. You should use new port for pa2 which is your pa1 ports add 200. don't use pa1's ports for pa2, since we need some time to grade your pa1.

  For example, if your group ports for pa1 are `5697`  `6697`, your ports for pa2 are `5897` and `6897`

  When you do this, you will have to modify four lines of httpd.conf under conf folder. 

  For example, if your group ports for pa1 are `5697`  `6697`
The orginal line 43&44 in httpd.conf: `Listen 5697` `Listen 6697`
should change into `Listen 5897` `Listen 6897`
Also line 368 & 375 need change.


Finally, run `httpd -f /var/www/html/GROUPNAME/admin/PA2FOLDER/php/conf/httpd.conf -k start`
Then your baseline pa2 site is good to go. Good luck!
