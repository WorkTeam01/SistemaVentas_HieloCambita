<?php
require_once '../../App/config.php';
require_once '../../Views/Layouts/sesion.php';
require_once '../../App/Controllers/middleware/AuthMiddleware.php';

$auth = new AuthMiddleware($pdo, $URL);
$usuario = $auth->verificarRoles(['Administrador', 'Vendedor', 'Comprador']);

include_once '../../Views/Layouts/header.php';
include_once '../../App/Controllers/pedidos/listado_de_pedidos.php';
include_once '../../App/Controllers/productos/listado_de_productos.php';
include_once '../../App/Controllers/clientes/listado_de_clientes.php';
include_once '../../App/Controllers/puesto/listado_de_puestos.php';
include_once '../../App/Controllers/tipo_pago/listado_de_tipo_pagos.php';

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Pedidos</h1>
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
                                    <h3 class="card-title"><i class="fas fa-shopping-bag"></i> Pedido Nro: <?php echo $contador_de_pedidos; ?></h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <b>Detalle de pedido</b>
                                        <button type="button" class="btn btn-primary btn-sm ml-2" data-toggle="modal" data-target="#modal-buscar_producto">
                                            <i class="fas fa-search"></i> Buscar producto
                                        </button>
                                    </div>
                                    <!-- Modal para buscar productos -->
                                    <div class="modal fade" id="modal-buscar_producto">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h4 class="modal-title">Busqueda del producto</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table table-responsive">
                                                        <table id="example1" class="table table-bordered table-hover table-striped table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">Nro</th>
                                                                    <th class="text-center">Seleccionar</th>
                                                                    <th class="text-center">Código</th>
                                                                    <th class="text-center">Categoría</th>
                                                                    <th class="text-center">Nombre</th>
                                                                    <th class="text-center">Imagen</th>
                                                                    <th class="text-center">Descripción</th>
                                                                    <th class="text-center">Stock</th>
                                                                    <th class="text-center">Precio compra</th>
                                                                    <th class="text-center">Precio venta</th>
                                                                    <th class="text-center">Fecha compra</th>
                                                                    <th class="text-center">Puesto</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                foreach ($productos_datos as $producto_dato) {
                                                                    $id_producto = $producto_dato['IdProducto'];
                                                                ?>
                                                                    <tr>
                                                                        <td class="text-center"><?php echo $contador_de_pedidos; ?></td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-info btn-sm" id="btn_seleccionar<?php echo $id_producto; ?>">
                                                                                Seleccionado
                                                                            </button>
                                                                            <script>
                                                                                $('#btn_seleccionar<?php echo $id_producto; ?>').click(function() {

                                                                                    var id_producto = '<?php echo $id_producto; ?>';
                                                                                    $('#id_producto').val(id_producto);

                                                                                    var producto = '<?php echo $producto_dato['NombreProducto']; ?>';
                                                                                    $('#producto').val(producto);

                                                                                    var descripcion = '<?php echo $producto_dato['DescripcionProducto']; ?>';
                                                                                    $('#descripcion').val(descripcion);

                                                                                    var precio_unitario = '<?php echo $producto_dato['PrecioVenta']; ?>';
                                                                                    $('#precio_unitario').val(precio_unitario);

                                                                                    $('#cantidad').focus();

                                                                                });
                                                                            </script>
                                                                        </td>
                                                                        <td><?php echo $producto_dato['CodigoProducto']; ?></td>
                                                                        <td><?php echo $producto_dato['NombreCategoria']; ?></td>
                                                                        <td><?php echo $producto_dato['NombreProducto']; ?></td>
                                                                        <td>
                                                                            <img class="rounded mx-auto d-block" src="<?php echo $URL . "/Views/Productos/img_productos/" . $producto_dato['ImagenProducto']; ?>" width="80" alt="">
                                                                        </td>
                                                                        <td><?php echo $producto_dato['DescripcionProducto']; ?></td>
                                                                        <td><?php echo $producto_dato['Stock']; ?></td>
                                                                        <td><?php echo $producto_dato['PrecioCompra']; ?></td>
                                                                        <td><?php echo $producto_dato['PrecioVenta']; ?></td>
                                                                        <td><?php echo $producto_dato['FechaIngreso']; ?></td>
                                                                        <td><?php echo $producto_dato['NombrePuesto']; ?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <input type="text" id="id_producto" class="form-control" hidden>
                                                                    <label>Producto</label>
                                                                    <input type="text" id="producto" class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label>Descripción</label>
                                                                    <input type="text" id="descripcion" class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>Cantidad</label>
                                                                    <input type="text" id="cantidad" class="form-control">
                                                                    <small class="text-danger d-none" id="lbl_cantidad">* Rellene la cantidad</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group"><label>Precio unitario</label>
                                                                    <input type="text" id="precio_unitario" class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                    <button type="button" id="btn_registrar_detalle_pedido" class="btn btn-primary">Registrar venta</button>
                                                </div>
                                                <div id="repuesta_detalle_pedido"></div>
                                                <script>
                                                    $('#btn_registrar_detalle_pedido').click(function() {
                                                        var nro_pedido = '<?php echo $contador_de_pedidos; ?>';
                                                        var id_producto = $('#id_producto').val();
                                                        var cantidad = $('#cantidad').val();
                                                        var precio = $('#precio_unitario').val();

                                                        if (id_producto == "") {
                                                            alert("El producto está vacio");
                                                            return;
                                                        }

                                                        if (cantidad == "") {
                                                            $('#cantidad').focus();
                                                            $('#lbl_cantidad').removeClass('d-none');
                                                        } else {
                                                            $('#lbl_cantidad').addClass('d-none');

                                                            var url = "../../App/Controllers/pedidos/registrar_detalle_pedido.php";
                                                            $.get(url, {
                                                                nro_pedido: nro_pedido,
                                                                id_producto: id_producto,
                                                                cantidad: cantidad,
                                                                precio: precio
                                                            }, function(datos) {
                                                                $('#repuesta_detalle_pedido').html(datos);
                                                            });
                                                        }
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3 table-responsive">
                                        <table class="table table-bordered table-sm table-hover table-striped">
                                            <thead class="bg-secondary">
                                                <tr class="text-center">
                                                    <th>Nro</th>
                                                    <th>Producto</th>
                                                    <th>Descripción</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio unitario</th>
                                                    <th>Subtotal</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $contador_de_detalles_pedido = 0;
                                                $cantidad_total = 0;
                                                $total_precio_unitario = 0;
                                                $precio_total = 0;

                                                // Modificación en la consulta SQL para incluir el puesto
                                                $sql_detalle_pedido = "SELECT dtp.*, p.IdProducto, p.NombreProducto, p.DescripcionProducto, p.PrecioVenta, p.Stock, pue.IdPuesto, pue.NombrePuesto
                                                                    FROM detalle_pedido dtp
                                                                    INNER JOIN producto p ON dtp.IdProducto = p.IdProducto
                                                                    INNER JOIN puesto pue ON p.IdPuesto = pue.IdPuesto
                                                                    WHERE NroPedido = :nro_pedido 
                                                                    ORDER BY IdDetallePedido ASC";

                                                $query_detalle_pedido = $pdo->prepare($sql_detalle_pedido);
                                                $query_detalle_pedido->bindParam(':nro_pedido', $contador_de_pedidos, PDO::PARAM_INT);
                                                $query_detalle_pedido->execute();
                                                $detalle_pedido_datos = $query_detalle_pedido->fetchAll(PDO::FETCH_ASSOC);

                                                foreach ($detalle_pedido_datos as $detalle_pedido_dato) {
                                                    $id_detalle_pedido = $detalle_pedido_dato['IdDetallePedido'];
                                                    $contador_de_detalles_pedido++;
                                                    $cantidad_total += $detalle_pedido_dato['Cantidad'];
                                                    $total_precio_unitario += floatval($detalle_pedido_dato['PrecioVenta']);
                                                ?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <?php echo $contador_de_detalles_pedido; ?>
                                                            <input type="hidden" value="<?php echo $detalle_pedido_dato['IdProducto']; ?>" id="id_producto<?php echo $contador_de_detalles_pedido; ?>">
                                                        </td>
                                                        <td><?php echo htmlspecialchars($detalle_pedido_dato['NombreProducto']); ?></td>
                                                        <td><?php echo htmlspecialchars($detalle_pedido_dato['DescripcionProducto']); ?></td>
                                                        <td class="text-center">
                                                            <span id="cantidad_detalle_pedido<?php echo $contador_de_detalles_pedido; ?>"><?php echo $detalle_pedido_dato['Cantidad']; ?></span>
                                                            <input type="hidden" class="form-control" value="<?php echo $detalle_pedido_dato['Stock']; ?>" id="stock_de_inventario<?php echo $contador_de_detalles_pedido; ?>">
                                                        </td>
                                                        <td class="text-center"><?php echo number_format($detalle_pedido_dato['Precio'], 2); ?></td>
                                                        <td class="text-center">
                                                            <?php
                                                            $cantidad = floatval($detalle_pedido_dato['Cantidad']);
                                                            $precio_venta = floatval($detalle_pedido_dato['Precio']);
                                                            $subtotal = $cantidad * $precio_venta;
                                                            echo number_format($subtotal, 2);
                                                            $precio_total += $subtotal;
                                                            ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <form action="../../App/Controllers/pedidos/borrar_detalle_pedido.php" method="post">
                                                                <input type="hidden" name="id_detalle_pedido" value="<?php echo $id_detalle_pedido; ?>">
                                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Eliminar</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <th class="bg-secondary text-right" colspan="3">Total</th>
                                                    <th class="text-center"><?php echo $cantidad_total; ?></th>
                                                    <th class="text-center"><?php echo number_format($total_precio_unitario, 2); ?></th>
                                                    <th class="text-center bg-warning"><?php echo number_format($precio_total, 2); ?></th>
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
                            <div class="d-flex">
                                <b>Cliente</b>
                                <button type="button" class="btn btn-primary btn-sm ml-2" data-toggle="modal" data-target="#modal-buscar_cliente">
                                    <i class="fas fa-search"></i> Buscar cliente
                                </button>
                            </div>
                            <hr>
                            <!-- Modal para buscar cliente -->
                            <div class="modal fade" id="modal-buscar_cliente">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h4 class="modal-title">Busqueda del cliente</h4>
                                            <button type="button" class="btn btn-default ml-2" data-toggle="modal" data-target="#modal-agregar_cliente">
                                                <i class="fas fa-user-plus"></i> Registrar cliente
                                            </button>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table table-responsive">
                                                <table id="example2" class="table table-bordered table-hover table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Nro</th>
                                                            <th class="text-center">Seleccionar</th>
                                                            <th class="text-center">Nombre/Razon Social</th>
                                                            <th class="text-center">Celular</th>
                                                            <th class="text-center">Descuento</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $contador_de_clientes = 0;
                                                        foreach ($clientes_datos as $clientes_dato) {
                                                            $id_cliente = $clientes_dato['IdCliente'];
                                                            $descuento_aplicado = $clientes_dato['DescuentoCliente'];
                                                            $contador_de_clientes += 1;
                                                        ?>
                                                            <tr>
                                                                <td class="text-center"><?php echo $contador_de_clientes; ?></td>
                                                                <td class="text-center">
                                                                    <button type="button" id="btn_pasar_cliente<?php echo $id_cliente; ?>" class="btn btn-info">Seleccionar</button>
                                                                    <script>
                                                                        $('#btn_pasar_cliente<?php echo $id_cliente; ?>').on('click', function() {
                                                                            var id_cliente = <?php echo $id_cliente; ?>;
                                                                            $('#id_cliente').val(id_cliente);

                                                                            var cliente = '<?php echo !empty($clientes_dato['RazonSocial']) ? $clientes_dato['RazonSocial'] : $clientes_dato['NombreCliente']; ?>';
                                                                            $('#cliente').val(cliente);

                                                                            var celular_cliente = '<?php echo $clientes_dato['CelularCliente']; ?>';
                                                                            $('#celular_cliente').val(celular_cliente);

                                                                            var descuento_cliente = '<?php echo $descuento_aplicado; ?>';
                                                                            $('#descuento_cliente').val(descuento_cliente);

                                                                            $('#modal-buscar_cliente').modal('toggle');
                                                                        });
                                                                    </script>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php echo !empty($clientes_dato['RazonSocial']) ? $clientes_dato['RazonSocial'] : $clientes_dato['NombreCliente']; ?>
                                                                </td>
                                                                <td class="text-center"><?php echo $clientes_dato['CelularCliente']; ?></td>
                                                                <td><?php echo $clientes_dato['DescuentoCliente']; ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" id="id_cliente" class="form-control" hidden>
                                        <label>Cliente</label>
                                        <input type="text" id="cliente" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Celular del cliente</label>
                                        <input type="text" id="celular_cliente" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Descuento del cliente</label>
                                        <input type="text" id="descuento_cliente" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tipo_pago">Tipo de pago</label>
                                        <select name="tipo_pago" id="tipo_pago" class="form-control">
                                            <?php foreach ($tipo_pagos_datos as $tipo_pagos_dato) { ?>
                                                <option value="<?php echo $tipo_pagos_dato['IdTipoPago']; ?>"><?php echo $tipo_pagos_dato['TipoPago']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <b>Datos del usuario</b>
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
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-shopping-basket"></i> Registrar pedido</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Fecha del pedido</label>
                                <input type="date" id="fecha_pedido" class="form-control text-center">
                                <small class="d-none text-danger" id="lbl_fecha_pedido">* Debe ingresar la fecha del pedido</small>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        // Obtener la fecha actual en el formato de la laptop (AAAA-MM-DD)
                                        let today = new Date();
                                        let day = String(today.getDate()).padStart(2, '0');
                                        let month = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0
                                        let year = today.getFullYear();
                                        // Formatear la fecha en formato YYYY-MM-DD
                                        let formattedDate = year + '-' + month + '-' + day;
                                        // Asignar la fecha actual al input
                                        document.getElementById("fecha_pedido").value = formattedDate;
                                    });
                                </script>
                            </div>
                            <div class="form-group">
                                <label>Puesto</label>
                                <input type="text" id="id_puesto" class="form-control" value="<?= $id_puesto_sesion; ?>" hidden>
                                <input type="text" id="nombre_puesto" class="form-control" value="<?php echo $puesto_usuario_sesion; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label>Monto a cancelar</label>
                                <input type="text" id="total_a_cancelar" class="form-control text-center bg-warning" value="<?php echo $precio_total; ?>" disabled>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Total pagado</label>
                                        <input type="text" id="total_pagado" class="form-control text-center">
                                        <script>
                                            $('#total_pagado').keyup(function() {
                                                var total_a_cancelar = $('#total_a_cancelar').val();
                                                var total_pagado = $('#total_pagado').val();
                                                var cambio = parseFloat(total_pagado) - parseFloat(total_a_cancelar);
                                                $('#cambio').val(cambio);
                                            });
                                        </script>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cambio</label>
                                        <input type="text" id="cambio" class="form-control text-center" disabled>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <button type="button" id="btn_guardar_pedido" class="btn btn-primary btn-block">Guardar pedido</button>
                                <a href="<?php echo $URL; ?>/Views/Pedidos" class="btn btn-secondary btn-block">Cancelar</a>
                                <div id="respuesta_registro_pedido"></div>
                                <script>
                                    $('#btn_guardar_pedido').click(function() {
                                        var nro_pedido = '<?php echo $contador_de_pedidos; ?>';
                                        var id_cliente = $('#id_cliente').val();
                                        var id_tipo_pago = $('#tipo_pago').val();
                                        var id_usuario = $('#id_usuario').val();
                                        var id_puesto = $('#id_puesto').val();
                                        var fecha_pedido = $('#fecha_pedido').val();
                                        var total_a_cancelar = $('#total_a_cancelar').val();
                                        var descuento_cliente = $('#descuento_cliente').val();
                                        var pago_cliente = $('#total_pagado').val();
                                        var estado_pago = 0;

                                        if (id_cliente == "") {
                                            alert("Debe seleccionar a un cliente.");
                                            return;
                                        }
                                        if (id_tipo_pago == "") {
                                            alert("Debe seleccionar un tipo de pago.");
                                            return;
                                        }
                                        if (id_usuario == "") {
                                            alert("Debe seleccionar a un usuario.");
                                            return;
                                        }
                                        if (fecha_pedido == "") {
                                            $('#fecha_pedido').focus();
                                            $('#lbl_fecha_pedido').removeClass('d-none');
                                            return;
                                        } else {
                                            $('lbl_fecha_pedido').addClass('d-none');
                                        }
                                        // Verifica si hay un descuento y aplícalo al total
                                        if (descuento_cliente !== "") {
                                            total_a_cancelar = parseFloat(total_a_cancelar) - parseFloat(descuento_cliente);
                                            // Asegurarse de que el total no sea negativo
                                            if (total_a_cancelar < 0) {
                                                total_a_cancelar = 0;
                                            }
                                            $('#total_a_cancelar').val(total_a_cancelar.toFixed(2));
                                        }
                                        if (pago_cliente !== "") {
                                            estado_pago = 1;
                                        }
                                        guardar_venta();
                                        actualizar_stock();

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

                                                var stock_calculado = parseFloat(stock_de_inventario - cantidad_detalle_pedido);

                                                var url2 = "../../App/Controllers/pedidos/actualizar_stock.php";
                                                $.get(url2, {
                                                    id_producto: id_producto,
                                                    stock_calculado: stock_calculado
                                                }, function(datos) {});
                                            }
                                        }

                                        function guardar_venta() {
                                            var url = "../../App/Controllers/pedidos/registro_de_pedidos.php";
                                            $.get(url, {
                                                nro_pedido: nro_pedido,
                                                id_cliente: id_cliente,
                                                id_tipo_pago: id_tipo_pago,
                                                id_usuario: id_usuario,
                                                id_puesto: id_puesto,
                                                fecha_pedido: fecha_pedido,
                                                total_a_cancelar: total_a_cancelar,
                                                estado_pago: estado_pago
                                            }, function(datos) {
                                                $('#respuesta_registro_pedido').html(datos);
                                            });
                                        }
                                    });
                                </script>
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

<script>
    $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
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
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ productos",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 productos",
            "sInfoFiltered": "(filtrado de un total de _MAX_ productos)",
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

    $("#example2").DataTable({
        "responsive": true,
        "autoWidth": false,
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
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ clientes",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 clientes",
            "sInfoFiltered": "(filtrado de un total de _MAX_ clientes)",
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
</script>

<!-- Modal para registrar nuevo cliente -->
<div class="modal fade" id="modal-agregar_cliente">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h4 class="modal-title">Registrar nuevo cliente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo $URL; ?>/App/Controllers/clientes/create.php" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo_cliente">Tipo de Cliente</label>
                                <select name="tipo_cliente" id="tipo_cliente" class="form-control" required>
                                    <option value="natural">Natural</option>
                                    <option value="juridico">Jurídico</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="celular">Celular</label>
                                <input type="tel" id="celular" name="celular" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="descuento">Descuento</label>
                                <input type="number" id="descuento" name="descuento" class="form-control" min="0" step="0.01">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="campos_natural">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="genero">Género:</label>
                                    <select name="genero" id="genero" class="form-control">
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                            </div>
                            <div id="campos_juridico" style="display:none;">
                                <div class="form-group">
                                    <label for="razon_social">Razón Social</label>
                                    <input type="text" id="razon_social" name="razon_social" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="representante_legal">Representante Legal</label>
                                    <input type="text" id="representante_legal" name="representante_legal" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="email_juridico">Email Jurídico</label>
                                    <input type="email" id="email_juridico" name="email_juridico" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Registrar Cliente</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('tipo_cliente').addEventListener('change', function() {
        var camposNatural = document.getElementById('campos_natural');
        var camposJuridico = document.getElementById('campos_juridico');
        if (this.value === 'natural') {
            camposNatural.style.display = 'block';
            camposJuridico.style.display = 'none';
        } else {
            camposNatural.style.display = 'none';
            camposJuridico.style.display = 'block';
        }
    });
    document.getElementById('tipo_cliente').dispatchEvent(new Event('change'));
</script>