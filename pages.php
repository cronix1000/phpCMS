<?php
   $title = 'pages';
   require 'require/header.php';
   ?>
        <main class="container">
        <h1>Pages</h1>
        <a href="artist-details.php">Add a new page</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // connect
                require 'includes/db.php';

                // set up & run query
                $sql = "SELECT id FROM sites";
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $artists = $cmd->fetchAll();

                // loop through results and display inside table cells
                foreach ($site as $sites) {
                    echo '<tr>
                        <td>'
                            . $site['title'] . '</a>
                        <td>
                        <a href="index.php?siteId=' . $site['siteId'] . '">Edit</a>
                        </td>
                        <td>
                            <a href="delete-site.php?siteId='. $site['siteId'] . '
                                onclick="return confirmDelete()">
                                Delete
                            </a>
                        </td>
                        </tr>';
                }

                // disconnect
                $db = null;
            
                ?>
            </tbody>
        </table>
        </body>
    </main>
</html>
