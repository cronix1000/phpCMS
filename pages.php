<?php
   $title = 'pages';
   require 'require/header.php';
   ?>
        <main class="container">
        <h1>Pages</h1>
        <a href="page-details.php">Add a new page</a>
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
                require 'require/db.php';

                // set up & run query
                $sql = "SELECT * FROM sites";
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $sites = $cmd->fetchAll();

                // loop through results and display inside table cells
                foreach ($sites as $site) {
                    echo '<tr>
                            <td>
                            <a href="index.php?siteId=' . $site['siteId'] . '">' . $site['title'] . '</a>
                        </td>
                        <td>
                        <a href="index.php?siteId=' . $site['siteId'] . '">Edit</a>
                        </td>
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
