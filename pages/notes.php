<?php
if (isset($_POST['id'])) $id = $_POST['id'];
elseif (!empty($_GET['id'])) $id = $_GET['id'];
else $id = 1;

$connect = mysql_connect(DB_HOST, DB_USER, DB_PASS);
if (!$connect) die(mysql_error());
mysql_select_db(DB_NAME);

if (isset($_POST['save'])) {
    $notes = filter_var($_POST['notes'], FILTER_SANITIZE_STRING);

    $results = mysql_query("SELECT * FROM notes WHERE plantid =" . $id . ";");
    if($results === FALSE) {
        die(mysql_error()); // TODO: better error handling
    }
    if (!mysql_num_rows($results)) {
        $message = '<div class=\'alert alert-warning\'>Added new note</div>';
        $results = mysql_query("INSERT INTO notes VALUES ('$id', '$note')");
    } else {
        $results = mysql_query("UPDATE notes SET note = '$notes' WHERE id='$id'");
    }

} else {
    $results = mysql_query("SELECT * FROM plants WHERE id =" . $id . ";");
    if (!mysql_num_rows($results)) {
        $message = '<div class=\'alert alert-warning\'>The plant cannot be found</div>';
        $id = 1;
        $results = mysql_query("SELECT * FROM plants WHERE id =" . $id . ";");
    }
    while ($row = mysql_fetch_array($results)) {
        $bed = $row['bed'];
        $location = $row['location'];
        $product = $row['product'];
        $sown = $row['sown'];
        $qty = $row['qty'];
        $available = $row['available'];
    }
    $results = mysql_query("SELECT * FROM notes WHERE plantid =" . $id . ";");
    if($results === FALSE) {
        die(mysql_error()); // TODO: better error handling
    }
    if (!mysql_num_rows($results)) {
        $message = '<div class=\'alert alert-warning\'>No notes found</div>';
    } else {
        $notes = $row['note'];
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Notes</h1>
            <?php if (isset($message)) echo $message ?>
            <form method="post" action="notes.php" name=noteedit">
                <fieldset>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-4 control-label">Bed</label>
                                    <?php echo $bed ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-4 control-label">Location</label>
                                    <?php echo $location ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-4 control-label">Product</label>
                                    <?php if (!empty($product)) echo $product ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-4 control-label">Sown</label>
                                    <?php if (isset($sown)) echo $sown ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-4 control-label">QTY</label>
                                    <?php if (isset($qty)) echo $qty ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-4 control-label">Available</label>
                                    <?php if (isset($available)) echo $available ?>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" id="plant_id" value="<?php echo $id ?>">

                        <div class="col-md-8">
                            <div class="form-group">
                                <textarea name="notes" class="form-control"
                                          rows="8"><?php if (isset($notes)) echo $notes ?></textarea>
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
            </form>
        </div>


    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>