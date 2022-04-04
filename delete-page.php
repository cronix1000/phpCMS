<?php 
$title = "Page deleted";
require 'require/header.php';
?>
        <h1>Page deleted</h1>
        <?php
        // try{
            if(isset($_GET["siteId"])){
                if(is_numeric($_GET["siteId"])){
                require 'require/db.php';

                $sql = "DELETE FROM sites WHERE siteId = :siteId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':siteId',$_GET['siteId'],PDO::PARAM_INT);
                $cmd -> execute();

                // disconnect from
                $db = null;
                // show confirmation
                echo '<div class="alert alert-danger"> Site has been deleted.
                <a href="pages.php">Return to sites</a>
                </div>';
            }
            else{
                echo '<div class="alert alert-danger">Site Missing</div>';
            }
        }
        else{
            echo '<div class="alert alert-danger">Site Missing</div>';
        }
        // }
        // catch (Exception $error){
        //     header('location:error.php');
        // } 
        // ?>
    </body>
</html>