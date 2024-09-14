<?php
require_once '../../App/config.php';
require_once '../../Views/Layouts/sesion.php';
require_once '../../App/Controllers/middleware/AuthMiddleware.php';

$auth = new AuthMiddleware($pdo, $URL);
$usuario = $auth->verificarPermiso('Administrador');

include_once '../../Views/Layouts/header.php';
include_once '../../App/Controllers/puesto/listado_de_puestos.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Lista de puestos
                        <button type="button" class="btn btn-primary ml-1" data-toggle="modal" data-target="#modal-create">
                            <i class="fas fa-plus"></i> Crear nuevo
                        </button>
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
                <div class="col-md-8">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Puestos registrados</h3>
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
                                            <th class="text-center">Nombre del puesto</th>
                                            <th class="text-center">Ubicación del puesto</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $contador = 0;
                                        foreach ($puestos_datos as $puesto_dato) {
                                            $id_puesto = $puesto_dato['IdPuesto'];
                                            $nombre_puesto = $puesto_dato['NombrePuesto'];
                                            $ubicacion_puesto = $puesto_dato['UbicacionPuesto'];
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $contador += 1; ?></td>
                                                <td><?php echo $nombre_puesto; ?></td>
                                                <td><?php echo $ubicacion_puesto; ?></td>
                                                <td>
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-update<?php echo $id_puesto; ?>">
                                                            <i class="fas fa-pencil-alt"></i> Editar
                                                        </button>
                                                    </div>
                                                    <!-- Modal update puesto -->
                                                    <div class="modal fade" id="modal-update<?php echo $id_puesto; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-success">
                                                                    <h4 class="modal-title">Actualizar puesto</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="nombre_puesto">Nombre del puesto</label>
                                                                                <input type="text" id="nombre_puesto<?php echo $id_puesto; ?>" value="<?php echo $nombre_puesto; ?>" class="form-control">
                                                                                <small class="text-danger d-none" id="lbl_nombre_puesto_update<?php echo $id_puesto; ?>">* Debe ingresar el nombre del puesto</small>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="ubicacion_puesto">Ubicación del puesto</label>
                                                                                <input type="text" id="ubicacion_puesto<?php echo $id_puesto; ?>" value="<?php echo $ubicacion_puesto; ?>" class="form-control">
                                                                                <small class="text-danger d-none" id="lbl_ubicacion_puesto_update<?php echo $id_puesto; ?>">* Debe ingresar la ubicación del puesto</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                    <button type="button" class="btn btn-success" id="btn_update<?php echo $id_puesto; ?>">Actualizar puesto</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        $('#btn_update<?php echo $id_puesto; ?>').click(function() {
                                                            var nombre_puesto = $('#nombre_puesto<?php echo $id_puesto; ?>').val();
                                                            var ubicacion_puesto = $('#ubicacion_puesto<?php echo $id_puesto; ?>').val();
                                                            var id_puesto = '<?php echo $id_puesto; ?>';

                                                            if (nombre_puesto == "") {
                                                                $('#nombre_puesto<?php echo $id_puesto; ?>').focus();
                                                                $('#lbl_nombre_puesto_update<?php echo $id_puesto; ?>').removeClass('d-none');
                                                            } else if (ubicacion_puesto == "") {
                                                                $('#ubicacion_puesto<?php echo $id_puesto; ?>').focus();
                                                                $('#lbl_ubicacion_puesto_update<?php echo $id_puesto; ?>');
                                                            } else {
                                                                var url = "../../App/Controllers/puesto/update_de_puestos.php";
                                                                $.get(url, {
                                                                    id_puesto: id_puesto,
                                                                    nombre_puesto: nombre_puesto,
                                                                    ubicacion_puesto: ubicacion_puesto
                                                                }, function(datos) {
                                                                    $('#respuesta_update<?php echo $id_puesto; ?>').html(datos);
                                                                });
                                                            }
                                                        });
                                                    </script>
                                                    <div id="respuesta_update<?php echo $id_puesto; ?>"></div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <!-- Fin de load_puesto -->
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
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ Puestos",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 Puestos",
            "sInfoFiltered": "(filtrado de un total de _MAX_ Puestos)",
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

<!-- Modal para creación de puestos -->
<div class="modal fade" id="modal-create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Crear puesto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nombre_puesto">Nombre del puesto</label>
                            <input type="text" id="nombre_puesto" class="form-control">
                            <small class="text-danger d-none" id="lbl_nombre_puesto_create">* Debe agregar el nombre del puesto</small>
                        </div>
                        <div class="form-group">
                            <label for="ubicacion_puesto">Ubicación del puesto</label>
                            <input type="text" id="ubicacion_puesto" class="form-control">
                            <small class="text-danger d-none" id="lbl_ubicacion_puesto_create">* Debe agregar la ubicación del puesto</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn_create">Crear puesto</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#btn_create').click(function() {

        var nombre_puesto = $('#nombre_puesto').val();
        var ubicacion_puesto = $('#ubicacion_puesto').val();
        var url = "../../App/Controllers/puesto/registro_de_puestos.php";

        if (nombre_puesto == "") {
            $('#nombre_puesto').focus();
            $('#lbl_nombre_puesto_create').removeClass('d-none');
        } else if (ubicacion_puesto == "") {
            $('#lbl_ubicacion_puesto_create').focus();
            $('#lbl_ubicacion_puesto_create').removeClass('d-none');
        } else {
            $.get(url, {
                nombre_puesto: nombre_puesto,
                ubicacion_puesto: ubicacion_puesto
            }, function(datos) {
                $('#respuesta').html(datos);
            });
        }
    });
</script>

<div id="respuesta"></div>