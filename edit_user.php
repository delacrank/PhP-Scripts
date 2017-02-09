<?php # Edit Users Script
    
    echo '<h1>Edit Users</h1>';
    
    if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
}  else {
            echo '<p>This page has been accessed in error1</p>';
            exit();
    }
    
    require('connection_string.php');
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
    
            $errors = array();
        
            if (empty($_POST['UserName'])) {
                    $errors[] = 'You forgot to enter user name';
            } else {
                    $u = mysqli_escape_string($dbc, trim($_POST['UserName']));
            }
            
            if (empty($_POST['email'])) {
                    $errors[] = 'You forgot to enter user email';
            } else {
                    $e = mysqli_escape_string($dbc, trim($_POST['email']));
            }
            
            if (empty($errors)) {
            
                    $query = "SELECT user_id FROM users WHERE email='$e'
                    AND user_id != $id";
                    $result = @mysqli_query($dbc, $query);
                    
                    if (mysqli_num_rows($result) == 0 ) {
                    
                            $query = "UPDATE users SET UserName = '$u', email = '$e'
                            WHERE user_id = $id LIMIT 1";
                            $result = @mysqli_query ($dbc, $query);
                            if (mysqli_affected_rows($dbc) == 1 ) {
                                    
                                    echo '<p>The user has been edited.</p>';
                                    
                            } else {
                                    
                                    echo '<p>The user could not be edited due to a
                                    system error</p>';
                                    echo '<p>' . mysqli_error($dbc) . '<br />
                                    Query: ' . $query . '</p>';
                            }
                            
                    } else {   
                        echo '<p>The email address has already been registered.</p>';
                    }
                    
            } else {
                    
                    echo '<p>The following error(s) occured:<br />';
                    foreach ($errors as $msg) {
                            echo " - $msg<br />\n";
                    }
                    echo '</p><p>Please try again.</p>';
                    }
            }
            
           $q = "SELECT username, email FROM users WHERE user_id=$id";		
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

	// Get the user's information:
	$row = mysqli_fetch_array ($r, MYSQLI_NUM);
                    
                    echo '<form action="edit_user.php" method="post">
                    <p>User Name: <input type="text" name="UserName" size="30"
                    maxlenght="30" value="' . $row[0] . '" /></label><br />
                    <label>email: <input type="text" name="email" size="15"
                    maxlenght="20" value="' . $row[1] . '" /></label><br />
                  <input type="submit" name="submit" value="Submit" />
                    <input type="hidden" name="id" value="' . $id . '" />
                    </form>';
                    
            } else {
            
                    echo '<p>This page has been accessed in an error.3</p>';
            }
mysqli_close($dbc);
?>