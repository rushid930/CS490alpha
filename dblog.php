<?php
   //database connection
   //test commit
   $server = 'sql1.njit.edu';
   $dbuser = '******';
   $pass = '*************';
   $dbname = 'ss4366';
   $database = mysqli_connect($server, $dbuser, $pass, $dbname);
   if(mysqli_connect_errno()){
   	die("connection error".mysqli_connect_error());
    }
?>