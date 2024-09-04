<?php
include_once 'App/config.php';
include_once 'Views/Layouts/sesion.php';
include_once 'Views/Layouts/header.php';

include_once 'App/Controllers/usuarios/listado_de_usuarios.php';
include_once 'App/Controllers/roles/listado_de_roles.php';
include_once 'App/Controllers/categorias/listado_de_categorias.php';
include_once 'App/Controllers/productos/listado_de_productos.php';
include_once 'App/Controllers/proveedores/listado_de_proveedores.php';
include_once 'App/Controllers/abasto/listado_de_abastos.php';
include_once 'App/Controllers/puesto/listado_de_puestos.php';
include_once 'App/Controllers/tipo_pago/listado_de_tipo_pagos.php';
include_once 'Views/Layouts/mensajes.php';

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Bienvenido al sistema - <?= $rol_sesion; ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- Tarjeta de usuarios -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $total_user; ?></h3>
                            <p>Usuarios registrados</p>
                        </div>
                        <a href="<?php echo $URL; ?>/Views/Usuarios/create.php">
                            <div class="icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL; ?>/Views/Usuarios" class="small-box-footer">
                            Mas detalles <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- Tarjeta de roles -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $total_roles; ?></h3>
                            <p>Roles registrados</p>
                        </div>
                        <a href="<?php echo $URL; ?>/Views/Roles/create.php">
                            <div class="icon">
                                <i class="fas fa-id-card-alt"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL; ?>/Views/Roles" class="small-box-footer">
                            Mas detalles <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- Tarjeta de categorias -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $total_categorias; ?></h3>
                            <p>Categorias registradas</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tag"></i>
                        </div>
                        <a href="<?php echo $URL; ?>/Views/Categorias" class="small-box-footer">
                            Mas detalles <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- Tarjeta de productos -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?php echo $total_productos; ?></h3>
                            <p>Productos registrados</p>
                        </div>
                        <a href="<?php echo $URL; ?>/Views/Productos/create.php">
                            <div class="icon">
                                <i class="fas fa-boxes"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL; ?>/Views/Productos" class="small-box-footer">
                            Mas detalles <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- Tarjeta de proveedores -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3><?php echo $total_proveedores; ?></h3>
                            <p>Proveedores registrados</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-truck-moving"></i>
                        </div>
                        <a href="<?php echo $URL; ?>/Views/Proveedores" class="small-box-footer">
                            Mas detalles <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- Tarjeta de abastos -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo $total_abasto; ?></h3>
                            <p>Abastos registrados</p>
                        </div>
                        <a href="<?php echo $URL; ?>/Views/Abasto/create.php">
                            <div class="icon">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL; ?>/Views/Abasto" class="small-box-footer">
                            Mas detalles <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- Tarjeta de puestos -->
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h3><?php echo $total_puestos; ?></h3>
                            <p>Puestos registrados</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-warehouse"></i>
                        </div>
                        <a href="<?php echo $URL; ?>/Views/Puesto" class="small-box-footer">
                            Mas detalles <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- Tarjeta de tipos de pagos -->
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3><?php echo $total_tipo_pagos; ?></h3>
                            <p>Tipos de pagos registrados</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <a href="<?php echo $URL; ?>/Views/TipoPago" class="small-box-footer">
                            Mas detalles <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include_once 'Views/Layouts/footer.php';
?>