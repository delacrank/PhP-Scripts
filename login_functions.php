<?php #  script login_functions.ini.php
    
    function redirect_user ($page = 'index.html') {
        $url = 'http://' . $_SERVER['HTTP_HOST'];
        
        $url = rtrim($url, '/\\');
        $url .= '/' . $page;
        header("location:$url");
        exit();
    }
    
    function check_login($dbc, $email = '', $pass = '') {
        $errors = array();
        
        if (empty($email)) {
            $errors[] = 'You forgot to enter your email address.';
        } else {
            $e = mysqli_real_escape_string($dbc, trim($email));
        }
        
        if (empty($pass)) {
            $errors[] = 'you forgot to enter your pass';
        } else {
            $p = mysqli_real_escape_string($dbc, trim($pass));
        }
        
        if (empty($errors)) {
            $query = "SELECT user_id, username FROM users WHERE email='$e'
            AND password ='$p'";
            $result =@mysqli_query($dbc, $query);
            
            if (mysqli_num_rows($result) == 1) {
                $row = (mysqli_fetch_array ($result, MYSQLI_ASSOC));
                return array(true, $row);
            } else {
                $errors[] = 'The email address and password are not on file';
            }
        } // End if empty($errors)
        return array(false, $errors);
    } // End check_login function
    
    ?>    