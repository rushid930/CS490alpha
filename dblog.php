<?php
//database connection
$server = 'sql1.njit.edu';
$dbuser = 'ss4366';
$pass = 'Ss!98119811';
$dbname = 'ss4366';
$database = mysqli_connect($server, $dbuser, $pass, $dbname);
if (mysqli_connect_errno()) {
   die("connection error" . mysqli_connect_error());
}
?>

<?php

?>
