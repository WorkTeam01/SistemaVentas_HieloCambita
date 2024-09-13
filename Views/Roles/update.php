<?php
require_once '../../App/config.php';
require_once '../../Views/Layouts/sesion.php';
require_once '../../App/Controllers/middleware/AuthMiddleware.php';

$auth = new AuthMiddleware($pdo, $URL);
$usuario = $auth->verificarPermiso('Administrador');

include_once '../../Views/Layouts/header.php';

include_once '../../App/Controllers/roles/update_roles.php';

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Actualizar rol</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Datos para modificar</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"> <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="<?php echo $URL; ?>/App/Controllers/roles/update.php" method="post">
                                        <input type="text" name="id_rol" class="form-control" value="<?php echo $id_rol_get; ?>" hidden>
                                        <div class="form-group">
                                            <label for="">Rol</label>
                                            <input type="text" name="rol" class="form-control" value="<?php echo $rol; ?>" required>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <a href="<?php echo $URL; ?>/Views/Roles" class="btn btn-secondary mr-1">Cancelar</a>
                                            <button type="submit" class="btn btn-success">Actualizar</button>
                                        </div>
                                    </form>
                                </div>
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