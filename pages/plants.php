<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Plants</h1>
            <?php
            $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (mysqli_connect_errno() && $_SESSION['admin']) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            if (isset($_GET['bid'])) $sql = "SELECT * FROM plants WHERE bed = '" . $_GET['bid'] . "'";
            elseif (empty($_GET['view'])) $sql = "SELECT * FROM plants";
            elseif ($_GET['view'] === 'ready') $sql = "SELECT * FROM plants WHERE available = 'Now'";
            elseif ($_GET['view'] === 'not_ready') $sql = "SELECT * FROM plants WHERE available <> 'Now'";

            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result)) {
                echo '
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>';
                if ($_SESSION['admin']) echo "<td>ID</td>";
                echo '<td>Bed</td>
                    <td>Location</td>
                    <td>Product</td>
                    <td>Sown</td>
                    <td>QTY</td>
                    <td>Available</td>
                    <td>Edit</td>
                </tr>
                </thead>
                <tbody> ';
                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    if ($_SESSION['admin']) echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['bed'] . '</td>
                        <td>' . $row['location'] . '</td>
                        <td>' . $row['product'] . '</td>
                        <td>'; if ($row['sown'] <> '0000-00-00') echo $row['sown'];
                    echo '</td>
                        <td>' . $row['qty'] . '</td>
                        <td>' . $row['available'] . '</td>
                        <td><a href="editplant.php?id=' . $row['id'] . '">Edit</a> | <a href="notes.php?id=' . $row['id'] . '">Notes</a></td>
                    </tr>';

                }
            } else echo '<div class=\'alert alert-warning\'>No plants found</div>';

            mysqli_close($con);
            ?>
            </tbody>
            </table>

        </div>
    </div>
</div>