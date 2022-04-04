<?php
//check for session status
//set session notpublic to not public redirect to pages
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['public'] = 'notpublic';
    header('location:pages.php');
?>
