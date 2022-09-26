<?php
   //database connection
   //test commit
   $server = 'sql1.njit.edu';
   $dbuser = 'ss4366';
   $pass = 'Ss!98119811';
   $dbname = 'information';
   $database = mysqli_connect($server, $dbuser, $pass, $dbname);
   if(mysqli_connect_errno()){
   	die("connection error".mysqli_connect_error());
    }
?>