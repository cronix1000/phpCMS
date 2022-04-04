<?php
    // require 'require/auth.php';
    $title = 'Save page';
    require 'require/header.php';
    try{
    $siteId = $_POST['siteId'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $theme = $_POST['theme'];
    $ok = true;

     // input validation
     if (empty($title)) {
        echo "title is required<br />";
        $ok = false;
    }
    else {
        if (strlen($title) > 100) {
            echo "title cannot exceed 100 characters";
            $ok = false;
        }
    }
    if (empty($content)) {
        echo "content is required<br />";
        $ok = false;
    }

    if($ok){
        require 'require/db.php';
        if(empty($siteId)){
            $sql = "INSERT INTO sites (title, content, theme) VALUES (:title, :content, :theme)";
        }
        else{
            $sql = "UPDATE sites SET title = :title, content = :content, theme = :theme WHERE siteId = :siteId";
        }

        $cmd = $db->prepare($sql);
        $cmd->bindParam(':title', $title, PDO::PARAM_STR, 100);
        $cmd->bindParam(':content', $content, PDO::PARAM_STR);
        $cmd->bindParam(':theme', $theme, PDO::PARAM_STR);

        if (!empty($siteId)) {
            $cmd->bindParam(':siteId', $siteId, PDO::PARAM_INT);
        }

        $cmd->execute();
        $db = null;

        
        echo '<p class="col-12">Site Saved</p>';
        echo '<a href="pages.php">View Pages</a>';
    }
    }
    catch (Exception $error) {
        header('location:error.php');
    }
    ?>
    </body>
</html>
