<?php
   $title = 'Admin List';
   require 'require/header.php';
   ?>
        <main class="container">
        <h1>Admins</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                <?php
                try{
                    //set table structure based on admin status
                    $adminAuth = $_SESSION['admin'];
                    if($adminAuth == "admin"){
                        echo " <tr>
                        <th>Email</th>
                        <th>Edit</th>
                        <th>Admin Status</th>
                        <th>Delete</th>
                       </tr>";
                    }
                    else{
                        echo " <tr>
                            <th>Email</th>
                        </tr>";
                    }
                }
                catch (Exception $error) {
                    header('location:error.php');
                }
                ?>

                </tr>
            </thead>
            <tbody>
                <?php
                // connect
                try{
                require 'require/db.php';

                $sql = "SELECT * FROM admins";
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $admins = $cmd->fetchAll();

                // loop through admins queries and display admins
                // restrict to table structure based on admin status
                if($_SESSION['admin'] == 'admin')
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
                else if($_SESSION['admin'] == 'notAdmin')
                foreach ($admins as $admin) {
                    echo '<tr>
                            <td>'
                             . $admin['username'] .
                        '</td>';
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
