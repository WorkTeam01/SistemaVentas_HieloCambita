<?php
require_once '../../App/config.php';
require_once '../../Views/Layouts/sesion.php';
require_once '../../App/Controllers/middleware/AuthMiddleware.php';

$auth = new AuthMiddleware($pdo, $URL);
$usuario = $auth->verificarPermisoYAdmin('permisos');

include_once '../../App/Controllers/permisos/obtener_permisos.php';
include_once '../../Views/Layouts/header.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Gestión de Permisos</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Asignación de Permisos</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"> <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            <form id="permisos-form" method="post" action="<?php echo $URL; ?>/App/Controllers/permisos/actualizar_permisos.php">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="rol" class="form-label">Selecciona un rol:</label>
                                            <select class="form-select form-control" id="rol" name="rol" required>
                                                <option value="">Selecciona un rol</option>
                                                <?php foreach ($roles_datos as $roles_dato): ?>
                                                    <option value="<?php echo $roles_dato['IdRolUsuario']; ?>"><?php echo htmlspecialchars($roles_dato['RolUsuario']); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="usuario" class="form-label">Selecciona un usuario (opcional):</label>
                                            <select class="form-select form-control" id="usuario" name="usuario">
                                                <option value="">Selecciona un usuario</option>
                                                <!-- Los usuarios se cargarán dinámicamente aquí -->
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div id="permisos-container" style="display: none;">
                                    <h5>Permisos:</h5>
                                    <?php if (!empty($permisos)): ?>
                                        <?php foreach ($permisos as $permiso): ?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permisos[]" value="<?php echo $permiso['IdPermiso']; ?>" id="permiso_<?php echo $permiso['IdPermiso']; ?>">
                                                <label class="form-check-label" for="permiso_<?php echo $permiso['IdPermiso']; ?>">
                                                    <?php echo htmlspecialchars($permiso['NombrePermiso']); ?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p>No hay permisos disponibles.</p>
                                    <?php endif; ?>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-primary">Guardar Permisos</button>
                                <a href="<?php echo $URL; ?>" class="btn btn-secondary">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once '../../Views/Layouts/mensajes.php'; ?>
<?php include_once '../../Views/Layouts/footer.php'; ?>

<script>
    $(document).ready(function() {
        $('#rol').change(function() {
            var rolId = $(this).val();
            if (rolId) {
                // Cargar usuarios del rol seleccionado
                $.ajax({
                    url: '<?php echo $URL; ?>/App/Controllers/permisos/obtener_usuarios_rol.php',
                    method: 'POST',
                    data: {
                        rolId: rolId
                    },
                    dataType: 'json',
                    success: function(response) {
                        var usuarioSelect = $('#usuario');
                        usuarioSelect.empty();
                        usuarioSelect.append('<option value="">Selecciona un usuario</option>');
                        $.each(response.usuarios, function(index, usuario) {
                            usuarioSelect.append('<option value="' + usuario.IdUsuario + '">' + usuario.NombreUsuario + '</option>');
                        });
                    }
                });

                $('#permisos-container').show();
                cargarPermisos(rolId);
            } else {
                $('#usuario').empty().append('<option value="">Selecciona un usuario</option>');
                $('#permisos-container').hide();
            }
        });

        $('#usuario').change(function() {
            var usuarioId = $(this).val();
            if (usuarioId) {
                cargarPermisos(null, usuarioId);
            } else {
                var rolId = $('#rol').val();
                cargarPermisos(rolId);
            }
        });

        function cargarPermisos(rolId, usuarioId) {
            $('input[type="checkbox"]').prop('checked', false);
            $.ajax({
                url: '<?php echo $URL; ?>/App/Controllers/permisos/obtener_permisos.php',
                method: 'POST',
                data: {
                    rolId: rolId,
                    usuarioId: usuarioId
                },
                dataType: 'json',
                success: function(response) {
                    response.permisos.forEach(function(permiso) {
                        var permisoId = permiso.IdPermiso;
                        $('#permiso_' + permisoId).prop('checked', response.permisosAsignados.includes(permisoId.toString()));
                    });
                }
            });
        }

        $('#permisos-form').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var usuarioId = $('#usuario').val();
            var rolId = $('#rol').val();

            if (!usuarioId && !rolId) {
                Swal.fire({
                    toast: true,
                    icon: 'error',
                    title: 'Debe seleccionar un usuario o un rol',
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
                return;
            }

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            toast: true,
                            icon: 'success',
                            title: response.message,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        }).then(() => {
                            // Resetear el formulario
                            $('#rol').val('');
                            $('#usuario').empty().append('<option value="">Selecciona un usuario</option>');
                            $('#permisos-container').hide();
                            $('input[type="checkbox"]').prop('checked', false);
                        });
                    } else {
                        Swal.fire({
                            toast: true,
                            icon: 'error',
                            title: response.message,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error:', textStatus, errorThrown);
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        title: 'Error al procesar la solicitud: ' + textStatus,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                }
            });
        });
    });
</script>