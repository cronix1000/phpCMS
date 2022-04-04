<?php
$title = 'Saving your Registration';
require 'require/header.php';

$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

if(empty($username)){
    echo '<p class="alert alert-dangers">Username is required</p>';
    $ok = false;
}
if(empty($password)){
    echo '<p class="alert alert-danger">Password is required</p>';
    $ok = false;
}
if($password != $confirm){
    echo '<p class="alert alert-danger">Passwords do not match</p>';
    $ok = false;
}

if($ok){
    require 'require/db.php';

    $sql = "SELECT * FROM admins WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd-> bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd-> execute();
    $user = $cmd->fetch();

    if($user){
        echo '<p class="alert alert-danger">This username is already taken</p>';
        $db = null;
    }
    else{
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO admins (username, password) VALUES (:username, :password)";
        $cmd = $db->prepare($sql);
        $cmd-> bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd-> bindParam(':password', $password, PDO::PARAM_STR, 50);
        $cmd-> execute();
        echo '<p class="alert alert-info">Registration succesful </p>';
    }
    $db = null;

}

?>
</body>
</html>