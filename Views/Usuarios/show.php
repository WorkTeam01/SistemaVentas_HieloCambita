<?php
include_once '../../App/config.php';

include_once '../../Views/Layouts/sesion.php';
include_once '../../Views/Layouts/header.php';

include_once '../../App/Controllers/usuarios/show_usuario.php';

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Detalles del usuario</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Información del usuario</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"> <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md 4">
                                            <div class="form-group">
                                                <label for="">Usuario</label>
                                                <input type="text" name="nombres" value="<?php echo $usuario; ?>" class="form-control" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Nombres</label>
                                                <input type="text" name="nombres" value="<?php echo $nombres_usuario; ?>" class="form-control" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Apellidos</label>
                                                <input type="text" name="nombres" value="<?php echo $apellidos_usuario; ?>" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md 4">
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="email" name="email" value="<?php echo $email_usuario; ?>" class="form-control" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Rol</label>
                                                <input type="text" name="rol" value="<?php echo $rol; ?>" class="form-control" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Estado</label>
                                                <input type="text" name="rol" value="<?php echo $estado_usuario; ?>" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <a href="<?php echo $URL; ?>/Views/Usuarios" class="btn btn-secondary mr-1">Volver</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<!-- /.content-wrapper -->

<?php include_once '../../Views/Layouts/mensajes.php'; ?>
<?php include_once '../../Views/Layouts/footer.php'; ?>