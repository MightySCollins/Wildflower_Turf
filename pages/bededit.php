<?php
if (isset($_POST['bid'])) {
    $bid = $_POST['bid'];
} elseif (isset($_GET['bid'])) {
    $bid = $_GET['bid'];
} else {
    $bid = 1;
}

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno() && $_SESSION['admin']) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if (isset($_POST['delete'])) {
    $sql = "DELETE FROM beds WHERE bid='$bid'";
    $result = mysqli_query($con, $sql);
}

if (isset($_POST['save'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    if (!empty($name)) {
        $sql = "UPDATE beds SET name = '$name' WHERE bid='$bid'";
        $result = mysqli_query($con, $sql);
    } else
        $message = '<div class="alert alert-warning">Some inputs are invalid</div>';
} else {
    $sql = "SELECT * FROM beds WHERE bid ='$bid '";
    $result = mysqli_query($con, $sql);
    if (!mysqli_num_rows($result)) {
        $message = '<div class=\'alert alert-warning\'>The bed cannot be found</div>';
    } else {
        while ($row = mysqli_fetch_array($result)) {
            $name = $row['name'];
        }
    };
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Bed</h1>
            <?php if (isset($message)) echo $message ?>
            <form method="post" action="bededit.php" name="bededit">
                <fieldset>
                    <?php if ($_SESSION['admin']) echo'
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="bed_edit_id" class="col-sm-2 control-label">ID</label></div>
                            <div class="col-md-4">
                                '. $bid .'
                            </div>
                        </div>
                    </div>';
                    ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="bed_edit_name" class="col-sm-2 control-label">Name</label></div>
                            <div class="col-md-4">
                                <input class="form-control" id="bed_edit_name"
                                       name="name" type="text" value="<?php echo $name ?>">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="bid" value="<?php echo $bid ?>">
                    <div class="col-md-4">
                        <br>
                        <input type="submit" class="btn btn-lg btn-success btn-block" name="save" value="Save"/>
                    </div>
                    <div class="col-md-2 col-sm-4">
                        <br>
                        <a href="bed.php" class="btn btn-lg btn-default btn-block" name="cancel">Cancel</a>
                    </div>
                    <div class="col-md-2">
                        <br>
                        <input type="submit" class="btn btn-lg btn-danger btn-block" name="delete" value="Delete"/>
                    </div>
                </fieldset>
            </form>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>