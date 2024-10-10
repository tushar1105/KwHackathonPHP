<?php
//session start
// session_start(); // now we can access $_SESSION.

// db connection.
include('includes/dbConnection.php');

if(!empty($_POST)){
    // to fix security issues SQL injection.
    // real_escape_string to skip any special charaters that may have been added by the users/hacker.
    $username = $db->real_escape_string($_POST['username']);
    $password = $db->real_escape_string($_POST['password']);
    //encrypted password to md5.
    $password = md5($password);

    $sqlQuery = "SELECT * from `kw_userlogin` WHERE `username` LIKE '$username' AND `password` LIKE '$password'";

    $result = $db->query($sqlQuery);

    //outputArray
    $output = [];


    if($result->num_rows == 1){
       $row = $result->fetch_assoc();
        $output['resultType'] = 'success';
        // set session variables.
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role'];

    }else{
        $output['resultType'] = 'error';
        $output['errorType'] = 'User not found';
    }

    $outputString = json_encode($output);
    echo $outputString;

    $db->close();

}
