<?php
   //database connection
   //test commit
   $server = 'sql1.njit.edu';
   $dbuser = 'ss4366';
   $pass = 'Ss!98119811';
   $dbname = 'ss4366';
   $database = mysqli_connect($server, $dbuser, $pass, $dbname);
   if(mysqli_connect_errno($database)){
   	die("connection error".mysqli_connect_error($database));
    }

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM `information` WHERE username='$username' and password = '$password'";

$result = mysqli_query($database, $query);
$rows = mysqli_num_rows($result);

if ($rows == 0) 
  $resp = array("resp"=>"noExist");
else if ($rows == 1) {
    $column = mysqli_fetch_assoc($result);
    $full_name = $column['Full Name'];
    $user_type = $column['Type'];
    $fields1 = array(
        'match' => $rows,
        'full_name' => $full_name,
        'user_type' => $user_type,
        'message' => "Successful Login"
    );
    $json_string = json_encode($fields1);
    echo $json_string;
} else {
    $fields0 = array(
        'match' => $rows,
        'message' => "Incorrect Credentials"
    );

    $json_string0 = json_encode($fields0);
    echo $json_string0;
}

$r=mysqli_fetch_array($result,MYSQLI_ASSOC);
$hash=$r['hash'];

if (password_verify($password, $hash))
	{$resp =array("resp"=>"backYes");}
else
	$resp = array("resp"=>"backNo");

$resp_string = json_encode($resp);                                                                                    

echo $resp_string;

mysqli_free_result($result);
mysqli_close($database);
?>