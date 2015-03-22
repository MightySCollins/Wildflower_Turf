<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Beds</h1>
            <?php
            $connect = mysql_connect(DB_HOST, DB_USER, DB_PASS);
            if (!$connect) {
                die(mysql_error());
            }
            mysql_select_db(DB_NAME);
            $results = mysql_query("SELECT * FROM beds");

            if (mysql_fetch_array($results) <> 0) {
                echo "
            <table class=\"table table-bordered table-hover table-striped\">
                <thead>
                <tr>
                    <td>Name</td>
                    <td>Edit</td>
                    <td>View</td>
                </tr>
                </thead>
                <tbody> ";
                while ($row = mysql_fetch_array($results))
                    echo '<tr>
                        <td>' . $row['name'] . '</td>
                        <td><a href="bededit.php?bid=' . $row['bid'] . '">Edit</a></td>
                        <td><a href="plants.php?bid=' . $row['name'] . '">View</a></td>
                    </tr>';

            } else {
                echo '<div class=\'alert alert-warning\'>No beds found</div>';
            }
            ?>
            </tbody>
            </table>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>