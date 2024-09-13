<?php
require_once '../../App/config.php';
require_once '../../Views/Layouts/sesion.php';
require_once '../../App/Controllers/middleware/AuthMiddleware.php';

$auth = new AuthMiddleware($pdo, $URL);
$usuario = $auth->verificarRoles(['Administrador', 'Vendedor', 'Comprador']);

include_once '../../Views/Layouts/header.php';
include_once '../../App/Controllers/tipo_pago/listado_de_tipo_pagos.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Lista de tipos de pagos
                        <?php if ($rol_sesion != 'Administrador') : ?>
                            <button type="button" class="btn btn-primary ml-1" data-toggle="modal" data-target="#modal-create" disabled>
                                <i class="fas fa-plus"></i> Crear nueva
                            </button>
                        <?php else : ?>
                            <button type="button" class="btn btn-primary ml-1" data-toggle="modal" data-target="#modal-create">
                                <i class="fas fa-plus"></i> Crear nueva
                            </button>
                        <?php endif; ?>
                    </h1>
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
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tipos de pagos registrados</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"> <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-hover table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nro</th>
                                            <th class="text-center">Tipo de pago</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $contador = 0;
                                        foreach ($tipo_pagos_datos as $tipo_pagos_dato) {
                                            $id_tipo_pago = $tipo_pagos_dato['IdTipoPago'];
                                            $tipo_pago = $tipo_pagos_dato['TipoPago']; ?>
                                            <tr>
                                                <td class="text-center"><?php echo $contador += 1; ?></td>
                                                <td><?php echo $tipo_pago; ?></td>
                                                <td>
                                                    <div class="text-center">
                                                        <?php if ($rol_sesion != 'Administrador') : ?>
                                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-update<?php echo $id_tipo_pago; ?>" disabled>
                                                                <i class="fas fa-pencil-alt"></i> Editar
                                                            </button>
                                                        <?php else : ?>
                                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-update<?php echo $id_tipo_pago; ?>">
                                                                <i class="fas fa-pencil-alt"></i> Editar
                                                            </button>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <!-- Fin de load_categoria -->
                            </div>
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

<!-- Page specific script -->
<script>
    $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
        buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: [{
                    text: 'Copiar',
                    extend: 'copy'
                }, {
                    extend: 'pdf',
                }, {
                    extend: 'csv',
                }, {
                    extend: 'excel',
                }, {
                    text: 'Imprimir',
                    extend: 'print'
                }]
            },
            {
                extend: 'colvis',
                text: 'Visualización de columnas'
            }
        ],
        "pageLength": 5,
        lengthMenu: [
            [3, 5, 10, 25, 50],
            [3, 5, 10, 25, 50]
        ],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ Tipos de pago",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 Tipos de pago",
            "sInfoFiltered": "(filtrado de un total de _MAX_ Tipos de pago)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
</script>

<!-- Modal para creación de tipos de pagos -->
<div class="modal fade" id="modal-create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Crear tipo de pago</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tipo_pago">Tipo de pago</label>
                            <input type="text" id="tipo_pago" class="form-control">
                            <small class="text-danger d-none" id="lbl_create">* Debe ingresar el tipo de pago</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn_create">Crear tipo de pago</button>
            </div>
        </div>
    </div>
</div>
<div id="respuesta"></div>

<script>
    $('#btn_create').click(function() {

        var tipo_pago = $('#tipo_pago').val();
        var url = "../../App/Controllers/tipo_pago/registro_de_tipo_pagos.php";

        if (tipo_pago == "") {
            $('#tipo_pago').focus();
            $('#lbl_create').removeClass('d-none');
        } else {
            $.get(url, {
                tipo_pago: tipo_pago
            }, function(datos) {
                $('#respuesta').html(datos);
            });
        }
    });
</script>

<?php
foreach ($tipo_pagos_datos as $tipo_pagos_dato) :
    $id_tipo_pago = $tipo_pagos_dato['IdTipoPago'];
    $tipo_pago = $tipo_pagos_dato['TipoPago']; ?>
    <!-- Modal update categorias -->
    <div class="modal fade" id="modal-update<?php echo $id_tipo_pago; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title">Actualizar tipo de pago</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tipo_pago">Tipo de pago</label>
                                <input type="text" id="tipo_pago<?php echo $id_tipo_pago; ?>" value="<?php echo $tipo_pago; ?>" name="tipo_pago" class="form-control">
                                <small class="text-danger d-none" id="lbl_update<?php echo $id_tipo_pago; ?>">* Debe ingresar el tipo de pago</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" id="btn_update<?php echo $id_tipo_pago; ?>">Actualizar tipo de pago</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#btn_update<?php echo $id_tipo_pago; ?>').click(function() {
            var tipo_pago = $('#tipo_pago<?php echo $id_tipo_pago; ?>').val();
            var id_tipo_pago = '<?php echo $id_tipo_pago; ?>';

            if (tipo_pago == "") {
                $('#tipo_pago<?php echo $id_tipo_pago; ?>').focus();
                $('#lbl_update<?php echo $id_tipo_pago; ?>').removeClass('d-none');
            } else {
                var url = "../../App/Controllers/tipo_pago/update_de_tipo_pago.php";
                $.get(url, {
                    id_tipo_pago: id_tipo_pago,
                    tipo_pago: tipo_pago
                }, function(datos) {
                    $('#respuesta_update<?php echo $id_tipo_pago; ?>').html(datos);
                });
            }
        });
    </script>
    <div id="respuesta_update<?php echo $id_tipo_pago; ?>"></div>
<?php endforeach; ?>