<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo URLROOT ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo URLROOT ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo URLROOT ?>/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?php echo URLROOT ?>" class="h1"><b>Electro</b>Shop</a>
            </div>
            <div class="card-body">
                <h2 class="login-box-msg">Sign in</h2>

                <form action="<?php echo URLROOT ?>/auth/authticateAdmin" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control <?php echo (isset($data['username_err'])) ? 'is-invalid' : ''; ?>" placeholder="UserName" name='username'>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <span style="color:#e46145;position:relative;top: -15px;"><?php echo (isset($data['username_err'])) ? $data['username_err'] : ''; ?></span>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control <?php echo (isset($data['password_err'])) ? 'is-invalid' : ''; ?>" placeholder="Password" name='password'>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <span style="color:#e46145;position:relative;top: -15px;"><?php echo (isset($data['password_err'])) ? $data['password_err'] : ''; ?></span>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" checked>
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="text-align:center;margin: 8% 8px;">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>

                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?php echo URLROOT ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo URLROOT ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo URLROOT ?>/dist/js/adminlte.min.js"></script>
</body>

</html>