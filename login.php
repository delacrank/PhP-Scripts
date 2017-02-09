<?php # Script login.php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require('login_functions.php');
        require('connection_string.php');
        
        list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);
        
        if ($check) {
            setcookie ('user_id', $data['user_id']);
            setcookie ('username',$data['username']);
            redirect_user('PhP/loggedin.php');
        } else {
            $errors = $data;
        }
        mysqli_close($dbc);
    } // end of main submit
    
include('login_page.php');

    ?>    