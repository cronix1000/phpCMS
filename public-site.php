<?php
//check for session status
//set session public to not public redirect to index 1
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['public'] = 'public';
    header('location:index.php?siteId=2');
?>
