<?php
$connect = mysql_connect(DB_HOST, DB_USER, DB_PASS);
if (!$connect) die(mysql_error());
mysql_select_db(DB_NAME);

if (isset($_POST['save'])) {
    $location = $_POST['location'];
    $product = $_POST['product'];
    $sown = $_POST['sown'];
    $qty = $_POST['qty'];
    $available = $_POST['available'];
    $results = mysql_query("INSERT INTO plants
                            VALUES ('$location', '$product', '$sown', '$qty', '$available')");
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Plant</h1>
            <?php if (isset($message)) echo $message ?>
            <form method="post" action="newplant.php" name="plantadd">
                <fieldset>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_input_location" class="col-sm-2 control-label">Location</label></div>
                            <div class="col-md-4">
                                <input class="form-control" id="plant_input_location"
                                       name="location" type="number">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_input_location" class="col-sm-2 control-label">Product</label></div>
                            <div class="col-md-4">
                                <input class="form-control" id="plant_input_product"
                                       name="product" type="text"">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_input_sown" class="col-sm-2 control-label">Sown</label></div>
                            <div class="col-md-4">
                                <input class="form-control" id="plant_input_sown"
                                       name="sown" type="date"">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_input_qty" class="col-sm-2 control-label">QTY</label></div>
                            <div class="col-md-4">
                                <input class="form-control" id="plant_input_qty"
                                       name="qty" type="number"">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_input_available" class="col-sm-2 control-label">Available</label></div>
                            <div class="col-md-4">
                                <input class="form-control" id="plant_input_available"
                                       name="available" type="text"">
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