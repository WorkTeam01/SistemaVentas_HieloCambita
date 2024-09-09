<?php
require_once '../../App/config.php';
require_once '../../Views/Layouts/sesion.php';

include_once '../../Views/Layouts/header.php';

include_once '../../App/Controllers/pedidos/listado_de_pedidos.php';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Lista de pedidos</h1>
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
                            <h3 class="card-title">Pedidos registrados</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"> <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            <div class="table table-responsive">
                                <table id="example1" class="table table-bordered table-hover table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nro</th>
                                            <th class="text-center">Nro de pedido</th>
                                            <th class="text-center">Productos</th>
                                            <th class="text-center">Cliente</th>
                                            <th class="text-center">Pago del pedido</th>
                                            <th class="text-center">Total ingreso</th>
                                            <th class="text-center">Tipo de pago</th>
                                            <th class="text-center">Puesto</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $contador = 0;
                                        foreach ($pedidos_datos as $pedidos_dato) {
                                            $id_pedido = $pedidos_dato['IdPedido'];
                                            $id_cliente = $pedidos_dato['IdCliente'];
                                            $contador += 1;
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $contador; ?></td>
                                                <td class="text-center"><?php echo $pedidos_dato['NroPedido']; ?></td>
                                                <td class="text-center">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modal-productos<?php echo $id_pedido; ?>">
                                                        <i class="fas fa-shopping-bag"></i> Productos
                                                    </button>

                                                    <!-- Modal de datos del producto -->
                                                    <div class="modal fade" id="Modal-productos<?php echo $id_pedido; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-primary">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Productos del pedido: <?php echo $pedidos_dato['NroPedido']; ?></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-sm table-hover table-striped">
                                                                            <thead class="bg-secondary">
                                                                                <tr class="text-center">
                                                                                    <th>Nro</th>
                                                                                    <th>Producto</th>
                                                                                    <th>Descripción</th>
                                                                                    <th>Cantidad</th>
                                                                                    <th>Precio unitario</th>
                                                                                    <th>Subtotal</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php
                                                                                $contador_de_detalles_pedido = 0;
                                                                                $cantidad_total = 0;
                                                                                $total_precio_unitario = 0;
                                                                                $precio_total = 0;

                                                                                $NroPedido = $pedidos_dato['NroPedido'];
                                                                                $sql_detalle_pedido = "SELECT dtp.*, p.IdProducto, p.NombreProducto, p.DescripcionProducto, p.PrecioVenta, p.Stock FROM detalle_pedido dtp
                                                                                INNER JOIN producto p on dtp.IdProducto = p.IdProducto
                                                                                WHERE NroPedido = '$NroPedido' ORDER BY IdDetallePedido ASC";
                                                                                $query_detalle_pedido = $pdo->prepare($sql_detalle_pedido);
                                                                                $query_detalle_pedido->execute();
                                                                                $detalle_pedido_datos = $query_detalle_pedido->fetchAll(PDO::FETCH_ASSOC);

                                                                                foreach ($detalle_pedido_datos as $detalle_pedido_dato) {
                                                                                    $id_detalle_pedido = $detalle_pedido_dato['IdDetallePedido'];
                                                                                    $contador_de_detalles_pedido += 1;
                                                                                    $cantidad_total = $cantidad_total + $detalle_pedido_dato['Cantidad'];
                                                                                    $total_precio_unitario = $total_precio_unitario + floatval($detalle_pedido_dato['PrecioVenta']);
                                                                                ?>
                                                                                    <tr>
                                                                                        <td class="text-center">
                                                                                            <?php echo $contador_de_detalles_pedido; ?>
                                                                                            <input type="text" value="<?php echo $detalle_pedido_dato['IdProducto']; ?>" id="id_producto<?php echo $contador_de_detalles_pedido; ?>" hidden>
                                                                                        </td>
                                                                                        <td><?php echo $detalle_pedido_dato['NombreProducto']; ?></td>
                                                                                        <td><?php echo $detalle_pedido_dato['DescripcionProducto']; ?></td>
                                                                                        <td class="text-center">
                                                                                            <span id="cantidad_detalle_pedido<?php echo $contador_de_detalles_pedido; ?>"><?php echo $detalle_pedido_dato['Cantidad']; ?></span>
                                                                                            <input type="text" class="form-control" value="<?php echo $detalle_pedido_dato['Stock']; ?>" id="stock_de_inventario<?php echo $contador_de_detalles_pedido; ?>" hidden>
                                                                                        </td>
                                                                                        <td class="text-center"><?php echo $detalle_pedido_dato['PrecioVenta']; ?></td>
                                                                                        <td class="text-center">
                                                                                            <?php
                                                                                            $cantidad = floatval($detalle_pedido_dato['Cantidad']);
                                                                                            $precio_venta = floatval($detalle_pedido_dato['PrecioVenta']);
                                                                                            echo $subtotal = $cantidad * $precio_venta;
                                                                                            $precio_total = $precio_total + $subtotal;
                                                                                            ?>
                                                                                        </td>
                                                                                    </tr>
                                                                                <?php } ?>
                                                                                <tr>
                                                                                    <th class="bg-secondary text-right" colspan="3">Total</th>
                                                                                    <th class="text-center"><?php echo $cantidad_total; ?></th>
                                                                                    <th class="text-center"><?php echo $total_precio_unitario; ?></th>
                                                                                    <th class="text-center bg-warning"><?php echo $precio_total; ?></th>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modal-cliente<?php echo $id_pedido; ?>">
                                                            <i class="fas fa-user"></i>
                                                            <?php
                                                            if (!empty($pedidos_dato['RazonSocial'])) {
                                                                echo $pedidos_dato['RazonSocial'];
                                                            } else {
                                                                echo $pedidos_dato['NombreCliente'];
                                                            }
                                                            ?>
                                                        </button>
                                                    </div>
                                                    <!-- Modal para clientes -->
                                                    <div class="modal fade" id="Modal-cliente<?php echo $id_pedido; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-sm" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-primary">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Datos del cliente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <?php
                                                                $sql_clientes = "SELECT c.IdCliente, c.CelularCliente, c.DescuentoCliente, cj.RazonSocial, cj.RepresentanteLegal, cj.EmailJuridico, cn.NombreCliente, cn.Genero
                                                                FROM cliente c
                                                                LEFT JOIN cjuridico cj on c.IdCliente = cj.IdCliente
                                                                LEFT JOIN cnatural cn on c.IdCliente = cn.IdCliente
                                                                WHERE c.IdCliente = '$id_cliente'";

                                                                $query_clientes = $pdo->query($sql_clientes);
                                                                $query_clientes->execute();
                                                                $clientes_datos = $query_clientes->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach ($clientes_datos as $clientes_dato) : ?>
                                                                    <div class="modal-body">
                                                                        <!-- Diferenciar entre clientes naturales y jurídicos -->
                                                                        <?php if (!empty($clientes_dato['RazonSocial'])): ?>
                                                                            <!-- Cliente Jurídico -->
                                                                            <div class="form-group">
                                                                                <label>Razón Social</label>
                                                                                <input type="text" class="form-control" value="<?php echo $clientes_dato['RazonSocial']; ?>" disabled>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Representante Legal</label>
                                                                                <input type="text" class="form-control" value="<?php echo $clientes_dato['RepresentanteLegal']; ?>" disabled>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Email</label>
                                                                                <input type="email" class="form-control" value="<?php echo $clientes_dato['EmailJuridico']; ?>" disabled>
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <!-- Cliente Natural -->
                                                                            <div class="form-group">
                                                                                <label>Nombre</label>
                                                                                <input type="text" class="form-control" value="<?php echo $clientes_dato['NombreCliente']; ?>" disabled>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Género</label>
                                                                                <input type="text" class="form-control" value="<?php echo $clientes_dato['Genero']; ?>" disabled>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <div class="form-group">
                                                                            <label>Celular</label>
                                                                            <input type="text" class="form-control" value="<?php echo $clientes_dato['CelularCliente']; ?>" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Descuento</label>
                                                                            <input type="text" class="form-control" value="<?php echo $clientes_dato['DescuentoCliente']; ?>" disabled>
                                                                        </div>
                                                                        <hr>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($pedidos_dato['EstadoPedido'] === 0) : ?>
                                                        <button class="btn btn-danger btn-sm">Pendiente</button>
                                                    <?php else : ?>
                                                        <button class="btn btn-success btn-sm">Cancelado</button>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center"><?php echo "Bs. " . $pedidos_dato['MontoPago']; ?></td>
                                                <td><?php echo $pedidos_dato['TipoPago']; ?></td>
                                                <td><?php echo $pedidos_dato['NombrePuesto']; ?></td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="show.php?id=<?php echo $id_pedido; ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Ver</a>
                                                        <a href="delete.php?id=<?php echo $id_pedido; ?>&nro_pedido=<?php echo $NroPedido; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Eliminar</a>
                                                        <a href="nota_de_entrega.php?id=<?php echo $id_pedido; ?>&nro_pedido=<?php echo $NroPedido; ?>" class="btn btn-success btn-sm"><i class="fas fa-print"></i> Imprimir</a>
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
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ Pedidos",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 Pedidos",
            "sInfoFiltered": "(filtrado de un total de _MAX_ Pedidos)",
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