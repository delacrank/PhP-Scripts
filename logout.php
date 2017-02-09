<?php # Script logout
    
    if (!isset($_COOKIE['user_id'])) {
        require('login_functions.php');
        redirect_user();
    } else {
        setcookie ('user_id', '', time()-3600, '/', '', 0, 0);
        setcookie ('username', '', time()-3600, '/', '', 0, 0);
    }
    
    echo "<h1> Logged Out!</h1>
    <p>You are now logged out, {$_COOKIE['username']}!</p><br />
    <a href=\"PhP31.html\">Back to main</a>";
    
?>