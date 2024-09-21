<?php
require_once '../../App/config.php';
require_once '../../Views/Layouts/sesion.php';
require_once '../../App/Controllers/middleware/AuthMiddleware.php';

$auth = new AuthMiddleware($pdo, $URL);
$usuario = $auth->verificarPermisoYAdmin('usuarios');

include_once '../../Views/Layouts/header.php';
include_once '../../App/Controllers/roles/listado_de_roles.php';
include_once '../../App/Controllers/puesto/listado_de_puestos.php';

// Obtener los datos del formulario de la sesión, si existen
$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
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
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ingrese los datos del usuario</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"> <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo $URL; ?>/App/Controllers/usuarios/create.php" method="post">
                                <div class="form-group">
                                    <label for="">Usuario</label>
                                    <input type="text" name="usuario" class="form-control" placeholder="Ingrese un nombre de usuario" required value="<?php echo isset($form_data['usuario']) ? $form_data['usuario'] : ''; ?>">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nombres del usuario</label>
                                            <input type="text" name="nombres_usuario" class="form-control" placeholder="Ingrese los nombres del usuario" required value="<?php echo isset($form_data['nombres_usuario']) ? $form_data['nombres_usuario'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Apellidos del usuario</label>
                                            <input type="text" name="apellidos_usuario" class="form-control" placeholder="Ingrese los apellidos del usuario" required value="<?php echo isset($form_data['apellidos_usuario']) ? $form_data['apellidos_usuario'] : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Ingrese el email del usuario" required value="<?php echo isset($form_data['email']) ? $form_data['email'] : ''; ?>">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rol">Rol</label>
                                            <select name="rol" id="rol" class="form-control">
                                                <?php foreach ($roles_datos as $roles_dato) { ?>
                                                    <option value="<?php echo $roles_dato['IdRolUsuario']; ?>" <?php echo (isset($form_data['rol']) && $form_data['rol'] == $roles_dato['IdRolUsuario']) ? 'selected' : ''; ?>><?php echo $roles_dato['RolUsuario']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="puesto">Puesto</label>
                                            <select name="puesto" id="puesto" class="form-control">
                                                <?php foreach ($puestos_datos as $puestos_dato) { ?>
                                                    <option value="<?php echo $puestos_dato['IdPuesto']; ?>" <?php echo (isset($form_data['puesto']) && $form_data['puesto'] == $puestos_dato['IdPuesto']) ? 'selected' : ''; ?>><?php echo $puestos_dato['NombrePuesto']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Contraseña</label>
                                            <input type="password" name="password_user" class="form-control" placeholder="Ingrese la contraseña" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Repetir contraseña</label>
                                            <input type="password" name="password_repeat" class="form-control" placeholder="Repita la contraseña" required>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <a type="button" href="<?php echo $URL; ?>/App/Controllers/usuarios/cancelar_creacion_usuario.php" class="btn btn-secondary mr-2">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Guardar usuario</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include_once '../../Views/Layouts/mensajes.php'; ?>
<?php include_once '../../Views/Layouts/footer.php'; ?>