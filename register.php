<?php
$title = 'Register';
require 'require/header.php';
?>

<main class="container">
    <h1>Registration</h1>
    <h6 class="alert alert-danger" id="message">Passwords must be a minimum of 8 characters,
        including 1 digit, 1 upper-case letter, and 1 lower-case letter.
    </h6>
    <form method="post" action="save-login.php">
        <fieldset class="m-2">
            <label for="username" class="col-2">Username:</label>
            <input name="username" id="username" required type="email" placeholder="name@email.com" />
        </fieldset>
        <fieldset class="m-2">
            <label for="password" class="col-2">Password:</label>
            <input type="password" name="password" id="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
        </fieldset>
        <fieldset class="m-1">
            <label for="confirm" class="col-2">Confirm Password:</label>
            <input type="password" name="confirm" id="confirm" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
        </fieldset>
        <div class="offset-3">
            <button class="btn btn-info" onclick="return comparePasswords()">Register</button>
        </div>
    </form>
</main>
</body>

</html>