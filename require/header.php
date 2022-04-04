<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>CMS | <?php echo $title; ?></title>
    <!--Bootstrap-->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- CSS-->
    <link type="text/css" rel="stylesheet" href="css/styles.css" />
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?siteId=1">PHP CMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">            
                    <?php
                    try{
                    // only call session start if there is no session
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
                    //check for either not empty username and site status not public
                    if (!empty($_SESSION['username']) && $_SESSION['public'] == 'notpublic') {
                        echo '
                            <li class="nav-item">
                                <a class="nav-link" href="pages.php">Pages</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="admin-list.php">Admins</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="log-out.php">Log Out</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="public-site.php">public site</a>
                            </li>';
                    }
                    // if site status public show the public site header with a link pack to admin site
                    else if($_SESSION['public'] == 'public'){
                        require 'db.php';

                        // set up & run query
                        $sql = "SELECT * FROM sites";
                        $cmd = $db->prepare($sql);
                        $cmd->execute();
                        $sites = $cmd->fetchAll();

                        foreach($sites as $site){         
                            echo '<li class="nav-item">
                            <a class="nav-link"  href="index.php?siteId=' . $site['siteId'] . '">' . $site['title'] . '</a>
                            </li>';
                        }
                        echo '<li class="nav-item">
                            <a class="nav-link" href="notpublic-site.php">not public site</a>
                            </li>';

                    }
                    //if user name not set display all index sites
                    else if(empty($_SESSION['username'])){
                        require 'db.php';

                        // set up & run query
                        $sql = "SELECT * FROM sites";
                        $cmd = $db->prepare($sql);
                        $cmd->execute();
                        $sites = $cmd->fetchAll();

                        foreach($sites as $site){         
                            echo '<li class="nav-item">
                            <a class="nav-link"  href="index.php?siteId=' . $site['siteId'] . '">' . $site['title'] . '</a>
                            </li>';
                        }
                    }
                    }
                    catch (Exception $error) {
                        header('location:error.php');
                    }
                    $db = null
                    ?>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php
                    try{
                    // only call session start if there is no session
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
                    //if not username show login and register links
                    if (empty($_SESSION['username'])) {
                        echo '<li class="nav-item">
                                <a class="nav-link" href="register.php">Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>';
                            
                    }
                    //else show logout and username
                    else {
                        echo '<li class="nav-item">
                                <a class="nav-link" href="#">' . $_SESSION['username'] . '</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="log-out.php">Logout</a>
                            </li>';
                    }
                    }
                    catch (Exception $error) {
                        header('location:error.php');
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
