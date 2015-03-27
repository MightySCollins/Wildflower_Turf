<?php
if (isset($_POST['id'])) $id = $_POST['id'];
elseif (isset($_GET['id'])) $id = $_GET['id'];
else $id = 1;

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno() && $_SESSION['admin']) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if (isset($_POST['delete'])) {
    $sql = "DELETE FROM plants WHERE id='$id'";
    $result = mysqli_query($con, $sql);
    $message = '<div class="alert alert-warning">Plant deleted</div>';
}

if (isset($_POST['save'])) {
    $bed = filter_var($_POST['bed'], FILTER_SANITIZE_STRING);
    $location = filter_var($_POST['location'], FILTER_SANITIZE_STRING);
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
        && !empty($available))
    {
        $sql = "UPDATE plants SET product = '$product', sown = '$sown', qty = '$qty', available = '$available' WHERE id='$id'";
        $result = mysqli_query($con, $sql);
        $message = '<div class="alert alert-success">Plant updated</div>';
    } else $message = '<div class="alert alert-warning">Some inputs are invalid</div>'; //todo: more descriptive
} else {
    $sql = "SELECT * FROM plants WHERE id ='$id'";
    $result = mysqli_query($con, $sql);
    if (!mysqli_num_rows($result)) {
        $message = '<div class="alert alert-warning">The plant cannot be found</div>';
        $id = 1;
        $sql = "SELECT * FROM plants WHERE id ='$id'";
        $result = mysqli_query($con, $sql);
    }

    while ($row = mysqli_fetch_array($result)) {
        $bed = htmlspecialchars($row['bed']);
        $location = htmlspecialchars($row['location']);
        $product = htmlspecialchars($row['product']);
        $sown = htmlspecialchars($row['sown']);
        $qty = htmlspecialchars($row['qty']);
        $available = htmlspecialchars($row['available']);
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
                                <?php echo $bed ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_edit_location" class="col-sm-2 control-label">Location</label></div>
                            <div class="col-md-4">
                                <?php echo $location ?>
                            </div>
                            <input type="hidden" name="location" id="plant_edit_location" value="<?php echo $id ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_edit_product" class="col-sm-2 control-label">Product</label></div>
                            <div class="col-md-4">
                                <input class="form-control" id="plant_edit_product"
                                       name="product" type="text" value="<?php if (isset($product)) echo $product ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_edit_sown" class="col-sm-2 control-label">Sown</label></div>
                            <div class="col-md-4">
                                <input class="form-control" id="plant_edit_sown"
                                       name="sown" type="date" value="<?php if (isset($sown)) echo $sown ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="plant_edit_qty" class="col-sm-2 control-label">QTY</label></div>
                            <div class="col-md-4">
                                <input class="form-control" id="plant_edit_qty"
                                       name="qty" type="number" value="<?php if (isset($qty)) echo $qty ?>" required>
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
                                       name="available" type="text"
                                       value="<?php if (isset($available)) echo $available ?>" required>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="id" id="plant_edit_id" value="<?php echo $id ?>">
                    <input type="hidden" name="bed" id="plant_edit_bed" value="<?php echo $bed ?>">
                    <input type="hidden" name="location" id="plant_edit_location" value="<?php echo $location ?>">

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
    </div>
</div>
