<?php
$connect = mysql_connect(DB_HOST, DB_USER, DB_PASS);
if (!$connect) {
    die(mysql_error());
}
mysql_select_db(DB_NAME);

if (isset($_POST['save'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    if (!empty($name)
        //&& preg_match('/^[a-zA-Z\d]{0,64}$/i', $name) todo:add back in
    ) {
        $results = mysql_query("INSERT INTO beds (name) VALUES ('$name');");
        $message = '<div class=\'alert alert-success\'>Bed added</div>';
    } else {
        $message = '<div class=\'alert alert-warning\'>Some inputs are invalid</div>';
    }
    }
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Bed</h1>
            <?php if (isset($message)) echo $message ?>
            <form method="post" action="newbed.php" name="bedadd">
                <fieldset>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="bed_input_name" class="col-sm-2 control-label">Bed Name</label></div>
                            <div class="col-md-4">
                                <input class="form-control" id="bed_input_name"
                                       name="name" type="text" required autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <br>
                        <input type="submit" class="btn btn-lg btn-success btn-block" name="save" value="Save"/>
                    </div>
                    <div class="col-md-2 col-sm-4">
                        <br>
                        <a href="plants.php" class="btn btn-lg btn-default btn-block" name="cancel">Cancel</a>
                    </div>
                </fieldset>
            </form>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>