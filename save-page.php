<?php
    // require 'require/auth.php';
    $title = 'Save page';
    require 'require/header.php';

    $title = $_POST['title'];
    $content = $_POST['content'];
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
        $sql = "INSERT INTO sites (title, content) VALUES (:title, :content)";

        $cmd = $db->prepare($sql);
        $cmd->bindParam(':title', $title, PDO::PARAM_STR, 100);
        $cmd->bindParam(':content', $content, PDO::PARAM_STR);

        $cmd->execute();
        $db = null;

        
        echo '<p class="col-12 text-center">Site Saved</p>';
        echo '<a href="pages.php">View Pages</a>';
    }
    ?>
    </body>
</html>
