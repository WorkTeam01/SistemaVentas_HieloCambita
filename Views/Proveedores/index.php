<?php
require_once '../../App/config.php';
require_once '../../Views/Layouts/sesion.php';

include_once '../../Views/Layouts/header.php';

include_once '../../App/Controllers/proveedores/listado_de_proveedores.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Lista de proveedores
                        <button type="button" class="btn btn-primary ml-3" data-toggle="modal" data-target="#modal-create">
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
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Proveedores registrados</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"> <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            <div class="table-responsive">
                                <!-- La tabla completa se incluye aquí -->
                                <table id="example1" class="table table-bordered table-hover table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nro</th>
                                            <th class="text-center">Nombre de proveedor</th>
                                            <th class="text-center">Celular</th>
                                            <th class="text-center">Telefono</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Dirección</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $contador = 0;
                                        foreach ($proveedores_datos as $proveedor_dato) {
                                            $id_proveedor = $proveedor_dato['IdProveedor'];
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $contador += 1; ?></td>
                                                <td><?php echo $proveedor_dato['NombreProveedor']; ?></td>
                                                <td class="text-center">
                                                    <a href="http://wa.me/591<?php echo $proveedor_dato['CelularProveedor']; ?>" target="_blank" class="btn btn-success btn-sm">
                                                        <i class="fas fa-phone-alt"></i>
                                                        <?php echo $proveedor_dato['CelularProveedor']; ?>
                                                    </a>
                                                </td>
                                                <td><?php echo $proveedor_dato['TelefonoProveedor']; ?></td>
                                                <td><?php echo $proveedor_dato['EmailProveedor']; ?></td>
                                                <td><?php echo $proveedor_dato['DireccionProveedor']; ?></td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a type="button" href="update.php?id=<?php echo $id_proveedor; ?>" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>
                                                        <a type="button" href="delete.php?id=<?php echo $id_proveedor; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Eliminar</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <!-- Fin de load_proveedor -->
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
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ Proveedores",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 Proveedores",
            "sInfoFiltered": "(filtrado de un total de _MAX_ Proveedores)",
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

<!-- Modal para creación de Proveedores -->
<div class="modal fade" id="modal-create">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Crear proveedor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre_proveedor">Nombre del proveedor</label>
                            <input type="text" id="nombre_proveedor" class="form-control">
                            <small class="text-danger d-none" id="lbl_nombre">* Este campo es necesario rellenar</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="celular">Celular</label>
                            <input type="number" id="celular" class="form-control">
                            <small class="text-danger d-none" id="lbl_celular">* Este campo es necesario rellenar</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telefono">Telefono</label>
                            <input type="number" id="telefono" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <textarea id="direccion" rows="3" class="form-control"></textarea>
                            <small class="text-danger d-none" id="lbl_direccion">* Este campo es necesario rellenar</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn_create">Crear proveedor</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#btn_create').click(function() {
        var nombre_proveedor = $('#nombre_proveedor').val();
        var celular = $('#celular').val();
        var telefono = $('#telefono').val();
        var empresa = $('#empresa').val();
        var email = $('#email').val();
        var direccion = $('#direccion').val();
        var url = "../../App/Controllers/proveedores/create.php";

        // Limpiar mensajes de error previos
        $('.error').addClass('d-none');

        // Validación de campos
        if (nombre_proveedor == "") {
            $('#nombre').focus();
            $('#lbl_nombre').removeClass('d-none');
            return; // Detener la ejecución
        } else {
            $('#lbl_nombre').addClass('d-none');
        }
        if (celular == "") {
            $('#celular').focus();
            $('#lbl_celular').removeClass('d-none');
            return; // Detener la ejecución
        } else {
            $('#lbl_celular').addClass('d-none');
        }
        if (empresa == "") {
            $('#empresa').focus();
            $('#lbl_empresa').removeClass('d-none');
            return; // Detener la ejecución
        } else {
            $('#lbl_empresa').addClass('d-none');
        }
        if (direccion == "") {
            $('#direccion').focus();
            $('#lbl_direccion').removeClass('d-none');
            return; // Detener la ejecución
        } else {
            $('#lbl_direccion').addClass('d-none');
        }

        // Si todos los campos son válidos, enviar los datos
        $.get(url, {
            nombre_proveedor: nombre_proveedor,
            celular: celular,
            telefono: telefono,
            empresa: empresa,
            email: email,
            direccion: direccion
        }, function(datos) {
            $('#respuesta').html(datos);
        });
    });
</script>

<div id="respuesta"></div>