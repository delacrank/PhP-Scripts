    <?php # Sortable View
    
    echo '<h1> Registered Users </h1>';
    
    require_once ('connection_string.php');
    
    $display = 3;
    
    if (isset($_GET['p']) && is_numeric($_GET['p'])) {
        $pages = $_GET['p'];
    } else {
        $query = "SELECT COUNT(user_id) FROM users";
        $result = @mysqli_query ($dbc, $query);
        $row = @mysqli_fetch_array ($result, MYSQLI_NUM);
        $records = $row[0];
        
        if ($records > $display ) {
            $pages = ceil ($records/$display);
        } else {
            $pages = 1;
        }
    } // end of p IF
    
    if (isset($_GET['s']) && is_numeric($_GET['s'])) {
        $start = $_GET['s'];
    } else {
        $start = 0;
    }
    
    $sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';
    
    switch ($sort) {
        case 'id':
            $order_by = 'user_id ASC';
            break;
        case 'un':
            $order_by = 'username ASC';
            break;
        case 'rd':
            $order_by = 'registration_date ASC';
            break;
        default:
            $order_by = 'registration_date ASC';
            $sort = 'rd';
            break;
    }
    
    $query = "SELECT user_id, username, registration_date FROM users 
    ORDER BY $order_by LIMIT $start, $display";
    $result = @mysqli_query ($dbc, $query);
    
    echo '<table width="100%">
    <tr>
        <td>Edit</td>
        <td>Delete</td>
        <td><a href="view_users.php?sort=id">User ID</a></td>
        <td><a href="view_users.php?sort=un">User Name</a></td>
        <td><a href="view_users.php?sort=rd">Registration Date</a></td>
    </tr>';
    
    $bg = '#eeeeee';
    while ($row = mysqli_fetch_array ($result, MYSQLI_ASSOC)) {
        $bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
            echo '<tr bgcolor="' . $bg . '">
            <td><a href="edit_user.php?=' . $row['user_id'] .
            '">Edit</a></td>
            <td><a href="delete_user.php?id=' . $row['user_id'] .
            '">Delete</a></td>
            <td>' . $row['user_id'] . '</td>
            <td>' . $row['username'] . '</td>
            <td>' . $row['registration_date'] . '</td>
        </tr>';
    }
        
    echo '</table>';
    mysqli_free_result ($result);
    mysqli_close ($dbc);
    
    if ($pages > 1) {
        echo '<br /><p>';
        $current_page = ($start/$display) + 1;
        
        if ($current_page != 1 ) {
            echo'<a href="view_users.php?s=' . ($start - $display) . '&p='
            . $pages . '&sort=' . $sort . '">Previous</a> ';
        }
        
        for ($i = 1; $i <= $pages; $i++) {
            if ($i != $current_page) {
                echo '<a href="view_users.php?s=' . (($display * ($i - 1 ))) .
                '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a>';
            } else {
                echo $i . ' ';
            }
        }
        
        if ($current_page != $pages) {
            echo '<a href="view_users.php?s=' . ($start + $display) .
            '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
        }
        echo '</p>';
        
        echo '<a href="PhP27.html">Back to Main</a>';
    }
    ?>