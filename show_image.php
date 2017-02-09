<?php #script 11.5 show_image.php
    
    $name = FALSE;
    
    if (isset($_GET['image'])) {
        $ext = strtolower ( substr ($_GET['image'], -4));
        
        if (($ext == '.jpg') OR ($ext == 'jpeg') OR ($ext == '.png')) {
            $image = "uploads/{$_GET['image']}";
            
            if (file_exists ($image) && (is_file($image))) {
                $name = $_GET['image'];
            } // end of file_exists
        } // end of $ext
    } // end of isset
    
    if (!$name) {
        $image = 'images/unavaileable.png';
        $name = 'unavailable.png';
    }
    
    $info = getimagesize($image);
    $fs = filesize($image);
    
    header ("Content-Type: {$info['mime']}\n");
    header ("Content-Dispostion: inline;
    filename=\"$name\"\n");
    header ("Content-Lenght: $fs\n");
    
    readfile ($image);
    
    ?>    