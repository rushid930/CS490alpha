<?php
   //database connection
   error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
   ini_set('display_errors' , 1);

   $server = 'sql1.njit.edu';
   $dbuser = 'ss4366';
   $pass = 'Ss!98119811';
   $dbname = 'ss4366';
   $database = mysqli_connect($server, $dbuser, $pass, $dbname);

   if(mysqli_connect_errno($database)){
    die("connection error".mysqli_connect_error($database));
   }
?>
