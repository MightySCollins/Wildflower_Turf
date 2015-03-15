<?php
if (isset($_POST['lookup']) || isset($_POST['save'])) {
        $location = $_POST['location'];
} elseif (!empty($_GET['location']))
    $location = $_GET['location'];
else $location = 1;

$connect = mysql_connect(DB_HOST, DB_USER, DB_PASS);
if (!$connect) {
    die(mysql_error());
}

mysql_select_db(DB_NAME);
$results = mysql_query("SELECT * FROM plants WHERE location =" . $location . ";");
while ($row = mysql_fetch_array($results)) {
    $product = $row['product'];
    $sown = $row['sown'];
    $qty = $row['qty'];
    $available = $row['available'];
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Plant</h1>

            <form method="post" action="edit.php" name="plantedit">
                <fieldset>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_input_location" class="col-sm-2 control-label">Location</label></div>

                            <div class="col-md-4">
                                <input class="form-control" id="plant_input_location"
                                       name="location" type="number" value="<?php echo $location ?>">
                            </div>

                            <div class="col-md-1 col-sm-1">
                                <input class="btn btn-primary" type="submit" name="lookup" value="Lookup"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_input_location" class="col-sm-2 control-label">Product</label></div>

                            <div class="col-md-4">
                                <input class="form-control" id="plant_input_product"
                                       name="product" type="text" value="<?php echo $product ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_input_sown" class="col-sm-2 control-label">Sown</label></div>

                            <div class="col-md-4">
                                <input class="form-control" id="plant_input_sown"
                                       name="product" type="date" value="<?php echo $sown ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_input_qty" class="col-sm-2 control-label">QTY</label></div>

                            <div class="col-md-4">
                                <input class="form-control" id="plant_input_qty"
                                       name="qty" type="number" value="<?php echo $qty ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_input_available" class="col-sm-2 control-label">Available</label></div>

                            <div class="col-md-4">
                                <input class="form-control" id="plant_input_available"
                                       name="available" type="text" value="<?php echo $available ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <br>
                        <input type="submit" class="btn btn-lg btn-success btn-block" name="save" value="Save"/>
                    </div>
                </fieldset>
            </form>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>