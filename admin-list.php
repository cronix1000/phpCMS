<?php
   $title = 'Admin List';
   require 'require/header.php';
   ?>
        <main class="container">
        <h1>Admins</h1>
        <a href="page-details.php">Add a new page</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Edit</th>
                    <th>Admin Status</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // connect
                require 'require/db.php';

                // set up & run query
                $sql = "SELECT * FROM admins";
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $admins = $cmd->fetchAll();

                // loop through results and display inside table cells
                foreach ($admins as $admin) {
                    echo '<tr>
                            <td>'
                             . $admin['username'] .
                        '</td>
                        <td>
                        <a href="edit-admin.php?userId=' . $admin['userId'] . '">Edit</a>
                        </td>
                        <td>'
                        . $admin['admin'] .
                        '</td>
                        <td>
                            <a href="delete-admin.php?userId='. $admin['userId'] . '
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
