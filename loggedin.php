<?php # Script loggedin.php

    if (!isset($_COOKIE['user_id'])) {
        require ('login_functions.php');
        redirect_user();
    }
    
    echo "<h1>Logged In!</h1>
    <p>You are now logged in, {$_COOKIE['username']}!</p>
    <p><a href=\"logout.php\">Logout</a></p><br />
    <a href=\"PhP31.html\">Back to main</a>";
    
?>    

