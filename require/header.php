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
                    // only call session start if not called previously in this http request
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
                    if (!empty($_SESSION['username'])) {
                        echo '
                            <li class="nav-item">
                                <a class="nav-link" href="pages.php">Pages</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="admin-list.php">Admins</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="log-out.php">Log Out</a>
                            </li>';
                    }
                    else{
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
                    $db = null
                    ?>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php
                    // only call session start if not called previously in this http request
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
                    
                    if (empty($_SESSION['username'])) {
                        echo '<li class="nav-item">
                                <a class="nav-link" href="register.php">Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>';
                            
                    }
                    else {
                        echo '<li class="nav-item">
                                <a class="nav-link" href="#">' . $_SESSION['username'] . '</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="log-out.php">Logout</a>
                            </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
