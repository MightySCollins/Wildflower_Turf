<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<?php
$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$db_connection->set_charset("utf8")) {
    $errors[] = $db_connection->error;
}

if (!$db_connection->connect_errno) {
    ?>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-leaf fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                <?php
                                $sql = "SELECT location
                                    FROM plants;";
                                $result_of_login_check = $db_connection->query($sql);

                                $total_plants = $result_of_login_check->num_rows;
                                echo $total_plants;
                                ?>
                            </div>
                            <div>Plants Added</div>
                        </div>
                    </div>
                </div>
                <a href="plants.php">
                    <div class="panel-footer">
                        <span class="pull-left">View All</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-clock-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                <?php
                                $sql = "SELECT location
                                    FROM plants
                                    WHERE available='Now';";
                                $result_of_login_check = $db_connection->query($sql);

                                $ready_plants = $result_of_login_check->num_rows;
                                echo $ready_plants;
                                ?>
                            </div>
                            <div>Ready Now</div>
                        </div>
                    </div>
                </div>
                <a href="plants.php?view=ready"> <!-- todo: add plants views -->
                    <div class="panel-footer">
                        <span class="pull-left">View Ready</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-calendar fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php
                                echo $total_plants - $ready_plants;
                                ?></div>
                            <div>Not Ready</div>
                        </div>
                    </div>
                </div>
                <a href="plants.php?view=not_ready">
                    <div class="panel-footer">
                        <span class="pull-left">View not ready</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-support fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">13</div>
                            <div>Support Tickets!</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
<?php }