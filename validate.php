<?php
try{
    //retrieve info from login
$username = $_POST['username'];
$password = $_POST['password'];


require 'require/db.php';

//query the user logging in
$sql = "SELECT * FROM admins WHERE username = :username";
$cmd = $db->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
$cmd->execute();
$admin = $cmd->fetch();

//if user does not exist return to login
if (!$admin) {
    $db = null;
    header('location:login.php?invalid=true');
}

//else verify the password 
else {
    //if user does not pass check send back
    if (!password_verify($password, $admin['password'])) {
        $db = null;
        header('location:login.php?invalid=true');
    }
    //if user passes check set all session variables
    else {
           session_start();
           $_SESSION['username'] = $username;
           $_SESSION['userId'] = $admin['userId'];
           $_SESSION['admin'] = $admin['admin'];
           $_SESSION['public'] = "notpublic";
           header('location:pages.php');
    }
}
}
catch (Exception $error) {
    header('location:error.php');
}
?>