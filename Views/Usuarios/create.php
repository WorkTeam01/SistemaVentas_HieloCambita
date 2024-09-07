<?php
include_once '../../App/config.php';

include_once '../../Views/Layouts/sesion.php';
include_once '../../Views/Layouts/header.php';

include_once '../../App/Controllers/roles/listado_de_roles.php';
include_once '../../App/Controllers/puesto/listado_de_puestos.php';

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Crear usuario</h1>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ingrese los datos del usuario</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"> <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="<?php echo $URL; ?>/App/Controllers/usuarios/create.php" method="post">
                                        <div class="form-group">
                                            <label for="">Usuario</label>
                                            <input type="text" name="usuario" class="form-control" placeholder="Ingrese un nombre de usuario" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nombres del usuario</label>
                                            <input type="text" name="nombres_usuario" class="form-control" placeholder="Ingrese los nombres del usuario" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Apellidos del usuario</label>
                                            <input type="text" name="apellidos_usuario" class="form-control" placeholder="Ingrese los apellidos del usuario" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" name="email" class="form-control" placeholder="Ingrese el email del usuario" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="rol">Rol</label>
                                            <select name="rol" id="rol" class="form-control">
                                                <?php foreach ($roles_datos as $roles_dato) { ?>
                                                    <option value="<?php echo $roles_dato['IdRolUsuario']; ?>"><?php echo $roles_dato['RolUsuario']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="puesto">Puesto</label>
                                            <select name="puesto" id="puesto" class="form-control">
                                                <?php foreach ($puestos_datos as $puestos_dato) { ?>
                                                    <option value="<?php echo $puestos_dato['IdPuesto']; ?>"><?php echo $puestos_dato['NombrePuesto']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Contraseña</label>
                                            <input type="password" name="password_user" class="form-control" placeholder="Ingrese la contraseña del usuario" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Repita la contraseña</label>
                                            <input type="password" name="password_repeat" class="form-control" placeholder="Vuelva a ingresar la contraseña" required>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <a href="<?php echo $URL; ?>/Views/Usuarios" class="btn btn-secondary mr-1">Cancelar</a>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
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