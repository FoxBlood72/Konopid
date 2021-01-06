<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require 'p_req/login.php';
?>
<!doctype html>
<!-- 
* Bootstrap Simple Admin Template
* Version: 2.0
* Author: Alexis Luna
* Copyright 2020 Alexis Luna
* Website: https://github.com/alexis-luna/bootstrap-simple-admin-template
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login | Bootstrap Simple Admin Template</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/auth.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <div class="auth-content">
            <div class="card">
                <div class="card-body text-center">
                <?php 
                if(isset($errpwd) && $errpwd === true)
                {
                ?>
                    <div class="alert alert-danger" role="alert">Invalid username or password!</div>
                <?php 
                }
                ?>
                    <div class="mb-4">
                        <img class="brand" src="../images/konopid-min.png" height="125" alt="bootstraper logo">
                    </div>
                    <h6 class="mb-4 text-muted">Admin Panel Login</h6>
                    <form action="" method="post">
                        <div class="form-group text-left">
                            <label for="email">Username</label>
                            <input name="username" class="form-control" placeholder="Enter Username" required>
                        </div>
                        <div class="form-group text-left">
                            <label for="password">Password</label>
                            <input name="pwd" type="password" class="form-control" placeholder="Password" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary shadow-2 mb-4">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>