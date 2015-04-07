<?php

// setup configs
require_once("config/db.php");
require_once("config/config.php");

// load the login class
require_once("classes/Login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login();

$page = 'pages/search.php';

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() === true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
    include("pages/template.php");

} else {
    // forces the user to login again
    include("pages/login.php");
}
