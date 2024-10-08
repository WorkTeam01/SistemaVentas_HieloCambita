<?php
require_once '../../App/config.php';
require_once '../../Views/Layouts/sesion.php';
require_once '../../App/Controllers/middleware/AuthMiddleware.php';

$auth = new AuthMiddleware($pdo, $URL);
$usuario = $auth->verificarPermiso('pedidos');

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
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            <?php if ($auth->isAdmin() && $auth->tienePermiso('pedidos')) : ?>
                                <!-- Filtros de puesto -->
                                <div class="dropright mb-3">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Filtro de puestos
                                    </button>
                                    <div class="dropdown-menu" id="puestoDropdown">
                                        <!-- Opciones generadas dinámicamente aquí -->
                                    </div>
                                </div>
                                <!-- Final de filtro -->
                            <?php endif; ?>
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
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modal-productos<?php echo $id_pedido; ?>">
                                                        <i class="fas fa-shopping-bag"></i> Productos
                                                    </button>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modal-cliente<?php echo $id_pedido; ?>">
                                                            <i class="fas fa-user"></i>
                                                            <?php
                                                            echo !empty($pedidos_dato['RazonSocial']) ? $pedidos_dato['RazonSocial'] : $pedidos_dato['NombreCliente'];
                                                            ?>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    $estadoActual = $pedidos_dato['EstadoPedido'];
                                                    $textoBoton = $estadoActual === 0 ? 'Pendiente' : 'Cancelado';
                                                    $claseBoton = $estadoActual === 0 ? 'btn-danger' : 'btn-success';
                                                    ?>
                                                    <button class="btn <?php echo $claseBoton; ?> btn-sm actualizar-estado"
                                                        data-id-pedido="<?php echo $pedidos_dato['IdPedido']; ?>"
                                                        data-estado-actual="<?php echo $estadoActual; ?>">
                                                        <?php echo $textoBoton; ?>
                                                    </button>
                                                </td>
                                                <td class="text-center"><?php echo "Bs. " . $pedidos_dato['MontoPago']; ?></td>
                                                <td><?php echo $pedidos_dato['TipoPago']; ?></td>
                                                <td><?php echo $pedidos_dato['NombrePuesto']; ?></td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="show.php?id=<?php echo $id_pedido; ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Ver</a>
                                                        <?php if ($auth->isAdmin() && $auth->tienePermiso('pedidos')) : ?>
                                                            <a href="delete.php?id=<?php echo $id_pedido; ?>&nro_pedido=<?php echo $pedidos_dato['NroPedido']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Eliminar</a>
                                                        <?php endif; ?>
                                                        <a href="nota_de_entrega.php?id=<?php echo $id_pedido; ?>&nro_pedido=<?php echo $pedidos_dato['NroPedido']; ?>" class="btn btn-success btn-sm"><i class="fas fa-print"></i> Imprimir</a>
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

<!-- Modales de productos y clientes fuera del bucle principal -->
<?php foreach ($pedidos_datos as $pedidos_dato) :
    $id_pedido = $pedidos_dato['IdPedido'];
    $id_cliente = $pedidos_dato['IdCliente'];
    $NroPedido = $pedidos_dato['NroPedido'];
?>
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
<?php endforeach; ?>

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
        });

        var puestosDatos = <?php echo json_encode($puestos_datos); ?>;

        // Ordenar los datos por IdPuesto en orden ascendente
        puestosDatos.sort(function(a, b) {
            return a.IdPuesto - b.IdPuesto;
        });

        var dropdownMenu = $('#puestoDropdown');

        // Limpiar el menú desplegable antes de agregar nuevos elementos
        dropdownMenu.empty();

        // Agregar opción de "Todos"
        dropdownMenu.append('<a class="dropdown-item" href="#" id="filtro-todos">Todos</a>');

        // Agregar opciones de puestos ordenadas
        puestosDatos.forEach(function(puesto) {
            dropdownMenu.append('<a class="dropdown-item" href="#" data-id="' + puesto.IdPuesto + '">' + puesto.NombrePuesto + '</a>');
        });

        // Configurar filtros
        $('.dropdown-menu a').on('click', function() {
            var puestoId = $(this).data('id');
            var filtro = $(this).text();
            if (filtro === 'Todos') {
                // Mostrar todos
                table.column(7).search('').draw(); // Asumiendo que la columna del puesto es la 7
            } else {
                // Filtrar por puesto
                table.column(7).search(filtro).draw();
            }
        });

        // Manejar la actualización del estado de los pedidos
        $('.actualizar-estado').on('click', function() {
            var boton = $(this);
            var idPedido = boton.data('id-pedido');
            var estadoActual = parseInt(boton.data('estado-actual'));

            // Validar si el pedido ya está cancelado
            if (estadoActual === 1) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Este pedido ya está cancelado y no se puede modificar.',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                return;
            }

            var nuevoEstado = 1; // Siempre cambiamos a cancelado (1)

            $.ajax({
                url: '../../App/Controllers/pedidos/update_estado_pedido.php',
                method: 'POST',
                data: {
                    idPedido: idPedido,
                    nuevoEstado: nuevoEstado
                },
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        boton.text('Cancelado');
                        boton.removeClass('btn-danger').addClass('btn-success');
                        boton.data('estado-actual', nuevoEstado);
                        boton.prop('disabled', true);

                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'El pedido ha sido cancelado exitosamente.',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                    } else {
                        throw new Error(data.error || 'Error desconocido al actualizar el estado');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Error al actualizar el estado: ' + error,
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                }
            });
        });

        table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>