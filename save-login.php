<?php
$title = 'Saving your Registration';
require 'require/header.php';
try{
    //Get info from login 
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    require 'require/db.php';

    //query the username
    $sql = "SELECT * FROM admins WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd-> bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd-> execute();
    $user = $cmd->fetch();
    //if username is taken full stop
    if($user){
        echo '<p class="alert alert-danger">Username taken please go back and try again</p>';
        $db = null;
    }
    //if user name not taken insert into the database the username and password
    else{
        //run hash on username
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO admins (username, passwordm) VALUES (:username, :password)";
        $cmd = $db->prepare($sql);
        $cmd-> bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd-> bindParam(':password', $password, PDO::PARAM_STR, 50);
        $cmd-> execute();
        echo '<p class="alert alert-info">Registration succesful</p>';
        session_start();
    }
    $db = null;
    }   
    catch (Exception $error) {
        header('location:error.php');
    }
?>
</body>
</html>