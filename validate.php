<?php
$username = $_POST['username'];
$password = $_POST['password'];


require 'require/db.php';

$sql = "SELECT * FROM admins WHERE username = :username";
$cmd = $db->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
$cmd->execute();
$admin = $cmd->fetch();

if (!$admin) {
    $db = null;
    header('location:login.php?invalid=true');
}
else {
    if (!password_verify($password, $admin['password'])) {
        $db = null;
        header('location:login.php?invalid=true');
    }
    else {
           session_start();
           $_SESSION['username'] = $username;
           $_SESSION['userId'] = $admin['userId'];
           $_SESSION['admin'] = $admin['admin'];
           header('location:pages.php');
    }
}

?>