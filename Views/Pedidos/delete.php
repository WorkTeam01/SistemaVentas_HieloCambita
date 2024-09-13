<?php
$id_pedido_get = $_GET['id'];
$nro_pedido_get = $_GET['nro_pedido'];

require_once '../../App/config.php';
require_once '../../Views/Layouts/sesion.php';
require_once '../../App/Controllers/middleware/AuthMiddleware.php';

$auth = new AuthMiddleware($pdo, $URL);
$usuario = $auth->verificarPermiso('Administrador');

include_once '../../Views/Layouts/header.php';
include_once '../../App/Controllers/pedidos/cargar_pedido.php';
include_once '../../App/Controllers/clientes/cargar_cliente.php';
include_once '../../App/Controllers/tipo_pago/cargar_tipo_pago.php';

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Detalle del pedido</h1>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-outline card-danger">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-shopping-bag"></i> Detalle del pedido Nro: <?php echo $nro_pedido; ?> ¿Estás seguro de eliminar este pedido?</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="mt-2 table-responsive">
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

                                                $sql_detalle_pedido = "SELECT dtp.*, p.IdProducto, p.NombreProducto, p.DescripcionProducto, p.PrecioVenta, p.Stock FROM detalle_pedido dtp
                                                INNER JOIN producto p on dtp.IdProducto = p.IdProducto
                                                WHERE NroPedido = '$nro_pedido' ORDER BY IdDetallePedido ASC";
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
                                                        <td class="text-center"><?php echo $detalle_pedido_dato['Precio']; ?></td>
                                                        <td class="text-center">
                                                            <?php
                                                            $cantidad = floatval($detalle_pedido_dato['Cantidad']);
                                                            $precio_venta = floatval($detalle_pedido_dato['Precio']);
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="card card-outline card-danger">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-user-check"></i> Datos del cliente y del usuario</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5>Datos del cliente</h5>
                            <hr>
                            <div class="row">
                                <?php if (!empty($razon_social)) : ?>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Cliente</label>
                                            <input type="text" value="<?php echo $razon_social; ?>" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Representante legal</label>
                                            <input type="text" value="<?php echo $representante_legal; ?>" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" value="<?php echo $email_juridico; ?>" class="form-control" disabled>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Cliente</label>
                                            <input type="text" value="<?php echo $nombre_cliente; ?>" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Género</label>
                                            <input type="text" value="<?php echo $genero_cliente; ?>" class="form-control" disabled>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Celular del cliente</label>
                                        <input type="text" id="celular_cliente" value="<?php echo $celular_cliente; ?>" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Descuento del cliente</label>
                                        <input type="text" id="descuento_cliente" value="<?php echo $descuento_cliente; ?>" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tipo_pago">Tipo de pago</label>
                                        <input type="text" class="form-control" value="<?php echo $tipo_pago; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h5>Datos del usuario</h5>
                            <hr>
                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" id="id_usuario" value="<?php echo $id_usuario_sesion; ?>" class="form-control" hidden>
                                        <label>Usuario</label>
                                        <input type="text" class="form-control" value="<?php echo $usuario_sesion; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Nombres del usuario</label>
                                        <input type="text" class="form-control" value="<?php echo $nombres_sesion . " " . $apellidos_sesion; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Puesto del usuario</label>
                                        <input type="text" class="form-control" value="<?php echo $puesto_usuario_sesion; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-outline card-danger">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-shopping-basket"></i> Datos del pedido</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Fecha del pedido</label>
                                <input type="date" class="form-control text-center" value="<?php echo $fecha_pedido; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label>Monto a cancelado</label>
                                <input type="text" class="form-control text-center bg-warning" value="<?php echo $monto_pago; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label>Estado del pago</label>
                                <?php if ($estado_pedido === 0) : ?>
                                    <input type="text" class="form-control text-center bg-danger" value="Pendiente" disabled>
                                <?php else : ?>
                                    <input type="text" class="form-control text-center bg-success" value="Cancelado" disabled>
                                <?php endif; ?>
                            </div>
                            <hr>
                            <div class="form-group">
                                <button type="button" id="btn_eliminar_pedido" class="btn btn-danger btn-block"><i class="fas fa-trash"></i> Eliminar pedido</button>
                                <a href="<?php echo $URL; ?>/Views/Pedidos" class="btn btn-secondary btn-block">Volver</a>
                                <div id="respuesta_eliminar_pedido"></div>
                            </div>
                            <script>
                                $('#btn_eliminar_pedido').click(function() {
                                    var id_pedido = '<?php echo $id_pedido_get; ?>';
                                    var nro_pedido = '<?php echo $nro_pedido_get; ?>';

                                    actualizar_stock();
                                    Swal.fire({
                                        title: '¿Está seguro de eliminar este pedido?',
                                        text: 'No podrá recuperar la información una vez eliminada.',
                                        icon: 'question',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Eliminar pedido'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            Swal.fire(
                                                borrar_venta(),
                                                'El pedido ha sido eliminada con éxito.',
                                                'success'
                                            )
                                        }
                                    });

                                    function actualizar_stock() {
                                        var i = 1;
                                        var n = '<?php echo $contador_de_detalles_pedido; ?>';

                                        for (i = 1; i <= n; i++) {
                                            var stocks = '#stock_de_inventario' + i;
                                            var stock_de_inventario = $(stocks).val();

                                            var cantidades = '#cantidad_detalle_pedido' + i;
                                            var cantidad_detalle_pedido = $(cantidades).html();

                                            var id_productos = '#id_producto' + i;
                                            var id_producto = $(id_productos).val();

                                            var stock_calculado = parseFloat(parseInt(stock_de_inventario) + parseInt(cantidad_detalle_pedido));

                                            var url2 = "../../App/Controllers/pedidos/actualizar_stock.php";
                                            $.get(url2, {
                                                id_producto: id_producto,
                                                stock_calculado: stock_calculado
                                            }, function(datos) {});
                                        }
                                    }

                                    function borrar_venta() {
                                        var url = "../../App/Controllers/pedidos/borrar_pedido.php";
                                        $.get(url, {
                                            id_pedido: id_pedido,
                                            nro_pedido: nro_pedido
                                        }, function(datos) {
                                            $('#respuesta_eliminar_pedido').html(datos);
                                        });
                                    }
                                });
                            </script>
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