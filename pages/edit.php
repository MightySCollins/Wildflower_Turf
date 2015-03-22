<?php
if (isset($_POST['id'])) $id = $_POST['id'];
elseif (!empty($_GET['id'])) $id = $_GET['id'];
else $id = 1;

$connect = mysql_connect(DB_HOST, DB_USER, DB_PASS);
if (!$connect) die(mysql_error());
mysql_select_db(DB_NAME);
//echo $id;
if (isset($_POST['delete'])) {
    $results = mysql_query("DELETE FROM plants WHERE id='$id';");
}

if (isset($_POST['save'])) {
    $product = filter_var($_POST['product'], FILTER_SANITIZE_STRING);
    $sown = $_POST['sown'];
    $qty = filter_var($_POST['qty'], FILTER_SANITIZE_NUMBER_INT);
    $available = filter_var($_POST['available'], FILTER_SANITIZE_STRING);
    if (!empty($id)
        && is_numeric($id)
        && !empty($product)
        && preg_match('/^[a-zA-Z\d]{0,64}$/i', $product)
        && !empty($qty)
        && is_numeric($qty)
        && !empty($available)
        && preg_match('/^[a-zA-Z\d]{0,64}$/i', $available)
    )
        $results = mysql_query("UPDATE plants
                            SET product = '$product', sown = '$sown', qty = '$qty', available = '$available'
                            WHERE id='$id'");
    else $message = '<div class=\'alert alert-warning\'>Some inputs are invalid</div>';
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
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Plant</h1>
            <?php if (isset($message)) echo $message ?>
            <form method="post" action="edit.php" name="plantedit">
                <fieldset>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_edit_bed" class="col-sm-2 control-label">Bed</label></div>
                            <div class="col-md-4">
                                <?php echo $bed?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_edit_location" class="col-sm-2 control-label">Location</label></div>
                            <div class="col-md-4">
                                <?php echo $location?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_edit_location" class="col-sm-2 control-label">Product</label></div>
                            <div class="col-md-4">
                                <input class="form-control" id="plant_edit_product"
                                       name="product" type="text" value="<?php if(isset($product))echo $product ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_edit_sown" class="col-sm-2 control-label">Sown</label></div>
                            <div class="col-md-4">
                                <input class="form-control" id="plant_edit_sown"
                                       name="sown" type="date" value="<?php if(isset($sown))echo $sown ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_edit_qty" class="col-sm-2 control-label">QTY</label></div>
                            <div class="col-md-4">
                                <input class="form-control" id="plant_edit_qty"
                                       name="qty" type="number" value="<?php if(isset($qty))echo $qty ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_edit_available" class="col-sm-2 control-label">Available</label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control" id="plant_edit_available"
                                       name="available" type="text" value="<?php if(isset($available))echo $available ?>" required>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="plant_edit_id" value="<?php echo $id?>">
                    <div class="col-md-4">
                        <br>
                        <input type="submit" class="btn btn-lg btn-success btn-block" name="save" value="Save"/>
                    </div>
                    <div class="col-md-2 col-sm-4">
                        <br>
                        <a href="plants.php" class="btn btn-lg btn-default btn-block" name="cancel">Cancel</a>
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