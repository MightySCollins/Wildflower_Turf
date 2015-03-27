<?php
$connect = mysql_connect(DB_HOST, DB_USER, DB_PASS);
if (!$connect) die(mysql_error());
mysql_select_db(DB_NAME);

if (isset($_POST['save'])) {
    $bed = filter_var($_POST['bed'], FILTER_SANITIZE_STRING);
    $location = filter_var($_POST['location'], FILTER_SANITIZE_NUMBER_INT);
    $product = filter_var($_POST['product'], FILTER_SANITIZE_STRING);
    $sown = $_POST['sown'];
    $qty = filter_var($_POST['qty'], FILTER_SANITIZE_NUMBER_INT);
    $available = filter_var($_POST['available'], FILTER_SANITIZE_STRING);
    if (!empty($location)
        && !empty($product)
        && preg_match('/^[a-zA-Z\d]{0,64}$/i', $product)
        && !empty($qty)
        && is_numeric($qty)
        && !empty($available)
        && preg_match('/^[a-zA-Z\d]{0,64}$/i', $available)
    ) {
        $results = mysql_query("INSERT INTO plants (bed, location, product, sown, qty, available)
                            VALUES ('$bed', '$location', '$product', '$sown', '$qty', '$available')");
        $message = '<div class=\'alert alert-success\'>Plant added</div>';
    } else $message = '<div class=\'alert alert-warning\'>Some inputs are invalid</div>';
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Plant</h1>
            <?php if (isset($message)) echo $message;
            $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (!$db_connection->set_charset("utf8")) {
            $errors[] = $db_connection->error; }

            $sql = "SELECT * FROM beds;";
            $beds = $db_connection->query($sql);

            if ($beds->num_rows > 0){
            ?>
            <form method="post" action="newplant.php" name="plantadd">
                <fieldset>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_input_bed" class="col-sm-2 control-label">Bed</label></div>
                            <div class="col-md-4">
                                <select class="form-control" id="plant_input_bed"
                                        name="bed" required>
                                    <?php
                                    $results = mysql_query("SELECT * FROM beds");
                                    while ($row = mysql_fetch_array($results)) {
                                        echo '<option>' . $row['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_input_location" class="col-sm-2 control-label">Location</label></div>
                            <div class="col-md-4">
                                <input class="form-control" id="plant_input_location"
                                       name="location" type="text" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_input_product" class="col-sm-2 control-label">Product</label></div>
                            <div class="col-md-4">
                                <input class="form-control" id="plant_input_product"
                                       name="product" type="text" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_input_sown" class="col-sm-2 control-label">Sown</label></div>
                            <div class="col-md-4">
                                <input class="form-control" id="plant_input_sown"
                                       name="sown" type="date" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_input_qty" class="col-sm-2 control-label">QTY</label></div>
                            <div class="col-md-4">
                                <input class="form-control" id="plant_input_qty"
                                       name="qty" type="number" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_input_available" class="col-sm-2 control-label">Available</label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control" id="plant_input_available"
                                       name="available" type="text" required>
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
            <?php } else echo '<div class=\'alert alert-warning\'>You must add some beds first</div>' ?>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>