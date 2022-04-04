<?php
$title = 'page-details';
require 'require/header.php';



try {
    $siteId = null;
    $title = null;
    $content = null;

    //get siteId
    //populate variables based on query
    if(isset($_GET["siteId"])){
        if(is_numeric($_GET["siteId"])){
            $siteId = $_GET["siteId"];
            require 'require/db.php';

            $sql = "SELECT * FROM sites WHERE siteId = :siteId";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':siteId', $siteId, PDO::PARAM_INT);
            $cmd->execute();
            $site = $cmd->fetch();
            if (empty($site)) {
                $db = null;
                header('location:error.php');
                exit();
            }
            else {
                $title = $site['title'];
                $content = $site['content'];
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
    <h1>Page Details</h1>
    <p>All fields are required.</p>
    <form method="POST" action="save-page.php">
        <fieldset class="form-group m-1">
            <label for="title" >title:</label>
            <input name="title" id="title" required maxlength="100" value="<?php echo $title; ?>" />
        </fieldset>
        <fieldset>
            <label for="contant">content:</label>
            <textarea rows="4" cols="50" name="content" id="content" required maxlength="100"><?php echo $content; ?></textarea>
        </fieldset>
        <fieldset class="m-2">
        <label for="admin" class="col-2">Set Theme:</label>
            <label for="admin">Indigo/Purple:</label>
            <input type="radio" id="theme" name="theme" value="Indigo/Purple">
            <label for="admin">Black/Gold:</label>
            <input type="radio" id="theme" name="theme" value="Black/Gold">
            <label for="admin">Green/Red:</label>
            <input type="radio" id="theme" name="theme" value="Green/Red">
        </fieldset>
        <input type="hidden" name="siteId" id="siteId" value="<?php echo $siteId; ?>" />
        <button>Save</button>
    </form>
</main>
</body>

</html>  