<?php
$title = 'Saving your Registration';
require 'require/header.php';
try{
    //retrieve info from edit admin 
$username = $_POST['username'];
$adminAuth = $_POST['admin'];
$ok = true;

//check if username is empty 
if(empty($username)){
    echo '<p class="alert alert-dangers">Username is required</p>';
    $ok = false;
}

if($ok){
    require 'require/db.php';

    //query the selected admin
    $sql = "SELECT * FROM admins WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd-> bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd-> execute();
    $user = $cmd->fetch();

    //update admins info based on retrieved info
    $sql = "UPDATE admins SET username = :username, admin = :admin WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd-> bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd-> bindParam(':admin', $adminAuth, PDO::PARAM_STR, 10);
    $cmd-> execute();

    $db = null;
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    //set admin status in session
    $_SESSION['admin'] = $adminAuth;


    echo '<p class="alert alert-info">Set Admin Status</p>';
}
}
catch (Exception $error) {
    header('location:error.php');
}
?>
</body>
</html>