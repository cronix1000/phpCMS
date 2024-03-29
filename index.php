<?php
try{
    //Get siteId
    if(isset($_GET["siteId"])){
        if(is_numeric($_GET["siteId"])){
            $siteId = $_GET["siteId"];
            require 'require/db.php';

            $sql = "SELECT * FROM sites WHERE siteId = :siteId";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':siteId', $siteId, PDO::PARAM_INT);
            $cmd->execute();
            $site = $cmd->fetch();

            $title = $site['title'];
            $theme = $site['theme']; 
            
            //set theme based on theme in query
            if($theme == "Indigo/Purple"){
                echo "<style>";
                require 'css/IndigoPurple.css';
                echo "</style>";
            }
            else if($theme == "Black/Gold"){
                echo "<style>";
                require 'css/blackgold.css';
                echo "</style>";
            }
            else if($theme == "Green/Red"){
                echo "<style>";
                require 'css/greenred.css';
                echo "</style>";
            }
            
            require 'require/header.php';
            // echo out the title and content from the query
            echo '<div class = "container">
                <div class ="div-1">
                    <h1 class=".bg-primary">' . $site['title']. '</h1>
                </div>
                <div class="div-2">
                    <div>
                        <p>' .  $site['content'] . '</p>
                    <div>
                </div>
            </div>';

        }
    }
    else{
        header('location:index.php?siteId=1');
    }
}
catch (Exception $error) {
    header('location:error.php');
}
?>
    </body>
</html>