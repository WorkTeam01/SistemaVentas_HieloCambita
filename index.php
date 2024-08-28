<?php
include_once 'App/config.php';
include_once 'Views/Layouts/sesion.php';
include_once 'Views/Layouts/header.php';

include_once 'App/Controllers/usuarios/listado_de_usuarios.php';
include_once 'App/Controllers/roles/listado_de_roles.php';

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
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include_once 'Views/Layouts/footer.php';
?>