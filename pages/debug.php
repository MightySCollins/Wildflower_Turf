<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Debug</h1>

            <?php
            if (DEV_MODE) {
                function trueFalse($const)
                {
                    if ($const == 0) return "False";
                    elseif ($const == 1) return "True";
                    else echo $const;
                }

                echo "<h4>Session Info</h4>";
                if (CLEAN_SESSIONS) {
                    echo "Username: " . $_SESSION['user_name'];
                    echo "<br>Logged in: ";
                    trueFalse($_SESSION['user_login_status']);
                } else {
                    foreach ($_SESSION as $key => $val)
                        echo $key . " " . $val . "<br>";
                    echo '<form method="post" action="debug.php">
                                <input class="btn btn-danger" type="submit" name="destroy" value="destroy"/>Warning: This will log you out
                            </form>';
                    if (isset($_POST['destroy'])) {
                        if ($_POST['destroy'] and $_SERVER['REQUEST_METHOD'] == "POST") {
                            session_destroy();
                        }
                    }
                }

                if (SHOW_CONFIG) {
                    echo "<h4>Config</h4>Edit these values in <strong>config/config.php</strong>";
                    echo "<br>Company name: " . COMPANY_NAME;
                    echo "<br>Registration: ";
                    echo trueFalse(REGISTER);
                    echo "<br><h5>Debug Area</h5>Dev Mode: ";
                    echo trueFalse(DEV_MODE);
                    echo "<br>Clean Sessions: ";
                    echo trueFalse(CLEAN_SESSIONS);
                    echo "<br>PHP Info: ";
                    echo trueFalse(PHP_INFO);
                    echo "<br>Show Config: ";
                    echo trueFalse(SHOW_CONFIG);
                    echo "<br>Show Constants: ";
                    echo trueFalse(SHOW_CONST);
                }

                if (SHOW_MYSQL) {
                    echo "<h4>MySQL</h4>";
                    echo "Host: " . DB_HOST;
                    echo "<br>Database: " . DB_NAME;
                    echo "<br>User: " . DB_USER;
                    echo "<br>Find password in <strong>config/dp.php</strong>";

                    $db = mysql_connect(DB_HOST, DB_USER, DB_PASS);
                    if (!$db) {
                        die('<br><button type="button" class="btn btn-warning">Disconnected</button><br>');
                    } else {
                        echo '<br><button type="button" class="btn btn-success">Connected</button>';
                    }
                }

                if (SHOW_CONST) {
                    echo "<h4>Constants</h4>";
                    print_r(get_defined_constants(true));
                }

                if (PHP_INFO) {
                    echo "<h4>PHP Info</h4>";
                    phpinfo();
                }
            } else echo '<div class="alert alert-danger">Please enable "DEV_MODE" in the config options</div>';
            ?>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>