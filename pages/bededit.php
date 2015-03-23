<?php
if (isset($_POST['bid'])) {
    $location = $_POST['bid'];
} elseif (!empty($_GET['bid'])) {
    $location = $_GET['bid'];
} else {
    $bid = 1;
}

$connect = mysql_connect(DB_HOST, DB_USER, DB_PASS);
if (!$connect) {
    die(mysql_error());
}
mysql_select_db(DB_NAME);
//echo $id;
if (isset($_POST['delete'])) {
    $results = mysql_query("DELETE FROM beds WHERE bid='$bid';");
}

if (isset($_POST['save'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    if (!empty($name)
        && preg_match('/^[a-zA-Z\d]{0,64}$/i', $name)
    ) {
            $results = mysql_query("UPDATE beds SET name = '$name' WHERE bid='$bid'");
    } else {
        $message = '<div class=\'alert alert-warning\'>Some inputs are invalid</div>';
    }
    } else {
    $results = mysql_query("SELECT * FROM beds WHERE bid =" . $bid . ";");
    if (!mysql_num_rows($results)) {
        $message = '<div class=\'alert alert-warning\'>The bed cannot be found</div>';
        $location = 1;
        $results = mysql_query("SELECT * FROM beds WHERE bid =" . $location . ";");
    }

    while ($row = mysql_fetch_array($results)) {
        $name = $row['name'];

    }
}
if ($_SESSION['user_name'] === ADMIN) {
    echo $bid;
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Bed</h1>
            <?php if (isset($message)) echo $message ?>
            <form method="post" action="bededit.php" name="bededit">
                <fieldset>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="bed_edit_name" class="col-sm-2 control-label">Name</label></div>
                            <div class="col-md-4">
                                <input class="form-control" id="bed_edit_name"
                                       name="name" type="text" value="<?php echo $name ?>">
                                <input type="hidden" name="location" value="<?php echo $bid ?>">
                            </div>
                        </div>
                    </div>
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