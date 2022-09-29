<?php
include "dblog.php"; // back end
?>
<?php
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
?>
<?php
    // middle end was a group effort. We kind of got back end and middle confused so both Andrew and Sumit initially worked on it
    // Rushi basically took their codes and reworked it into something functional
    if(mysqli_connect_errno($database)){
        die("connection error".mysqli_connect_error($database));
    }
    else{
        $query = "SELECT * FROM `information` WHERE username='$username'";
        $result = mysqli_query($database, $query);
        $rows = mysqli_num_rows($result);

        if($rows > 0){
            $column = mysqli_fetch_assoc($result);
            $full_name = $column['Full Name'];
            $user_type = $column['Type'];

            if($column['password'] == $password){
                $resp =array("resp"=>"backYes");
                if($column['Type'] == 'Teacher'){                    
                    echo "<meta http-equiv = 'refresh' content = '0; url = https://web.njit.edu/~rd448/teacherLanding.php' />";
                }
                else if($column['Type'] == 'Student'){
                    echo "<meta http-equiv = 'refresh' content = '0; url = https://web.njit.edu/~rd448/studentLanding.php' />";
                }
                else{
                    $resp = array("resp"=>"backNo");
                    //echo "<h2>Type not found. You are nothing</h2>";
                    debug_to_console("Type Not Found");
                    echo "<meta http-equiv = 'refresh' content = '0; url = https://web.njit.edu/~rd448/login.php' />";
                }
            }
            else{
                //echo "<h2>Invalid username or password</h2>";
                debug_to_console("Invalid username or Password");
                echo "<meta http-equiv = 'refresh' content = '0; url = https://web.njit.edu/~rd448/login.php' />";
            }            
        }
        else {
            //echo "<h2>No User Found</h2>";
            debug_to_console("No User Found");
            echo "<meta http-equiv = 'refresh' content = '0; url = https://web.njit.edu/~rd448/login.php' />";
        }
    }
?>