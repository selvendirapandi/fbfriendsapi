# fbfriendsapi

Here is the Task:
Develop a application using PHP, HTML and JAVASCRIPT that utilizes Facebook API's to perform the following,
Create a Facebook Login page.
After login, Get the Facebook friends list via API and Store it in DB.
Write a Stored Procedure to retrieve the friends list and display it in the front end.
Add a export button in the page to download the  list in Excel file.
Upload this code to GitHub and share the link. 

 Step 1 - facebook configuration setup

#  fbfriendlist\application\config\facebook.php

$config['appId']   = 'xxxxxxxxxxxxxxxx';
$config['secret']  = 'yyyyyyyyyyyyyyyy';
$config['scope'] = 'email, public_profile, user_friends';
$config['cookie'] = false;

 Step -2  -  Base url setup
 
 #  fbfriendlist\application\config\config.php
 
      $config['base_url'] = 'http://localhost/fbfriendlist/';

Step - 3   -  Database setup

 #  fbfriendlist\application\config\database.php

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'web';
$db['default']['password'] = 'websa';
$db['default']['database'] = 'fbfriends';
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = '';

Note: To perform Stored Procedure you should setup username and password .  We can't user  user : "root"   with  pwd :  " "
