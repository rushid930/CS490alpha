<?php
include "dblog.php";
?>
<?php
$json = file_get_contents('php://input');
$data = json_decode($json);

if (isset($data->username) && isset($data->password)) {
    $username = $data->username;
    $password = $data->password;
} else {
    $username = NULL;
    $password = NULL;
}

$query = "SELECT `Full Name`,`Type` FROM `information` WHERE username = '$username' and password = '$password'";

$result = mysqli_query($database, $query);
$rows = mysqli_num_rows($result);

if ($rows == 1) {
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

mysqli_free_result($result);
mysqli_close($database);
?>