<?php
$title = 'edit-admin';
require 'require/header.php';

try {
    // check for artistId url param.  if we have one, query db & populate form.  if not show blank form
    $userId = null;
    $username = null;
    $password = null;

    if (isset($_GET['userId'])) {
        if (is_numeric($_GET['userId'])) {
            $userId = $_GET['userId'];

            require 'require/db.php';

            // add userId filter so users can only see their own artists
            $sql = "SELECT * FROM admins WHERE userId = :userId";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);
            $cmd->execute();
            $admin = $cmd->fetch();  // use fetch() not fetchAll() for single-row queries
            $username = $admin['username'];
            if (empty($username)) {
                $db = null;
                header('location:error.php');
                exit();
            }
            else {
                $username = $admin['username'];
                $db = null;                
            }
        }
    }
}
catch (Exception $error) {
    header('location:error.php');
}
?>

<main class="container">
    <h1>Edit Admin</h1>
    <h2><?php echo $username; ?></h2>
    <form method="post" action="update-admin.php">
        <fieldset class="m-2">
            <label for="username" class="col-2">Username:</label>
            <input name="username" id="username" required type="email" placeholder="name@email.com" value="<?php echo $username; ?>"/>
        </fieldset>
        <fieldset class="m-2">
        <label for="admin" class="col-2">Set Admin:</label>
            <label for="admin">Not Admin:</label>
            <input type="radio" id="admin" name="admin" value="notAdmin">
            <label for="admin">Admin:</label>
            <input type="radio" id="admin" name="admin" value="admin">
        </fieldset>
        <div class="offset-2">
            <button class="btn btn-info">Set Admin</button>
        </div>
    </form>
</main>
</body>

</html>  