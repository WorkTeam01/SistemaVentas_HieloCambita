<?php
require_once '../../App/config.php';
require_once '../../Views/Layouts/sesion.php';

include_once '../../Views/Layouts/header.php';

include_once '../../App/Controllers/abasto/listado_de_abastos.php';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Lista de abastos</h1>
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
                            <h3 class="card-title">Abastos registrados</h3>
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
                                            <th class="text-center">Nro del abasto</th>
                                            <th class="text-center">Producto</th>
                                            <th class="text-center">Fecha del abasto</th>
                                            <th class="text-center">Proveedor</th>
                                            <th class="text-center">Puesto</th>
                                            <th class="text-center">Usuario</th>
                                            <th class="text-center">Precio compra</th>
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $contador = 0;
                                        foreach ($abasto_datos as $abasto_dato) {
                                            $id_abasto = $abasto_dato['IdAbasto'];
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $contador += 1; ?></td>
                                                <td class="text-center"><?php echo $abasto_dato['NroAbasto']; ?></td>
                                                <td>
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-producto<?php echo $id_abasto; ?>">
                                                            <?php echo $abasto_dato['NombreProducto']; ?>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="text-center"><?php echo $abasto_dato['FechaAbasto']; ?></td>
                                                <td>
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-proveedor<?php echo $id_abasto; ?>">
                                                            <?php echo $abasto_dato['NombreProveedor']; ?>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td><?php echo $abasto_dato['NombrePuesto']; ?></td>
                                                <td><?php echo $abasto_dato['NombresUsuario'] . " " . $abasto_dato['ApellidosUsuario']; ?></td>
                                                <td class="text-center">Bs. <?php echo $abasto_dato['PrecioAbasto']; ?></td>
                                                <td class="text-center"><?php echo $abasto_dato['CantidadAbasto']; ?></td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="show.php?id=<?php echo $id_abasto; ?>" type="button" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Ver</a>
                                                        <a href="update.php?id=<?php echo $id_abasto; ?>" type="button" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>
                                                        <a href="delete.php?id=<?php echo $id_abasto; ?>" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Eliminar</a>
                                                    </div>
                                                </td>
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

<!-- Modales -->
<?php foreach ($abasto_datos as $abasto_dato) {
    $id_abasto = $abasto_dato['IdAbasto']; ?>
    <!-- Modal datos de productos -->
    <div class="modal fade" id="modal-producto<?php echo $id_abasto; ?>" tabindex="-1" role="dialog" aria-labelledby="productoModalLabel<?php echo $id_abasto; ?>" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title" id="productoModalLabel<?php echo $id_abasto; ?>">Detalle de producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Código</label>
                                        <input type="text" value="<?php echo $abasto_dato['CodigoProducto']; ?>" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" value="<?php echo $abasto_dato['NombreProducto']; ?>" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <textarea rows="3" class="form-control" disabled><?php echo $abasto_dato['DescripcionProducto']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Stock</label>
                                        <input type="text" class="form-control" value="<?php echo $abasto_dato['Stock']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Stock mínimo</label>
                                        <input type="text" class="form-control" value="<?php echo $abasto_dato['StockMinimo']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Stock máximo</label>
                                        <input type="text" class="form-control" value="<?php echo $abasto_dato['StockMaximo']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Fecha de ingreso</label>
                                        <input type="text" class="form-control" value="<?php echo $abasto_dato['FechaIngreso']; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Precio de compra</label>
                                        <input type="text" class="form-control" value="<?php echo $abasto_dato['PrecioCompra']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Precio de venta</label>
                                        <input type="text" class="form-control" value="<?php echo $abasto_dato['PrecioVenta']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Categoría</label>
                                        <input type="text" class="form-control" value="<?php echo $abasto_dato['NombreCategoria']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Puesto</label>
                                        <input type="text" class="form-control" value="<?php echo $abasto_dato['NombrePuesto']; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Imagen del producto</label>
                                <img src="<?php echo $URL . "/Views/Productos/img_productos/" . $abasto_dato['ImagenProducto']; ?>" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Volver</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal datos de proveedor -->
    <div class="modal fade" id="modal-proveedor<?php echo $id_abasto; ?>" tabindex="-1" role="dialog" aria-labelledby="proveedorModalLabel<?php echo $id_abasto; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title" id="proveedorModalLabel<?php echo $id_abasto; ?>">Detalle de proveedor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="codigo">Nombres del proveedor</label>
                                        <input type="text" value="<?php echo $abasto_dato['NombreProveedor']; ?>" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Celular del proveedor</label>
                                        <div class="text-center">
                                            <a href="http://wa.me/591<?php echo $abasto_dato['CelularProveedor']; ?>" target="_blank" class="btn btn-success">
                                                <i class="fas fa-phone-alt"></i>
                                                <?php echo $abasto_dato['CelularProveedor']; ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="codigo">Teléfono del proveedor</label>
                                        <input type="text" value="<?php echo $abasto_dato['TelefonoProveedor']; ?>" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="codigo">Email del proveedor</label>
                                        <input type="text" value="<?php echo $abasto_dato['EmailProveedor']; ?>" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="codigo">Dirección del proveedor</label>
                                        <textarea class="form-control" rows="3" disabled><?php echo $abasto_dato['DireccionProveedor']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Volver</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

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
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ Abasto",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 Abasto",
            "sInfoFiltered": "(filtrado de un total de _MAX_ Abasto)",
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