<?php 
require 'require/auth.php';
$title = "Page deleted";
require 'require/header.php';
?>
        <h1>Page deleted</h1>
        <?php
        try{
        if(isset($_GET['userId'])){
            if(is_numeric($_GET['userId'])){
                require 'require/db.php';

                $user = $_SESSION['userId'];
                $sql = "DELETE FROM admins WHERE userId = :userId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':userId',$_GET['userId'],PDO::PARAM_INT);
                $cmd -> execute();

                // disconnect from
                $db = null;
                // show confirmation
                echo '<div class="alert alert-danger"> Amdmin has been deleted.
                <a href="admin-list.php">Return to Amdmin list</a>
                </div>';
            }
            else{
                echo '<div class="alert alert-danger">Amdmin Missing</div>';
            }
        }
        else{
            echo '<div class="alert alert-danger">Admin Missing</div>';
        }
        }
        catch (Exception $error){
            header('location:error.php');
        } 
        ?>
    </body>
</html>