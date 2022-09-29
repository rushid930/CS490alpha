<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
    ini_set('display_errors' , 1);

    $username = $_POST['username'];
    $password = $_POST['password'];

    $server = 'sql1.njit.edu';
    $dbuser = 'ss4366';
    $pass = 'Ss!98119811';
    $dbname = 'ss4366';
    $database = mysqli_connect($server, $dbuser, $pass, $dbname);

    if(mysqli_connect_errno($database)){
        die("connection error".mysqli_connect_error($database));
    }
    else{       
        $query = "SELECT * FROM `information` WHERE username='$username'";
        $result = mysqli_query($database, $query);
        $rows = mysqli_num_rows($result);

        if($rows > 0){
            $column = mysqli_fetch_assoc($result);
            $user_type = $column['Type'];

            if($column['password'] == $password){
                if($column['Type'] == 'Teacher'){
                    echo "<h2>Login Successful Oh Glorious Teacher</h2>";
                }
                else if($column['Type'] == 'Student'){
                    echo "<h2>Login Successful Pitiful Student</h2>";
                }
                else{
                    echo "<h2>Type not found. You are nothing</h2>";
                }
            }
            else{
                echo "<h2>Invalid username or password 1</h2>";
            }            
        }
        else {
            $fields0 = array(
                'match' => $rows,
                'message' => "Incorrect Credentials"
            );
            echo "<h2>No User Found</h2>";
        }
        
        echo "test";
    }
?>