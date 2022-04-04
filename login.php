<?php
$title = 'Login';
require 'require/header.php';
?>

<main class="container">
    <h1>Login</h1>
    <?php
    try{
    if(empty($_GET['invalid'])){
        echo '<h6 class="alert alert-dark">please enter your credentials</h6>';
    }
    else{
        echo '<h6 class="alert alert-dark">Invalid Login</h6>';
    }
    }
    catch (Exception $error) {
        header('location:error.php');
    }
    ?>
    <form method="post" action="validate.php">
        <fieldset class="m-1">
            <label for="username" class="col-6">Username:</label>
            <input name="username" id="username" required type="email" placeholder="email@email.com" />
        </fieldset>
        <fieldset class="m-1">
            <label for="password" class="col-6">Password:</label>
            <input type="password" name="password" id="password" required />
        </fieldset>
        <div class="offset-7">
            <button class="btn btn-info">Login</button>
        </div>
    </form>
</main>

</body>
</html>