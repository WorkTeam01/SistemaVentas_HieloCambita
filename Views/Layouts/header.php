<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de ventas</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/Public/Css/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/Public/Css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/Public/Css/sweetalert2.min.css">
    <script src="<?php echo $URL; ?>/Public/Js/sweetalert2.min.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/Public/Css/datatables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $URL; ?>/Public/Css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $URL; ?>/Public/Css/buttons.bootstrap4.min.css">
    <!-- jQuery -->
    <script src="<?php echo $URL; ?>/Public/Js/jquery.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo $URL; ?>" class="nav-link">Sistema de Ventas</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <span><?php echo $nombres_sesion; ?></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo $URL; ?>/App/Controllers/login/cerrar_sesion.php" role="button" class="nav-link">
                        <i class="nav-icon fas fa-power-off"></i>
                        <span class="d-none d-sm-inline">Salir</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?php echo $URL; ?>" class="brand-link">
                <img src="<?php echo $URL; ?>/Public/Img/logo_hielo_cambita_2.jpeg" alt="Hielo Cambita Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Hielo cambita</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-5">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <?php if (esAdmin() && tienePermiso('roles')) : ?>
                            <!-- Modulo de Roles -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-address-card"></i>
                                    <p>
                                        Roles
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= $URL; ?>/Views/Roles" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de roles</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= $URL; ?>/Views/Roles/create.php" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Registrar rol</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if (esAdmin() && tienePermiso('usuarios')) : ?>
                            <!-- Modulo de usuarios -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Usuarios
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= $URL; ?>/Views/Usuarios" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de usuarios</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= $URL; ?>/Views/Usuarios/create.php" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Registrar usuario</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if (esAdmin() && tienePermiso('permisos')) : ?>
                            <!-- Modulo de permisos -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-list-check"></i>
                                    <p>
                                        Permisos
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/Views/Permisos" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Asignar permisos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if (tienePermiso('proveedores')) : ?>
                            <!-- Modulo de proveedores -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-truck"></i>
                                    <p>
                                        Proveedores
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/Views/Proveedores" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de proveedores</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if (tienePermiso('puestos')) : ?>
                            <!-- Modulo de puestos -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-warehouse"></i>
                                    <p>
                                        Puestos
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/Views/Puesto" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de puestos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if (tienePermiso('categorias')) : ?>
                            <!-- Modulo de categorias -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-tags"></i>
                                    <p>
                                        Categorias
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/Views/Categorias" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de categorias</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if (tienePermiso('productos')) : ?>
                            <!-- Modulo de productos -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-boxes-packing"></i>
                                    <p>
                                        Productos
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/Views/Productos" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de productos</p>
                                        </a>
                                    </li>
                                    <?php if (esAdmin() && tienePermiso('productos')) : ?>
                                        <li class="nav-item">
                                            <a href="<?php echo $URL; ?>/Views/Productos/create.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Crear producto</p>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if (tienePermiso('abastos')) : ?>
                            <!-- Modulo de abasto -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-shopping-basket"></i>
                                    <p>
                                        Abasto
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/Views/Abasto" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de abastos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/Views/Abasto/create.php" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Crear abasto</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if (tienePermiso('tipos_pago')) : ?>
                            <!-- Modulo de tipos de pago -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-money-check"></i>
                                    <p>
                                        Tipos de pagos
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/Views/TipoPago" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de tipos de pago</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if (tienePermiso('clientes')) : ?>
                            <!-- Modulo de clientes -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-user-friends"></i>
                                    <p>
                                        Clientes
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/Views/Clientes" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de clientes</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/Views/Clientes/create.php" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Crear cliente</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if (tienePermiso('pedidos')) : ?>
                            <!-- Modulo de pedidos -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-shopping-cart"></i>
                                    <p>
                                        Pedidos
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/Views/Pedidos" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de pedidos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo $URL; ?>/Views/Pedidos/create.php" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Crear pedido</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>