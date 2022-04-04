<?php
   $title = 'pages';
   require 'require/header.php';
   ?>
        <main class="container">
        <h1>Pages</h1>
        <a href="page-details.php">Add a new page</a>
        <table class="table table-striped">
            <thead>
                <?php
                try{
                    $adminAuth = $_SESSION['admin'];
                    if($adminAuth == "admin"){
                        echo " <tr>
                            <th>Title</th>
                            <th>Edit</th>
                            <th>Theme</th>
                            <th>Delete</th>
                    <   </tr>";
                    }
                    else{
                        echo " <tr>
                            <th>Title</th>
                            <th>Theme</th>
                    <   </tr>";
                    }
                }
                catch (Exception $error) {
                    header('location:error.php');
                }
                ?>
            </thead>
            <tbody>
                <?php
                // connect
                require 'require/db.php';
                try{
                // set up & run query
                $sql = "SELECT * FROM sites";
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $sites = $cmd->fetchAll();

                
                if($adminAuth == "admin"){
                // loop through results and display inside table cells
                foreach ($sites as $site) {
                    echo '<tr>
                            <td>
                            <a href="index.php?siteId=' . $site['siteId'] . '">' . $site['title'] . '</a>
                        </td>
                        <td>
                        <a href="page-details.php?siteId=' . $site['siteId'] . '">Edit</a>
                        </td>
                        <td>'
                         . $site['theme'] . 
                        '</td>
                        <td>
                            <a href="delete-page.php?siteId='. $site['siteId'] . '
                                "onclick="return confirmDelete()">
                                Delete
                            </a>
                        </td>
                        </tr>';
                }
            }
            else{
                foreach ($sites as $site) {
                echo '
                <td>
                ' . $site['title'] . '
                </td>
                <td>
                </td>
                </tr>';
                    }
            }
                // disconnect
                $db = null;
            }
            catch (Exception $error) {
                header('location:error.php');
            }
                ?>
            </tbody>
        </table>
        </body>
    </main>
</html>
