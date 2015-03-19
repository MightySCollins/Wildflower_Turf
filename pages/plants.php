<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Plants</h1>
            <?php
            $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (!$db_connection->set_charset("utf8")) {
                $errors[] = $db_connection->error;
            }
            $connect = mysql_connect(DB_HOST, DB_USER, DB_PASS);
            if (!$connect) {
                die(mysql_error());
            }
            mysql_select_db(DB_NAME);
            if (empty($_GET['view'])) $results = mysql_query("SELECT * FROM plants");
            elseif ($_GET['view'] === 'ready') $results = mysql_query("SELECT * FROM plants WHERE available = 'Now' ");
            elseif ($_GET['view'] === 'not_ready') $results = mysql_query("SELECT * FROM plants WHERE available <> 'Now' ");

            if (mysql_fetch_array($results) <> 0) {
                $sql = "SELECT location
                        FROM plants;";
                $result_of_login_check = $db_connection->query($sql);

                $total_plants = $result_of_login_check->num_rows;
                echo "Total plants: ". $total_plants."    ";

                $sql = "SELECT location
                        FROM plants
                        WHERE available='Now';";
                $result_of_login_check = $db_connection->query($sql);

                $ready_plants = $result_of_login_check->num_rows;
                echo "Ready plants: ".$ready_plants."    ";
                $not_ready_plants = $total_plants - $ready_plants;
                echo "Not ready plants: ".$not_ready_plants;

                echo "
            <table class=\"table table-bordered table-hover table-striped\">
                <thead>
                <tr>
                    <td>Location</td>
                    <td>Product</td>
                    <td>Sown</td>
                    <td>QTY</td>
                    <td>Available</td>
                    <td>Edit</td>
                </tr>
                </thead>
                <tbody> ";
                while ($row = mysql_fetch_array($results)) {
                    echo '<tr>
                        <td>' . $row['location'] . '</td>
                        <td>' . $row['product'] . '</td>
                        <td>' . $row['sown'] . '</td>
                        <td>' . $row['qty'] . '</td>
                        <td>' . $row['available'] . '</td>
                        <td><a href="edit.php?location=' . $row['location'] . '">Edit</a></td>
                    </tr>';
                }
            } else {
                echo '<div class=\'alert alert-warning\'>No plants found</div>';
            }
            ?>
            </tbody>
            </table>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>