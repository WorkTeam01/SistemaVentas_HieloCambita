<?php
require_once '../../App/config.php';
require_once '../../Views/Layouts/sesion.php';

include_once '../../Views/Layouts/header.php';

include_once '../../App/Controllers/productos/listado_de_productos.php';
include_once '../../App/Controllers/proveedores/listado_de_proveedores.php';
include_once '../../App/Controllers/abasto/cargar_abasto.php';

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Actualizar abasto</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Datos del abasto</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"> <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body" style="display: block;">
                                    <div class="d-flex">
                                        <h5>Datos del producto</h5>
                                        <button type="button" class="btn btn-primary btn-sm ml-2" data-toggle="modal" data-target="#modal-buscar_producto">
                                            <i class="fas fa-search"></i> Buscar producto
                                        </button>
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
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $contador = 0;
                                                                    foreach ($productos_datos as $producto_dato) {
                                                                        $id_producto = $producto_dato['IdProducto'];
                                                                    ?>
                                                                        <tr>
                                                                            <td class="text-center"><?php echo $contador += 1; ?></td>
                                                                            <td>
                                                                                <button type="button" class="btn btn-info" id="btn_seleccionar<?php echo $id_producto; ?>">
                                                                                    Seleccionado
                                                                                </button>
                                                                                <script>
                                                                                    $('#btn_seleccionar<?php echo $id_producto; ?>').click(function() {

                                                                                        var id_producto = <?php echo $id_producto; ?>;
                                                                                        $('#id_producto').val(id_producto);

                                                                                        var codigo = "<?php echo $producto_dato['CodigoProducto']; ?>";
                                                                                        $('#codigo').val(codigo);

                                                                                        var categoria = "<?php echo $producto_dato['NombreCategoria']; ?>";
                                                                                        $('#categoria').val(categoria);

                                                                                        var nombre = "<?php echo $producto_dato['NombreProducto']; ?>";
                                                                                        $('#nombre_producto').val(nombre);

                                                                                        var descripcion_producto = "<?php echo $producto_dato['DescripcionProducto']; ?>";
                                                                                        $('#descripcion_producto').val(descripcion_producto);

                                                                                        var stock = "<?php echo $producto_dato['Stock']; ?>";
                                                                                        $('#stock').val(stock);
                                                                                        $('#stock_actual').val(stock);

                                                                                        var stock_minimo = "<?php echo $producto_dato['StockMinimo']; ?>";
                                                                                        $('#stock_minimo').val(stock_minimo);

                                                                                        var stock_maximo = "<?php echo $producto_dato['StockMaximo']; ?>"
                                                                                        $('#stock_maximo').val(stock_maximo);

                                                                                        var precio_compra = "<?php echo $producto_dato['PrecioCompra']; ?>"
                                                                                        $('#precio_compra').val(precio_compra);

                                                                                        var precio_venta = "<?php echo $producto_dato['PrecioVenta']; ?>"
                                                                                        $('#precio_venta').val(precio_venta);

                                                                                        var fecha_ingreso = "<?php echo $producto_dato['FechaIngreso']; ?>";
                                                                                        $('#fecha_ingreso').val(fecha_ingreso);

                                                                                        var ruta_img = "<?php echo $URL . '/Views/Productos/img_productos/' . $producto_dato['ImagenProducto']; ?>";
                                                                                        $('#img_producto').attr({
                                                                                            src: ruta_img
                                                                                        });

                                                                                        $('#modal-buscar_producto').modal('toggle');
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
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row" style="font-size: 14px;">
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" id="id_producto" value="<?php echo $id_producto_tabla ?>" class="form-control" hidden>
                                                        <label>Código</label>
                                                        <input type="text" id="codigo" value="<?php echo $codigo; ?>" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Categoría</label>
                                                        <input type="text" id="categoria" value="<?php echo $nombre_categoria; ?>" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Nombre del producto</label>
                                                        <input type="text" id="nombre_producto" value="<?php echo $nombre_producto; ?>" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Descripción del producto</label>
                                                        <textarea type="text" rows="3" id="descripcion_producto" class="form-control" disabled><?php echo $descripcion_producto; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Fecha de ingreso</label>
                                                        <input type="text" id="fecha_ingreso" value="<?php echo $fecha_ingreso; ?>" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Stock</label>
                                                        <input type="text" id="stock" value="<?php echo $stock; ?>" class="form-control bg-warning" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Stock mínimo</label>
                                                        <input type="text" id="stock_minimo" value="<?php echo $stock_minimo; ?>" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Stock máximo</label>
                                                        <input type="text" id="stock_maximo" value="<?php echo $stock_maximo; ?>" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Precio de compra</label>
                                                        <input type="text" id="precio_compra" value="<?php echo $precio_compra; ?>" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Precio de venta</label>
                                                        <input type="text" id="precio_venta" value="<?php echo $precio_venta; ?>" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Imagen del producto</label>
                                                <img class="rounded mx-auto d-block" id="img_producto" src="<?php echo $URL . "/Views/Productos/img_productos/" . $imagen; ?>" width="50%" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="d-flex">
                                        <h5>Datos del proveedor</h5>
                                        <button type="button" class="btn btn-primary btn-sm ml-2" data-toggle="modal" data-target="#modal-buscar_proveedor">
                                            <i class="fas fa-search"></i> Buscar proveedor
                                        </button>
                                        <!-- Modal para buscar proveedor -->
                                        <div class="modal fade" id="modal-buscar_proveedor">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h4 class="modal-title">Busqueda del proveedor</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="table table-responsive">
                                                            <div class="table-responsive">
                                                                <!-- La tabla completa se incluye aquí -->
                                                                <table id="example2" class="table table-bordered table-hover table-striped table-sm">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center">Nro</th>
                                                                            <th class="text-center">Seleccionar</th>
                                                                            <th class="text-center">Nombre de proveedor</th>
                                                                            <th class="text-center">Celular</th>
                                                                            <th class="text-center">Telefono</th>
                                                                            <th class="text-center">Email</th>
                                                                            <th class="text-center">Dirección</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $contador = 0;
                                                                        foreach ($proveedores_datos as $proveedores_dato) {
                                                                            $id_proveedor = $proveedores_dato['IdProveedor'];
                                                                        ?>
                                                                            <tr>
                                                                                <td class="text-center"><?php echo $contador += 1; ?></td>
                                                                                <td>
                                                                                    <div class="text-center">
                                                                                        <button type="button" class="btn btn-info" id="btn_seleccionar_proveedor<?php echo $id_proveedor; ?>">
                                                                                            Seleccionado
                                                                                        </button>
                                                                                    </div>
                                                                                    <script>
                                                                                        $('#btn_seleccionar_proveedor<?php echo $id_proveedor; ?>').click(function() {

                                                                                            var id_proveedor = "<?php echo $id_proveedor; ?>"
                                                                                            $('#id_proveedor').val(id_proveedor);

                                                                                            var nombre_proveedor = "<?php echo $proveedores_dato['NombreProveedor']; ?>";
                                                                                            $('#nombre_proveedor').val(nombre_proveedor);

                                                                                            var celular = "<?php echo $proveedores_dato['CelularProveedor']; ?>";
                                                                                            $('#celular').val(celular);

                                                                                            var telefono = "<?php echo $proveedores_dato['TelefonoProveedor']; ?>";
                                                                                            $('#telefono').val(telefono);

                                                                                            var email = "<?php echo $proveedores_dato['EmailProveedor']; ?>";
                                                                                            $('#email').val(email);

                                                                                            var direccion = "<?php echo $proveedores_dato['DireccionProveedor']; ?>";
                                                                                            $('#direccion').val(direccion);

                                                                                            $('#modal-buscar_proveedor').modal('toggle');
                                                                                        });
                                                                                    </script>
                                                                                </td>
                                                                                <td><?php echo $proveedores_dato['NombreProveedor']; ?></td>
                                                                                <td class="text-center">
                                                                                    <a href="http://wa.me/591<?php echo $proveedores_dato['CelularProveedor']; ?>" target="_blank" class="btn btn-success">
                                                                                        <i class="fas fa-phone-alt"></i>
                                                                                        <?php echo $proveedores_dato['CelularProveedor']; ?>
                                                                                    </a>
                                                                                </td>
                                                                                <td><?php echo $proveedores_dato['TelefonoProveedor']; ?></td>
                                                                                <td><?php echo $proveedores_dato['EmailProveedor']; ?></td>
                                                                                <td><?php echo $proveedores_dato['DireccionProveedor']; ?></td>
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
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="id_proveedor" value="<?php echo $id_proveedor_tabla ?>" hidden>
                                                <label for="nombre_proveedor">Nombre del proveedor</label>
                                                <input type="text" id="nombre_proveedor" value="<?php echo $nombre_proveedor_tabla; ?>" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="celular">Celular</label>
                                                <input type="number" id="celular" value="<?php echo $celular_proveedor; ?>" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="telefono">Telefono</label>
                                                <input type="number" id="telefono" value="<?php echo $telefono_proveedor; ?>" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" value="<?php echo $email_proveedor; ?>" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="direccion">Dirección</label>
                                                <textarea id="direccion" rows="3" class="form-control" disabled><?php echo $direccion_proveedor; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-outline card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Detalle del abasto</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Número del abasto</label>
                                                <input type="text" class="form-control" value="<?php echo $nro_abasto ?>" disabled>
                                                <input type="text" value="<?php echo $nro_abasto ?>" id="nro_abasto" hidden>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Fecha del abasto</label>
                                                <input type="date" class="form-control" id="fecha_abasto" value="<?php echo $fecha_abasto; ?>">
                                                <small class="text-danger d-none" id="lbl_fecha_abasto">* Este campo es necesario rellenar</small>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Comprobante de la compra</label>
                                                <input type="text" class="form-control" id="comprobante" value="<?php echo $comprobante; ?>">
                                                <small class="text-danger d-none" id="lbl_comprobante">* Este campo es necesario rellenar</small>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Precio del abasto</label>
                                                <input type="text" class="form-control" id="precio_abasto" value="<?php echo $precio_abasto; ?>">
                                                <small class="text-danger d-none" id="lbl_precio_abasto">* Este campo es necesario rellenar</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Stock actual</label>
                                                <input type="text" id="stock_actual" value="<?= $stock  = $stock - $cantidad; ?>" class="form-control bg-warning">
                                                <small class="text-danger d-none" id="lbl_stock">* Este campo es necesario rellenar</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Stock total</label>
                                                <input type="text" id="stock_total" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Cantidad del abasto</label>
                                                <input type="number" id="cantidad_abasto" value="<?php echo $cantidad; ?>" class="form-control text-center">
                                                <small class="text-danger d-none" id="lbl_cantidad_abasto">* Este campo es necesario rellenar</small>
                                            </div>
                                            <script>
                                                $('#cantidad_abasto').keyup(function() {
                                                    var stock_actual = $('#stock_actual').val();
                                                    var stock_abasto = $('#cantidad_abasto').val();

                                                    var total = parseInt(stock_actual) + parseInt(stock_abasto);
                                                    $('#stock_total').val(total);
                                                });
                                            </script>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Usuario</label>
                                                <input type="text" class="form-control" value="<?php echo $nombre_usuario; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-success btn-block" id="btn_actualizar_compra">Actualizar compra</button>
                                            <a href="<?php echo $URL; ?>/Views/Abasto" class="btn btn-secondary btn-block">Cancelar</a>
                                        </div>
                                    </div>
                                    <script>
                                        $('#btn_actualizar_compra').click(function() {

                                            var id_abasto = <?php echo $id_abasto; ?>;
                                            var id_producto = $('#id_producto').val();
                                            var nro_abasto = $('#nro_abasto').val();
                                            var fecha_abasto = $('#fecha_abasto').val();
                                            var id_proveedor = $('#id_proveedor').val();
                                            var comprobante = $('#comprobante').val();
                                            var id_usuario = <?php echo $id_usuario_sesion; ?>;
                                            var precio_abasto = $('#precio_abasto').val();
                                            var cantidad_abasto = $('#cantidad_abasto').val();
                                            var stock_total = $('#stock_total').val();

                                            if (id_producto == "") {
                                                $('#id_producto').focus();
                                                alert("Debe llenar el campo del producto");
                                                return;
                                            }
                                            if (nro_abasto == "") {
                                                $('#nro_abasto').focus();
                                                alert("Debe llenar el campo de numero de compra");
                                                return;
                                            }
                                            if (fecha_abasto == "") {
                                                $('#fecha_abasto').focus();
                                                $('#lbl_fecha_abasto').removeClass('d-none');
                                                return;
                                            } else {
                                                $('#lbl_fecha_abasto').addClass('d-none');
                                            }
                                            if (id_proveedor == "") {
                                                $('#id_proveedor').focus();
                                                alert("Debe llenar el campo del proveedor");
                                                return;
                                            }
                                            if (comprobante == "") {
                                                $('#comprobante').focus();
                                                $('#lbl_comprobante').removeClass('d-none');
                                                return;
                                            } else {
                                                $('#lbl_comprobante').addClass('d-none');
                                            }
                                            if (id_usuario == "") {
                                                $('#id_usuario').focus();
                                                alert("Debe llenar el campo del usuario");
                                                return;
                                            }
                                            if (precio_abasto == "") {
                                                $('#precio_abasto').focus();
                                                $('#lbl_precio_abasto').removeClass('d-none');
                                                return;
                                            } else {
                                                $('#lbl_precio_abasto').addClass('d-none');
                                            }
                                            if (cantidad_abasto == "") {
                                                $('#cantidad_abasto').focus();
                                                $('#lbl_cantidad_abasto').removeClass('d-none');
                                                return;
                                            } else {
                                                $('#lbl_cantidad_abasto').addClass('d-none');
                                            }
                                            var url = "../../App/Controllers/abasto/update.php";
                                            $.get(url, {
                                                id_abasto: id_abasto,
                                                id_producto: id_producto,
                                                nro_abasto: nro_abasto,
                                                fecha_abasto: fecha_abasto,
                                                id_proveedor: id_proveedor,
                                                comprobante: comprobante,
                                                id_usuario: id_usuario,
                                                precio_abasto: precio_abasto,
                                                cantidad_abasto: cantidad_abasto,
                                                stock_total: stock_total
                                            }, function(datos) {
                                                $('#respuesta_update').html(datos);
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div id="respuesta_update"></div>
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
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ proveedores",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 proveedores",
            "sInfoFiltered": "(filtrado de un total de _MAX_ proveedores)",
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