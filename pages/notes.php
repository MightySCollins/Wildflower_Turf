<?php
if (isset($_POST['id'])) $id = $_POST['id'];
elseif (!empty($_GET['id'])) $id = $_GET['id'];
else $id = 1;

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno() && $_SESSION['admin']) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

mysql_select_db(DB_NAME);

if (isset($_POST['save'])) {
    $notes = filter_var($_POST['notes'], FILTER_SANITIZE_STRING);
    $sql = "SELECT * FROM notes WHERE plantid =" . $id . ";";
    $result = mysqli_query($con, $sql);

    if (!mysqli_num_rows($result)) {
        $message = '<div class=\'alert alert-warning\'>Added new note</div>';

        $sql = "INSERT INTO notes (plantid, note) VALUES ('$id', '$notes')";
    } else $sql = "UPDATE notes SET note = '$notes' WHERE plantid='$id'";

    $result = mysqli_query($con, $sql);

} else {
    $sql = "SELECT * FROM notes WHERE plantid =" . $id . ";";
    $result = mysqli_query($con, $sql);

    if (!mysqli_num_rows($result))
        $message = '<div class=\'alert alert-warning\'>No notes found, will add new</div>';
    else {
        $row = mysqli_fetch_array($result);
        $notes = $row['note'];
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Notes</h1>
            <?php
            if (isset($message)) echo $message;

            $sql = "SELECT * FROM plants WHERE id =" . $id . ";";
            $message = '';
            $result = mysqli_query($con, $sql);

            if (!mysqli_num_rows($result))
            echo '<div class=\'alert alert-warning\'>The plant cannot be found</div>';
            else {
                $row = mysqli_fetch_array($result);
                $bed = $row['bed'];
                $location = $row['location'];
                $product = $row['product'];
                $sown = $row['sown'];
                $qty = $row['qty'];
                $available = $row['available'];
                echo '
                <form method="post" action="notes.php" name=noteedit">
                <fieldset>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-4 control-label">Bed</label>
                                    '. $bed .'
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-4 control-label">Location</label>
                                    '. $location .'
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-4 control-label">Product</label>
                                    '; if (isset($product)) echo $product; echo '
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-4 control-label">Sown</label>
                                    '; if (isset($sown)) echo $sown; echo '
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-4 control-label">QTY</label>
                                    '; if (isset($qty)) echo $qty; echo '
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-4 control-label">Available</label>
                                    '; if (isset($available)) echo $available; echo '
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" id="plant_id" value="'. $id .'">
                        <div class="col-md-8">
                            <div class="form-group">
                                <textarea name="notes" class="form-control"
                                          rows="8">'; if (isset($notes)) echo $notes; echo '</textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-lg btn-success btn-block" name="save" value="Save"/>
                            </div>
                            <div class="form-group">
                                <a href="plants.php" class="btn btn-lg btn-default btn-block" name="cancel">Cancel</a>
                            </div>
                        </div>
                    </div>
                </fieldset>
                </form>';
            }
            ?>
        </div>
    </div>
</div>
</div>