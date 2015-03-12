<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo COMPANY_NAME ?> - Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <br><br>

            <h1><?php echo COMPANY_NAME ?></h1>

            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if (!REGISTER) echo '<div class=\'alert alert-warning\'>Registration is currently <strong>closed</strong></div>';

                    if (isset($login)) {
                        if ($login->errors) {
                            foreach ($login->errors as $error) {
                                echo "<br><div class='alert alert-danger'>$error</div>";
                            }
                        }
                        if ($login->messages) {
                            foreach ($login->messages as $message) {
                                echo "<br><div class='alert alert-warning'>$message</div>";
                            }
                        }
                    }
                    ?>
                    <form role="form">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" id="login_input_username" placeholder="Username"
                                       name="username" type="text" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="login_input_password" placeholder="Password"
                                       name="password" type="password"
                                       value="">
                            </div>
                            <input type="submit" class="btn btn-lg btn-success btn-block" name="login" value="Login"/>
                        </fieldset>
                        <?php if (REGISTER) echo '<br><a class="btn btn-primary" href="register.php">Register Now</a>'; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>