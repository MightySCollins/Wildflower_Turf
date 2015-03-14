<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Plants</h1>
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <td>Location</td>
                    <td>Product</td>
                    <td>Player Name</td>
                    <td>QTY</td>
                    <td>Available</td>
                    <td>Edit</td>
                </tr>
                </thead>
                <tbody>
                <?php
                $connect = mysql_connect(DB_HOST, DB_USER, DB_PASS);
                if (!$connect) {
                    die(mysql_error());
                }
                mysql_select_db(DB_NAME);
                $results = mysql_query("SELECT * FROM plants LIMIT 10");
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
                ?>
                </tbody>
            </table>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>