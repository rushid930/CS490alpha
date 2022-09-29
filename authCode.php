<?php
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
?>
<?php

session_start();
include('dblog.php');


$username = mysqli_real_escape_string($database, $_SESSION['auth-user']['username']);
$password = mysqli_real_escape_string($database, $_SESSION['auth-user']['password']);
debug_to_console($username);
debug_to_console($password);

$query = "SELECT * FROM `information` WHERE username='$username' AND password='$password'";
$result = mysqli_query($database, $query);
$rows = mysqli_num_rows($result);


if($rows > 0){
    $_SESSION['auth'] = true;
    debug_to_console($_SESSION["auth"]);

    $userdata = mysqli_fetch_array($result);
    debug_to_console($userdata);
    $username = $userdata['username'];
    $password = $userdata['password'];
    $full_name = $userdata['Full Name'];
    $user_type = $userdata['Type'];
    debug_to_console($userdata['Type']);

    $_SESSION['user-type'] = $user_type;
    debug_to_console($_SESSION['user-type']);

    //send to middleend
    header('Location: https://web.njit.edu/~ac235/middleEnd.php');
}
else{
    $_SESSION['message'] = "Invalid Credentials";
    header('Location: https://web.njit.edu/~rd448/login.php');
}


?>