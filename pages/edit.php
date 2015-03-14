<?php

function lookup(location) {

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
                                       name="location" type="number" value="<?php echo $_GET['location'] ?>">
                            </div>

                            <div class="col-md-1 col-sm-1">
                                <form method="post" action="edit.php">
                                    <input class="btn btn-primary" type="submit" name="lookup" value="lookup"/>
                                </form>
                            </div>

                            <?php
                            if (isset($_POST['lookup'])) {
                                if ($_POST['lookup'] and $_SERVER['REQUEST_METHOD'] == "POST") {
                                    lookup($_POST['location']);
                                    // todo: add lookup script
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="login_input_password" placeholder="Password"
                               name="user_password" type="password"
                               value="">
                    </div>
                    <input type="submit" class="btn btn-lg btn-success btn-block" name="login" value="Login"/>
                </fieldset>
            </form>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>