<?php
require_once '../../App/config.php';
require_once '../../Views/Layouts/sesion.php';
require_once '../../App/Controllers/middleware/AuthMiddleware.php';

$auth = new AuthMiddleware($pdo, $URL);
$usuario = $auth->verificarPermiso('pedidos');

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
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-shopping-bag"></i> Detalle del pedido Nro: <?php echo $nro_pedido; ?></h3>
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
                                                            $precio_total += $subtotal;
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
                    <div class="card card-outline card-primary">
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
                                        <input type="text" id="id_usuario" value="<?php echo $id_usuario_pedido; ?>" class="form-control" hidden>
                                        <label>Usuario</label>
                                        <input type="text" class="form-control" value="<?php echo $usuario_pedido; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Nombres del usuario</label>
                                        <input type="text" class="form-control" value="<?php echo $nombres_usuario_pedido . " " . $apellidos_usuario_pedido; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Puesto del usuario</label>
                                        <input type="text" class="form-control" value="<?php echo $nombre_puesto; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-outline card-primary">
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
                                <label>Puesto del pedido</label>
                                <input type="text" class="form-control text-center" value="<?php echo $nombre_puesto; ?>" disabled>
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
                                <a href="<?php echo $URL; ?>/Views/Pedidos" class="btn btn-secondary btn-block">Volver</a>
                            </div>
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