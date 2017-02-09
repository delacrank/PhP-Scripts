<?php # Delete User Script
            
    echo '<h1>Delete User</h1>';
            
    if ( (isset($_GET['id'])) && (is_numeric ($_GET['id'])) ) {
            $id = $_GET['id'];
    } elseif ( (isset($_POST['id'])) && ( is_numeric($_POST['id'])) ) {
            $id = $_POST['id'];
    } else {
            echo '<p>This page has been accessed in error.</p>';
            exit();
    }
    
    require_once('connection_string.php');
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if ($_POST['sure'] == 'Yes') {
                    
                    $query = "DELETE FROM users WHERE user_id = $id LIMIT 1";
                    $result = @mysqli_query ($dbc, $query);
                    if (mysqli_affected_rows($dbc) == 1 ) {
                    
                            echo '<p>The user has been deleted.</p>';
                            
                    } else {
                        
                            echo '<p>The user could not be deleted due to a system
                            error.</p>';
                            echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $query . '</p>';
                    }
            
            } else {
                    echo '<p>User has NOT been deleted.</p>';
            }
            
    } else {
    
            $query = "SELECT UserName FROM users WHERE user_id = '$id'";
            $result = @mysqli_query ($dbc, $query);
            
            if (mysqli_num_rows($result) == 1) {
            
                    $row = mysqli_fetch_array ($result, MYSQLI_NUM);
                    
                    echo "<h3>Name: $row[0]</h3>
                    Are you sure you want to delete this user?";
                    
                    echo '<form action = "delete_user.php" method = "post">
                    <input type="radio" name="sure" value="Yes" /> Yes
                    <input type="radio" name="sure" value="No" checked="checked" />
                    No
                    <input type="submit" name="submit" value="Submit" />
                    <input type="hidden" name="id" value="' . $id . '" />
                    </form>';
                    
            } else {
                    echo '<p>This page has been accessed in error.</p>';
            }
    }
    
    mysqli_close($dbc);
    
    ?>