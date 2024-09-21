<?php
require_once '../../App/config.php';
require_once '../../Views/Layouts/sesion.php';
require_once '../../App/Controllers/middleware/AuthMiddleware.php';

$auth = new AuthMiddleware($pdo, $URL);
$usuario = $auth->verificarPermiso('clientes');

include_once '../../Views/Layouts/header.php';
include_once '../../App/Controllers/clientes/listado_de_clientes.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Lista de clientes</h1>
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
                            <h3 class="card-title">Clientes registrados</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"> <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            <!-- Filtros de clientes -->
                            <div class="dropright mb-3">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Filtro de clientes
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" id="filtro-todos">Todos</a>
                                    <a class="dropdown-item" href="#" id="filtro-naturales">Clientes Naturales</a>
                                    <a class="dropdown-item" href="#" id="filtro-juridicos">Clientes Jurídicos</a>
                                </div>
                            </div>
                            <!-- Final de filtro -->
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-hover table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nro</th>
                                            <th>Celular</th>
                                            <th>Descuento</th>
                                            <th>Tipo</th>
                                            <th>Nombre/Razón Social</th>
                                            <th>Representante Legal</th>
                                            <th>Email</th>
                                            <th>Género</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $contador = 0;
                                        foreach ($clientes_datos as $clientes_dato) { ?>
                                            <tr>
                                                <td class="text-center"><?php echo $contador += 1; ?></td>
                                                <td><?php echo $clientes_dato['CelularCliente']; ?></td>
                                                <td><?php echo $clientes_dato['DescuentoCliente']; ?></td>
                                                <td><?php echo !empty($clientes_dato['RazonSocial']) ? 'Jurídico' : 'Natural'; ?></td>
                                                <td>
                                                    <?php
                                                    if (!empty($clientes_dato['RazonSocial'])) {
                                                        echo $clientes_dato['RazonSocial'];
                                                    } else {
                                                        echo $clientes_dato['NombreCliente'];
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $clientes_dato['RepresentanteLegal'] ?? ''; ?></td>
                                                <td><?php echo $clientes_dato['EmailJuridico'] ?? ''; ?></td>
                                                <td><?php echo $clientes_dato['Genero'] ?? ''; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
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
    $(document).ready(function() {
        var table = $("#example1").DataTable({
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
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ Clientes",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 Clientes",
                "sInfoFiltered": "(filtrado de un total de _MAX_ Clientes)",
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
        });

        // Filtros por tipo de cliente y mostrar/ocultar columnas
        $('#filtro-todos').on('click', function() {
            table.columns(5).visible(true); // Mostrar columna Representante Legal
            table.columns(6).visible(true); // Mostrar columna Email Jurídico
            table.columns(7).visible(true); // Mostrar columna Género
            table.columns(3).search('').draw(); // Mostrar todos
        });

        $('#filtro-naturales').on('click', function() {
            table.columns(5).visible(false); // Ocultar columna Representante Legal
            table.columns(6).visible(false); // Ocultar columna Email Jurídico
            table.columns(7).visible(true); // Mostrar columna Género
            table.columns(3).search('Natural').draw(); // Filtrar por clientes naturales
        });

        $('#filtro-juridicos').on('click', function() {
            table.columns(5).visible(true); // Mostrar columna Representante Legal
            table.columns(6).visible(true); // Mostrar columna Email Jurídico
            table.columns(7).visible(false); // Ocultar columna Género
            table.columns(3).search('Jurídico').draw(); // Filtrar por clientes jurídicos
        });

        table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>