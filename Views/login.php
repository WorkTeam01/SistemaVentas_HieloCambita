<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../Public/Css/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../Public/Css/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../Public/Css/adminlte.min.css">
    <!-- SweetAlert2-->
    <link rel="stylesheet" href="../Public/Css/sweetalert2.min.css">
    <script src="../Public/Js/sweetalert2.min.js"></script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <?php
        session_start();
        if (isset($_SESSION['mensaje'])) {
            $respuesta = $_SESSION['mensaje']; ?>
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "error",
                    title: "<?php echo $respuesta; ?>"
                });
            </script>
        <?php
            unset($_SESSION['mensaje']);
        }
        ?>
        <div class="login-logo">
            <img src="https://img.freepik.com/vector-gratis/impulsar-ilustracion-concepto-abstracto-ventas_335657-1833.jpg?t=st=1722898994~exp=1722902594~hmac=7d1efa237835c4809ecffc6e37448aa241c0ec228445f3ba9afaec7d07f99655&w=826" class="img-fluid img-circle" width="150" height="150" alt="Img del login">
        </div>
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>SISTEMA DE</b> VENTAS</a>
            </div>
            <div class="card-body">
                <h5 class="login-box-msg">Login</h5>

                <form action="../App/Controllers/login/ingreso.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="user" class="form-control" placeholder="Ingrese su usuario">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password_user" class="form-control" placeholder="Ingrese su contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="../Public/Js/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../Public/Js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../Public/Js/adminlte.min.js"></script>
</body>

</html>