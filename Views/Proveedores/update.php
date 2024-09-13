<?php
require_once '../../App/config.php';
require_once '../../Views/Layouts/sesion.php';
require_once '../../App/Controllers/middleware/AuthMiddleware.php';

$auth = new AuthMiddleware($pdo, $URL);
$usuario = $auth->verificarPermiso('Administrador');

include_once '../../Views/Layouts/header.php';
include_once '../../App/Controllers/proveedores/update_proveedores.php';

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Actualizar proveedor</h1>
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
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Datos del proveedor</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"> <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="<?php echo $URL; ?>/App/Controllers/proveedores/update.php" method="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input name="id_proveedor" value="<?php echo $id_proveedor; ?>" class="form-control" hidden>
                                                    <label for="nombre_proveedor">Nombre del proveedor</label>
                                                    <input type="text" value="<?php echo $nombre_proveedor; ?>" name="nombre_proveedor" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="celular">Celular</label>
                                                    <input type="number" value="<?php echo $celular; ?>" name="celular" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="telefono">Telefono</label>
                                                    <input type="number" value="<?php echo $telefono; ?>" name="telefono" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="text" value="<?php echo $email; ?>" name="email" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="direccion">Dirección</label>
                                                    <textarea type="text" rows="3" name="direccion" class="form-control" required><?php echo $direccion; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <a href="<?php echo $URL; ?>/Views/Proveedores" class="btn btn-secondary mr-1">Cancelar</a>
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