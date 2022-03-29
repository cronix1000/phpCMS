<?php
// require 'includes/auth.php';
$title = 'page-details';
require 'require/header.php';

//not needed until creating login
// try {
//     $sitedId = null;
//     $title = null;
//     $content = null;

//     if(isset($_GET['siteId'])){
//         if(isnumeric($_GET['siteId'])){
//             require 'includes/db.php';

//             $sql = "SELECT * FROM "
//         }
//     }

// }
?>

<main class="container">
    <h1>Page Details</h1>
    <p>All fields are required.</p>
    <form method="POST" action="save-page.php">
        <fieldset class="form-group m-1">
            <label for="title" >title:</label>
            <input name="title" id="title" required maxlength="100" value="<?php echo $title; ?>" />
        </fieldset>
        <fieldset>
            <label for="contant">content:</label>
            <textarea rows="4" cols="50" name="content" id="content" required maxlength="100" value="<?php echo $contant; ?>" ></textarea>
        </fieldset>
        </fieldset>
        <button>Save</button>
    </form>
</main>
</body>

</html>  