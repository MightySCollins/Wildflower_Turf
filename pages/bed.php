<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Beds</h1>
            <?php
            $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (mysqli_connect_errno() && $_SESSION['admin']) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            $sql = "SELECT * FROM beds";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result)) {
                echo '
                <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <td>Name</td>
                    <td>Edit</td>
                    <td>View</td>
                </tr>
                </thead>
                <tbody> ';
                while ($row = mysqli_fetch_array($result))
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