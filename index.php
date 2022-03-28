<?php
    $siteId = null;
    $title = null;
    $content = null;

    if(isset($_GET["siteId"])){
        if(is_numeric($_GET["siteId"])){
            $siteId = $_GET["siteId"];
            require 'require/db/php';

            $sql = "SELECT * FROM sites WHERE siteId = :siteId";
            $cmd = $db ->prepare($sql);
            $cmd -> bindParam(':siteId', $siteId, PDO::PARAM_INT);
            $cmd -> execute();
            $site -> $cmd->fetch();

            $title = $site['title'];

            
            require 'require/header.php';
            echo '<h1>' . $site['title']. '</h1>
            <p>' .  $site['content'] . '</p>';
        }
    }
?>