<?php
include_once '../../App/config.php';

include_once '../../Views/Layouts/sesion.php';
include_once '../../Views/Layouts/header.php';

include_once '../../App/Controllers/usuarios/show_usuario.php';
include_once '../../App/Controllers/roles/listado_de_roles.php';

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Actualizar usuario</h1>
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
                                    <form action="../../App/Controllers/usuarios/update.php" method="post">
                                        <input type="text" name="id_usuario" class="form-control" value="<?php echo $id_usuario_get; ?>" hidden>
                                        <div class="form-group">
                                            <label for="">Usuario</label>
                                            <input type="text" name="usuario" class="form-control" value="<?php echo $usuario; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nombres</label>
                                            <input type="text" name="nombres" class="form-control" value="<?php echo $nombres_usuario; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Apellidos</label>
                                            <input type="text" name="apellidos" class="form-control" value="<?php echo $apellidos_usuario; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" name="email" class="form-control" value="<?php echo $email_usuario; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Estado</label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch1" name="estado" value="1" <?php echo $estado_usuario ? 'checked' : ''; ?>>
                                                <label class="custom-control-label" for="customSwitch1"><?php echo $estado_usuario ? 'Activo' : 'Inactivo'; ?></label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Rol</label>
                                            <select name="rol" class="form-control" required>
                                                <?php foreach ($roles_datos as $roles_dato) {
                                                    $rol_tabla = $roles_dato['RolUsuario'];
                                                    $id_rol = $roles_dato['IdRolUsuario']; ?>
                                                    <option value="<?php echo $id_rol; ?>" <?php if ($rol_tabla == $rol) { ?> selected="selected" <?php } ?>>
                                                        <?php echo $rol_tabla; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Contraseña</label>
                                            <input type="text" name="password_user" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Repita la contraseña</label>
                                            <input type="text" name="password_repeat" class="form-control">
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <a href="<?php echo $URL; ?>/Views/Usuarios" class="btn btn-secondary mr-1">Cancelar</a>
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