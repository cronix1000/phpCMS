<?php
$title = 'Saving your Registration';
require 'require/header.php';

$username = $_POST['username'];
$adminAuth = $_POST['admin'];
$ok = true;

if(empty($username)){
    echo '<p class="alert alert-dangers">Username is required</p>';
    $ok = false;
}

if($ok){
    require 'require/db.php';

    $sql = "SELECT * FROM admins WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd-> bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd-> execute();
    $user = $cmd->fetch();

    $sql = "UPDATE admins SET username = :username, admin = :admin WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd-> bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd-> bindParam(':admin', $adminAuth, PDO::PARAM_STR, 10);
    $cmd-> execute();

    $db = null;
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['admin'] = $user['admin'];


    echo '<p class="alert alert-info">Set Admin Status</p>';
}

?>
</body>
</html>